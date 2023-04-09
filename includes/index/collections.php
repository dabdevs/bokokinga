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
                            foreach ($data["latest_products_category_1"]->products as $product) { ?>
                                <div class="item">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="public/img/products/<?= $product->image1 ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?= $product->name ?></h4>
                                        <span><?= $product->price ?></span>
                                        <ul class="stars d-none">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php
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
                            foreach ($data["latest_products_category_2"]->products as $product) { ?>
                                <div class="item">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="public/img/products/<?= $product->image1 ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?= $product->name ?></h4>
                                        <span><?= $product->price ?></span>
                                        <ul class="stars d-none">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php
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
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- ***** Latest Products Third Row Ends ***** -->