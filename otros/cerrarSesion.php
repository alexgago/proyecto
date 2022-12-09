<?php
    session_start();
    session_destroy();
    include_once("../conexion/conexion.php");
    $conexion = ConectaDB::singleton();
    $conexion->cerrarconexion();
    header("location:../inicio.php");
?>