<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php">MebDev</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="shopping-cart.php">Koszyk</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalog-page.php">Sklep</a></li>
                    <li class="nav-item"><a class="nav-link" href="about-us.php">o nas</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">kontakt</a></li>
                    <?php
                    session_start();
                    // if(isset($_SESSION["loggedin"]) == false){
                    //     $_SESSION["loggedin"] = false; 
                    // }
                    if (!isset($_SESSION['role'])) {
                        $_SESSION['role'] = null;
                    }
                    if($_SESSION["role"] == 'admin'){
                        echo '<li class="nav-item"><a class="nav-link" href="admin.php">Panel administracyjny</a></li>';
                    }
                    elseif(empty($_SESSION["loggedin"]) == false){
                        echo '';
                    }
					if(empty($_SESSION["loggedin"]) == false){
						if($_SESSION["loggedin"]==true){
							echo '<a class="nav-link" href="edit.php">'.$_SESSION["username"] .'</a>';
						}
						else{
							echo '<a class="nav-link" href="login.php"><span>Konto</span></a>';
						}
					}
					else{
						echo '<a class="nav-link" href="login.php"><span>Konto</span></a>';
					}
                    ?>
                </ul>
            </div>
        </div>
    </nav>