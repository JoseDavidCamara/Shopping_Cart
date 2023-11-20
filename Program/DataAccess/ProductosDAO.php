<?php 
require 'conexion.php';

function devolver_productos()
{
    $conexion=Conexion();
    try{
        $consulta=$conexion->prepare("SELECT * FROM productos");
        $consulta->execute();
        $listado=[];
        while($registro=$consulta->fetch())
        {
            array_push($listado,$registro['id_producto']);
            array_push($listado,$registro['nombre_producto']);
            array_push($listado,$registro['descripcion']);
            array_push($listado,$registro['precio']);
        }

        return $listado;
    }
    catch (PDOException $e)
    {
      die("Error al ejecutar la consulta: ". $e->getMessage());
    }
}
  
//dDEspues de mostrar el producto , añadir un array d sesion lo de añadir el producto cada vez que presionas un producto y después hacer modificar cantidad
