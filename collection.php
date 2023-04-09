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
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Últimos publicados</h2>
                    <span class="d-none">Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach($collection as $product) { ?>
            <div class="col-lg-4">
                <?php include("includes/product_card.php") ?>
            </div>
            <?php } ?>

            <div class="col-lg-12">
                <div class="pagination">
                    <ul>
                        <li>
                            <a href="#">1</a>
                        </li>
                        <li class="active">
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Products Area Ends ***** -->

<?php
$content = ob_get_clean();
include './includes/layout.php';
?>