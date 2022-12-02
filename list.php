<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista użytkowników</title>
</head>
<body>
    <br><br><br><br>
    <main class="page login-page">
    <section class="clean-block clean-form dark">
    <div class="container">
    <div class="block-heading">
    <h2 class="text-info"> Lista użytkowników </h2>
</div>
    <table class="table table-bordered">
        <tr class="bg-dark text-white">
            <td> ID </td>
            <td> Nazwa użytkownika </td>
            <td> Hasło </td>
            <td> Stworzone </td>
            <td> Rola </td>
            <td> Usuń konto </td>
</tr>
<tr>
    <?php
    include 'includes/header.php';
    include_once 'config.php';
    if($_SESSION["role"] == null || $_SESSION["role"] != "admin"){
        header("location: error.php");
    }
    $sql = 'SELECT * FROM users WHERE role="user"';
    $result = mysqli_query($link,$sql);   
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['username'];?></td>
        <td><?php echo $row['password'];?></td>
        <td><?php echo $row['created_at'];?></td>
        <td><?php echo $row['role'];?></td>
        <td><?php echo "<a href='delete.php?id=".$row['id']."''>Usuń"?></td>
    </tr>
        <?php
    }
    ?>
    </table>
</div>
</section>
</main>
<?php
include 'includes/footer.php';
?>
</body>
</html>