// Función para registrar un alumno
const registrar_alumno = () => {
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const anio_ingreso = document.getElementById('anio_ingreso').value;
    const carrera = document.getElementById('carrera').value;
    const fecha_nacimiento = document.getElementById('fecha_nacimiento').value;

    // Verifica si alguno de los campos está vacío
    if (!nombre || !apellido || !anio_ingreso || !carrera || !fecha_nacimiento) {
        alert("Por favor completa todos los campos.");
        return;
    }

    const data = new FormData();
    data.append("nombre", nombre);
    data.append("apellido", apellido);
    data.append("anio_ingreso", anio_ingreso);
    data.append("carrera", carrera);
    data.append("fecha_nacimiento", fecha_nacimiento);
    data.append("action", "registrar");

    fetch("./agregar.php", {
        method: "POST",
        body: data
    }).then(respuesta => respuesta.json())
    .then(respuesta => {
        alert(respuesta[1]);
        if (respuesta[0] == 1) {
            window.location = "../../index.php"; 
        }
    });
};




// Función para eliminar alumno
const eliminar_alumno = (id_alumno) => {
    if (confirm("¿Estás seguro de que deseas eliminar este alumno?")) {
        const data = new FormData();
        data.append("alumno_key", id_alumno); 
        data.append("action", "eliminar");

        fetch("./app/controller/eliminarAlumno.php", {
            method: "POST",
            body: data
        })
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            if (respuesta[0] === 1) {
                Swal.fire('Éxito', respuesta[1], 'success');
                window.location = "index.php"; 
            } else {
                Swal.fire('Error', respuesta[1], 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error', 'Error de red, intenta de nuevo', 'error');
        });
    }
}

// Función para editar alumno
const editar_alumno = (id_alumno) => {
    const nombre_alumno = document.getElementById('nombre').value;
    const apellido_alumno = document.getElementById('apellido').value;
    const anio_ingreso = document.getElementById('anio_ingreso').value;
    const carrera = document.getElementById('carrera').value;
    const fecha_nacimiento = document.getElementById('fecha_nacimiento').value;

    const data = new FormData();
    data.append("nombre", nombre_alumno);
    data.append("apellido", apellido_alumno);
    data.append("anio_ingreso", anio_ingreso);
    data.append("carrera", carrera);
    data.append("fecha_nacimiento", fecha_nacimiento);
    data.append("action", "editar");

    fetch("./editar.php?id=" + id_alumno, { 
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if (respuesta[0] === 1) {
            Swal.fire('Éxito', respuesta[1], 'success');
            window.location = "../../index.php"; // Redirigir al listado después de la actualización
        } else {
            Swal.fire('Error', respuesta[1], 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Error de red, intenta de nuevo', 'error');
    });
}
