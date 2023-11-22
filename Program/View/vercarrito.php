<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Cart - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
    <script>
        function updateCartItem(obj, id) {
            $.get("vercarrito.php", {
                action: "updateCartItem",
                id: id,
                qty: obj.value
            }, function(data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
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

    <div class="container">
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
                <!-- Product Rows -->
                <!-- Replace the following block with your PHP loop for cart items -->
                <tr>
                    <td>Product Name</td>
                    <td>$100 USD</td>
                    <td>
                        <input type="number" class="form-control" value="1" onchange="updateCartItem(this, 'rowid')">
                    </td>
                    <td>$100 USD</td>
                    <td>
                        <a href="#" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="glyphicon glyphicon-trash"></i> Remove
                        </a>
                    </td>
                </tr>
                <!-- End of Product Rows -->
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
    </div>
</body>

</html>