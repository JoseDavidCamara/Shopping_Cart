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

function ordersList($user_id)
{
    try {
    $conexion = Conexion();
    $param[':nombre'] = "%$user_id%";
    $sql = "SELECT* FROM pedidos WHERE id_usuario=:nombre";

    // Prepare the SQL statement
    $stmt = $conexion->prepare($sql);
    
    // Bind the parameter
    $stmt->bindParam(':idUsuario', $user_id, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();
    
    $conexion = null;

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
    }
    catch (PDOException $e) {
        echo "Error al sacar el id de usuario: " . $e->getMessage();
    }finally  {
        $conexion = null;
    }  

}