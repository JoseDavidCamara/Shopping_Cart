<style>
    .navbar-nav>li {
        margin-right: 10px;
        /* Ajusta el valor según la separación deseada */
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Mi Tienda en Línea</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="verpedidos.php">Mis Pedidos</a>
            </li>
            <?php
            if (!isset($_SESSION['usu_nombre'])) {
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Log In</a></li>";
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"registro.php\">Registro</a></li>";
            } else {
                echo "<li class=\"nav-item\"><span class=\"nav-link\">" . $_SESSION['usu_nombre'] . "</span></li>";
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="../View/vercarrito.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../View/logout.php">
                    <i class="fa fa-sign-out" style="font-size:20px;color:red"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>