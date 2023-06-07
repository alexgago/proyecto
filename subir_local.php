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
            width: 100%;
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
    include_once("otros/cabeceraTrabajador.php");
    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");

    $con = ConectaDB::singleton();
    $locales = $con->administrar_Local();
    if (!isset($_SESSION['email'])) {
        header("Location:Inicio.php");
    }
    if ($_SESSION['rol'] != "Trabajador") {
        header("Location:Inicio.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['subir_local'])) {
            $con->insertar_establecimiento($_POST['venta_alquiler'], $_POST['metros'], $_POST['lavavo'], $_POST['habitacion'], $_POST['plantas'], $_POS['portal'], $_POST['puerta'], $_POST['numero'], $_POST['escalera'], $_POST['calle'], $_POST['municipio'], (int)($_POST['cod_postal']), (float)$_POST['precio']);
            $max = $con->selecionarIdlocalMAx();
            print_r($max);
            for ($i = 0; $i < count($_FILES['imagen']['name']); $i++) {
                $id_foto = $i + 1;
                $nombre_imagen = $max['max(id_vivienda)'] . "_" . $id_foto;
                $tipoArchivo = $_FILES['imagen']['type'][$i];
                $tamanoArchivo = $_FILES['imagen']['size'][$i];
                $imagenSubida = fopen($_FILES['imagen']['tmp_name'][$i], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $con->insertarimagenlocal($id_foto, $max['max(id_local)'], $nombre_imagen, $binariosImagen, $tipoArchivo);
            }
            header("location: administrar_local.php");
        }
    }
    ?>
    <br>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <br>
        <H1>Subir local</H1>
        <div id="formulario">
            <div class="mb-3">
                <label for="metros" style="width: 200px;" class="form-label">Metros</label>
                <input type="text" style="width: 400px;" minlength="2" maxlength="10" pattern="[1-9][0-9]{9}" id="metros" class="form-control" name="metros" required>
            </div>
            <div class="mb-3">
                <label for="habitacion" style="width: 200px;" class="form-label">Habitaciones</label>
                <input type="text" style="width: 400px;" id="habitacion" minlength="1" maxlength="2" pattern="[1-9][0-9]" class="form-control" name="habitacion" required>
            </div>
            <div class="mb-3">
                <label for="lavavo" style="width: 200px;" class="form-label">Lavavos:</label>
                <input type="text" style="width: 400px;" minlength="1" maxlength="2" pattern="[1-9][0-9]" id="lavavo" class="form-control" name="lavavo">
            </div>
            <div class="mb-3">
                <label for="planta" style="width: 200px;" class="form-label">Plantas:</label>
                <input type="text" style="width: 400px;" minlength="1" maxlength="2" pattern="[1-9][0-9]" id="planta" class="form-control" name="planta" required>
            </div>
            <div class="mb-3">
                <label for="calle" style="width: 200px;" class="form-label">Calle:</label>
                <input type="text" style="width: 400px;" id="calle" class="form-control" name="calle" required>
            </div>
            <div class="mb-3">
                <label for="numero" style="width: 200px;" class="form-label">Numero:</label>
                <input type="text" style="width: 400px;" id="enumeromail" class="form-control" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="municipio" style="width: 200px;" class="form-label">Municipio:</label>
                <input type="text" style="width: 400px;" id="municipio" class="form-control" name="municipio" required>
            </div>
            <div class="mb-3">
                <label for="cod_postal" style="width: 200px;" class="form-label">Código postal:</label>
                <input type="text" style="width: 400px;" id="cod_postal" minlength="5" maxlength="5" pattern="[0-5][0-9][0-9]{3}" class="form-control" title="El codigo postal debe empezar entre 0 y 5" class="form-control" name="cod_postal" required>
            </div>
            <div class="mb-3">
                <label for="precio" style="width: 200px;" class="form-label">Precio:</label>
                <input type="text" style="width: 400px;" minlength="2" maxlength="9" pattern="[1-9][0-9]{8}" id="precio" class="form-control" name="precio" name="cod_postal" required>
            </div>
            <div class="mb-3">
                <label for="venta_alquiler" style="width: 200px;" class="form-label">Venta/Alquiler:</label>
                <select style="width: 400px;" name="venta_alquiler">
                    <option style="height:50px" value="venta">Venta</option>
                    <option style="height:50px" value="alquilar">Alquilar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagen" style="width: 200px;" class="form-label">Imagen del local:</label>
                <input type="file" style="width: 400px; margin: 0 auto;" id="imagen" accept="image/*" class="form-control" name="imagen[]" multiple>
            </div>
            <input type="submit" name="subir_local" accept="image/*" class="btn btn-primary" value="Enviar">
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>