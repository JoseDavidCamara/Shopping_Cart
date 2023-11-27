<?php
session_start();
require_once '../Business/ProductClass.php';
if (isset($_SESSION["carrito"])) {
    $carrito = $_SESSION["carrito"];

    $quantities = array();
    $prices = array();

    foreach ($carrito as $item) {
        // Deserializa el objeto Product
        $product = unserialize($item);

        // Accede a las propiedades del objeto Product
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