<?php 
session_start();

require_once '../Business/PedidoClass.php';
if(!isset($_SESSION['usu_nombre'])){
    header("Location: login.php");
}

$listado=listaPedido($_SESSION['usu_id']);

foreach($listado as $pedido)
{
    echo '<br>.................................................................................<br>';
    echo '<br>'.$pedido->getNombreProducto().'<br>'.
             $pedido->getCantidad().'<br>'.
             '<br>'.$pedido->getFechaPedido();
}