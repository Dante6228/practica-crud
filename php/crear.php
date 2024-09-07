<?php

require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $Apaterno = $_POST['Apaterno'];
    $Amaterno = $_POST['Amaterno'];
    $usuario = $_POST['us'];
    $contrasena = $_POST['ps'];
    $tipo = $_POST['tipo'];
    $tipo_id = consultar($tipo);
    if (registrar($nombre, $Apaterno, $Amaterno, $usuario, $contrasena, $tipo_id)) {
        header('Location: ../index.php?mensaje=registro');
    } else{
        header('Location: ../crear.php?mensaje=error');
    }
    
} else{
    header('Location: ../index.php?mensaje=error2');
    session_destroy();
}

function consultar($tipo){
    $pdo = Conexion::connection();

    if (!$pdo) {
        throw new UnexpectedValueException("Error en la conexión a la base de datos.");
    }

    $query = "SELECT id from tipo_usuario where descripcion = :tipo";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':tipo', $tipo);
    return $statement->execute();
    
}

function registrar($nombre, $apaterno, $amaterno, $usuario, $contrasena, $tipo){
    try {
        $pdo = Conexion::connection();
        
        if (!$pdo) {
            throw new UnexpectedValueException("Error de conexión a la base de datos.");
        }

        $query = "INSERT INTO usuario (nombre, Apaterno, Amaterno, usuario, pwd, tipo_us, status) VALUES (:nombre, :Apaterno, :Amaterno, :usuario, :contrasena, :tipo, 1)";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':Apaterno', $apaterno);
        $statement->bindParam(':Amaterno', $amaterno);
        $statement->bindParam(':usuario', $usuario);
        $statement->bindParam(':contrasena', $contrasena);
        $statement->bindParam(':tipo', $tipo);
        $statement->execute();
        return true;

    } catch (\Throwable $th) {
        echo "Error: ". $th->getMessage();
        return false;
    }
}
