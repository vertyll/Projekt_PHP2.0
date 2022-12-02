<?php
include 'includes/header.php';
?>
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Sklep</h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
								<form action="catalog-page.php" method="GET">
                                    <div class="filter-item">
                                        <h3>Kategorie</h3>
										<?php
										require_once "config.php";
										$results = mysqli_query($link, "SELECT name, id FROM category");
										$i = 1;
										while($row = mysqli_fetch_row($results)){
											echo '<div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-'.$i.'" name="Categories[]" value="'.$row[1].'"><label class="form-check-label" for="formCheck-'.$i.'">'.$row[0].'</label></div>';
											$i = $i+1;
										}
										?>
                                    </div>
                                    <div class="filter-item">
                                        <h3>Marki</h3>
										<?php
										$results = mysqli_query($link, "SELECT name, id FROM brands");
										while($row = mysqli_fetch_row($results)){
											echo '<div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-'.$i.'" name="Brands[]" value="'.$row[1].'"><label class="form-check-label" for="formCheck-'.$i.'">'.$row[0].'</label></div>';
											$i = $i+1;
										}
										?>
                                    </div>
									<button class="btn btn-primary" type="submit" >Filtruj</button>
								</form>
                                </div>
                            </div>
                            <div class="d-md-none"><a class="btn btn-link d-md-none filter-collapse" data-bs-toggle="collapse" aria-expanded="false" aria-controls="filters" href="#filters" role="button">Filters<i class="icon-arrow-down filter-caret"></i></a>
                                <div class="collapse" id="filters">
                                    <div class="filters">
									<form action="catalog-page.php" method="GET">
                                        <div class="filter-item">
                                            <h3>Kategorie</h3>
											<?php
											$i = 1;
											$results = mysqli_query($link, "SELECT name, id FROM category");
											while($row = mysqli_fetch_row($results)){
												echo '<div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-'.$i.'" name="Categories[]" value="'.$row[1].'"><label class="form-check-label" for="formCheck-'.$i.'">'.$row[0].'</label></div>';
												$i = $i+1;
											}
											?>
                                        </div>
                                        <div class="filter-item">
                                            <h3>Marki</h3>
											<?php
											$results = mysqli_query($link, "SELECT name, id FROM brands");
											while($row = mysqli_fetch_row($results)){
												echo '<div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-'.$i.'" name="Brands[]" value="'.$row[1].'"><label class="form-check-label" for="formCheck-'.$i.'">'.$row[0].'</label></div>';
												$i = $i+1;
											}
											?>
                                        </div>
										<button class="btn btn-primary" type="submit" >Filtruj</button>
									</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row g-0" id="product">
									<?php
										$query1 = "SELECT P.id, P.name, picture FROM products P JOIN category C ON P.id_category = C.id JOIN brands B ON B.id = P.id_brand";
										$query = $query1;
										$query3 = "";
										
										if(empty($_GET["page"])==false && $_GET["page"] != 1)
										{
											$max = $_GET["page"]*10-1;
											$min = $max-10;
											$query3 = " LIMIT {$min}, {$max}";
										}
										else{
											$query3 = " LIMIT 0, 9";
										}
										$query2 = "";
										if(!empty($_GET["Categories"])){
											$k = 0;
											$query2 = " WHERE C.id in (";
											foreach($_GET["Categories"] as $category){
												if($k == 0){
												$query2 .= $category;
												}
												else{
												$query2 .= ", ".$category;
												}
											}
											$query2 .= ")";
										}
										if(!empty($_GET["Brands"])){
											$k = 0;
											if(empty($query2)){
											$query2 = " WHERE B.id in (";
											foreach($_GET["Brands"] as $brand){
												if($k == 0){
												$query2 .= $brand;
												}
												else{
												$query2 .= ", ".$brand;
												}
											}
											$query2 .= ")";
											}
											else{
											$query2 .= " AND B.id in (";
											foreach($_GET["Brands"] as $brand){
												if($k == 0){
												$query2 .= $brand;
												}
												else{
												$query2 .= ", ".$brand;
												}
											}
											$query2 .= ")";
											}
										}
										if(empty($query2) == false)
										{
											$query .= $query2;
										}
										$query .= $query3;
										$results = mysqli_query($link, $query);
										while($row = mysqli_fetch_row($results)){
											echo '<div class="col-12 col-md-6 col-lg-4" style="text-align: center;">';
											echo '<img class="img-fluid" src="assets/img/products/'.$row[2].'">';
											echo '<a href="product-page.php?id='.$row[0].'">'.$row[1].'<a>';
											echo '</div>';
										}
									?>
                                </div>
                                <nav>
                                    <ul class="pagination">
										<?php
										$results = mysqli_query($link, "SELECT count(id) FROM products");
										$j = 0;
										$result = mysqli_fetch_row($results);
										$url = '//'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
										if(!empty($_GET["page"]) && $_GET["page"] != 1){
											$pre = $_GET["page"]-1;
											if(strpos($url, "?")){
												echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="'.$url.'&page='.$pre.'"><span aria-hidden="true">«</span></a></li>';
											}
											else
											{
												echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="'.$url.'?page='.$pre.'"><span aria-hidden="true">«</span></a></li>';
											}
										}
										else
										{
											echo '<li class="page-item"><a class="page-link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
										}
										while($j < $result[0]/10){
											$j=$j+1;
											if((empty($_GET["page"])==true && $j==1)||$_GET["page"]==$j)
											{
												$if = strpos($url, "?");
												if($if){
													echo '<li class="page-item active"><a class="page-link" href="'.$url.'&page='.$j.'">'.$j.'</a></li>';
												}
												else{
													echo '<li class="page-item active"><a class="page-link" href="'.$url.'?page='.$j.'">'.$j.'</a></li>';
												}
											}
											else
											{
												$if = strpos($url, "?");
												if($if){
													echo '<li class="page-item"><a class="page-link" href="'.$url.'&page='.$j.'">'.$j.'</a></li>';
												}
												else{
													echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$j.'">'.$j.'</a></li>';
												}
											}
										}
										if(!empty($_GET["page"])){
											if($_GET["page"] == $j){
												echo '<li class="page-item"><a class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
											}
											else{
												$next = $_GET["page"]+1;
												if(strpos($url, "?")){
													echo '<li class="page-item"><a class="page-link" aria-label="Next" href="'.$url.'&page='.$mext.'"><span aria-hidden="true">»</span></a></li>';
												}
												else
												{
													echo '<li class="page-item"><a class="page-link" aria-label="Next" href="'.$url.'?page='.$next.'"><span aria-hidden="true">»</span></a></li>';
												}
											}
										}
										else{
											if($j > 1){
											if(strpos($url, "?")){
												echo '<li class="page-item"><a class="page-link" aria-label="Next" href="'.$url.'&page=2"><span aria-hidden="true">»</span></a></li>';
											}
											else
											{
												echo '<li class="page-item"><a class="page-link" aria-label="Next" href="'.$url.'?page=2"><span aria-hidden="true">»</span></a></li>';
											}
											}
											else
											{
												echo '<li class="page-item"><a class="page-link" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
											}
										}
										mysqli_close($link);
										?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>