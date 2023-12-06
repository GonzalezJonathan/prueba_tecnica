<?php

# Ejemplo de Conexion
$conexion = new mysqli('localhost', 'root', '', 'prueba_practica', '3307');

# Ejemplo de Consulta
$consulta = $conexion->query("SELECT a.apellido, a.nombres,  c.desccripcion, c.abreviatura, c.cod_curso, a.dni  from alumnos a join inscripciones i on a.dni = i.dni_Alu
join cursos c on c.cod_curso = i.cod_curso");

###### Lectura y armado de Datos #######

$arrayEjemplo = array();

while ($fila = $consulta->fetch_assoc()) {
    $abreviatura = $fila['abreviatura'];
    $idCurso = $fila['cod_curso'];
    $nombreCurso = $fila['desccripcion'];
    $dniAlumno = $fila['dni'];
    $nombreAlumno = $fila['nombres'];
    $apellidoAlumno = $fila['apellido'];

    if (!isset($arrayEjemplo[$abreviatura])) {
        $arrayEjemplo[$abreviatura] = array(
            'id_curso' => $idCurso,
            'nombre_curso' => $nombreCurso,
            'alumnos' => array()
        );
    }

    $arrayEjemplo[$abreviatura]['alumnos'][] = array(
        'dni' => $dniAlumno,
        'nombre' => $nombreAlumno,
        'apellido' => $apellidoAlumno
    );
}

echo json_encode(array(
    "codigo" => 0,
    "mensajes" => array("Datos obtenidos con éxito"),
    "data" => $arrayEjemplo
));