<?php
session_start();

require_once('config.php');
if(isset($_SESSION['loggedin']))
{
    include('header_inside.php');
}
else{
    include ('header.php');
}
if(!empty($_SESSION['cart'])) {
    $items =  $_SESSION['cart'];
}

?>

    <div class="container">
        <p>
        <h1>Contact us</h1>
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </div>



<?php
include ('footer.php');
?>