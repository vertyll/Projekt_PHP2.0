<?php
session_start();
include 'includes/header.php';
require_once "config.php";
$select_cart  = mysqli_query($link, "SELECT quantity, product_id FROM cart WHERE user_id=".$_SESSION["id"]);
$grand_total = 0;
if(mysqli_num_rows($select_cart) > 0){
   while($fetch_cart = mysqli_fetch_assoc($select_cart)){
	   $result = mysqli_query($link, "SELECT picture, name, price FROM products WHERE id=".$fetch_cart['product_id']);
	   $row = mysqli_fetch_array($result);
	   
?>
    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Koszyk</h2>
                </div>
                <div class="content">
                    <div class="row g-0">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">
                                <div class="product">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3">
                                            <div class="product-image">
                                                <img class="img-fluid" src="assets/img/products/<?php echo $row[0]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5 product-info"><a class="product-name" href="#"><?php echo $row[1]; ?></a>
                                            <div class="product-specs">
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
										<form action="updatecart.php" method="POST">
                                        <div class="col-6 col-md-2 quantity"><label class="form-label d-none d-md-block" for="quantity">Ilość</label><input type="number" id="number" class="form-control quantity-input" value="<?php echo $fetch_cart['quantity']; ?>"name="quantity"></div>
                                        <div class="col-6 col-md-2 price"><span><?php $sum = $row[2] * $fetch_cart['quantity'];
										$grand_total = $grand_total + $sum;
										echo $sum;
										?> zł</span></div>
										<input type="number" name="product-id" hidden value="<?php echo $fetch_cart['product_id']?>">
										<button class="btn btn-primary" type="submit">Aktualizuj</button>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Podliczenie</h3>
                                <h4><span class="text">Razem</span><span class="price"><?php echo $grand_total ?> zł</span></h4><a href="payment-page.php"><button class="btn btn-primary btn-lg d-block w-100" type="button">Zamów</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
$grand_total += $sub_total;  
};
};
include 'includes/footer.php';
?>