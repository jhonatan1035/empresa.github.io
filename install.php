<?php

include 'funciones.php';

try{

    $sql = file_get_contents('data/migracion.sql');

    $conexion=ConexionBD();

    $conexion->exec($sql);

    echo "La base de datos y la tabla se han creado con exito";

}catch(PDOException $error){

    echo $error->getMessage();

}