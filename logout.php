<?php
session_start();
$_SESSION = array();
$_SESSION["loggedin"] = false;
header("location: login.php");
exit;
?>