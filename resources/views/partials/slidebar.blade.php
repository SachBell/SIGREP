<nav id="sidebar" class="slidebar h-100 d-flex flex-column justify-content-between position-fixed top-0 pt-3 bg-dark">
    <div class="container-fluid justify-content-center">
        <span class="fs-2">SIREP ISUS</span>
    </div>
    <div class="h-100 d-flex flex-column justify-content-between contianer-fluid mt-4 px-1">
        <div class="container-fluid ms-3">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link fs-5 active" aria-current="page">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('registros.index') }}" class="nav-link fs-5">Registros de Formulario</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link fs-5"></a>
                </li>
            </ul>
        </div>
        <div id="footer-slidebar" class="container-fluid py-4 px-0">
            <div class="container-fluid d-flex justify-content-center">
                <div class="container text-center p-0">
                    <a id="session-btn" href="profile" class="p-3 ps-4 pe-4 fs-4"><i class="fa-solid fa-user"></i></a>
                </div>
                <div class="container text-center p-0">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a id="session-btn" class="p-3 ps-4 pe-4 fs-4" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
