<?php
include 'includes/header.php';
?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">
                    <?php
						echo $_SESSION["role"];
                        echo "Brak uprawnień do panelu administracyjnego. Błąd 401 ";
                        echo "<br>";
                    ?> </h2>
                    <p>
                    <?php
                        echo "<a href='index.php'>Strona Główna </a>";
                    ?>
                    </p>
                </div>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>