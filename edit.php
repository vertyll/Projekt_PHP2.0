<?php
include 'includes/header.php';
    if(!isset($_SESSION["loggedin"])){
        header("Location: index.php");
    }

include 'config.php';
?>
<?php
    $currentUser = $_SESSION["username"];
    $sql = 'SELECT * FROM users WHERE username="'.$currentUser.'"';
    // print_r($sql);
    $result = mysqli_query($link, $sql);
    $mysql = mysqli_fetch_array($result);
    if($mysql == false || $mysql == null){
        echo "Nic nie ma";
    }
    // print_r($result['num_rows']);
    ?>
<main class="page login-page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Edycja profilu</h2>
            </div>
            <div class="wrapper">
                    <form action="edit_profile.php" method="post">
                                <div class="form-group">
                                    <label>Nazwa użytkownika</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $mysql['username']; ?>">
                                    <span class="invalid-feedback"></span>
                                </div>    
                                <div class="form-group">
                                    <label>Hasło</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $mysql['password']; ?>">
                                    <span class="invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label>Potwierdź hasło</label>
                                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $mysql['password']; ?>">
                                    <span class="invalid-feedback"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submit">Aktualizuj dane</button>
                                        <a href="logout.php">Wyloguj się</a>
                                    </div>
                    </form>
            </div>
        </div>
    </section>
</main> 
<?php
include 'includes/footer.php';
?>