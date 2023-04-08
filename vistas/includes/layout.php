<?php
session_start();



if (!isset($_SESSION["user"])) {
    header("Location: login.php");
} else {
    $user_id = $_SESSION["user"]->id;
    $firstname = $_SESSION["user"]->firstname;
    $lastname = $_SESSION["user"]->lastname;
    $username = $_SESSION["user"]->username;
    $email = $_SESSION["user"]->email;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head_tags.php'); ?>
</head>

<body>
    <?php include('encabezado.php'); ?>

    <main class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-left">
            <?php include('../vistas/menu.php'); ?>

            <div class="col main pt-5 mt-3">
                <?= $content ?>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>