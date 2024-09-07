<?php

require_once __DIR__ . "/php/conexion.php";

$pdo = Conexion::connection();

if (!$pdo) {
    throw new UnexpectedValueException("Error en la conexión a la base de datos.");
}

$query = "SELECT * from tipo_usuario";
$statement = $pdo->prepare($query);
$statement->execute();
$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrar.css">
    <title>Registrarme</title>
</head>
<body>
    <div id="contenedor">
        <form action="php/crear.php" method="POST">
            <table>
                <th colspan="2">
                    <h1>Registrarme uwu</h1>
                </th>
                <tbody>
                    <tr>
                        <td>
                            <label for="nombre">Nombre: </label>
                        </td>
                        <td>
                            <input type="text" name="nombre" id="Nombre">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Apaterno">Apellido Paterno: </label>
                        </td>
                        <td>
                            <input type="text" name="Apaterno" id="Apaterno">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Amaterno">Apellido Materno: </label>
                        </td>
                        <td>
                            <input type="text" name="Amaterno" id="Amaterno">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="us">Usuario: </label>
                        </td>
                        <td>
                            <input type="text" name="us" id="usuario">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ps">Contraseña : </label>
                        </td>
                        <td>
                            <input type="text" name="ps" id="ps">
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
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Registrar">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="index.php">Iniciar sesión</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
