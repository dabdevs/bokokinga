<?php
    require_once "./functions.php";
    $configurations = getConfigurations();
    $collections = getCollections();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head_tags.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>

    <?= $content ?>

    <?php include('footer.php'); ?>
</body>

</html>