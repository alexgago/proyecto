create DATABASE proyecto;
use proyecto;
create table  Usuario(
    DNI varchar (20),
    nombre varchar(20),
    pri_apellido varchar(20),
    seg_apellido varchar(20),
    correo varchar(100),
    password varchar(100),
    direccion varchar(200),
    telefono int,
    codigo_postal int,
    rol varchar (20),
    imagen_usu MEDIUMBLOB
);

create table establecimiento(
    id_local int,
    venta_alquiler varchar(10),
    metros int,
    baños int,
    habitacion int,
    plantas int,
    numero varchar(5),
    calle varchar(100),
    municipio varchar(20),
    codigo_postal int,
    precio float
);
create table vivienda(
    id_vivienda int,
    venta_alquiler varchar(10),
    metros int,
    habitacion int,
    baños int,
    plantas int,
    portal varchar (5),
    puerta varchar(5),
    numero int,
    escalera varchar(10),
    calle varchar(100),
    municipio varchar(20),
    codigo_postal int,
    precio float
);
create table imagenes_establecimiento(
    id_foto int,
    id_local int,
    imagenes longblob
);
create table imagenes_viviendas(
    id_foto int,
    id_vivienda int,
    imagenes longblob
);