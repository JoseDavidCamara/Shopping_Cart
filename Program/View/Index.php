<?php
session_start();
require_once '../Business/ProductClass.php';
require_once '../Business/UsuarioServicio.php';


if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}


$listado = arrayClass(
    isset($_GET['nombre']) ? $_GET['nombre'] : null,
    isset($_GET['precio_max']) ? $_GET['precio_max'] : null,
    isset($_GET['precio_min']) ? $_GET['precio_min'] : null
);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mi Tienda en Línea</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Menú de navegación -->
    <?php include 'navbar.inc'; ?>



    <!-- Sección de productos y menú lateral de búsqueda -->
    <div class="container mt-3">
        <div class="row">
            <!-- Menú lateral de búsqueda -->
            <div class="col-md-3 sticky-sidebar top">
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
                                <img src='resources/imgs/<?php echo $item->getUrlImagen() ?>' class='card-img-top' alt='...' style='object-fit: cover; height: 300px;'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $item->getName(); ?></h5>
                                    <p class='card-text'><?php echo $item->getDescription(); ?></p>
                                    <p class='card-text'><?php echo $item->getPrice(); ?> €</p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='btn-group'>
                                            <?php
                                            if (!isset($_SESSION['usu_nombre'])) {
                                                echo "<a class='btn btn-sm btn-outline-primary' href=\"login.php\">Agregar al carrito</a>";
                                            } else {
                                                // Agrega un atributo data con la información del producto
                                                echo "<a class='btn btn-sm btn-outline-primary agregarAlCarrito' href='#' data-product='" . urlencode(json_encode($item)) . "'>Agregar al carrito</a>";
                                            }
                                            ?>
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

    <!-- Agrega la referencia a Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".agregarAlCarrito").click(function(e) {
                e.preventDefault();

                // Obtener la información del producto desde el atributo data
                var productInfo = $(this).data("product");

                // Realizar la llamada AJAX
                $.ajax({
                    url: 'añadirCarrito.php?agregarAlCarrito=' + productInfo,
                    type: 'GET',
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        console.log(response);
                        // Puedes mostrar un mensaje al usuario si lo deseas
                    },
                    error: function(error) {
                        // Manejar errores
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>