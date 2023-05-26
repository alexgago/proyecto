<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrar Locales</title>
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
        if (isset($_POST['guardar'])) {
            for ($i = 0; $i < count($locales); $i++) {
                $con->actualizarEstablecimeinto($_POST["id_local$i"], $_POST["metros$i"], $_POST["habitacion$i"], $_POST["lavavo$i"], $_POST["plantas$i"], $_POST["calle$i"], $_POST["numero$i"], $_POST["municipio$i"], $_POST["cod_postal$i"], $_POST["precio$i"], $_POST["venta_alquiler$i"]);
            }
            header("Location: administrar_local.php");
        }
    }
    ?>
    <h1 class="text-center">Administrar Locales</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal3" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Modificar Local</button>

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
                                <th style="background-color: #0d6efd; color: white;">lavavo</th>
                                <th style="background-color: #0d6efd; color: white;">Plantas</th>
                                <th style="background-color: #0d6efd; color: white;">Calle</th>
                                <th style="background-color: #0d6efd; color: white;">Numero</th>
                                <th style="background-color: #0d6efd; color: white;">Municipio</th>
                                <th style="background-color: #0d6efd; color: white;">Codigo Postal</th>
                                <th style="background-color: #0d6efd; color: white;">Precio</th>
                                <th style="background-color: #0d6efd; color: white;">Venta/Alquiler</th>
                                <th style="background-color: #0d6efd; color: white;">imagen del establecimiento</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            for ($i = 0; $i < count($locales); $i++) {
                                echo "<tr>";
                                echo "<td>" . $locales[$i]['metros'] . "</td>";
                                echo "<td>" . $locales[$i]['habitacion'] . "</td>";
                                echo "<td>" . $locales[$i]['lavavo'] . "</td>";
                                echo "<td>" . $locales[$i]['plantas'] . "</td>";
                                echo "<td>" . $locales[$i]['calle'] . "</td>";
                                echo "<td>" . $locales[$i]['numero'] . "</td>";
                                echo "<td>" . $locales[$i]['municipio'] . "</td>";
                                echo "<td>" . $locales[$i]['codigo_postal'] . "</td>";
                                echo "<td>" . $locales[$i]['precio'] . "</td>";
                                echo "<td>" . $locales[$i]['venta_alquiler'] . "</td>";
                            ?>
                                <td>
                                    <?php $num_imagenes = $con->seleccionarimageneslocal($locales[$i]["id_local"]);

                                    if ($num_imagenes != null) {
                                        $max = $num_imagenes['COUNT(id_local)'];
                                        $num = rand(1, $max);
                                        $imagen = $con->seleccionarfoto_vivienda($num, $locales[$i]["id_local"]);
                                    ?>

                                        <img src="data:<?php echo $imagen[0]['tipo']; ?>;base64,<?php echo  base64_encode($imagen[0]["imagen"]); ?>" class="card-img-top" alt="...">
                                    <?php } ?>
                                </td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="submit" name="nuevo_local" id="nuevo_local" value="Nuevo Local">

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
                                                <th style="background-color: #0d6efd; color: white;">ID Local</th>
                                                <th style="background-color: #0d6efd; color: white;">Metros</th>
                                                <th style="background-color: #0d6efd; color: white;">Habitaciones</th>
                                                <th style="background-color: #0d6efd; color: white;">lavavo</th>
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
                                                    echo "<td> <input type='text' name='id_local$i' style = 'text-align: center;border: 0;width: 50px; background-color: white;' value='" . $locales[$i]['id_local'] . "'></td>";
                                                    echo "<td> <input type='number' name='metros$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['metros'] . "'></td>";
                                                    echo "<td> <input type='number' name='habitacion$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['habitacion'] . "'></td>";
                                                    echo "<td> <input type='number' name='lavavo$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['lavavo'] . "'></td>";
                                                    echo "<td> <input type='number' name='plantas$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['plantas'] . "'></td>";
                                                    echo "<td> <input type='text' name='calle$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['calle'] . "'></td>";
                                                    echo "<td> <input type='number' name='numero$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['numero'] . "'></td>";
                                                    echo "<td> <input type='number' name='municipio$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['municipio'] . "'></td>";
                                                    echo "<td> <input type='number' name='cod_postal$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['codigo_postal'] . "'></td>";
                                                    echo "<td> <input type='number' name='precio$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $locales[$i]['precio'] . "'></td>";
                                                    echo "<td> 
                                                            <select name='venta_alquiler$i'>
                                                                <option value='venta'";
                                                    if ($locales[$i]['venta_alquiler'] == "venta") {
                                                        echo "selected";
                                                    }
                                                    echo ">Venta</option>
                                                                <option value='alquiler'";
                                                    if ($locales[$i]['venta_alquiler'] == "alquiler") {
                                                        echo "selected";
                                                    }
                                                    echo ">Alquilar</option>
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