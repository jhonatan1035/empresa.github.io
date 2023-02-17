<?php

include 'funciones.php';

$conexionBD = ConexionBD();

$error = false;

try {

  $Resultado = MostrarEmpleados($conexionBD['conexion']);
} catch (PDOException $error) {

  $error = $error->getMessage();
}

?>

<?php
include "templates/encabezado.php";
?>

<!-- informacion de los empleados registrados -->
<br>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
  </symbol>
</svg>

<?php $Estado = $_GET['estado'] ?? null;
if ($Estado == "SI") { ?>
 
<?php } ?>
<h2 class="text-center ">EMPLEADOS EMPRESA</h2>
<div class="table-wrapper-scroll-y my-custom-scrollbar">
  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">Cedula</th>
        <th scope="col">Nombres Completos</th>
        <th scope="col">Apellidos Completos</th>
        <th scope="col">Telefono</th>
        <th scope="col">Edad</th>
        <th scope="col">Genero</th>
        <th scope="col">Seguro</th>
        <th scope="col">Correo Electronico</th>
        <th scope="col">Actualizar</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if (is_array($Resultado) || is_object($Resultado)) {
          foreach ($Resultado as $resul) { ?>
            <tr>
              <td><?php echo $resul->cedula; ?></td>
              <td><?php echo $resul->nombres; ?></td>
              <td><?php echo $resul->apellidos; ?></td>
              <td><?php echo $resul->telefono; ?></td>
              <td><?php echo $resul->edad; ?></td>
              <td><?php echo $resul->genero; ?></td>
              <td><?php echo $resul->seguro; ?></td>
              <td><?php echo $resul->correo; ?></td>
              <td><button class="btn-op"><a class='fas fa-edit' href="<?= 'Modificar.php?cedula=' . $Cedula = $resul->cedula ?>"></a></button></td>
              <td><button class="btn-op"><a class="fa fa-trash" href="<?= 'Eliminar.php?cedula=' . $Cedula = $resul->cedula ?>"></a></button></td>
        <?php }
        } ?>
      </tr>
    </tbody>
  </table>
</div>

<div class="col-md-12 text-center"><a href="agregar.php" class="btn btn-primary mt-4">AGREGAR EMPLEADO </a></div>




<?php
include "templates/piepagina.php"
?>