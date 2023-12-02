<?php
session_start();
include 'navbar.inc';
require_once '../Business/PedidoClass.php';
if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
$modoOscuroCookie = isset($_COOKIE['modo_oscuro']) ? $_COOKIE['modo_oscuro'] : 'false';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Historial de Pedidos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="resources/css/verpedidos.css">
</head>

<body class="<?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">
<div class="container">
<div class="row">
        <div class="col-md-3">
            <div class="card mt-3  <?php echo ($modoOscuroCookie === 'true') ? 'dark-mode' : ''; ?>">
                <div class="card-body p-2"> <!-- Reducir el padding del cuerpo de la tarjeta -->
                    <h5 class="card-title <?php echo ($modoOscuroCookie === 'true') ? 'text-white' : ''; ?>">Filtrar por fecha</h5>
                    <form class="form-inline" method="get" action="">
                        <div class="form-group mx-1 mb-2"> <!-- Reducir los márgenes horizontal y vertical del grupo de formulario -->
                            <label for="fecha" class="sr-only">Fecha:</label>
                            <input type="date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php
            // Tu código PHP para obtener la lista de pedidos
            $fechaFiltro = isset($_GET['fecha']) ? $_GET['fecha'] : null;
            $listado = listaPedido($_SESSION['usu_id'], $fechaFiltro);

            echo '<h1>Historial de Pedidos</h1>';

            // Creamos un array para agrupar los pedidos por fecha
            $pedidosPorFecha = [];

            foreach ($listado as $pedido) {
                $fecha = $pedido->getFechaPedido();

                if (!isset($pedidosPorFecha[$fecha])) {
                    $pedidosPorFecha[$fecha] = [];
                }

                $pedidosPorFecha[$fecha][] = $pedido;
            }

            // Mostramos los pedidos agrupados por fecha
            foreach ($pedidosPorFecha as $fecha => $pedidos) {
                echo '<div class="pedido-container ' . ($modoOscuroCookie === 'true' ? 'dark-mode' : '') . '">';
                echo '<h3>Pedido realizado el: ' . $fecha . '</h3>';

                foreach ($pedidos as $pedido) {
                    echo '<div class="pedido-item ' . ($modoOscuroCookie === 'true' ? 'dark-mode' : '') . '">';
                    echo '<h4>' . $pedido->getNombreProducto() . '</h4>';
                    echo '<p>Cantidad: ' . $pedido->getCantidad() . '</p>';
                    echo '</div>';
                }

                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
</body>

</html>