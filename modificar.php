<?php

require_once __DIR__ . '/php/conexion.php';

session_start();

$pdo = Conexion::connection();

if (!$pdo) {
    throw new UnexpectedValueException("Error en la conexión a la base de datos.");
}

$id = $_GET['id'];

$query = "SELECT * from tipo_usuario";
$statement = $pdo->prepare($query);
$statement->execute();
$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM usuario WHERE id = :id";
$statement = $pdo->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$resultado2 = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar usuario</title>
</head>
<body>
    <div class="modificar">
        <table>
            <thead>
                <th colspan="2">
                    <h1>Modificar usuario</h1>
                </th>
            </thead>
            <tbody>
                <form action="php/modificar.php" method="POST">
                    <tr>
                        <td>
                            <label for="nombre">Nombre: </label>
                        </td>
                        <td>
                            <input type="text" name="nombre" value="<?php echo $resultado2['nombre']?>"" id="Nombre">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Apaterno">Apellido Paterno: </label>
                        </td>
                        <td>
                            <input type="text" name="Apaterno" value="<?php echo $resultado2['Apaterno']?>"" id="Apaterno">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Amaterno">Apellido Materno: </label>
                        </td>
                        <td>
                            <input type="text" name="Amaterno" value="<?php echo $resultado2['Amaterno']?>" id="Amaterno">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="us">Usuario: </label>
                        </td>
                        <td>
                            <input type="text" name="us" value="<?php echo $resultado2['usuario']?>" id="usuario">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ps">Contraseña : </label>
                        </td>
                        <td>
                            <input type="text" name="ps" value="<?php echo $resultado2['pwd']?>" id="ps">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="tipo">Tipo de usuario:</label>
                        </td>
                        <td>
                            <select name="tipo" id="tipo">
                                <?php
                                
                                    foreach ($resultado as $row) {
                                        ?> <option value="<?php echo $row["descripcion"]?>"><?php echo $row["descripcion"]?></option>
                                
                                <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="status">Status:</label>
                        </td>
                        <td>
                            <select name="status" id="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </td>
                    </tr>
                    <input type="hidden" name="idUs" value="<?php $idUs = $_GET['id']; echo $idUs;  ?>" id="idUs">
                    <tr>
                        <td>
                            <input type="submit" value="Modificar">
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</body>
</html>
