<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="/public/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        // Verificar si el usuario ha iniciado sesión
        if (!localStorage.getItem('loggedIn')) {
            // Si no ha iniciado sesión, redirigir al login
            window.location.href = '/';
        }
    </script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fs-2 fw-bold" href="/">ISUS SPP</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbaContetent" aria-controls="navbaContetent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbaContetent">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item fs-5">
                        <a class="nav-link active" href="/dashboard" aria-current="page">Inicio
                        <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="/register_reports">Registros</a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="" onclick="logout()">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <h1>Bienvenido al Panel de Control</h1>
    </main>

    <footer class="container-fluid d-flex align-items-center justify-content-center">
        <span class="fs-5">Power By <a class="text-decoration-none" href="#">YggdrasilCode</a></span>
    </footer>

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
