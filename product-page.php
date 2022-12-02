<?php
	include 'includes/header.php';
	require_once "config.php";
	$result = mysqli_query($link,"SELECT P.name, P.description, C.name, B.name, P.price, P.picture FROM products P JOIN category C ON P.id_category = C.id JOIN brands B ON P.id_brand = B.id WHERE P.id = ".$_GET["id"]);
	$row = mysqli_fetch_array($result);
	$descriptionp = explode(".",$row[1]);
	$price = $row[4];
	if(isset($_POST['add_to_cart'])){

		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_picture = $_POST['product_picture'];
		$product_quantity = 1;
	 
		$select_cart = mysqli_query($link, "SELECT * FROM cart WHERE name = '$product_name'");
	 
		if(mysqli_num_rows($select_cart) > 0){
		   $message[] = 'Produkt jest już dodany do koszyka';
		}else{
		   $insert_product = mysqli_query($link, "INSERT INTO cart(name, price, picture, quantity) VALUES('$product_name', '$product_price', '$product_picture', '$product_quantity')");
		   $message[] = 'Produkt został dodany do koszyka';
		}
	 
	 }

	 if(isset($message)){
		foreach($message as $message){
		   echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
		};
	 };
?>
   <div class="box-container">

</div>
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Strona produktu - <?php echo $row[0];?></h2>
                    <p>
					<?php
						echo $descriptionp[0];
					?>
					</p>
                </div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div id="product-preview" class="vanilla-zoom">
                                        <div class="zoomed-picture"><img class="img-fluid" src="assets/img/products/<?php echo $row[5];?>"></div>
                                        <div class="sidebar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3><?php echo $row[0];?></h3>
                                    <div class="rating">
									<?php
										$result1 = mysqli_query($link,"SELECT avg(stars) FROM reviews WHERE id_product = ".$_GET["id"]);
										if($result1 != null){
										$row1 = mysqli_fetch_array($result1);
										$i = 1;
										if(!empty($row1[0])){
										while($i<=$row1[0])
										{
											if($i+1>$row1[0] && $i+0.5<=$row1[0]){
												echo '<picture src="assets/img/star-half-empty.svg">';
											}
											else{
												echo '<img src="assets/img/star.svg">';
											}
											$i++;
										}
										$emptystars= 5-$i;
										while($emptystars >= 0){
											echo '<img src="assets/img/star-empty.svg">';
											$emptystars--;
										}
										}
										else
										{
											for($i=1;$i<=5;$i++){
												echo '<img src="assets/img/star-empty.svg">';
											}
										}
										}
									?>
									</div>
                                    <div class="price">
                                        <h3><?php echo $price;?> zł</h3>
                                    </div>
									<form action="addcart.php" method="POST">
									<input name="product-id" type="number" hidden value="<?php echo $_GET["id"]?>">
									<button class="btn btn-primary" type="submit"><i class="icon-basket" name="add_to_cart"></i>Dodaj do koszyka</button>
									</form>
                                    <div class="summary">
                                        <p>
										<?php
										if(count($descriptionp) < 5)
										{
											for($i=0;$i<count($descriptionp);$i++)
											{
												echo $descriptionp[$i];
											}
										}
										else
										{
											for($i=0;$i<5;$i++)
											{
												echo $descriptionp[$i];
											}
										}
										?>
										</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" id="description-tab" href="#description">Opis produktu</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" id="specifications-tabs" href="#specifications">Specyfikacje</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" id="reviews-tab" href="#reviews">Opinie</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active description" role="tabpanel" id="description">
									<p>
									<?php
										if(count($descriptionp) < 5)
										{
											for($i=0;$i<count($descriptionp);$i++)
											{
												echo $descriptionp[$i];
											}
										}
										else
										{
											for($i=0;$i<5;$i++)
											{
												echo $descriptionp[$i];
											}
										}
									?>
									</p>
									<?php
									if(count($descriptionp) > 5 && count($descriptionp) < 12){
										echo '<div class="row">';
											echo '<div class="col-md-5">';
												echo '<figure class="figure"></figure>';
											echo '</div>';
											echo '<div class="col-md-7">';
												echo '<h4>'.$row[0].'</h4>';
												echo '<p>';
												for($i=5; $i<12; $i++){
													echo $descriptionp[$i];
												}
												echo '</p>';
											echo '</div>';
										echo '</div>';
									}
									if(count($descriptionp) > 12){
                                    echo '<div class="row">';
                                        echo '<div class="col-md-7 right">';
                                            echo '<h4>'.$row[0].'</h4>';
											echo '<p>';
											for($i=12; $i<count($descriptionp); $i++){
												echo $descriptionp[$i];
											}
											echo '</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-5">';
                                            echo '<figure class="figure"></figure>';
                                        echo '</div>';
                                    echo '</div>';
									}
									?>
                                </div>
                                <div class="tab-pane fade specifications" role="tabpanel" id="specifications">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="stat">Kategoria</td>
                                                    <td><?php echo $row[2]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">Marka</td>
                                                    <td><?php echo $row[3]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="reviews">
									<?php
										$result = mysqli_query($link,"SELECT R.title, R.content, R.stars, U.username, R.date FROM reviews R JOIN users U ON R.id_user = U.id WHERE R.id_product = ".$_GET["id"]);
										while($row = mysqli_fetch_array($result)){
											echo '<div class="reviews">';
												echo '<div class="review-item">';
													echo '<div class="rating">';
													for($i=1;$i<=$row[2];$i++){
														echo '<img src="assets/img/star.svg">';
													}
													echo '</div>';
													echo '<h4>'.$row[0].'</h4><span class="text-muted"><a href="#">'.$row[3].'</a>, '.$row[4].'</span>';
													echo '<p>'.$row[1].'</p>';
												echo '</div>';
											echo '</div>';
										}
										mysqli_close($link);
									?>
									<?php
									if(empty($_SESSION["loggedin"])==false){
										if($_SESSION["loggedin"]==true){
											echo '<form action="add_review.php" method="POST">';
												echo '<input class="form-control" type="number" name="productid" value="'.$_GET["id"].'" hidden required>';
												echo '<label class="form-label">tytuł</label>';
												echo '<input class="form-control" type="text" name="title" required>';
												echo '<label class="form-label">Ilość Gwiazdek (1-5)</label>';
												echo '<input class="form-control" type="number" name="stars" step="1" min="1" max="5" required>';
												echo '<label class="form-label">Komentarz</label>';
												echo '<textarea class="form-control" name="content" required min="3"></textarea>';
												echo '<button class="btn btn-primary" type="submit">Dodaj komentarz</button>';
											echo '</form>';
										}
									}
									?>
                                </div>
							</div>
                        </div>
                    </div>
                    <div class="clean-related-items">
                        <div class="items"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>