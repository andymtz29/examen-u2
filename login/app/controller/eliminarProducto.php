<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'eliminar') {
    $id = $_POST['alumno_key']; 
    
    $sql = "DELETE FROM t_alumno WHERE id_alumno = :id"; // Asegúrate de que el nombre de la columna coincida
    $query = $conexion->prepare($sql);
    $query->bindParam(':id', $id);

    if ($query->execute()) {
        // Respuesta exitosa en formato JSON
        echo json_encode([1, "Alumno eliminado exitosamente."]);
    } else {
        // Error al eliminar
        echo json_encode([0, "Error al eliminar el alumno."]);
    }
    exit(); 
}
?>

