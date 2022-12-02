<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'demo');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($_SESSION["role"] == null || $_SESSION["role"] != "admin"){
    header("location: error.php");
}
$id = intval($_GET['id']);
$sql="DELETE FROM users where id = " . $id;

if (!mysqli_query($link,$sql))
{
die('Error: ' . mysqli_error($link));
}
echo "Record Deleted";
header("Location: list.php");

mysqli_close($link);
?>