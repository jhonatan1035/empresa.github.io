if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);}



function Validar(){
    // datos necesarios para validar
    const Cedula = document.getElementById("cedula");
    const Nombres = document.getElementById("nombres");
    const Apellidos = document.getElementById("apellidos");
    const Telefono = document.getElementById("telefono");
    const Edad = document.getElementById("edad");
    const Genero = document.getElementById("genero");
    const Seguro = document.getElementById("seguro");
    const Correo = document.getElementById("correo");

    // alerta de los datos que no estan correctos
    const AlertaV = document.getElementById("alertaV");
    // opcion para validar que un correo sea correcto
    var CorreoValidacion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    AlertaV.innerHTML = "";
    let valido = false;
    let MensajeA = "";
    
    if (Cedula.value.length == 0) {
        MensajeA  += `El campo de la cedula no puede estar vacio <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Cedula.value.length < 8 || Cedula.value.length > 10) {
            
        MensajeA  += `Ingresa un numero de cedula valido <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;
        
    }

    if (Nombres.value.length == 0 && Apellidos.value.length == 0) {
         
        MensajeA  += `Por favor ingresar el nombre y el apellido del empleado <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Nombres.value.length == 0) {

        MensajeA  += `Por favor ingresa el nombre del empleado  <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Apellidos.value.length == 0){

        MensajeA  += `Por favor ingresa el Apellido del empleado  <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }

    if (Telefono.value.length==0) {

        MensajeA  += `Por favor ingresar el numero de celular del empleado <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Telefono.value.length != 10){

        MensajeA  += `Por favor ingresa un numero de telefono valido <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }
    
    if (Edad.value.length == 0) {

        MensajeA += `Ingresa la edad del empleado <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Edad.value.length > 2) {

        MensajeA += `Ingresa una edad valida <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (Edad.value < 18) {

        MensajeA += `Verifica la edad ingresa (No cumple con los criterios de la empresa) <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }

    if (Seguro.value == "") {
        
        MensajeA += `Ingresa un seguro al que este vinculado el empleado <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }
    
    if (Genero.value == "") {
        
        MensajeA += `Ingresa un genero con el que se identifique el empleado <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }

    if (Correo.value.length == 0) {
            
        MensajeA += `Debes ingresar una dirrecion de correo electronico <br>`;  
        valido = true;
        mensaje(valido,MensajeA);
        return false;

    }else if (CorreoValidacion.test(Correo.value) == false) {

        MensajeA += `Ingresa una dirrecion de correo electronico valida <br>`;
        valido = true;
        mensaje(valido,MensajeA);
        return false;
        
    }

    mensaje(valido,MensajeA);
    
}

function mensaje(valido,MensajeA) {

    const AlertaV = document.getElementById("alertaV");

    if (valido == true) {
        
        AlertaV.style.display = "block";
        AlertaV.innerHTML = MensajeA;

    }else if (valido == false) {

        AlertaV.style.display = "block";
        AlertaV.innerHTML = "Enviado";

    } 
}

function Limpiar() {
    
    const AlertaV = document.getElementById("alertaV");

    AlertaV.style.display = "none";
    
}

