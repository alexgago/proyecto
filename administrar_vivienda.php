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
        if (isset($_POST['guardar'])) {
            for ($i=0; $i < count($vivienda); $i++) { 
                $con->actualizarVivienda($_POST["id_vivienda$i"], $_POST["metros$i"], $_POST["habitacion$i"], $_POST["lavavo$i"],$_POST["plantas$i"], $_POST["calle$i"], $_POST["numero$i"], $_POST["portal$i"], $_POST["puerta$i"], $_POST["escalera$i"], $_POST["municipio$i"], $_POST["cod_postal$i"], $_POST["precio$i"], $_POST["venta_alquiler$i"]);
            }
            header("Location: administrar_vivienda.php");
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
                                <th style="background-color: #0d6efd; color: white;">lavavo/th>
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
                                echo "<td>" . $vivienda[$i]['lavavo'] . "</td>";
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
                                                    <th style="background-color: #0d6efd; color: white;">ID VIvienda</th>
                                                    <th style="background-color: #0d6efd; color: white;">Metros</th>
                                                    <th style="background-color: #0d6efd; color: white;">Habitaciones</th>
                                                    <th style="background-color: #0d6efd; color: white;">lavavo/th>
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
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php
                                                for ($i = 0; $i < count($vivienda); $i++) {
                                                    echo "<tr>";
                                                    echo "<td> <input type='text'name='id_vivienda$i' style = 'text-align: center;border: 0;width: 50px; background-color: white;' value='" . $vivienda[$i]['id_vivienda'] . "'></td>";
                                                    echo "<td> <input type='number' name='metros$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['metros'] . "'></td>";
                                                    echo "<td> <input type='number' name='habitacion$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['habitacion'] . "'></td>";
                                                    echo "<td> <input type='number' name='lavavo$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['lavavo'] . "'></td>";
                                                    echo "<td> <input type='number' name='plantas$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['plantas'] . "'></td>";
                                                    echo "<td> <input type='text' name='portal$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['portal'] . "'></td>";
                                                    echo "<td> <input type='text' name='escalera$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['escalera'] . "'></td>";
                                                    echo "<td> <input type='text' name='puerta$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['puerta'] . "'></td>";
                                                    echo "<td> <input type='text' name='calle$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['calle'] . "'></td>";
                                                    echo "<td> <input type='number' name='numero$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['numero'] . "'></td>";
                                                    echo "<td> <input type='number' name='municipio$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['municipio'] . "'></td>";
                                                    echo "<td> <input type='number' name='cod_postal$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['codigo_postal'] . "'></td>";
                                                    echo "<td> <input type='number' name='precio$i' style = 'text-align: center;border: 0;background-color: white;' value='" . $vivienda[$i]['precio'] . "'></td>";
                                                    echo "<td> 
                                                            <select name='venta_alquiler'>
                                                                <option value='venta'";
                                                    if ($vivienda[$i]['venta_alquiler'] == "venta") {
                                                        echo "selected";
                                                    }
                                                    echo ">Venta</option>
                                                                <option value='alquiler'";
                                                    if ($vivienda[$i]['venta_alquiler'] == "alquiler") {
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