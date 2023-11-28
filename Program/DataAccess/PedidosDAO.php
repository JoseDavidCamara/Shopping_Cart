<?php
require_once 'conexion.php';

function insertarPedido($idUsuario)
{
    try {
        $conexion = Conexion();

        $sql = "INSERT INTO pedidos (id_usuario) VALUES (:idUsuario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        $idPedido = $conexion->lastInsertId();

        $conexion = null;

        return $idPedido;

        
    } catch (PDOException $e) {
        echo "Error al insertar el pedido: " . $e->getMessage();
    } finally {
        $conexion = null;
    }
}
function añadirProductosAlPedido($idPedido, $idProducto , $cantidad)
{
    $conexion = Conexion();
    
        $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad) VALUES
                (:idPedido, :idProducto, :cantidad)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
    
    $conexion = null;
}