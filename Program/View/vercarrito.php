//Falta el checkout, pero antes se ha de enviar los datos con el total
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if (!isset($_SESSION['usu_nombre'])) {
        header("Location: login.php");
    }
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

<body>
    <?php
    require_once '../Business/ProductClass.php';
    if (isset($_SESSION["carrito"])) {
        $carrito = $_SESSION["carrito"];

        if (empty($carrito)) {
            echo "El carrito está vacío.";
        } else {
            echo "<h2>Contenido del Carrito:</h2>";
            echo "<ul>";
            foreach ($carrito as $item) {
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

    <!-- Barra de navegación  -->
    <?php include 'navbar.inc'; ?>

    <div class="container">
        <?php

        require_once '../Business/ProductClass.php';
        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];

            if (empty($carrito)) {
        ?>
                <tr>
                    <h1>El carrito está vacío</h1>
                <?php
            } else {
                ?>
                    <h1 class="text-center">Shopping Cart</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($carrito as $item) {
                                // Deserializa el objeto Product
                                $product = unserialize($item);
                                // Accede a las propiedades del objeto Product
                            ?>
                                <tr class="product-row" data-product-name='<?php echo $product->product_name; ?>'>

                                    <td>
                                        <?php echo $product->product_name ?>
                                    </td>
                                    <td>
                                        <?php echo $product->price ?> €
                                    </td>
                                    <td>
                                        <input name="cantidad" type="number" class="form-control" min="1" value="1" onchange="updateCartItem('<?php echo $product->product_name; ?>', <?php echo $product->price; ?>, this)">
                                    </td>
                                    <td class='subtotal' data-product-name='<?php echo $product->product_name; ?>'>
                                        <?php echo $product->price; ?> €
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger" onclick="removeCartItem('<?php echo $product->product_name; ?>'); return false;">
                                            <i class="glyphicon glyphicon-trash"></i> Remove
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <a href="index.php" class="btn btn-warning">
                                        <i class="glyphicon glyphicon-menu-left"></i> Continue Shopping
                                    </a>
                                </td>
                                <td colspan="2" class="text-center">
                                    <strong id="total">Total</strong>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-block" onclick="openModal()">
                                        Checkout <i class="glyphicon glyphicon-menu-right"></i>
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
    <div class="modal" id="modal">
        <div class="modal-content">
            <p>Are you sure you want to perform this action?</p>
            <div class="btn-modal-group">
                <button onclick="confirmAction()" class="btn-modal btn-success">Confirm</button>
                <button onclick="cancelAction()" class="btn-modal btn-danger">Cancel</button>
            </div>
        </div>
    </div>

    
    
</body>

</html>