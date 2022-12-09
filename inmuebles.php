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

<body>

    <?php
    
    session_start();

    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");

    if (isset($_SESSION['email'])) {
        if ( $_SESSION['rol'] == "Trabajador") {
            include_once("otros/cabeceraTrabajador.php");
        }else{
            include_once("otros/cabeceraUsuario.php");
        }
    }else{
        include_once("otros/cabeceraprincipal.php");
    }

    $conexion = ConectaDB::singleton();
    ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        switch (isset($_POST)) {
            case isset($_POST["alquiler_local"]):
                header("location: alquiler_local.php");
                break;
            case isset($_POST["alquiler_vivienda"]):
                header("location: alquiler_vivienda.php");
                break;
            case isset($_POST["compra_local"]):
                header("location: compra_local.php");
                break;
            case isset($_POST["ordenes"]):
                header("location: ficha_ordenes.php");
                break;
            case isset($_POST["compra_vivienda"]):
                header("location: compra_vivienda.php");
                break;
        }
    }
    ?>
    <div class="                           
                    ">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="container" style="margin-top: 50px;">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="alquiler_localphp"><img src="img/alquilar_local.jpg" class="card-img-top" alt="..."></a>
                            <div class="card-body ">
                                <button name="alquiler_local" class="btn btn-primary">Alquiler de local</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="alquiler_vivienda.php"><img src="img/alquilar_vivienda.jpg" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <button name="alquiler_vivienda" class="btn btn-primary">Alquiler de Vivienda</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container" style="text-align: center; justify-content: center;">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <a href="compra_local.php"><img src="img/compra_local.jpg" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <button name="compra_local" class="btn btn-primary">Comprar local</button>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: center; justify-content: center;">
                        <div class="card text-center" style="width: 17rem;">
                            <a href="compra_vivienda.php"><img src="img/compra_vienda.jpg" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <button name="compra_vivienda" value="" class="btn btn-primary">Compra Vivienda</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>