<?php
session_start();
require_once '../Business/ProductClass.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "updateCartItem") {
        $updatedProductName = $_POST['name'];
        $updatedQuantity = $_POST['value'];

        $itemUpdated = false;

        foreach ($_SESSION["carrito"] as $key => $item) {
            $product = unserialize($item);

            if ($product->getName() == $updatedProductName) {
                // Actualizar la cantidad del producto
                $product->setQuantity($updatedQuantity);

                // Volver a serializar y actualizar el elemento en la sesión
                $_SESSION["carrito"][$key] = serialize($product);

                $itemUpdated = true;
                break;
            }
        }

        if ($itemUpdated) {
            echo 'ok'; // Enviar una respuesta de éxito
        } else {
            echo 'error'; // Enviar una respuesta de error si el producto no se encuentra en el carrito
        }
    }
}
?>