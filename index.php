<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="mensaje">
        <?php

        if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'status') {
            $mensajeError = "Acceso no autorizado, su cuenta se encuentra desactivada.";
            ?>

            <div class="error"> <?php echo $mensajeError ?></div>

        <?php } ?>
        
        <?php

            if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'error') {
                $mensajeError = "Inicio de sesión fallido, verifica tus credenciales.";
                ?>

                <div class="error"> <?php echo $mensajeError ?></div>

        <?php } ?>
        
        <?php

            if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'error2') {
                $mensajeError = "Por favor inicia sesión para acceder a esta página.";
                ?>

                <div class="error"> <?php echo $mensajeError ?></div>

        <?php } ?>
        
        <?php

            if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'registro') {
                $mensajeError = "Regisro exitoso, por favor inicia sesión";
                ?>

                <div class="mensaje"> <?php echo $mensajeError ?></div>

        <?php } ?>

        <?php

        if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'cierre') {
            $mensajeError = "Cierre de sesión exitoso, vuelva pronto!";
            ?>

            <div class="mensaje"> <?php echo $mensajeError ?></div>

        <?php } ?>

    </div>
    <div class="contenedor-login">
        <h2 class="titulo-login">Iniciar sesión</h2>
        <form class="formulario-login" action="php/iniciar.php" method="POST">
            <input type="text" class="campo-login" name="us" placeholder="Usuario">
            <input type="password" class="campo-login" name="ps" placeholder="Contraseña">
            <button class="boton-login">Iniciar sesión</button>
        </form>
        <a href="crear.php">Crear cuenta</a>
    </div>
</body>
</html>
