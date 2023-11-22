<?php
session_start();
require_once '../Business/ProductClass.php';
require_once '../Business/UsuarioServicio.php';

if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}



$listado = arrayClass(
    isset($_GET['nombre']) ? $_GET['nombre'] : null,
    isset($_GET['precio_max']) ? $_GET['precio_max'] : null,
    isset($_GET['precio_min']) ? $_GET['precio_min'] : null
);

foreach ($listado as $item) {
    echo "Nombre del producto: " . $item->getName() . "<br>";
    echo "Descripción del producto: " . $item->getDescription() . "<br>";
    echo "Precio del producto: " . $item->getPrice() . "<br><br><br>";
}


if(isset($_SESSION["carrito"])) {
    $carrito = $_SESSION["carrito"];

    if(empty($carrito)) {
        echo "El carrito está vacío.";
    } else {
        echo "<h2>Contenido del Carrito:</h2>";
        echo "<ul>";
        foreach($carrito as $item) {
            // Deserializa el objeto Product
            $product = unserialize($item);
            // Accede a las propiedades del objeto Product
            echo "<li>{$product->product_name} - {$product->description} - {$product->price} €</li>";
        }
        echo "</ul>";
    }
} else {
    echo "El carrito está vacío.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mi Tienda en Línea</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
            .sticky-sidebar {
                position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1000; /* Ajusta según tus necesidades */
            transition: top 0.3s; /* Agregamos una transición para suavizar el movimiento */
        }
    </style>
</head>
<body>
<!-- Menú de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Mi Tienda en Línea</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../View/formPago.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../View/logout.php">
            <i class="fa fa-sign-out" style="font-size:20px;color:red"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sección de productos y menú lateral de búsqueda -->
<div class="container mt-3">
    <div class="row">
        <!-- Menú lateral de búsqueda -->
        <div class="col-md-3 sticky-sidebar top" >
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Filtrar Productos</h5>
                    <form method="get">
                        <label for="nombre">Buscar por nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                        <br>
                        <label for="precio_min">Precio mínimo:</label>
                        <input type="number" name="precio_min" id="precio_min" class="form-control">
                        <br>
                        <label for="precio_max">Precio máximo:</label>
                        <input type="number" name="precio_max" id="precio_max" class="form-control">
                        <br>
                        <input type="submit" value="Buscar" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($listado as $item) { ?>
                    <div class='col-md-4'>
                        <div class='card mb-4 shadow-sm'>
                            <img src='https://via.placeholder.com/300' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'><?php echo $item->getName(); ?></h5>
                                <p class='card-text'><?php echo $item->getDescription(); ?></p>
                                <p class='card-text'><?php echo $item->getPrice(); ?> €</p>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                        <a class='btn btn-sm btn-outline-primary' href="añadirCarrito.php?agregarAlCarrito=<?php echo urlencode(json_encode($item)); ?>">Agregar al carrito</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
        window.onscroll = function() {
            var sidebar = document.getElementById("sticky-sidebar");
            if (window.pageYOffset > 20) {
                sidebar.style.top = "20px";
            } else {
                sidebar.style.top = "0";
            }
        };
    </script>
<!-- Agrega la referencia a Bootstrap JS y Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>