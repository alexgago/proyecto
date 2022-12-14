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
		
		form {width: 100%;max-width: 700px;margin: 0 auto;flex-direction: column;justify-content: center;align-items: center;background:rgb(191, 208, 240); text-align: center; padding-bottom: 10px;}
    	p{font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;}
	
	</style>

<body>

<?php
session_start();
	include_once 'otros/funciones_variables.php';
    include_once("otros/cabeceraprincipal.php");
	include_once("conexion/conexion.php");

	//Si se ha enviado 	
	if ($_SERVER['REQUEST_METHOD']!='GET'){
		//validar los datos.
		$errores = [];
		$email=filtrado($_POST['email']);
        $dni = filtrado($_POST['dni']);
		
		if(empty($email)){
					$errores[]="El email esta vacío";
			}
        if(empty($dni)){
                $errores[]="EL DNI esta vacio";
        }
		if(isset($_POST['registrar'])){
           header("Location:registrar.php");
        }	
	}
	
	//Si se ha enviado y no tiene errores.
	if ($_SERVER['REQUEST_METHOD']!='GET' && empty($errores)){
		//procesa.
		if (isset($_POST['enviar'])) {
			$con = ConectaDB::singleton();
			$datos = $con->seleccionarUsuario($email, $dni);
			$_SESSION['DNI'] = $datos['DNI'];
			$_SESSION['nombre'] = $datos['nombre'];
			$_SESSION['apellidos'] = $datos['pri_apellido']. " ". $datos['seg_apellido'];
			$_SESSION['dir'] = $datos['direccion'];
			$_SESSION['tel'] = $datos['telefono'];
			$_SESSION['cod_postal'] = $datos['codigo_postal'];
			$_SESSION['rol'] = ucfirst($datos['rol']);
            $_SESSION["email"] = $email;
			header("Location:inicio.php");
        }
  

	}
	else{
			
		?>

		
		
		<br>
		<br>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">           
 			<p>Iniciar sesion</p>
            <label for="email">email:</label><br>
            <input type="text" name="email"><br><br>
            <label for="DNI">DNI:</label><br>
            <input type="text" name="dni"><br><br>
	
            <input type="submit" name="registrar" href="registrar.php" value ="Si no tienes cuenta registrate">
            <input type = "submit" name="enviar" value = "Entrar">
        </form>
	<?php     
		if (!empty($errores))  {
			echo implode('<br>', $errores);
		}
		if (!empty($_POST)){
			session_start();
			$_SESSION["email"] = $email;

		 }
		
		}
	?>
</body>
</html>