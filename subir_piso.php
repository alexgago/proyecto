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
		
		form {width: 100%;max-width: 800px;margin: 0 auto;flex-direction: column;justify-content: center;align-items: center;background:rgb(191, 208, 240); text-align: center; padding-bottom: 10px;}
    	p{font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;}
	
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
    if ($_SESSION['rol']!= "Trabajador") {
        header("Location:Inicio.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['subir_piso'])){
            $con->insertar_vivienda($_POST['venta_alquiler'], $_POST['metros'], $_POST['baños'], $_POST['habitacion'], $_POST['plantas'], $_POST['portal'], $_POST['puerta'], $_POST['numero'], $_POST['escalera'], $_POST['calle'], $_POST['municipio'], $_POST['cod_postal'], $_POST['precio']);
            header("Location: administrar_vivienda.php");
        }
    }
    
    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <H1>Subir Vivienda</H1>
        <div class="mb-3">
            <label for="metros" class="form-label">Metros</label>
            <input type="number" id="metros" class="form-control" name="metros" required>
        </div>
        <div class="mb-3">
            <label for="habitaciones" class="form-label">Habitaciones</label>
            <input type="number" id="habitaciones" class="form-control" name="habitaciones" required>
        </div>
        <div class="mb-3">
            <label for="lavavo" class="form-label">Baños:</label>
            <input type="number" id="lavavo" class="form-control" name="lavavo">
        </div>
        <div class="mb-3">
            <label for="Plantas" class="form-label">Plantas:</label>
            <input type="number" id="Plantas" class="form-control" name="Plantas" required>
        </div>
        <div class="mb-3">
            <label for="portal" class="form-label">portal:</label>
            <input type="text" id="portal" class="form-control" name="portal" required>
        </div>
        <div class="mb-3">
            <label for="escalera" class="form-label">Escalera:</label>
            <input type="text" id="escalera" class="form-control" name="escalera" >
        </div>
        <div class="mb-3">
            <label for="puerta" class="form-label">Puerta:</label>
            <input type="text" id="puerta" class="form-control" name="puerta" required>
        </div>
        <div class="mb-3">
            <label for="Calle" class="form-label">Calle:</label>
            <input type="text" id="Calle" class="form-control" name="Calle" required>
        </div>
        <div class="mb-3">
            <label for="Numero" class="form-label">Numero:</label>
            <input type="text" id="eNumeromail" class="form-control" name="Numero" required>
        </div>
        <div class="mb-3">
            <label for="Municipio" class="form-label">Municipio:</label>
            <input type="text" id="Municipio" class="form-control" name="Municipio" required>
        </div>
        <div class="mb-3">
            <label for="cod_postal" class="form-label">Código postal:</label>
            <input type="text" id="cod_postal" minlength="5" maxlength="5" pattern="[0-5][0-9][0-9]{3}" class="form-control" title="El codigo postal debe empezar entre 0 y 5" class="form-control" name="cod_postal" required>
        </div>
        <div class="mb-3">
            <label for="Precio" class="form-label">Precio:</label>
            <input type="text" id="Precio" class="form-control" name="Precio" name="cod_postal" required>
        </div>
        <div class="mb-3">
            <label for="Venta_Alquiler" class="form-label">Venta/Alquiler:</label>
            <select name="Venta_Alquiler">
                <option style="height:50px" value="venta">Venta</option>
                <option style="height:50px" value="alquilar">Alquilar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del piso:</label>
            <input type="file" id="imagen" class="form-control" name="imagen[]" multiple>
        </div>
        <input type="submit" name="subir_piso" class="btn btn-primary" value="Enviar">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>