<?php
session_start();
//start a new session
if (empty($_SESSION['cart'])) {
	    $_SESSION['cart'] = array();
}
//put product id in the array
if(count($_SESSION['cart']) == 10)
{
    //Error prevention to stop customer filling cart over the maximum size
    //Given more time this would be a pop-up on the website.
    echo "Maximum cart size is 10";
}
else
{
    array_push($_SESSION['cart'], $_GET['id']);
}

if(isset($_SESSION['loggedin']))
{
    header('location: welcome.php?status=success');
}
else {
    header('location: index.php?status=success');
}
?>

