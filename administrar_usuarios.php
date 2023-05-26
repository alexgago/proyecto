<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrar Usuarios</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .sin_permisos {
            display: none;
        }
    </style>
</head>

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
    <h1 class="text-center">Administrar Usuarios</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal3" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Modificar Usuarios</button>
            </div>
        </div>
    </div>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="container caja" style="margin-top: 20px;">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="tablaPrincipal" border="1">
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
                                echo "<td>" . $usuarios[$i]['direccion'] . "</td>";
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
    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 300% ; margin-left: -500px;">
                <form method="post" autocomplete="off">
                    <!-- Modal body -->
                    <div class="modal-body" style="font-size: 15px;">
                        <h1 class="text-center" style="font-size: 18px;">MODIFICAR ESTABLECIMIENTOS</h1>
                        <div class="container caja">
                            <div class="container caja">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table" id="tablaPrincipal2" border="1">
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
                                                </tr>

                                            </thead>
                                            <tbody class="text-center">
                                                <?php
                                                for ($i = 0; $i < count($usuarios); $i++) {
                                                    echo "<tr>";
                                                    echo "<td> <input type='text'name='DNI$i' style = 'text-align: center;border: 0;width: 50px; background-color: white;' value='" . $usuarios[$i]['DNI'] . "'></td>";
                                                    echo "<td> <input type='text' name='nombre$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['nombre'] . "'></td>";
                                                    echo "<td> <input type='text' name='pri_apellido$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['pri_apellido'] . "'></td>";
                                                    echo "<td> <input type='text' name='seg_apellido$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['seg_apellido'] . "'></td>";
                                                    echo "<td> <input type='text' name='correo$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['correo'] . "'></td>";
                                                    echo "<td> <input type='text' name='direccion$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['direccion'] . "'></td>";
                                                    echo "<td> <input type='text' name='telefono$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['telefono'] . "'></td>";
                                                    echo "<td> <input type='text' name='cod_postal$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $usuarios[$i]['codigo_postal'] . "'></td>";
                                                   echo "<td> 
                                                            <select name='rol'>
                                                                <option value='Trabajador'";
                                                    if ($usuarios[$i]['rol'] == "Trabajador") {
                                                        echo "selected";
                                                    }
                                                    echo ">Trabajador</option>
                                                                <option value='cliente'";
                                                    if ($usuarios[$i]['rol'] == "cliente") {
                                                        echo "selected";
                                                    }
                                                    echo ">Cliente</option>
                                                            </select>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" name="guardar" id="guardar" value="guardar">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jqueryGP.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>