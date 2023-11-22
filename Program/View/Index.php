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


echo "<form method=\"get\">";
echo "<label for=\"nombre\">Buscar por nombre:</label>";
echo "<input type=\"text\" name=\"nombre\" id=\"nombre\">";
echo "<br>";
echo "<label for=\"precio_min\">Precio mínimo:</label>";
echo "<input type=\"number\" name=\"precio_min\" id=\"precio_min\">";
echo "<br>";
echo "<label for=\"precio_max\">Precio máximo:</label>";
echo "<input type=\"number\" name=\"precio_max\" id=\"precio_max\">";
echo "<br>";
echo "<input type=\"submit\" value=\"Buscar\">";
echo "</form>";
echo "<form action=\"logout.php\"><input type=\"submit\" value=\"Cerrar sesión\"></form><br>";

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <!-- Barra de navegación mejorada -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mi Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Banner de bienvenida -->
    <div class="jumbotron jumbotron-fluid text-center bg-info text-white">
        <div class="container">
            <h1 class="display-4">Bienvenido a Mi Tienda en Línea</h1>
            <p class="lead">Explora nuestra increíble selección de productos.</p>
        </div>
    </div>

    <!-- Sección de productos -->
    <div class="container">
        <div class="row">
            <!-- Producto 1 -->
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
                    <a class='btn btn-sm btn-outline-primary' href="añadirCarrito.php?agregarAlCarrito=<?php echo urlencode(json_encode($item));?>">Agregar al carrito</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } 
?>
    </div>

    <!-- Agrega la referencia a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

