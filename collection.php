<?php
require_once "./functions.php";
ob_start();

$title = $_GET["name"];
$collection = getCollection(str_replace("-", " ", $title));
?>

<?php include('includes/collection/banner.php'); ?>

<!-- ***** Products Area Starts ***** -->
<section class="section" id="products">
    <div class="container">
        <?php
        if (count($collection["products"]) > 0) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Últimos publicados</h2>
                        <span class="d-none">Check out all of our products.</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <div class="row">
            <?php
            if (count($collection["products"]) > 0) {
                foreach ($collection["products"] as $product) { ?>
                    <div class="col-lg-4">
                        <?php include("includes/product_card.php") ?>
                    </div>
                <?php
                }
                ?>
                <div class="col-lg-12">
                    <div class="pagination">
                        <ul>
                            <?= $collection["links"] ?>
                        </ul>
                    </div>
                </div>
            <?php 
            } else {
                echo "<div class='col-lg-12 py-4'><center><i class='fa fa-face-sad'></i> No encontramos ningun producto </center></div>";
            } ?>
        </div>
    </div>
</section>
<!-- ***** Products Area Ends ***** -->

<?php
$content = ob_get_clean();
include './includes/layout.php';
?>