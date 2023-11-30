<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}

$modoOscuroCookie = isset($_COOKIE['modo_oscuro']) ? $_COOKIE['modo_oscuro'] : 'false';

?>

<head>
    <title>Carrito</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/css/carrito.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="resources/js/carrito.js"></script>
  

</head>

<body class="<?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">

    <?php
    require_once '../Business/ProductClass.php';
    require_once '../Business/PedidoClass.php';
    if (isset($_SESSION["carrito"])) {
        $carrito = $_SESSION["carrito"];
    }
    ?>

    <!-- Barra de navegación  -->
    <?php include 'navbar.inc'; ?>

    <div class="container">
        <?php
        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];

            if (empty($carrito)) {
        ?>
                <tr>
                    <h1>El carrito está vacío</h1>
                <?php
            } else {
                ?>
                    <h1 class="text-center">Mi Carrito</h1>
                    <table class="table table-bordered <?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($carrito as $item) {
                                // Deserializa el objeto Product
                                $product = unserialize($item);
                                // Accede a las propiedades del objeto Product
                            ?>
                                <tr class="product-row " data-product-name='<?php echo $product->getName(); ?>'>

                                    <td>
                                        <?php echo $product->getName(); ?>
                                    </td>
                                    <td>
                                        <?php echo $product->getPrice(); ?> €
                                    </td>

                                    <td>
                                        <input name="cantidad" type="number" class="form-control" min="1" value='<?php echo $product->getQuantity(); ?>' onchange="updateCartItem('<?php echo $product->getName(); ?>', <?php echo $product->getPrice(); ?>, this)">
                                    </td>
                                    <td class='subtotal' data-product-name='<?php echo $product->getName(); ?>'>
                                        <?php echo $product->getPrice(); ?> €
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger" onclick="removeCartItem('<?php echo $product->getName(); ?>'); return false;">
                                            <i class="glyphicon glyphicon-trash"></i> Eliminiar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a href="index.php" class="btn btn-warning">
                                        <i class="glyphicon glyphicon-menu-left"></i> Continuar comprando
                                    </a>
                                </td>
                                <td colspan="2" class="text-center">
                                    <strong id="total">Total</strong>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-block" onclick="openModal()">
                                        Pedir <i class="glyphicon glyphicon-menu-right"></i>
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            <?php
            }
        } else {
            echo "El carrito está vacío.";
        }
            ?>

    </div>
    <div class="overlay" id="overlay"></div>
    <div class="modal <?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>" id="modal">
        <div class="modal-content <?php echo $modoOscuroCookie === 'true' ? 'dark-mode' : ''; ?>">
            <p>¿Estas seguro de efectuar el pedido?</p>
            <div class="btn-modal-group">
                <form method="post" action="vercarrito.php">
                    <button onclick="confirmAction()" type="submit" name="miBoton" class="btn-modal btn-success">Confirmar</button>
                </form>
                <button onclick="cancelAction()" class="btn-modal btn-danger">Cancelar</button>
            </div>
        </div>
    </div>

</body>
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["miBoton"])) {
    añadirPedido($_SESSION['usu_id'], $carrito);
    unset($_SESSION["carrito"]);
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}


?>





</html>