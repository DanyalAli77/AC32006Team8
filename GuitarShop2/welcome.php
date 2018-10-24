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
include("header_inside.php");
$buffer=ob_get_contents();
ob_end_clean();
$title = "Welcome";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;



?>

<div class="container">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</div>



<?php
include ('footer.php');
?>