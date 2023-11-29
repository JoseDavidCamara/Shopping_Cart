<?php
require 'conexion.php';

function devolver_productos($fNombre = null, $fMaxP = null, $fMinP = null)
{
    $conexion = Conexion();

    try {
        // Construye la consulta base
        $query = "SELECT * FROM productos";

        // Añade condiciones según los filtros proporcionados
        $params = array(); // Para almacenar los parámetros de la consulta

        if (!empty($fNombre)) {
            $query .= " WHERE nombre_producto LIKE :nombre";
            $params[':nombre'] = "%$fNombre%";
        }
        
        if (!empty($fMaxP) || !empty($fMinP)) {
            if (!empty($fNombre)) {
                $query .= " AND";
            } else {
                $query .= " WHERE";
            }
        
            if (!empty($fMinP) && !empty($fMaxP)) {
                $query .= " precio BETWEEN :min_precio AND :max_precio";
                $params[':min_precio'] = $fMinP;
                $params[':max_precio'] = $fMaxP;
            } elseif (!empty($fMinP)) {
                $query .= " precio >= :min_precio";
                $params[':min_precio'] = $fMinP;
            } elseif (!empty($fMaxP)) {
                $query .= " precio <= :max_precio";
                $params[':max_precio'] = $fMaxP;
            }
        }

        $consulta = $conexion->prepare($query);

        // Vincula los parámetros de la consulta
        foreach ($params as $key => $value) {
            $consulta->bindValue($key, $value);
        }

        $consulta->execute();

        return $consulta;
    } catch (PDOException $e) {
        die("Error al ejecutar la consulta: " . $e->getMessage());
    }
}
