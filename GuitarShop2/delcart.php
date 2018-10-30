<?php
session_start();
if (isset($_SESSION['cart'])) {
    $key=array_search($_GET['remove'],$_SESSION['cart']);
    if($key!==false)
        unset($_SESSION['cart'][$key]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
}

header('location:cart.php');
?>

