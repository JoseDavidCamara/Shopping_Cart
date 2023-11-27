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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;

        }

        .container {
            padding: 50px;
        }

        input[type="number"] {
            width: 70px;
            text-align: center;
        }

        th,
        td {
            text-align: center;
        }

        .table {
            background-color: #fff;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .modal {
            display: none;
            position: fixed;
            width: 400px;
            height: 150px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 4px;

        }

        .modal-content {
            margin-top: 10px;
            text-align: center;
            border: 0px;
        }

        .btn-modal {

            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-modal-group {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .btn-modal-group button {
            margin: 0 5px;
        }
    </style>

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

    <script>
        let subtotals = {}; // Objeto para almacenar los subtotales de cada producto

        function updateCartItem(productName, productPrice, inputElement) {
            var quantity = $(inputElement).val();

            if (quantity <= 0) {
                quantity = 1;
            }

            var subtotal = productPrice * quantity;


            subtotals[productName] = subtotal;
            console.log(subtotals);
            total(subtotals);
            // Update the corresponding subtotal cell for the product
            $(".subtotal[data-product-name='" + productName + "']").text(subtotal + ' €');
        }


        function removeCartItem(productName) {
            var confirmation = confirm('Are you sure you want to remove this item?');
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "deleteproduct.php",
                    data: {
                        action: "removeCartItem",
                        name: productName
                    },
                    success: function(data) {
                        if (data === 'ok') {
                            alert('Item removed successfully.');
                            delete subtotals[productName];
                            total(subtotals)
                            $(".product-row[data-product-name='" + productName + "']").remove();

                        } else {
                            alert('Failed to remove item. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Error in Ajax request.');
                    }
                });
            }
        }


        function total(subtotal) {
            let subtotalsArray = Object.values(subtotals); // Obtener un array de subtotales
            let newTotal = 0;

            for (let subtotal of subtotalsArray) {
                newTotal += subtotal; // Sumar cada subtotal al nuevo total
            }

            // Ahora, newTotal contiene la suma de todos los subtotales
            $("#total").text('Total ' + newTotal + ' €'); // Actualizar el elemento HTML con el nuevo total
        }

        function openModal() {
            document.getElementById("modal").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        function confirmAction() {
            // Aquí puedes agregar la lógica de PHP para confirmar la acción
            closeModal();
        }

        function cancelAction() {
            // Aquí puedes agregar la lógica de PHP para cancelar la acción
            closeModal();
        }
    </script>
</body>

</html>