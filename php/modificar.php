<?php

require_once __DIR__ . '/conexion.php';

$pdo = Conexion::connection();

if (!$pdo) {
    throw new UnexpectedValueException("Error en la conexión a la base de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['Apaterno'];
    $amaterno = $_POST['Amaterno'];
    $usuario = $_POST['us'];
    $password = $_POST['ps'];
    $tipo = $_POST['tipo'];
    $idUs = $_POST['idUs'];
    $status = $_POST['status'];
    
    if (modificar($nombre, $apaterno, $amaterno, $usuario, $password, $tipo, $idUs, $status)) {
        header('Location: ../inicio.php?mensaje=modificado');
    } else{
        header('Location: ../inicio.php?mensaje=error');
    }
    
} else{
    header('Location: cerrar.php');
    exit();
}

function modificar($nombre, $apaterno, $amaterno, $usuario, $password, $tipo, $id, $status){

    try {
        $pdo = Conexion::connection();

        $queryTipo = "SELECT id FROM tipo_usuario WHERE descripcion = :tipo";
        $stmtTipo = $pdo->prepare($queryTipo);
        $stmtTipo->bindParam(':tipo', $tipo);
        $stmtTipo->execute();
        $tipoId = $stmtTipo->fetchColumn();

        $query = "UPDATE usuario SET nombre = :nombre, Apaterno = :apaterno, Amaterno = :amaterno, usuario = :usuario, pwd = :password, tipo_us = :tipoId, status = :status WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apaterno', $apaterno);
        $statement->bindParam(':amaterno', $amaterno);
        $statement->bindParam(':usuario', $usuario);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':tipoId', $tipoId, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':status', $status, PDO::PARAM_INT);
        $statement->execute();
        return true;

    } catch (\Throwable $th) {
        echo "Error: ". $th->getMessage();
        return false;
    }

    
}
