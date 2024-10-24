<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="/public/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/be6056a694.js" crossOrigin="anonymous"></script>
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
                        <a class="nav-link active" href="/" aria-current="page">Inicio
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item fs-5">
                        <a class="nav-link" href="/login">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid mt-5">
        <form id="loginForm" class="container d-flex flex-column gap-4">
            <fieldset>
                <legend class="text-center mt-4 fs-1 fw-bold">Log In</legend>
                <legend class="container mt-2">
                    <label class="form-label" for="username">Usuario:</label>
                    <input class="form-control" type="text" id="username" name="username" required>
                </legend>
                <legend class="container mt-2">
                    <label class="form-label" for="password">Contraseña:</label>
                    <input class="form-control" type="password" id="password" name="password" required>                
                </legend>
            </fieldset>
            <div class="container-fluid d-flex justify-content-center">
                <button class="btn-primary pe-4 ps-4 p-2 fs-5 rounded" type="submit">Log In
                    
                </button>
            </div>
            <p id="error" style="color: red;"></p>
        </form>

        <script src="/public/js/app.js"></script>
    </main>

    <footer class="container-fluid d-flex align-items-center justify-content-center">
        <span class="fs-5">Power By <a class="text-decoration-none" href="https://alfahost.es">AlfaHost</a></span>
    </footer>
</body>
</html>