<?php
	session_start();
	require_once "config.php";
	$query = "INSERT INTO reviews(id_user,title,content,stars,date,id_product) VALUES(".$_SESSION["id"].",'".$_POST["title"]."','".$_POST["content"]."',".$_POST["stars"].",'".date("Y-m-d")."',".$_POST["productid"].")";
	mysqli_query($link,$query);
	mysqli_close($link);
    header("location: product-page.php?id=".$_POST["productid"]);
	exit();
?>