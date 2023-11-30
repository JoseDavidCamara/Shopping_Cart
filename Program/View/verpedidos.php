<?php
    session_start();
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Fondo principal, cambia según tus preferencias */
            color: #333; /* Color de texto predeterminado */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-mode {
            background-color: #343a40; /* Fondo gris oscuro */
            color: #fff; /* Texto blanco en modo oscuro */
        }

        h1 {
            text-align: center;
            color: #007bff; /* Azul brillante, puedes cambiar el color según tus preferencias */
        }

        .pedido-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            background-color: #fff; /* Fondo de los contenedores, puedes cambiar según tus preferencias */
            transition: background-color 0.3s ease;
        }

        .pedido-container.dark-mode {
            background-color: #333; /* Fondo gris oscuro en modo oscuro */
        }

        .pedido-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pedido-item.dark-mode {
            background-color: #444; /* Fondo gris oscuro en modo oscuro */
        }

        .pedido-item h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .pedido-item.dark-mode h3 {
            color: #fff; /* Color de texto blanco en modo oscuro */
        }

        .pedido-item p {
            margin: 0;
            color: #777;
        }

        .pedido-item.dark-mode p {
            color: #ccc; /* Color de texto gris claro en modo oscuro */
        }
    </style>
</head>

<body class="<?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">
<?php include 'navbar.inc'; ?>
    <?php
    // Tu código PHP para obtener la lista de pedidos
    $listado = listaPedido($_SESSION['usu_id']);

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
</body>

</html>