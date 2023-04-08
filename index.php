<?php
require_once "./functions.php";
ob_start();

$title = "Bokokinga";

$categories = getCategories();
$data = getIndexData();

?>

<?php include('includes/banner.php'); ?>
<?php include('includes/collections.php'); ?>

<?php
$content = ob_get_clean();
include './includes/layout.php';
?>