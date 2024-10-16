<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos que la acción es "registrar"
    if (isset($_POST['action']) && $_POST['action'] === 'registrar') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $anio_ingreso = $_POST['anio_ingreso'];
        $carrera = $_POST['carrera'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        // Insertar alumno en la base de datos
        $sql = "INSERT INTO t_alumno (nombre, apellido, anio_ingreso, carrera, fecha_nacimiento) VALUES (:nombre, :apellido, :anio_ingreso, :carrera, :fecha_nacimiento)";
        $query = $conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido', $apellido);
        $query->bindParam(':anio_ingreso', $anio_ingreso);
        $query->bindParam(':carrera', $carrera);
        $query->bindParam(':fecha_nacimiento', $fecha_nacimiento);

        if ($query->execute()) {
            // Si la inserción es exitosa, devolvemos una respuesta JSON
            echo json_encode([1, "Alumno registrado exitosamente."]);
        } else {
            // Si hay un error en la inserción
            echo json_encode([0, "Error al registrar el alumno."]);
        }
    } else {
        echo json_encode([0, "Acción no válida."]);
    }
    exit(); // Finalizamos el script PHP aquí
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Alumno</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo '../../public/css/agregarProductos.css'; ?>">
</head>

<body>

<div class="container">
        <h1><i class="fas fa-user-graduate"></i> Agregar Alumno</h1> <!-- Icono al lado del título -->

        <form id="alumno-form" class="formulario">
            <div class="form-group">
                <label for="nombre"><i class="fas fa-user"></i> Nombre:</label> <!-- Icono de usuario -->
                <input type="text" id="nombre" class="input-text" required>
            </div>

            <div class="form-group">
                <label for="apellido"><i class="fas fa-user-tag"></i> Apellido:</label> <!-- Icono de etiqueta de usuario -->
                <input type="text" id="apellido" class="input-text" required>
            </div>

            <div class="form-group">
                <label for="anio_ingreso"><i class="fas fa-calendar-alt"></i> Año de Ingreso:</label> <!-- Icono de calendario -->
                <input type="number" id="anio_ingreso" class="input-text" required>
            </div>

            <div class="form-group">
                <label for="carrera"><i class="fas fa-graduation-cap"></i> Carrera:</label> <!-- Icono de graduación -->
                <input type="text" id="carrera" class="input-text" required>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento"><i class="fas fa-birthday-cake"></i> Fecha de Nacimiento:</label> <!-- Icono de pastel de cumpleaños -->
                <input type="date" id="fecha_nacimiento" class="input-text" required>
            </div>

            <button type="button" class="btn" onclick="registrar_alumno()">
                <i class="fas fa-plus-circle"></i> Agregar <!-- Icono de agregar -->
            </button>

        </form>

        <a href="../../index.php" class="regresar"><i class="fas fa-arrow-left"></i> Regresar al listado</a> <!-- Icono de regresar -->
    </div>

    <script src="../../public/js/crud.js"></script> <!-- Asegúrate de que la ruta sea correcta -->
</body>
</html>
