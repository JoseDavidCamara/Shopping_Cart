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


$modoOscuroCookie = isset($_COOKIE['modo_oscuro']) ? $_COOKIE['modo_oscuro'] : 'false';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mi Tienda en Línea</title>
    <link rel="stylesheet" href="resources/css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>


<body class="<?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">

    <!-- Menú de navegación -->
    <?php include 'navbar.inc'; ?>



    <!-- Sección de productos y menú lateral de búsqueda -->
    <div class="container mt-3">
        <div class="col-md-3 ">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="modoOscuroSwitch" <?php echo $modoOscuroCookie === 'true' ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="modoOscuroSwitch">Modo Oscuro</label>
            </div>
        </div>
        <div class="row">
            <!-- Menú lateral de búsqueda -->
            <div class="col-md-3 sticky-sidebar top">

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Filtrar Productos</h5>
                        <form method="get">
                            <div class="form-group">
                                <label for="nombre">Buscar por nombre:</label>
                                <input type="text" name="nombre" id="nombre" value="<?php echo isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="precio_min">Precio mínimo:</label>
                                <input type="number" name="precio_min" id="precio_min" value="<?php echo isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : ''; ?>" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="precio_max">Precio máximo:</label>
                                <input type="number" name="precio_max" id="precio_max" value="<?php echo isset($_GET['precio_min']) ? htmlspecialchars($_GET['precio_min']) : ''; ?>" class="form-control">
                            </div>
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
                                    <h5 class='card-title text-info'><?php echo $item->getName(); ?></h5>
                                    <p class='card-text'><?php echo $item->getDescription(); ?></p>
                                    <p class='card-text font-weigth-bold'><?php echo $item->getPrice(); ?> €</p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='btn-group'>
                                            <?php
                                            if (!isset($_SESSION['usu_nombre'])) {
                                                echo "<a class='btn btn-sm btn-outline-success' href=\"login.php\">Agregar al carrito</a>";
                                            } else {
                                                // Agrega un atributo data con la información del producto
                                                echo "<a class='btn btn-sm btn-outline-success agregarAlCarrito' href='#' data-product='" . urlencode(json_encode($item)) . "'>Agregar al carrito</a>";
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
    <div id="mensajeCarrito" class="alert alert-success mensaje-carrito" style="display:none;"></div>

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
                    dataType: 'json', // Espera una respuesta JSON del servidor
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        console.log(response);

                        // Mostrar el mensaje de éxito o el mensaje de producto ya en el carrito
                        $("#mensajeCarrito").text(response.message).fadeIn().delay(2000).fadeOut();

                        // Puedes realizar acciones adicionales según la respuesta del servidor
                    },
                    error: function(error) {
                        // Manejar errores
                        console.error(error);
                    }
                });
            });
        });


        // Función para cambiar el modo oscuro
        function toggleDarkMode() {
            var body = document.body;
            body.classList.toggle('dark-mode');

            // Guarda el estado en una cookie
            var modoOscuroCookie = body.classList.contains('dark-mode') ? 'true' : 'false';
            document.cookie = 'modo_oscuro=' + modoOscuroCookie + '; path=/';
        }

        // Asigna la función al evento de cambio del interruptor
        document.getElementById('modoOscuroSwitch').addEventListener('change', toggleDarkMode);
    </script>
</body>

</html>