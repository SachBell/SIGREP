<div id="sidebar" class="sidebar d-flex flex-column flex-shrink-0 p-3 position-fixed top-0 bg-dark h-100"
    style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-2">SIREP ISUS</span>
    </a>
    <hr>
    <ul class="nav flex-column mb-auto">
        @auth
            @if (Auth::user()->id_role === 1)
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link fs-5 active" aria-current="page">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.registros.index') }}" class="nav-link fs-5">Registros</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.institutes.index') }}" class="nav-link fs-5">Institutos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user-manager.index') }}" class="nav-link fs-5">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.application-calls.index') }}" class="nav-link fs-5">Postulaciones</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link active fs-5" aria-current="page">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.form-register.index') }}" class="nav-link fs-5">Registrar Practicas</a>
                </li>
            @endif
        @endauth
    </ul>
    <hr>
    <div class="dropdown">
        <a id="profileAction" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://placehold.co/400" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ auth()->user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            @if (Auth::user()->id_role === 1)
                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Profile</a></li>
            @else
                <li><a class="dropdown-item" href="{{ route('user.profile.edit') }}">Profile</a></li>
            @endif
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                </form>
            </li>
        </ul>
    </div>
</div>
