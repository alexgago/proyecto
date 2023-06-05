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
    include_once 'otros/funciones_variables.php';
    include_once("otros/cabeceraprincipal.php");
    include_once("conexion/conexion.php");
    $con = ConectaDB::singleton();
    $errores = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //print_r($_POST);
        print_r($_FILES);
        if (isset($_POST['registro'])) {
            if ($con->comprobarCorreo($_POST['email']) != false) {
                $errores[] = "ESE CORREO YA ESTA EN USO";
            } elseif ($con->comprobarDNI($_POST['DNI']) != false) {
                $errores[] = "ESE DNI YA ESTA EN USO";
            } else {
                if ($_FILES['imagen'] == null) {
                    $con->insertar_usuario($_POST['DNI'], $_POST['nombre'], $_POST['primer_ape'], $_POST['segundo_ape'], $_POST['email'], $_POST['direccion'], $_POST['telefono'], $_POST['cod_postal'], "Usuario", "");
                } else {
                    $tipoArchivo = $_FILES['imagen']['type'];
                    $nombreArchivo = $_FILES['imagen']['name'];
                    $tamanoArchivo = $_FILES['imagen']['size'];
                    $imagenSubida = fopen($_FILES['imagen']['tmp_name'], 'r');
                    $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                    $con->insertar_usuario($_POST['DNI'], $_POST['nombre'], $_POST['primer_ape'], $_POST['segundo_ape'], $_POST['email'], $_POST['direccion'], $_POST['telefono'], $_POST['cod_postal'], "Usuario", $nombreArchivo);
                    $con->insertarimagen_usario($_POST['DNI'], $nombreArchivo, $tipoArchivo, $binariosImagen);
                }
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] != 'GET' && empty($errores)) {
        //procesa.
        if (isset($_POST['registro'])) {

            $_SESSION['DNI'] = $_POST['DNI'];
            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['apellidos'] = $_POST['primer_ape'] . " " . $_POST['segundo_ape'];
            $_SESSION['dir'] = $_POST['direccion'];
            $_SESSION['tel'] = $_POST['telefono'];
            $_SESSION['cod_postal'] = $_POST['cod_postal'];
            $_SESSION['rol'] = "Usuario";
            $_SESSION["email"] = $_POST['email'];
            header("Location:inicio.php");
        }
    }
    ?>
    <br>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <br>    
    <H1>Registro de usuario</H1>
        <div id="formulario">
            <div class="mb-3">
                <label for="nombre" style="width: 200px;" class="form-label">Nombre:</label>
                <input type="text" style="width: 400px;"id="nombre" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="primer_ape" style="width: 200px;" class="form-label">Primer Apellido:</label>
                <input type="text" style="width: 400px;" id="primer_ape" class="form-control" name="primer_ape" required>
            </div>
            <div class="mb-3">
                <label for="segundo_ape" style="width: 200px;" class="form-label">Segundo Apellido:</label>
                <input type="text" style="width: 400px;" id="segundo_ape" class="form-control" name="segundo_ape">
            </div>
            <div class="mb-3">
                <label for="nombre" style="width: 200px;" class="form-label">DNI:</label>
                <input type="text" style="width: 400px;" id="DNI" class="form-control" name="DNI" required>
                <div class="error">
                    <?php if (!empty($errores)) {
                        echo implode('<br>', $errores);
                    } ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="telefono" style="width: 200px;" class="form-label">Telefono:</label>
                <input type="text" style="width: 400px;" id="telefono" minlength="9" maxlength="9" pattern="[6-9][0-9]{8}" class="form-control" name="telefono" title="El telefono debe empezar por 6, 7, 8 o 9" required>
            </div>
            <div class="mb-3">
                <label for="email" style="width: 200px;" class="form-label">email:</label>
                <input type="text" style="width: 400px;" id="email" class="form-control" name="email" required>
                <div class="error">
                    <?php if (!empty($errores)) {
                        echo implode('<br>', $errores);
                    } ?>
                </div>

            </div>
            <div class="mb-3">
                <label for="direccion" style="width: 200px;" class="form-label">Dirección:</label>
                <input type="text" style="width: 400px;" id="direccion" class="form-control" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="cod_postal" style="width: 200px;" class="form-label">Código postal:</label>
                <input type="text" style="width: 400px;" id="cod_postal" minlength="5" maxlength="5" pattern="[0-5][0-9][0-9]{3}" class="form-control" name="cod_postal" title="El codigo postal debe empezar entre 0 y 5" class="form-control" name="cod_postal" required>
            </div>
            <div class="mb-3">
                <label for="imagen" style="width: 200px;" class="form-label">Imagen del usuario: (opcional)</label>
                <input type="file" style="width: 400px; margin:0 auto;" id="imagen" class="form-control" name="imagen">
            </div>
            <input type="submit" name="registro" class="btn btn-primary" value="Enviar">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>