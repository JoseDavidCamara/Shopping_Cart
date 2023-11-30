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

function pedidos($user_id)
{
    try {
    $conexion = Conexion();
    $consulta=$conexion->prepare("SELECT nombre_producto,cantidad,fecha_pedido from usuarios,pedidos_productos,pedidos,productos 
                              where usuarios.id_usuario=pedidos.id_usuario 
                              and pedidos.id_pedido=pedidos_productos.id_pedido
                              and pedidos_productos.id_producto=productos.id_producto
                              and usuarios.id_usuario= :user_id 
                              order by fecha_pedido desc");
    $consulta->bindParam('user_id',$user_id);
    $consulta->execute();
    return $consulta;
    }
    catch (PDOException $e) {
        echo "Error al sacar el id de usuario: " . $e->getMessage();
    }finally  {
        $conexion = null;
    }  

}