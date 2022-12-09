<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrar Viviendas</title>
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
    $vivienda = $con->administrar_vivienda();
    if (!isset($_SESSION['email'])) {
        header("Location:Inicio.php");
    }
    if ($_SESSION['rol'] != "Trabajador") {
        header("Location:Inicio.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nuevo_vivienda'])) {
            header("Location:subir_piso.php");
        }
    }
    ?>
    <h1 class="text-center">Administrar Vivienda</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal3" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Modificar Vivienda</button>
                </div>
            </div>
        </div>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        
        <div class="container caja" style="margin-top: 20px;">
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table" id="tablaPrincipal" border="1">
                <thead class="text-center">
                            <tr>
                                <th style="background-color: #0d6efd; color: white;">Metros</th>
                                <th style="background-color: #0d6efd; color: white;">Habitaciones</th>
                                <th style="background-color: #0d6efd; color: white;">Baños</th>
                                <th style="background-color: #0d6efd; color: white;">Plantas</th>
                                <th style="background-color: #0d6efd; color: white;">Portal</th>
                                <th style="background-color: #0d6efd; color: white;">Escalera</th>
                                <th style="background-color: #0d6efd; color: white;">Puerta</th>
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
                            for ($i = 0; $i < count($vivienda); $i++) {
                                echo "<tr>";
                                echo "<td>" . $vivienda[$i]['metros'] . "</td>";
                                echo "<td>" . $vivienda[$i]['habitacion'] . "</td>";
                                echo "<td>" . $vivienda[$i]['baños'] . "</td>";
                                echo "<td>" . $vivienda[$i]['plantas'] . "</td>";
                                echo "<td>" . $vivienda[$i]['portal'] . "</td>";
                                echo "<td>" . $vivienda[$i]['escalera'] . "</td>";
                                echo "<td>" . $vivienda[$i]['puerta'] . "</td>";
                                echo "<td>" . $vivienda[$i]['calle'] . "</td>";
                                echo "<td>" . $vivienda[$i]['numero'] . "</td>";
                                echo "<td>" . $vivienda[$i]['municipio'] . "</td>";
                                echo "<td>" . $vivienda[$i]['codigo_postal'] . "</td>";
                                echo "<td>" . $vivienda[$i]['precio'] . "</td>";
                                echo "<td>" . $vivienda[$i]['venta_alquiler'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <input type="submit" name="nuevo_vivienda" id="nuevo_vivienda" value="Nueva Vivienda">
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
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jqueryGP.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>