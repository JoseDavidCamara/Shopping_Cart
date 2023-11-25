//Falta el toal que se vaya actualizando, y el checkout impedir que se añadan duplicados en la lista del carrito
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Cart - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    </style>
   
</head>

<body>
<?php
session_start();
require_once '../Business/ProductClass.php';
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
                    <a class="nav-link" href="index.php">Productos</a>
                </li>
                <li class="nav-item">
            <a class="nav-link" href="../View/logout.php">
            <i class="fa fa-sign-out" style="font-size:20px;color:red"></i>
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
    <?php
                  
                  require_once '../Business/ProductClass.php';
                  if (isset($_SESSION["carrito"])) {
                      $carrito = $_SESSION["carrito"];

                      if (empty($carrito)) {
                          ?> <tr><h1>El carrito está vacío</h1> <?php
                      } else {
                            ?>    <h1 class="text-center">Shopping Cart</h1>
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
                                <tbody>  <?php
                            foreach($carrito as $item) {
                                // Deserializa el objeto Product
                                $product = unserialize($item);
                                // Accede a las propiedades del objeto Product
                                ?><tr class="product-row" data-product-name='<?php echo $product->product_name; ?>'>

                                <td><?php echo $product->product_name ?></td>
                                <td> <?php echo $product->price ?> €</td>
                                <td>
                                <input name="cantidad" type="number" class="form-control" value="1" onchange="updateCartItem('<?php echo $product->product_name; ?>', <?php echo $product->price; ?>, this)">
                                </td>
                                <td class='subtotal' data-product-name='<?php echo $product->product_name; ?>'><?php echo $product->price; ?> €</td>
                                <td>
                                <a href="#" class="btn btn-danger" onclick="removeCartItem('<?php echo $product->product_name; ?>'); return false;">
                                        <i class="glyphicon glyphicon-trash"></i> Remove
                                    </a>
                                </td>
                                </tr> <?php }?>
                            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="index.php" class="btn btn-warning">
                            <i class="glyphicon glyphicon-menu-left"></i> Continue Shopping
                        </a>
                    </td>
                    <td colspan="2" class="text-center">
                        <strong>Total $100 USD</strong>
                    </td>
                    <td>
                        <a href="checkout.php" class="btn btn-success btn-block">
                            Checkout <i class="glyphicon glyphicon-menu-right"></i>
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
                                <?php 
                                }        
                    }else
                    {
                        echo "El carrito está vacío.";
                    }
                    ?>
           
    </div>
    
    <script>
  function updateCartItem(productName, productPrice, inputElement) {
    var quantity = $(inputElement).val();
    var subtotal = productPrice * quantity;

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

    </script>

</body>

</html>