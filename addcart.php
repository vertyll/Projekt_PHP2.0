<?php
	session_start();
	require_once "config.php";
	$query = "INSERT INTO cart(quantity, user_id, product_id) VALUES(1,".$_SESSION["id"].",".$_POST['product-id'].")";
	mysqli_query($link,$query);
	mysqli_close($link);
    header("location: product-page.php?id=".$_POST["product-id"]);
	exit();
?>