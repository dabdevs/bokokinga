<?php

require_once "./functions.php";
$categories = getCategories();
$data = getIndexData();

ob_start();
$title = "Bokokinga";
?>

<?php include('includes/index/banner.php'); ?>
<?php include('includes/index/collections.php'); ?>
<?php include('includes/index/socials.php'); ?>
<?php include('includes/subscribe.php'); ?>

<?php
$content = ob_get_clean();
include './includes/layout.php';
?>