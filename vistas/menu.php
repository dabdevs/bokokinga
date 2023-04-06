<div class="col-sm-2 m-0 p-0 sidebar sidebar-offcanvas" id="sidebar-menu" role="navigation">
    <nav class="nav-container m-0">
        <div class="row m-0 d-sm-none text-white">
            <center class="sidebar-profile"><img src="../public/img/user.png" alt="" class="mt-2 mx-center"></center>
            <?= $nombre; ?>
            <?= $apellido; ?>
        </div>
        <div class="publico m-0">
            <a href="./dashboard.php"><i class='bx bx-home'></i><span>Dashboard</span></a>
            <a href="./categoria.php" id="categoria"><i class='bx bx-category'></i><span>Categoría</span></a>
            <a href="./libro.php" id="libro"><i class='bx bx-book'></i><span>Libro</span></a>
            <a href="./detalle.php" id="prestamo"><i class='bx bxs-dollar-circle'></i><span>Préstamo</span></a>
            <a href="#" class="es-padre es-modulo" id="modulo"><i class='bx bx-category'></i><span>Módulo padre</span></a>
            <a href="#" class="es-modulo collapse modulo-hijo padre-modulo"><i class='bx bx-category'></i><span>Módulo hijo 1</span></a>
            <a href="#" id="modulo2" class="es-modulo collapse modulo-hijo padre-modulo es-padre"><i class='bx bx-category'></i><span>Módulo hijo 2</span></a>
            <a href="#" class="es-modulo collapse modulo-hijo padre-modulo2"><i class='bx bx-category'></i><span>Módulo hijo 2.1</span></a>
            <a href="#" class="es-modulo collapse modulo-hijo padre-modulo2"><i class='bx bx-category'></i><span>Módulo hijo 2.2</span></a>
            <a href="#" class="es-modulo collapse modulo-hijo padre-modulo"><i class='bx bx-category'></i><span>Módulo hijo 3</span></a>
            <a href="#"><i class="bx bxs-dashboard"></i><span>Tablero</span></a>
            <a href="#"><i class="bx bxs-archive-in"></i><span>Archivos</span></a>
            <a href="#"><i class="bx bxs-heart"></i><span>Favoritos</span></a>
            <a href="#"><i class="bx bxs-user"></i><span>Equipo</span></a>
            <a href="#"><i class="bx bxs-message"></i><span>Mensajes</span></a>
            <a href="#"><i class="bx bxs-cog"></i><span>Configuración</span></a>
        </div>
        <div class="configuracion">
            <a href="#" onclick="logout()"><i class='bx bx-log-out'></i><span>Salir</span></a>
        </div>
    </nav>
</div>