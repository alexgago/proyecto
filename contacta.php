<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/navbar.css">
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    <style>
        .sin_permisos {
            display: none;
        }
    </style>
    <style>
        form {
            width: 130%;
            max-width: 800px;
            margin: 0 auto;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgb(191, 208, 240);
            text-align: center;
            padding-bottom: 10px;

        }

        p {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
    </style>

<body>

    <?php

    session_start();
    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");
    $con = ConectaDB::singleton();
    if (isset($_SESSION['email'])) {
        if ($_SESSION['rol'] == "Trabajador") {
            include_once("otros/cabeceraTrabajador.php");
        } else {
            include_once("otros/cabeceraUsuario.php");
        }
        $datos = $con->seleccionarUsuario($_SESSION['email']);
    } else {
        include_once("otros/cabeceraprincipal.php");
    } 
    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        //procesa.
        $con = ConectaDB::singleton();
        if (isset($_POST['contacta'])) {
            $nombre = filtrado ($_POST['nombre']);
            $pri_apellido = filtrado($_POST['primer_ape']);
            $seg_apellido = filtrado($_POST['segundo_ape']);
            $telefono = filtrado ($_POST['telefono']);
            $correo = filtrado($_POST['email']);
            $mensaje = filtrado($_POST['duda']);

            $apellidos = $pri_apellido . " " . $seg_apellido;
            $asunto = "Consulta del cliente: " . $nombre . " " . $apellidos;
            $consulta = $correo."\n".$asunto."\n".$telefono."\n".$mensaje;
            
            $header = "From: inmobiliaria@consulta.com\r\n";
            $header .= "Reaply-To: inmobiliaria@consulta.com\r\n";
            $header .= "X-Mailer: PHP/" . phpversion();
            $mail = @mail("gagoplay99@gmail.com", $asunto, $consulta, $header);
            $_SESSION ['error'] = var_dump(mail("gagoplay99@gmail.com", $asunto, $consulta, $header));
            echo $_SESSION['error'];
            header("location: contacta.php");
        }
    }
    
    ?>
    <br>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="width : 150%;">
        <H1>Contacta con nosotros</H1>
        <div id="formulario">
            <div class="mb-3">
                <label for="nombre" class="form-label" style="width: 200px;">Nombre:</label>
                <input type="text" style="width: 400px;" id="nombre" class="form-control" name="nombre" value="<?php if (isset($datos['nombre'])) {
                                                                                                                    echo $datos['nombre'];
                                                                                                                } ?>">
            </div>
            <div class="mb-3">
                <label for="primer_ape" style="width: 200px;" class="form-label">Primer Apellido:</label>
                <input type="text" id="primer_ape" style="width: 400px;" class="form-control" name="primer_ape" value="<?php if (isset($datos['pri_apellido'])) {
                                                                                                                            echo $datos['pri_apellido'];
                                                                                                                        } ?>">
            </div>
            <div class="mb-3">
                <label for="segundo_ape" style="width: 200px;" class="form-label">Segundo Apellido:</label>
                <input type="text" id="segundo_ape" style="width: 400px;" class="form-control" name="segundo_ape" value="<?php if (isset($datos['seg_apellido'])) {
                                                                                                                                echo $datos['seg_apellido'];
                                                                                                                            } ?>">
            </div>
            <div class="mb-3">
                <label for="telefono" style="width: 200px;" class="form-label">Telefono:</label>
                <input type="text" id="telefono" style="width: 400px;" minlength="9" maxlength="9" pattern="[6-9][0-9]{8}" class="form-control" name="telefono" title="El telefono debe empezar por 6, 7, 8 o 9" value="<?php if (isset($datos['telefono'])) {
                                                                                                                                                                                                                            echo $datos['telefono'];
                                                                                                                                                                                                                        } ?>">
            </div>
            <div class="mb-3">
                <label for="email" style="width: 200px;" class="form-label">EMAIL:</label>
                <input type="text" style="width: 400px;" id="email" class="form-control" name="email" value="<?php if (isset($datos['correo'])) {
                                                                                                                    echo $datos['correo'];
                                                                                                                } ?>" required>
            </div>
            <div class="mb-3">
                <label for="duda" style="width: 300px;" style="width: 300px;" class="form-label">Escribe aqui en que podemos ayudarte</label>
                <textarea style="width: 550px; margin: 0 auto;" id="duda" class="form-control" name="duda" cols="60" rows="8" required></textarea>
            </div>

            <input type="submit" name="contacta" class="btn btn-primary" value="Enviar">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>