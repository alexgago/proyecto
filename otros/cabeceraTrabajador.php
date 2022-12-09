<?php
//inactividadSesion();
?>
<div class="navbar justify-content-around">

<a href="inicio.php" style="font-size: 22px;"><i class="fa fa-fw fa-home"></i> Inicio</a>
<a href="inmuebles.php" style="font-size: 22px;"><i class="fa fa-fw fa-eye-slash"></i>Inmueble</a>
<a href="area_admin.php" style="font-size: 22px;"><i class="fa fa-fw fa-eye-slash"></i>Area de administracion</a>
<a href="otros/cerrarSesion.php" style="font-size: 22px;"><i class="fa fa-fw fa-eye-slash"></i> Cerrar Sesion</a>
<div class="justify-content-around">
    <p class="letra" style="font-size: 18px;"><i class="fa fa-fw fa-user"></i> <?php echo "Bienvenido " . $_SESSION["nombre"] . " " . $_SESSION["apellidos"] . 
    "<br> " . "Tu rol es: " . "<strong>" . $_SESSION["rol"] . "</strong>" . "<br>"// . "Último inicio de sesión:" . " " .  $_SESSION["sesion"]   ?></p>
  </div>
</div>