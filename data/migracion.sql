USE empresav;

CREATE TABLE empleados (
    cedula INT UNSIGNED PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    telefono VARCHAR(11) NOT NULL,
    edad INT NOT NULL,
    genero VARCHAR(10) ,
    seguro VARCHAR(20) ,
    correo VARCHAR(50) NOT NULL,
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UPDATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);