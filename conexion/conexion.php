<?php
class ConectaDB
{
    private $conex;
    private static $instancia;

    private function __construct()
    {
        $this->conex = new PDO("mysql:host=localhost;port=3306; dbname=proyecto", "root", "");
    }
    public static function singleton()
    { //método singleton que crea instancia sí no está creada
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function __clone()
    {  // Evita que el objeto se pueda clonar
        trigger_error("La clonación de este objeto no está permitida", E_USER_ERROR);
    }
    public function cerrarconexion()
    {
        $this->conex = null;
    }
   
   

    public function eliminar_acentos($cadena)
    {

        //Reemplazamos la A y a
        $cadena = str_replace(
            array("Á", "À", "Â", "Ä", "á", "à", "ä", "â", "ª"),
            array("A", "A", "A", "A", "a", "a", "a", "a", "a"),
            $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
            array("É", "È", "Ê", "Ë", "é", "è", "ë", "ê"),
            array("E", "E", "E", "E", "e", "e", "e", "e"),
            $cadena
        );

        //Reemplazamos la I y i
        $cadena = str_replace(
            array("Í", "Ì", "Ï", "Î", "í", "ì", "ï", "î"),
            array("I", "I", "I", "I", "i", "i", "i", "i"),
            $cadena
        );

        //Reemplazamos la O y o
        $cadena = str_replace(
            array("Ó", "Ò", "Ö", "Ô", "ó", "ò", "ö", "ô"),
            array("O", "O", "O", "O", "o", "o", "o", "o"),
            $cadena
        );

        //Reemplazamos la U y u
        $cadena = str_replace(
            array("Ú", "Ù", "Û", "Ü", "ú", "ù", "ü", "û"),
            array("U", "U", "U", "U", "u", "u", "u", "u"),
            $cadena
        );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
            array("Ñ", "ñ", "Ç", "ç"),
            array("N", "n", "C", "c"),
            $cadena
        );

        return $cadena;
    }
    public function seleccionarUsuario($correo)
    {
        $consulta = $this->conex->prepare("select * from usuario where correo=?");
        $consulta->bindParam(1, $correo);
        //$consulta->bindParam(2, $pas);
        if ($consulta->execute()) {
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function comprobarCorreo($correo)
    {
        $consulta = $this->conex->prepare("select correo from usuario where correo=?");
        $consulta->bindParam(1, $correo);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function comprobarDNI($dni)
    {
        $consulta = $this->conex->prepare("select dni from usuario where dni=?");
        $consulta->bindParam(1, $dni);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function administrar_usuarios()
    {
        $consulta = $this->conex->prepare("select * from usuario");
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    //obtener un medicamento con todos sus valores
    public function seleccionarTrabajador($rol)
    {
        $consulta = $this->conex->prepare("select nombre, pri_apellido, seg_apellido, correo, imagen_usu from usuario where rol = ?");
        $consulta->bindParam(1, $rol);
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function administrar_Local()
    {
        $consulta = $this->conex->prepare("select * from establecimiento");
        
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function administrar_vivienda()
    {
        $consulta = $this->conex->prepare("select * from vivienda");
        
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function seleccionar_Local($tipo)
    {
        $consulta = $this->conex->prepare("select * from establecimiento where venta_alquiler = ?");
        $consulta->bindParam(1, $tipo);
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function seleccionar_vivienda($tipo)
    {
        $consulta = $this->conex->prepare("select * from vivienda where venta_alquiler = ?");
        $consulta->bindParam(1, $tipo);
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
    public function insertar_establecimiento($venta_alquiler, $metros, $baños, $habitacion, $plantas, $puerta, $calle, $municipio, $cod_postal, $precio)
    {
        $consulta = $this->conex->prepare("INSERT INTO establecimiento (venta_alquiler, mentros, baños, habitacion, plantas, numero, calle, municipio, codigo_postal, precio) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $consulta->bindParam(1, $venta_alquiler);
        $consulta->bindParam(2, $metros);
        $consulta->bindParam(3, $baños);
        $consulta->bindParam(4, $habitacion);
        $consulta->bindParam(5, $plantas);
        $consulta->bindParam(6, $puerta);
        $consulta->bindParam(7, $calle);
        $consulta->bindParam(8, $municipio);
        $consulta->bindParam(9, $cod_postal);
        $consulta->bindParam(10, $precio);
        if (!$consulta->execute()) {
            return "fallo en la consulta";
        } else {
            return "exito";
            
        }
    }
    public function insertar_vivienda($venta_alquiler, $metros, $baños, $habitacion, $plantas, $portal, $puerta, $numero, $escalera, $calle, $municipio, $cod_postal, $precio)
    {
        $consulta = $this->conex->prepare("INSERT INTO vivienda (venta_alquiler, mentros, baños, habitacion, plantas, portal, puerta, numero, escalera, calle, municipio, codigo_postal, precio) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $consulta->bindParam(1, $venta_alquiler);
        $consulta->bindParam(2, $metros);
        $consulta->bindParam(3, $baños);
        $consulta->bindParam(4, $habitacion);
        $consulta->bindParam(5, $plantas);
        $consulta->bindParam(6, $portal);
        $consulta->bindParam(7, $puerta);
        $consulta->bindParam(8, $numero);
        $consulta->bindParam(9, $escalera);
        $consulta->bindParam(10, $calle);
        $consulta->bindParam(11, $municipio);
        $consulta->bindParam(12, $cod_postal);
        $consulta->bindParam(13, $precio);
        if (!$consulta->execute()) {
            return "fallo en la consulta";
        } else {
            return "exito";
            
        }
    }
    //actualizar fecha inicio sesion
    public function actualizarEstablecimeinto($id_local,$venta_alquiler, $metros, $baños, $habitacion, $plantas, $portal, $puerta, $escalera, $calle, $municipio, $cod_postal, $precio)
    {
        $consulta = $this->conex->prepare("UPDATE establecimiento set venta_alquiler=?, metros = ?, baños= ?, habitacion =?, plantas =?, numero=?, calle=?, municipio =?, codigo_postal=?, precio =? where id_local=?");
        $consulta->bindParam(1, $venta_alquiler);
        $consulta->bindParam(2, $metros);
        $consulta->bindParam(3, $baños);
        $consulta->bindParam(4, $habitacion);
        $consulta->bindParam(5, $plantas);
        $consulta->bindParam(6, $puerta);
        $consulta->bindParam(7, $calle);
        $consulta->bindParam(8, $municipio);
        $consulta->bindParam(9, $cod_postal);
        $consulta->bindParam(10, $precio);
        $consulta->bindParam(11, $id_local);
        if (!$consulta->execute()) {
            return "fallo en la consulta";
        } else {
            return "exito";
            
        }
    }
    public function actualizarVivienda($id_vivienda,$venta_alquiler, $metros, $baños, $habitacion, $plantas, $portal, $puerta,$numero, $escalera, $calle, $municipio, $cod_postal, $precio)
    {
        $consulta = $this->conex->prepare("UPDATE vivienda set venta_alquiler=?, metros = ?, baños= ?, habitacion =?, plantas =?, portal=?, puerta=? numero=?, calle=?, municipio =?, codigo_postal=?, precio =? where id_local=?");
        $consulta->bindParam(1, $venta_alquiler);
        $consulta->bindParam(2, $metros);
        $consulta->bindParam(3, $baños);
        $consulta->bindParam(4, $habitacion);
        $consulta->bindParam(5, $plantas);
        $consulta->bindParam(6, $portal);
        $consulta->bindParam(7, $puerta);
        $consulta->bindParam(8, $numero);
        $consulta->bindParam(9, $escalera);
        $consulta->bindParam(10, $calle);
        $consulta->bindParam(11, $municipio);
        $consulta->bindParam(12, $cod_postal);
        $consulta->bindParam(13, $precio);
        $consulta->bindParam(14, $id_vivienda);
        if (!$consulta->execute()) {
            return "fallo en la consulta";
        } else {
            return "exito";
            
        }
    }
    public function selectPermisos($nombre_rol)
    {
        $consulta = $this->conex->prepare("select id_permiso from roles_permisos where id_rol = (select id_rol from roles where nombre_rol= ?) ");
        $consulta->bindParam(1, $nombre_rol);
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function dar_Baja_Tpaciente($idPaciente, $fecha)
    {
        $consulta = $this->conex->prepare("UPDATE tipo_paciente set fecha_baja = ?  where id_tpaciente = ?");
        $consulta->bindParam(1, $fecha);
        $consulta->bindParam(2, $idPaciente);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

}