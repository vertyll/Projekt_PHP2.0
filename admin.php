<?php
ob_start();
	require_once "config.php";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($_POST["nameC"])){
			$resultAC = mysqli_query($link, "INSERT INTO category (name) VALUES ('".$_POST["nameC"]."')");
		}
		if(!empty($_POST["nameB"])){
			$resultAB = mysqli_query($link, "INSERT INTO brands (name) VALUES ('".strtoupper($_POST['nameB'])."')");
		}
		if(!empty($_POST["name"])){
			$path = './assets/img/products';
			$dir = opendir($path);
			$countFiles = 0;
			while($file = readdir($dir))
			{
				$countFiles++;
			}
			$number = $countFiles + 1-2;
			$array = explode('.', $_FILES["picture"]["name"]);
            $ext = end($array);
			$picture = $number.".".$ext;
			move_uploaded_file($_FILES["picture"]["tmp_name"], "./assets/img/products/".$picture);
			$resultAP = mysqli_query($link, "INSERT INTO products (name, description, id_category, id_brand, price, picture) VALUES ('".$_POST["name"]."', '".$_POST["description"]."', ".$_POST["category"].", ".$_POST["brand"].", ".$_POST["price"].", '".$picture."')");
		}
	}
	
	include 'includes/header.php';
?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Panel Administracyjny</h2>
					<h2 class="text-info"><a href="list.php" style="text-decoration: none;">Lista użytkowników -></a></h2>
                    <?php
                    if($_SESSION["role"] == null || $_SESSION["role"] != "admin"){
                        header("location: error.php");
                    }
                    ?>
					<?php
					if(!empty($resultAP) && $resultAP==true){
						echo '<h6 style="color: red;">Dodano Produkt</h6>';
					}
					?>
					<h4>Dodaj produkt</h4>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" autocomplete="on">
						<label class="form-label">Nazwa</label>
						<input class="form-control" type="text" name="name" required min="3">
						<label class="form-label">Opis</label>
						<textarea class="form-control" name="description" required min="5"></textarea>
						<label class="form-label">Kategoria</label>
						<select class="form-control" name="category" required>
						<?php
							$results = mysqli_query($link, "SELECT id, name FROM category");
							while($row = mysqli_fetch_row($results)){
							echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
						?>
						</select>
						<label class="form-label">Marka</label>
						<select class="form-control" name="brand" required>
						<?php
							$results = mysqli_query($link, "SELECT id, name FROM brands");
							while($row = mysqli_fetch_row($results)){
							echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
							mysqli_close($link);
						?>
						</select>
						<label class="form-label">Cena</label>
						<input class="form-control" name="price" type="number" step="0.01" min="0.00">
						<label class="form-label">Obrazek</label>
						<input class="custom-file-input" type="file" name="picture">
						<button type="submit">Dodaj produkt</button>
					</form>
					<?php
					if(!empty($resultAC) && $resultAC == true){
						echo '<h6 style="color: red;">Dodano Kategorie</h6>';
					}
					?>
					<h4>Dodaj Kategorie</h4>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						<label class="form-label">Nazwa kategorii</label>
						<input class="form-control" type="text" name="nameC" required min="3">
						<button type="submit">Dodaj kategorie</button>
					</form>
					<?php
					if(!empty($resultAB) && $resultAB==true){
						echo '<h6 style="color: red;">Dodano Markę</h6>';
					}
					?>
					<h4>Dodaj Markę</h4>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						<label class="form-label">Nazwa marki</label>
						<input class="form-control" type="text" name="nameB" required min="3">
						<button type="submit">Dodaj markę</button>
					</form>
                </div>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>