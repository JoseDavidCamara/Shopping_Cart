<?php
session_start();
require_once '../Business/ProductClass.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "removeCartItem") {
        $removedProductName = $_POST['name'];

        $itemRemoved = false;

        foreach ($_SESSION["carrito"] as $key => $item) {
            $product = unserialize($item);

            if ($product->product_name == $removedProductName) {
                unset($_SESSION["carrito"][$key]);
                $itemRemoved = true;
                break;
            }
        }

        if ($itemRemoved) {
            echo 'ok'; // Send a success response
        } else {
            echo 'error'; // Send an error response if the item is not found in the cart
        }
    }
}
?>