<!DOCTYPE html>
<html lang="en">

<head>
    <title>Comprar Vivienda</title>
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
    include_once("conexion/conexion.php");
    include_once("otros/funciones_variables.php");

    if (isset($_SESSION['email'])) {
        if ($_SESSION['rol'] == "Trabajador") {
            include_once("otros/cabeceraTrabajador.php");
        } else {
            include_once("otros/cabeceraUsuario.php");
        }
    } else {
        include_once("otros/cabeceraprincipal.php");
    }
    $conexion = ConectaDB::singleton();
    $vivienda = $conexion->seleccionar_vivienda('venta');
    ?>
    <br>
    <br>

    <div class="                           
                    ">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

            <h1 class="text-center">Viviendas en venta</h1>
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
                                <th style="background-color: #0d6efd; color: white;">Portal</th>
                                <th style="background-color: #0d6efd; color: white;">Escalera</th>
                                <th style="background-color: #0d6efd; color: white;">Puerta</th>
                                <th style="background-color: #0d6efd; color: white;">Calle</th>
                                <th style="background-color: #0d6efd; color: white;">Numero</th>
                                <th style="background-color: #0d6efd; color: white;">Municipio</th>
                                <th style="background-color: #0d6efd; color: white;">Codigo Postal</th>
                                <th style="background-color: #0d6efd; color: white;">Precio</th>
                                <th style="background-color: #0d6efd; color: white;">Imagen de la vivienda</th>
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
                            ?>
                                <td>
                                    <?php $num_imagenes = $conexion->seleccionarimagenesvivienda($vivienda[$i]["id_vivienda"]);
                                    
                                    if ($num_imagenes != null) {
                                        $max = $num_imagenes['COUNT(id_vivienda)']; 
                                        $num = rand(1, $max);
                                            $imagen= $conexion->seleccionarfoto_vivienda($num, $vivienda[$i]["id_vivienda"]);
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
        </form>
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="datatables/datatables.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jquery/jqueryGP.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>