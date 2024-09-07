<?php

session_start();

require_once __DIR__ . '/conexion.php';

$pdo = Conexion::connection();

if (!$pdo) {
    throw new UnexpectedValueException("Error en la conexión a la base de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    if ($action === 'modificar') {
        header("Location: ../modificar.php?id=$id");
    } elseif ( $action === 'eliminar') {
        $query = "delete from usuario where id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        header('Location: ../inicio.php');
     }
} else{
    header('Location: cerrar.php');
    exit();
}
