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
    $id = $_POST['id'];
    
    if (modificar($nombre, $apaterno, $amaterno, $usuario, $password, $tipo, $id)) {
        header('Location: ../inicio.php?mensaje=modificado');
        exit();
    } else{
        header('Location: ../inicio.php?mensaje=error');
        exit();
    }
    
} else{
    header('Location: cerrar.php');
    exit();
}

function modificar($nombre, $apaterno, $amaterno, $usuario, $password, $tipo, $id){

    $pdo = Conexion::connection();

    $queryTipo = "SELECT id FROM tipo_usuario WHERE descripcion = :tipo";
    $stmtTipo = $pdo->prepare($queryTipo);
    $stmtTipo->bindParam(':tipo', $tipo);
    $stmtTipo->execute();
    $tipoId = $stmtTipo->fetchColumn();

    $query = "UPDATE usuario SET nombre = :nombre, Apaterno = :apaterno, Amaterno = :amaterno, usuario = :usuario, pwd = :password, tipo_us = :tipoId WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apaterno', $apaterno);
    $statement->bindParam(':amaterno', $amaterno);
    $statement->bindParam(':usuario', $usuario);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':tipoId', $tipoId, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return true;
}
