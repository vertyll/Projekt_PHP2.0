<?php
include 'includes/header.php';
?>
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Płatność</h2>
                </div>
                <form>
                    <div class="products">
                        <h3 class="title">Rachunek</h3>
                        <div class="item"><span class="price">200 zł</span>
                            <p class="item-name">Produkt 1</p>
                            <p class="item-description">Lorem ipsum dolor sit amet</p>
                        </div>
                        <div class="item"><span class="price">120 zł</span>
                            <p class="item-name">Produkt 2</p>
                            <p class="item-description">Lorem ipsum dolor sit amet</p>
                        </div>
                        <div class="total"><span>Razem</span><span class="price">320 zł</span></div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Dane karty kredytowej</h3>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="mb-3"><label class="form-label" for="card_holder">Imię i nazwisko</label><input class="form-control" type="text" id="card_holder" placeholder="Card Holder" name="card_holder"></div>
                            </div>
                            <div class="col-sm-5">
                                <div class="mb-3"><label class="form-label">Data ważności</label>
                                    <div class="input-group expiration-date"><input class="form-control" type="text" placeholder="MM" name="expiration_month"><input class="form-control" type="text" placeholder="YY" name="expiration_year"></div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="mb-3"><label class="form-label" for="card_number">Numer karty kredytowej</label><input class="form-control" type="text" id="card_number" placeholder="Card Number" name="card_number"></div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3"><label class="form-label" for="cvc">Kod cvc</label><input class="form-control" type="text" id="cvc" placeholder="CVC" name="cvc"></div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Zapłać</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>