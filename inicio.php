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
    if (isset($_SESSION['email'])) {

        if ($_SESSION['email'] == "") {
            unset($_SESSION['email']);
            include_once("otros/cabeceraprincipal.php");
        }
        if ($_SESSION['rol'] == "Trabajador") {
            include_once("otros/cabeceraTrabajador.php");
        } else {
            include_once("otros/cabeceraUsuario.php");
        }
    } else {
        include_once("otros/cabeceraprincipal.php");
    }


    $con = ConectaDB::singleton();
    $usuarios =  $con->seleccionarTrabajador("Trabajador");

    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <div class="container" style="margin-top: 50px;">
            <div class="row align-items-center">

                <H1>Trabajadores</H1>
                <?php for ($i = 0; $i < count($usuarios); $i++) {  ?>

                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <h3><?php echo $usuarios[$i]["nombre"]; ?></h3>
                            <h3><?php echo $usuarios[$i]["pri_apellido"] . " " . $usuarios[$i]["seg_apellido"]; ?></h3>
                            <h3><?php echo $usuarios[$i]["correo"]; ?></h3>
                            <?php $imagen = $con->seleccionarfoto($usuarios[$i]["DNI"]);
                            if ($imagen == null) { ?>
                                <img src="img/admi_vivienda.jpg" class="card-img-top" alt="...">
                            <?php } else {
                            ?>
                                <img src="data:<?php echo $imagen[0]['tipo']; ?>;base64,<?php echo  base64_encode($imagen[0]["imagen"]); ?>" class="card-img-top" alt="...">
                            <?php } ?>
                        </div>
                    </div>
                <?php

                } ?>
            </div>

        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>