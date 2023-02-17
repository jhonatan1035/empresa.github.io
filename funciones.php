<?php

    function ConexionBD(){
        // datosd e la conexion
        $servername = 'localhost';
        $database = 'empresav';
        $username = 'root';
        $password = 'Medellin1@';

        // Aqui vamos a almacenar el EstadoC de la conexion y el valor de la conexion ya sea true o false
        $informacionC=[
            'conexion' => '',
            'estadoCo' => ''
        ];

        try {
            // AQUI CREAMOS LA CONEXION
            $conexion = new PDO("mysql:host=$servername;dbname=$database",$username,$password);

            // AQUI VAMOS A CHECKEAR LA CONEXION
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $informacionC['conexion'] = $conexion;
            $informacionC['estadoCo'] = "Conexion Exitosa";

        } catch (PDOException $e) {

            $informacionC['conexion'] = $conexion;
            $informacionC['estadoCo'] = "Conexion fallida" . $e->getMessage(); 

        }

        return $informacionC;
    }

    function EstadoConsola($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    function escapar($html){
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function MostrarEmpleados($conexion){

        try{
            $consulta = 'SELECT * FROM empleados';

            $query = $conexion -> prepare($consulta);

            $query -> execute();

            $resultado = $query -> fetchAll(PDO::FETCH_OBJ);

            if ($query -> rowCount()>0) {

                return $resultado;

            }
        } catch (PDOException $e) {
            
            echo $e->getMessage();

        }

    }

    function CrearEmpleado($conexion,$CEDULA,$NOMBRES,$APELLIDOS,$TELEFONO,$EDAD,$GENERO,$SEGURO,$CORREO){
        // Aqui se va a guardar la informacion y el EstadoC del nuevo usuario
        $EstadoC = [
            'FuncionC' => '',
            'mensaje' => ''
        ];

        // Vamos Primero a buscar si la cedula ingresada ya esta registrada

        $sql = "SELECT cedula FROM empleados WHERE cedula ='$CEDULA'";

        $resultado = $conexion->prepare($sql);

        $resultado ->execute();

        $cantidadFilas = $resultado->fetchColumn();

        if ($cantidadFilas > 0){

            $EstadoC['FuncionC'] = '1';
            $EstadoC['mensaje'] = 'Ya existe un empleado con la cedula '.$CEDULA;


        }else {

            try{

                $sql = "INSERT INTO empleados (cedula,nombres,apellidos,telefono,edad,genero,seguro,correo)
                VALUES ('$CEDULA','$NOMBRES','$APELLIDOS','$TELEFONO','$EDAD','$GENERO','$SEGURO','$CORREO')";

                $sql = $conexion->prepare($sql);

                $sql->execute();
                    
                $EstadoC['FuncionC'] = '2';
                $EstadoC['mensaje'] = "Se registro al empleado ".$NOMBRES." exitosamente";
                
            }catch (Exception $e){  

                echo 'Error: ', $e->getMessage();

            }

        }

        return $EstadoC;

    }
    
    function ActualizarE($conexion){

        $Actualizado = "";

        $empleados = [
            "cedula" => $_GET['cedula'],
            "nombres" => $_POST['nombres'],
            "apellidos" => $_POST['apellidos'],
            "telefono" => $_POST['telefono'],
            "edad" => $_POST['edad'],
            "genero" => $_POST['genero'],
            "seguro" => $_POST['seguro'],
            "correo" => $_POST['correo']
        ];

        try {
            
            $sql = "UPDATE empleados SET
                    nombres = :nombres,
                    apellidos = :apellidos,
                    telefono = :telefono,
                    edad = :edad,
                    genero = :genero,
                    seguro = :seguro,
                    correo = :correo
                    WHERE cedula = :cedula";

            $Resultado = $conexion->prepare($sql);
            $Resultado->execute($empleados);
            $Actualizado = "SI";

            header('Location: Clientes.php?estado='.$Actualizado);
            
        } catch (PDOException $e) {
            
            echo $e->getMessage();

        }
    }
?>