<?php

session_start();

require_once __DIR__ . "/php/conexion.php";

$pdo = Conexion::connection();

if (!$pdo) {
    throw new UnexpectedValueException("Error en la conexión a la base de datos.");
}

$query = "SELECT u.id, u.nombre, u.Apaterno, u.Amaterno, u.usuario, u.pwd, u.status,tu.descripcion AS tipo_usuario_descripcion FROM usuario u INNER JOIN tipo_usuario tu ON u.tipo_us = tu.id;";

$statement = $pdo->prepare($query);
$statement->execute();
$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement = $pdo->prepare($query);
$statement->execute();
$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Panel Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="inicio.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Administrar usuarios</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Acciones
            </div>


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="php/cerrar.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cerrar sesión</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <div class="input-group">
                        <h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
                    </div>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                        
                    <div class="tabla">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Tipo de usuario</th>
                                <th>Status</th>
                                <th colspan="2">Acciones</th>
                            </thead>
                            <tbody>
                            <?php
                    
                                foreach ($resultado as $row) {
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>" . $row['Apaterno'] . "</td>";
                                    echo "<td>" . $row['Amaterno'] . "</td>";
                                    echo "<td>" . $row['usuario'] . "</td>";
                                    echo "<td>" . $row['pwd'] . "</td>";
                                    echo "<td>" . $row['tipo_usuario_descripcion'] . "</td>";
                                    if ( $row['status'] == 1){
                                        echo "<td>Activo</td>";
                                    }else{
                                        echo "<td>Inactivo</td>";
                                    }
                                    echo '<form id="formularioUsuarios" method="post" action="php/procesar_usuario.php">';
                                    echo "<td><button type='submit' name='action' value='modificar'>Modificar</button></td>";
                                    echo "<td><button type='submit' name='action' value='eliminar'>Eliminar</button></td>";
                                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>
