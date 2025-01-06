<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a href="/" class="nav-link fs-2 fw-bold">SIREP ISUS</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-expanded="false" aria-label="Toggle Navbar" aria-controls="navbarContent">
            <i class="navbar-toggler-icon fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent" style="flex-grow: .1 !important">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/" class="nav-link active fs-5" aria-current="page">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link fs-5" aria-current="page">Log In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
