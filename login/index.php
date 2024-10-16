<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: login.php');
}
require_once "./app/config/dependencias.php";
require_once "./app/controller/db.php";

// Consulta a la tabla t_alumno
$sql = "SELECT * FROM t_alumno";
$query = $conn->prepare($sql);
$query->execute();
$alumnos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="<?= CSS.'tabla.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>

        .cerrar-sesion, .editar {
            position: absolute;
            top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .cerrar-sesion {
            right: 10px;
            background-color: #ff4d4d;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cerrar-sesion:hover {
            background-color: #ff1a1a;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .editar {
            right: 160px;
            background-color: #4CAF50;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .editar:hover {
            background-color: #45a049;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .cerrar-sesion i, .editar i {
            margin-right: 8px;
        }
    </style>

</head>
<body>

<h1><i class="fas fa-list"></i> Lista de Alumnos</h1>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><i class="fas fa-hashtag"></i>ID</th>
                <th><i class="fas fa-user"></i>Nombre</th>
                <th><i class="fas fa-user-tag"></i>Apellido</th>
                <th><i class="fas fa-calendar-alt"></i>Año de Ingreso</th>
                <th><i class="fas fa-graduation-cap"></i>Carrera</th>
                <th><i class="fas fa-birthday-cake"></i>Fecha de Nacimiento</th>
                <th><i class="fas fa-cog"></i>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?php echo $alumno['id_alumno']; ?></td>
                <td><?php echo $alumno['nombre']; ?></td>
                <td><?php echo $alumno['apellido']; ?></td>
                <td><?php echo $alumno['anio_ingreso']; ?></td>
                <td><?php echo $alumno['carrera']; ?></td>
                <td><?php echo $alumno['fecha_nacimiento']; ?></td>
                <td class="actions">
                    <a href="./app/controller/editar.php?id=<?php echo $alumno['id_alumno']; ?>" class="edit">
                        <i class="fas fa-edit"></i>Editar
                    </a>
                    <a href="#" class="delete" onclick="eliminar_alumno(<?php echo $alumno['id_alumno']; ?>);">
                        <i class="fas fa-trash-alt"></i>Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="container">
        <a href="./app/controller/agregar.php">
            <i class="fas fa-plus"></i>Agregar Alumno
        </a>

        <button class="cerrar-sesion" id="cerrar">
            <i class="fas fa-sign-out-alt"></i>Cerrar Sesión
        </button>

    </div>

</div>

<script src="./app/controller/crud.js"></script>
</body>
</html>
