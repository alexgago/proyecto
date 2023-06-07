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
    include_once("otros/cabeceraTrabajador.php");

    if (!isset($_SESSION['email'])) {
        header("Location:Inicio.php");
    }
    if ($_SESSION['rol'] != "Trabajador") {
        header("Location:Inicio.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        switch (isset($_POST)) {
            case isset($_POST["administrar_local"]):
                header("location: administrar_local.php");
                break;
            case isset($_POST["administrar_vivienda"]):
                header("location: administrar_vivienda.php");
                break;
            case isset($_POST["administrar_usuarios"]):
                header("location: administrar_usuarios.php");
                break;
        }
    }
    ?>
    <br>
    <div>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="container" style="margin-top: 50px;">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card text-center" style="width: 18rem; height: 100px">
                            <a href="administrar_local.php"><img src="img/admin_local.jpg" style="width: 300px; height: 200px" class="card-img-top" alt="..."></a>
                            <div class="card-body ">
                                <button name="administrar_local" class="btn btn-primary">Administrar locales</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem; height: 100px">
                            <a href="administrar_vivienda.php"><img src="img/admi_vivienda.jpg" style="width: 300px; height: 200px" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <button name="administrar_vivienda" class="btn btn-primary">Administrar Vivienda</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem; height: 100px">
                            <a href="administrar_usuarios.php"><img src="img/admin_usuario.jpg" style="width: 300px; height: 200px" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <button name="administrar_usuarios" class="btn btn-primary">Administrar Usuarios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>