<!DOCTYPE html>
<html lang="en">

<?php
$title = 'Login';

session_start();

if (isset($_SESSION["id"])) {
    header("Location: dashboard.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('./includes/head_tags.php'); ?>
    <title>Login</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">

            <!-- The content half -->
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">

                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <form>
                                    <center>
                                        <img src="../public/img/avatar.png" alt="">
                                        <h2>SIGN IN</h2>
                                    </center>

                                    <i class="fa fa-user"></i>
                                    <input id="email" type="text" placeholder="Email" class="w-100">
                                    <i class="fa fa-lock"></i>
                                    <input id="password" type="password" placeholder="Contraseña" class="w-100">
                                    <center>
                                        <a href="#">Olvidé mi contraseña</a>
                                    </center>
                                    <center>
                                        <button type="button" onclick="login()">LOGIN</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->


            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex right">
                <div class="w-100 container">
                    <h3 class="text-center">SIGUENOS</h3>
                    <p>EN NUESTRAS REDES SOCIALES</p>
                    <center>
                        <img src="../public/img/vector.svg" alt="">
                    </center>

                    <div class="socials">
                        <a target="__blank" href="https://www.facebook.com/"><i class="fa fa-facebook p-1" style="color: #3b5998;"></i></a>
                        <a target="__blank" href="https://twitter.com/?lang=es"><i class="fa fa-twitter" style="color: #00acee;"></i></a>
                        <a target="__blank" href="https://www.instagram.com/"><i class="fa fa-instagram" style="color: #DD2A7B;"></i></a>
                        <a target="__blank" href="https://uy.linkedin.com/"><i class="fa fa-linkedin" style="color:#0e76a8;"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('./includes/footer.php'); ?>

    <script>
        function login() {
            var email = document.querySelector("#email").value;
            var password = document.querySelector("#password").value;

            $.ajax({
                type: "POST",
                url: "../ajax/login.php",
                data: {
                    email,
                    password
                },
                success: function(response) {
                    res = JSON.parse(response)

                    if (res == null) {
                        Swal.fire("Email/Contraseña incorrectos");
                    } else {
                        window.location.href = 'dashboard.php';
                    }
                }
            });
        }
    </script>
</body>

</html>