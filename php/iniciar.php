<?php

require_once __DIR__ . '/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['us'];
    $contrasena = $_POST['ps'];
    $resultado = iniciar($usuario, $contrasena);
    if ($resultado === 0) {
        header('Location: ../index.php?mensaje=status');
        session_destroy();
    } else{
        if ($resultado === 2) {
            header('Location:../index.php?mensaje=error');
            session_destroy();
        } else{
            header('Location: ../pagina.html');
        }
    }
}

function iniciar($usuario, $password){
    try {
        $pdo = Conexion::connection();

        if (!$pdo) {
            throw new UnexpectedValueException("Error de conexión a la base de datos.");
        }

        $query = "SELECT * FROM usuario WHERE usuario = :usuario AND pwd = :contrasena";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':usuario', $usuario);
        $statement->bindParam(':contrasena', $password);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $status = $row['status'];
            $_SESSION["usuario"] = $row['usuario'];
            $_SESSION["nombre"] = $row['nombre'];
            $_SESSION["Apaterno"] = $row['Apaterno'];
            $_SESSION["Amaterno"] = $row['Amaterno'];
            $_SESSION["id"] = $row['id'];
            $_SESSION["tipo"] = $row['tipo_us'];

            return $status;
        } else{
            return 2;
        }

    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
