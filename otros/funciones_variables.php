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
function inactividadSesion()
{
    if (!isset($_SESSION["inactividad"])) {
        //Tiempo en segundos para dar vida a la sesión.
        $_SESSION["inactividad"] = 3600; //1 hora en este caso.
    }
    //Comprobamos si esta definida la sesión "tiempo".
    if (isset($_SESSION["tiempo"])) {

        //Calculamos tiempo de vida inactivo.
        $vida_session = time() - $_SESSION["tiempo"];

        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if ($vida_session > $_SESSION["inactividad"]) {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();
            
            //redirigimos a la pagina que queremos despues de la inactividad
            header("Location: inicio.php");

            exit();
        } else {  // si no ha caducado la sesion, actualizamos
            $_SESSION["tiempo"] = time();
        }
    } else {
        //Activamos sesion tiempo.
        $_SESSION["tiempo"] = time();
    }
}

?>