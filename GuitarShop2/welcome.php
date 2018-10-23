<?php
session_start();
// Check if the user is logged in, if not then redirect him to index.php page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

require_once ('config.php');

//Change title of website
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();
$title = "Welcome";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;



?>

<?php
if(isset($_SESSION['loggedin'])) {
    echo '<li class="nav-item inl"><a class="nav-link inlog" href="logout.php">Log Out</a></li>';
    echo '<a class="navbar-brand" href="welcome.php">GuitarShop</a>';
} else {
    echo '<li class="nav-item inl"><a class="nav-link inlog" href="login.php">Log In</a></li>';
}
?>

    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>




<?php
include ('footer.php');
?>