<!-- ***** Latest Products First Row Starts ***** -->
<?php if (count((array)$data["latest_products_category_1"]) > 0) { ?>
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Últimos en <?= $data["latest_products_category_1"]->title ?></h2>
                        <span><?= $data["latest_products_category_1"]->description ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php
                            foreach ($data["latest_products_category_1"]->products as $product) { 
                                include("./includes/product_card.php");
                                include("./includes/product_card.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- ***** Latest Products First Row Ends ***** -->

<!-- ***** Latest Products Second Row Starts ***** -->
<?php if (count((array)$data["latest_products_category_2"]) > 0) { ?>
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Últimos en <?= $data["latest_products_category_2"]->title ?></h2>
                        <span><?= $data["latest_products_category_2"]->description ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            <?php
                            foreach ($data["latest_products_category_2"]->products as $product) {
                                include("./includes/product_card.php");
                                include("./includes/product_card.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php } ?>
<!-- ***** Latest Products Second Row Ends ***** -->

<!-- ***** Latest Products Third Row Starts ***** -->
<?php if (count((array)$data["latest_products_category_3"]) > 0) { ?>
    <section class="section" id="kids">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Últimos en <?= $data["latest_products_category_3"]->title ?></h2>
                        <span><?= $data["latest_products_category_3"]->description ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kid-item-carousel">
                        <div class="owl-kid-item owl-carousel">
                            <?php
                            foreach ($data["latest_products_category_3"]->products as $product) {
                                include("./includes/product_card.php");
                                include("./includes/product_card.php");
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- ***** Latest Products Third Row Ends ***** -->