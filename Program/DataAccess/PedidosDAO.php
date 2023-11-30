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

function pedidos($user_id, $fecha = null)
{
    try {
        $conexion = Conexion();

        if ($fecha) {
            $consulta = $conexion->prepare("SELECT nombre_producto, cantidad, fecha_pedido 
                                           FROM usuarios, pedidos_productos, pedidos, productos 
                                           WHERE usuarios.id_usuario = pedidos.id_usuario 
                                           AND pedidos.id_pedido = pedidos_productos.id_pedido
                                           AND pedidos_productos.id_producto = productos.id_producto
                                           AND usuarios.id_usuario = :user_id
                                           AND DATE(fecha_pedido) = :fecha
                                           ORDER BY fecha_pedido DESC");
            $consulta->bindParam('fecha', $fecha);
        } else {
            $consulta = $conexion->prepare("SELECT nombre_producto, cantidad, fecha_pedido 
                                           FROM usuarios, pedidos_productos, pedidos, productos 
                                           WHERE usuarios.id_usuario = pedidos.id_usuario 
                                           AND pedidos.id_pedido = pedidos_productos.id_pedido
                                           AND pedidos_productos.id_producto = productos.id_producto
                                           AND usuarios.id_usuario = :user_id
                                           ORDER BY fecha_pedido DESC");
        }

        $consulta->bindParam('user_id', $user_id);
        $consulta->execute();

        return $consulta;
    } catch (PDOException $e) {
        echo "Error al sacar el id de usuario: " . $e->getMessage();
    } finally {
        $conexion = null;
    }
}
