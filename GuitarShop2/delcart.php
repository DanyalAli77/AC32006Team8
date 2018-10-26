<?php
session_start();
foreach ($_SESSION['cart'] as $key => $id) {

        unset($_SESSION['cart'][$id]);
}
        // ... (the rest of the code)
header('location:cart.php');
?>