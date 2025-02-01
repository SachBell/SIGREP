<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Actualiza el enlace de descarga
            const downloadLink = document.getElementById('downloadLink');
            downloadLink.href = 'http://practicasisus.test/src/DataBase/estidiantes.xlsx';  // Cambia aquí si la ruta es diferente
        });

        // Verificar si el usuario ha iniciado sesión
        if (!localStorage.getItem('loggedIn')) {
            // Si no ha iniciado sesión, redirigir al login
            window.location.href = '/';
        }
    </script>
</head>
<body>
    <h1>Bienvenido al Panel de Control</h1>
    <p>Para descargar los resultados del formulario da <a id="downloadLink" href="" download>click aquí</a></p>
    <button class="btn-danger rounded pe-4 ps-4 p-2 fs-5 fw-bolder" onclick="logout()">Cerrar Sesión</button>

    <script>
        function logout() {
            // Eliminar la sesión
            localStorage.removeItem('loggedIn');
            // Redirigir al login
            window.location.href = '/';
        }
    </script>
</body>
</html>
