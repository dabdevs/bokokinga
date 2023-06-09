<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="first-item">
                    <div class="logo d-none">
                        <img src="public/assets/images/white-logo.png" alt="hexashop ecommerce templatemo">
                    </div>
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="#">Dirección, Buenos Aires</a></li>
                        <li><a href="#">bokokinga@gmail.com</a></li>
                        <li><a href="#">010-020-0340</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <h4>Colleciones</h4>
                <ul>
                    <?php foreach ($collections as $category) { ?>
                        <li><a href="collection.php?name=<?= $category->name ?>"><?= $category->name ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">Nosotros</a></li>
                    <li><a href="#">Contactos</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Información útil</h4>
                <ul>
                    <li><a href="#">Políticas</a></li>
                    <li><a href="#">Preguntas frecuentes</a></li>
                    <li><a href="#">Shipping</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>Copyright © 2023 Bokokinga Co., Ltd. Todos derechos reservados.</p>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery -->
<script src="public/assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="public/assets/js/popper.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="public/assets/js/owl-carousel.js"></script>
<script src="public/assets/js/accordions.js"></script>
<script src="public/assets/js/datepicker.js"></script>
<script src="public/assets/js/scrollreveal.min.js"></script>
<script src="public/assets/js/waypoints.min.js"></script>
<script src="public/assets/js/jquery.counterup.min.js"></script>
<script src="public/assets/js/imgfix.min.js"></script>
<script src="public/assets/js/slick.js"></script>
<script src="public/assets/js/lightbox.js"></script>
<script src="public/assets/js/isotope.js"></script>

<!-- Global Init -->
<script src="public/assets/js/custom.js"></script>

<script>
    $(function() {
        var selectedClass = "";
        $("p").click(function() {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function() {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });
</script>