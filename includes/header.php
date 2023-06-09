<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img height="70" src="public/img/<?= $configurations['logo'] ?>">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/" class="active">Inicio</a></li>
                        <li class="submenu">
                            <a href="javascript:;">Colecciones</a>
                            <ul>
                                <?php
                                foreach ($collections as $category) { ?>
                                    <li><a href="collection.php?name=<?= $category->name ?>"><?= $category->name ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="scroll-to-section"><a href="#explore"><i class="fa fa-shopping-cart fa-2x"></i></a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->