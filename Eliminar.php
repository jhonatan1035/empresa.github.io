
<?php

include "funciones.php";

$conexio = ConexionBD();

$cedula = $_GET['cedula'];

$sql = "DELETE FROM empleados WHERE cedula = $cedula";

$resultado = $conexio['conexion']->prepare($sql);

if ($resultado->execute()) {

    header("Location: Clientes.php");

}


?>    