<?php

//elimina los caracteres especiales y hace que no haya problemas a la hora de buscar
function filtrado($texto)
{
    $texto = trim($texto);
    $texto = htmlspecialchars($texto);
    $texto = stripslashes($texto);
    return $texto;
}

function comprobarSesion()
{
    if (!isset($_SESSION["usuario"])) {
        header("location:inicio.php");
    }
}

?>