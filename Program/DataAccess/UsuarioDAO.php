<?php

require_once 'conexion.php';

class UsuarioDAO {

    public function validar_credenciales($correo, $contrasena) {
        $conexion =Conexion();
        try {
            $consulta = "SELECT * FROM usuarios WHERE email=:correo AND contraseña=:contrasena";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);
            $sentencia->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sentencia->execute();

            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    function insertar_usuario($nombre, $email, $contrasena) {
        $conexion = Conexion();
        try {
            // Verificar si el usuario ya existe antes de insertar
            $consulta_verificar = "SELECT COUNT(*) as total FROM usuarios WHERE email=:email";
            $sentencia_verificar = $conexion->prepare($consulta_verificar);
            $sentencia_verificar->bindParam(':email', $email, PDO::PARAM_STR);
            $sentencia_verificar->execute();
    
            $resultado_verificar = $sentencia_verificar->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado_verificar['total'] > 0) {
                // El usuario ya existe, lanzar una excepción con un mensaje específico
                throw new Exception("El correo electrónico ya está registrado.");
            }
    
            $consulta_insertar = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (:nombre, :email, :contrasena)";
            $sentencia_insertar = $conexion->prepare($consulta_insertar);
            $sentencia_insertar->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sentencia_insertar->bindParam(':email', $email, PDO::PARAM_STR);
            $sentencia_insertar->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $sentencia_insertar->execute();
    
            return true; // Usuario insertado correctamente
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
?>
