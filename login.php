<?php
ob_start();
include 'includes/header.php';
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = $login_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Proszę podać nazwę użytkownika";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Proszę podać swoje hasło";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";      
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["role"] = $role;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            if($role != "admin"){
                                header("location: index.php");
                            } 
                            else{
                                header("location: admin.php");
                            }                    
                        } else{
                            $login_err = "Nieprawidłowa nazwa użytkownika lub hasło";
                        }
                    }
                } else{
                    $login_err = "Nieprawidłowa nazwa użytkownika lub hasło";
                }
            } else{
                echo "Ups! Coś poszło nie tak. Proszę spróbować ponownie później";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Logowanie</h2>
                </div>
                <?php
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3"><label class="form-label" for="email">Nazwa użytkownika</label><input class="form-control item <?php echo (!empty($username_err)) ? 'jest-nieważny' : ''; ?>" value="<?php echo $username; ?>" type="text" name="username" required></div>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <div class="mb-3"><label class="form-label" for="password">Hasło</label><input class="form-control <?php echo(!empty($password_err)) ? 'jest-nieważny' : '';?>" type="password" name="password" required></div>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <div class="mb-3">
                        <div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox"><label class="form-check-label" for="checkbox">Zapamiętaj mnie</label></div>
                    </div><button class="btn btn-primary" type="submit">Zaloguj</button>
                    <a href="register.php">Zarejestruj się</a>
                </form>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>