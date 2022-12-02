<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact Us - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>
<?php
require_once "config.php";
if((isset($_POST['submit'])))
{
$Name = $link->real_escape_string($_POST['name']);
$Email = $link->real_escape_string($_POST['email']);
$Subject = $link->real_escape_string($_POST['subject']);
$Comments = $link->real_escape_string($_POST['message']);
$sql="INSERT INTO contact (name, subject, email, message) VALUES ('".$Name."','".$Email."', '".$Subject."', '".$Comments."')";
if(!$result = $link->query($sql)){
die('Wystąpił błąd [' . $link->error . ']');
}
else
   echo "Dziękujemy! Wkrótce się z Tobą skontaktujemy.";
}
?>
<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php">MebDev</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item"><a class="nav-link" href="shopping-cart.php">Koszyk</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalog-page.php">Sklep</a></li>
                    <li class="nav-item"><a class="nav-link" href="about-us.php">o nas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact-us.php">kontakt</a></li>
                    <li class="nav-item"><a class="nav-link active" href="admin.php">Panel administracyjny</a></li>
                    <?php
                    session_start();
                    // if(isset($_SESSION["loggedin"]) == false){
                    //     $_SESSION["loggedin"] = false; 
                    // }
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
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Skontaktuj się z nami</h2>
                </div>
                <form method="POST">
                    <?php
					if(empty($_SESSION["loggedin"]) == false){
						if($_SESSION["loggedin"]==true){
							echo '<div class="mb-3"><label class="form-label" for="name">Nazwa</label><input class="form-control" type="text" id="name" name="name" disabled value='.$_SESSION["username"];'></div>';
						}
						elseif($_SESSION['loggedin']==false){
							echo '<div class="mb-3"><label class="form-label" for="name">Nazwa</label><input class="form-control" type="text" id="name" name="name"></div>';
						}
					}
					else{
						echo '<div class="mb-3"><label class="form-label" for="name">Nazwa</label><input class="form-control" type="text" id="name" name="name"></div>';
					}
                    ?>
                    <div class="mb-3"><label class="form-label" for="subject">Temat</label><input class="form-control" type="text" id="subject" name="subject"></div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email"></div>
                    <div class="mb-3"><label class="form-label" for="message">Wiadomość</label><textarea class="form-control" id="message" name="message"></textarea></div>
                    <div class="mb-3"><button class="btn btn-primary" type="submit" name="submit">Wyślij</button></div>
                </form>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>