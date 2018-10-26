<?php
session_start();
//start a new session
if (empty($_SESSION['cart'])) {
	    $_SESSION['cart'] = array();
}
//put product id in the array
array_push($_SESSION['cart'], $_GET['id']);
header('location: index.php?status=success');
?>

