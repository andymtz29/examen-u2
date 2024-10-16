<?php
require_once '../config/conexion.php';

$id = $_GET['id'];

// Obtener datos del alumno a editar
$sql = "SELECT * FROM t_alumno WHERE id_alumno = :id"; // Cambié t_producto a t_alumno
$query = $conexion->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();
$alumno = $query->fetch(PDO::FETCH_ASSOC);

// Procesar la solicitud POST desde fetch
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'editar') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $anio_ingreso = $_POST['anio_ingreso'];
        $carrera = $_POST['carrera'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        // Actualizar alumno en la base de datos
        $sql = "UPDATE t_alumno SET nombre = :nombre, apellido = :apellido, anio_ingreso = :anio_ingreso, carrera = :carrera, fecha_nacimiento = :fecha_nacimiento WHERE id_alumno = :id";
        $query = $conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido', $apellido);
        $query->bindParam(':anio_ingreso', $anio_ingreso);
        $query->bindParam(':carrera', $carrera);
        $query->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            // Respuesta exitosa en formato JSON
            echo json_encode([1, "Alumno actualizado exitosamente."]);
        } else {
            // Error al actualizar
            echo json_encode([0, "Error al actualizar el alumno."]);
        }
    } else {
        echo json_encode([0, "Acción no válida."]);
    }
    exit(); // Terminar el script después de enviar la respuesta JSON
}
?>