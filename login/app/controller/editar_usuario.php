<?php
session_start();
require_once '../config/conexion.php';

// Obtener los valores desde el formulario
$id_alumno = $_POST['id_alumno'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$anio_ingreso = $_POST['anio_ingreso'];
$carrera = $_POST['carrera'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

// Preparar la consulta de actualización
$actualizacion = $conexion->prepare("UPDATE t_alumno SET 
    nombre = :nombre, 
    apellido = :apellido, 
    anio_ingreso = :anio_ingreso, 
    carrera = :carrera, 
    fecha_nacimiento = :fecha_nacimiento 
WHERE id_alumno = :id_alumno");

$actualizacion->bindParam(':nombre', $nombre);
$actualizacion->bindParam(':apellido', $apellido);
$actualizacion->bindParam(':anio_ingreso', $anio_ingreso);
$actualizacion->bindParam(':carrera', $carrera);
$actualizacion->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$actualizacion->bindParam(':id_alumno', $id_alumno);

// Ejecutar la actualización
$actualizacion->execute();

if ($actualizacion) {
    echo json_encode([1, "Actualización correcta"]);
} else {
    echo json_encode([0, "Actualización no correcta"]);
}
?>
