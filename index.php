<?php

    require_once "./functions.php";
    $title = "Bokokinga";
    $collections = getCollections();
    $data = getIndexData();

    ob_start();

    include('includes/index/banner.php'); 
    include('includes/index/collections.php'); 
    include('includes/index/socials.php'); 
    include('includes/subscribe.php'); 

    $content = ob_get_clean();
    include './includes/layout.php';
