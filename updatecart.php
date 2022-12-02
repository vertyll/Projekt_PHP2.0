<?php
	session_start();
	require_once "config.php";
	$query = "UPDATE `cart` SET `quantity`=".$_POST["quantity"]." WHERE product_id=".$_POST["product-id"]." AND user_id=".$_SESSION["id"];
	mysqli_query($link,$query);
	mysqli_close($link);
    header("location: shopping-cart.php");
	exit();
?>