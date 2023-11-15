<?php

require_once 'conexion.php';

class UsuarioDAO {

    public function validar_credenciales($correo, $contrasena) {
        $conexion =Conexion();
        try {
            $consulta = "SELECT * FROM usuarios WHERE correo=:correo AND contrasena=:contrasena";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
            $sentencia->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sentencia->execute();

            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            return !empty($resultado); // Devuelve true si se encuentra al menos un resultado
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
?>
