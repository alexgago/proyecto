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
		
		form {width: 100%;max-width: 600px;margin: 0 auto;flex-direction: column;justify-content: center;align-items: center;background:rgb(191, 208, 240); text-align: center; padding-bottom: 10px;}
    	p{font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;}
	
	</style>

<body>

    <?php
    
    session_start();
    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");
    $con = ConectaDB::singleton();
    if (isset($_SESSION['email'])) {
        if ( $_SESSION['rol'] == "Trabajador") {
            include_once("otros/cabeceraTrabajador.php");
        }else{
            include_once("otros/cabeceraUsuario.php");
        }
        $datos = $con->seleccionarUsuario($_SESSION['email']);
    }else{
        include_once("otros/cabeceraprincipal.php");
    }

    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <H1>Contacta con nosotros</H1>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="nombre" value="<?php if(isset($datos['nombre'])){ echo $datos['nombre'];} ?>">
        </div>
        <div class="mb-3">
            <label for="primer_ape" class="form-label">Primer Apellido</label>
            <input type="text" id="primer_ape" class="form-control" name="primer_ape" value="<?php if(isset($datos['pri_apellido'])){ echo $datos['pri_apellido'];} ?>">
        </div>
        <div class="mb-3">
            <label for="segundo_ape" class="form-label">Segundo Apellido</label>
            <input type="text" id="segundo_ape" class="form-control" name="segundo_ape" value="<?php if(isset($datos['seg_apellido'])){ echo $datos['seg_apellido'];} ?>">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" id="telefono" minlength="9" maxlength="9" pattern="[6-9][0-9]{8}" class="form-control" name="telefono" title="El telefono debe empezar por 6, 7, 8 o 9" value="<?php if(isset($datos['telefono'])){ echo $datos['telefono'];} ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="text" id="email" class="form-control" name="email" value="<?php if(isset($datos['correo'])){ echo $datos['correo'];} ?>" required>
        </div>
        <div class="mb-3">
            <label for="duda" class="form-label">Escribe aqui en que podemos ayudarte</label>
            <input type="textarea" id="duda" class="form-control" name="duda" required>
        </div>

        <input type="submit" name="contacta" class="btn btn-primary" value="Enviar">

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>