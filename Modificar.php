<?php
include "templates/encabezado.php";
?>

<?php

include "funciones.php";



$conexio = ConexionBD();

$Cedula = $_GET['cedula'];

if (isset($_POST['submit'])) {
    
    ActualizarE($conexio['conexion']);
    
}

try {

    $sql = "SELECT * FROM empleados WHERE cedula = $Cedula";

    $Resultado = $conexio['conexion']->prepare($sql);
    $Resultado->execute();

    $empleado = $Resultado->fetch(PDO::FETCH_ASSOC);

    if (!$empleado) {

        echo "No se encontro al empleado";
        $Existencia = FALSE;

    }

} catch (PDOException $e) {

    echo $e->getMessage();

}
?>
<?php if (isset($empleado) && $empleado) { ?>
<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
			
			<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
				<symbol id="check-circle-fill" viewBox="0 0 16 16">
					<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
				</symbol>
				<symbol id="info-fill" viewBox="0 0 16 16">
					<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
				</symbol>
				<symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
					<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
				</symbol>
			</svg>
				
				<?php	if (is_null($EstadoC ?? null)) {

							// si no muestra las advertencia es que $estadoC esta vacio

						} else if ($EstadoC['FuncionC']  == '1' ) { ?>

							<div class="alert alert-danger d-flex align-items-center" id="Duplicado" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									<h5 style="text-align: center;  margin-bottom:-1px;"><?php echo $EstadoC['mensaje'] ?? null ?></h5>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute;right: 10px;"></button>	
							</div>
		
						<?php }  else if ($EstadoC['FuncionC'] == '2') { ?>
							
							<div class="alert alert-success d-flex align-items-center" id="Registrado" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
								<div>
									<h5 style="text-align: center; margin-bottom:-1px;"><?php echo $EstadoC['mensaje'] ?? null ?></h5>
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="position: absolute;right: 10px;"></button>	
							</div>

						<?php }  ?>
				
				<div class="testbox">
					<form method="post" id="form" onsubmit="return Validar();">
						<h1>Estas modificando al empleado <?php echo $empleado['nombres'] ?></h1>
						<h4>Datos Principales<span>*</span></h4>
						<div class="title-block">
							<input class="name" id="cedula" name="cedula" type="number" value="<?php echo $empleado['cedula'] ?>" disabled placeholder="Cedula Empleado" autocomplete="off"/>
							<input class="name" id="nombres" name="nombres" type="text" value="<?php echo $empleado['nombres'] ?>" placeholder="Nombres Completos	" autocomplete="off"/>
							<input class="name" id="apellidos" name="apellidos" type="text" value="<?php echo $empleado['apellidos'] ?>"  placeholder="Apellidos completos" autocomplete="off"/>
						</div>

						<h4>Informacion Contacto<span>*</span></h4>
						<div class="title-block">
							<input type="number" id="telefono" name="telefono" value="<?php echo $empleado['telefono'] ?>"  placeholder="Numero Telefono" autocomplete="off" />
						</div>

						<h4>Datos Secundario<span>*</span></h4>
						<div class="title-block">
							<input type="number" id="edad" name="edad" value="<?php echo $empleado['edad'] ?>" placeholder="Edad Empleado" autocomplete="off" />
							<select name="genero" id="genero" >
								<option value="<?php echo $empleado['genero'] ?>" selected hidden><?php echo $empleado['genero'] ?></option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
								<option value="Otro">Otro</option>
							</select>
							<select name="seguro"  id="seguro" >
								<option value="<?php echo $empleado['seguro'] ?>" selected hidden><?php echo $empleado['seguro'] ?></option>
								<option value="Sura">Sura</option>
								<option value="Nueva Eps">Nueva Eps</option>
								<option value="Salud Vida">Salud Vida</option>
							</select>
						</div>

						<h4>Informacion Adicional<span>*</span></h4>
						<input type="email" id="correo"  name="correo" value="<?php echo $empleado['correo'] ?>" placeholder="Correo Electronico Empleado" autocomplete="off" />

						<div class="btn-block">
							<button type="submit" name="submit">Registrar</button>
						</div>
						<br>
						<div class="alert alert-info alertaV" id="alertaV" role="alert">

						</div>
					</form>
					<script src="style/js/app_Validar.js"></script>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="col-md-12 text-center"><a href="Clientes.php" class="btn btn-primary mt-4">VER EMPLEADOS</a></div>
			</div>
		</div>
	</div>
<?php }
include "templates/piepagina.php";
?>
