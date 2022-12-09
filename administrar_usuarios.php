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
    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");
    $con = ConectaDB::singleton();
    $usuarios = $con->administrar_usuarios();
    if (!isset($_SESSION['email'])) {
        header("Location:Inicio.php");
    }
    if ($_SESSION['rol'] != "Trabajador") {
        header("Location:Inicio.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    }

    ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="container caja" style="margin-top: 20px;">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="admin_local" border="1">
                        <thead class="text-center">
                            <tr>
                                <th style="background-color: #0d6efd; color: white;">DNI</th>
                                <th style="background-color: #0d6efd; color: white;">Nombre</th>
                                <th style="background-color: #0d6efd; color: white;">Primer apellido</th>
                                <th style="background-color: #0d6efd; color: white;">Segundo apellido</th>
                                <th style="background-color: #0d6efd; color: white;">Correo</th>
                                <th style="background-color: #0d6efd; color: white;">Dirección</th>
                                <th style="background-color: #0d6efd; color: white;">Telefono</th>
                                <th style="background-color: #0d6efd; color: white;">Codigo Postal</th>
                                <th style="background-color: #0d6efd; color: white;">Rol</th>
                                <th style="background-color: #0d6efd; color: white;">Imagen de usuario</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            for ($i = 0; $i < count($usuarios); $i++) {
                                echo "<tr>";
                                echo "<td>" . $usuarios[$i]['DNI'] . "</td>";
                                echo "<td>" . $usuarios[$i]['nombre'] . "</td>";
                                echo "<td>" . $usuarios[$i]['pri_apellido'] . "</td>";
                                echo "<td>" . $usuarios[$i]['seg_apellido'] . "</td>";
                                echo "<td>" . $usuarios[$i]['correo'] . "</td>";
                                echo "<td>" . $usuarios[$i]['direcion'] . "</td>";
                                echo "<td>" . $usuarios[$i]['telefono'] . "</td>";
                                echo "<td>" . $usuarios[$i]['codigo_postal'] . "</td>";
                                echo "<td>" . $usuarios[$i]['rol'] . "</td>";
                                echo "<td>" . $usuarios[$i]['imagen_usu'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery/permisos.js"></script>
</body>

</html>