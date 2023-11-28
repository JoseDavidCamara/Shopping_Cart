<?php
session_start();
if (!isset($_SESSION['usu_nombre'])) {
    header("Location: login.php");
}
require_once '../Business/ProductClass.php';
//In this code save the price and quantity of each product to send it to the window.onload function() in carrito.js
if (isset($_SESSION["carrito"])) {
    $carrito = $_SESSION["carrito"];

    $quantities = array();
    $prices = array();

    foreach ($carrito as $item) {
        // Deserializae obect product
        $product = unserialize($item);
        //Acced to the Product object properties
        $quantities[$product->getName()] = $product->getQuantity();
        $prices[$product->getName()] = $product->getPrice();
    }

    $data = array(
        'quantities' => $quantities,
        'prices' => $prices
    );
    
    
    if (empty($data)) {
        echo json_encode(array('error' => 'Empty data'));
    } else {
        echo json_encode($data);
    }
} else {
    echo json_encode(array('error' => 'Cart not found'));
}
?>