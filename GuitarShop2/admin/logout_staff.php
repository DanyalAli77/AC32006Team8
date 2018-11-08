<?php
/**
 * Created by PhpStorm.
 * User: Juura
 * Date: 23/10/2018
 * Time: 16:00
 */

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: index.php");
exit;
?>