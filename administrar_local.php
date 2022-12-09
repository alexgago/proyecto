<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Administrar Locales</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

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
    $locales = $con->administrar_Local();
    if (!isset($_SESSION['email'])) {
        header("Location:Inicio.php");
    }
    if ($_SESSION['rol'] != "Trabajador") {
        header("Location:Inicio.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nuevo_local'])) {
            header("Location:subir_local.php");
        }
    }
    ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <h1 class="text-center">Administrar Locales</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal3" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Modificar Local</button>
                    <input type="submit" name="nuevo_local" id="nuevo_local" value="Nuevo Local">
                </div>
            </div>
        </div>


        <?php

        ?>
        <div class="container caja" style="margin-top: 20px;">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="admin_local" border="1">
                        <thead class="text-center">
                            <tr>
                                <th style="background-color: #0d6efd; color: white;">Metros</th>
                                <th style="background-color: #0d6efd; color: white;">Habitaciones</th>
                                <th style="background-color: #0d6efd; color: white;">Baños</th>
                                <th style="background-color: #0d6efd; color: white;">Plantas</th>
                                <th style="background-color: #0d6efd; color: white;">Calle</th>
                                <th style="background-color: #0d6efd; color: white;">Numero</th>
                                <th style="background-color: #0d6efd; color: white;">Municipio</th>
                                <th style="background-color: #0d6efd; color: white;">Codigo Postal</th>
                                <th style="background-color: #0d6efd; color: white;">Precio</th>
                                <th style="background-color: #0d6efd; color: white;">Venta/Alquiler</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            for ($i = 0; $i < count($locales); $i++) {
                                echo "<tr>";
                                echo "<td>" . $locales[$i]['metros'] . "</td>";
                                echo "<td>" . $locales[$i]['habitacion'] . "</td>";
                                echo "<td>" . $locales[$i]['baños'] . "</td>";
                                echo "<td>" . $locales[$i]['plantas'] . "</td>";
                                echo "<td>" . $locales[$i]['calle'] . "</td>";
                                echo "<td>" . $locales[$i]['numero'] . "</td>";
                                echo "<td>" . $locales[$i]['municipio'] . "</td>";
                                echo "<td>" . $locales[$i]['codigo_postal'] . "</td>";
                                echo "<td>" . $locales[$i]['precio'] . "</td>";
                                echo "<td>" . $locales[$i]['venta_alquiler'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
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
                                                    <tr>
                                                        <th style="background-color: #0d6efd; color: white;">Metros</th>
                                                        <th style="background-color: #0d6efd; color: white;">Habitaciones</th>
                                                        <th style="background-color: #0d6efd; color: white;">Baños</th>
                                                        <th style="background-color: #0d6efd; color: white;">Plantas</th>
                                                        <th style="background-color: #0d6efd; color: white;">Calle</th>
                                                        <th style="background-color: #0d6efd; color: white;">Numero</th>
                                                        <th style="background-color: #0d6efd; color: white;">Municipio</th>
                                                        <th style="background-color: #0d6efd; color: white;">Codigo Postal</th>
                                                        <th style="background-color: #0d6efd; color: white;">Precio</th>
                                                        <th style="background-color: #0d6efd; color: white;">Venta/Alquiler</th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    <?php
                                                    for ($i = 0; $i < count($datos); $i++) {
                                                        echo "<tr>";
                                                        echo "<td> <input type='text'name='id_rol$i' style = 'text-align: center;border: 0;width: 50px; background-color: white;' value='" . $datos[$i]['id_rol'] . "'disabled></td>";
                                                        echo "<td> <input type='text'name='nombre_rol$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $datos[$i]['nombre_rol'] . "'></td>";
                                                        echo "<td> <input type='text'name='grupoldap_rol$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $datos[$i]['grupoldap_rol'] . "'></td>";
                                                        echo "<td> <input type='text'name='descripcion_rol$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $datos[$i]['descripcion_rol'] . "'></td>";
                                                        echo "<td>";
                                                        if ($datos[$i]['fecha_baja'] == NULL) {
                                                            echo "<strong><p style = 'color:#0DA262'>ACTIVO</p></strong>";
                                                        } else {
                                                            echo "<strong><p style = 'color:red'>INACTIVO</p></strong>";
                                                        }
                                                        echo "</td>";
                                                        echo "<td><button id='Activar" . $i . "' name='Activar" . $i . "' class='btn btn-success'>✓</button></td>";
                                                        if ($datos[$i]['fecha_baja'] == NULL) {
                                                            echo "<td><button id='Desactivar" . $i . "' name='Desactivar" . $i . "' class='btn btn-danger'>X</button></td>";
                                                        } else {
                                                            echo "<td><button id='Desactivar" . $i . "' name='Desactivar" . $i . "' class='btn btn-danger' disabled>X</button></td>";
                                                        }
                                                        echo "</td>";
                                                        if ($datos[$i]['fecha_baja'] == NULL) {
                                                            echo "<td><button id='Modificar" . $i . "' name='Modificar" . $i . "' class='btn btn-warning'><i class='fa fa-fw fa-pen'></i></button>
                                                    </td>";
                                                        } else {
                                                            echo "<td><button id='Modificar" . $i . "' name='Modificar" . $i . "' class='btn btn-warning' disabled><i class='fa fa-fw fa-pen'></i></button>
                                                    </td>";
                                                        }
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
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="area_admin.php"> <button type="submit" class="b_m btn btn-danger" name="volver" id="volver" style="margin-right: 30px; float: right; width: 10%; height: 50px;">Volver</button></a>

    </form>
    <a href="area_admin.php"> <button type="submit" class="b_m btn btn-danger" name="volver" id="volver" style="margin-right: 30px; float: right; width: 10%; height: 50px;">Volver</button></a>
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jquery/jqueryGP.js"></script>
        <script type="text/javascript" src="jquery/jquery.js"></script>


</body>

</html>