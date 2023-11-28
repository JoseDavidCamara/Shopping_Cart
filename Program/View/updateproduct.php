<?php
session_start();
if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
require_once '../Business/ProductClass.php';

//In this code are recived the name and value of each product that is updated in vercarrito.php using carrito.js function called updateCartItem
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "updateCartItem") {
        $updatedProductName = $_POST['name'];
        $updatedQuantity = $_POST['value'];  //This is th value of the input

        $itemUpdated = false;

        foreach ($_SESSION["carrito"] as $key => $item) {
            $product = unserialize($item);

            if ($product->getName() == $updatedProductName) {
                // Update the quanity of the product
                $product->setQuantity($updatedQuantity);

                //Serialize again and update the product in the $_SESSION
                $_SESSION["carrito"][$key] = serialize($product);

                $itemUpdated = true;
                break;
            }
        }

        if ($itemUpdated) {
            echo 'ok'; // send a satisfactory response 
        } else {
            echo 'error'; // Send an error message if the product doesnt exist in the shopping cart 
        }
    }
}
?>