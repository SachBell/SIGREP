<div id="sidebar-content" class="d-flex flex-column position-fixed top-0">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-grid"></i>
        </button>
        <div class="sidebar-logo">
            @if (Auth::user()->id_role === 1)
                <a href="{{ route('admin.dashboard') }}">SIGREP ISUS</a>
            @else
                <a href="{{ route('user.dashboard') }}">SIGREP ISUS</a>
            @endif
        </div>
    </div>
    <ul class="sidebar-nav d-flex flex-column gap-3">
        @if (Auth::user()->id_role === 1)
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <i class="bi bi-house-door-fill"></i>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.application-calls.index') }}" class="sidebar-link">
                    <i class="bi bi-award"></i>
                    <span>{{ __('Applications') }}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.institutes.index') }}" class="sidebar-link">
                    <i class="bi bi-book"></i>
                    <span>{{ __('Institutes') }}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.registros.index') }}" class="sidebar-link">
                    <i class="bi bi-journal-text"></i>
                    <span>{{ __('Registers') }}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.user-manager.index') }}" class="sidebar-link">
                    <i class="bi bi-people"></i>
                    <span>{{ __('Users') }}</span>
                </a>
            </li>
        @else
            <li class="sidebar-item">
                <a href="{{ route('user.dashboard') }}" class="sidebar-link">
                    <i class="bi bi-house-door-fill"></i>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('user.form-register.index') }}" class="sidebar-link">
                    <i class="bi bi-journal-text"></i>
                    <span>{{ __('Registers') }}</span>
                </a>
            </li>
        @endif
        <li class="sidebar-item">
            @if (Auth::user()->id_role === 1)
                <a href="{{ route('admin.profile.edit') }}" class="sidebar-link">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            @else
                <a href="{{ route('user.profile.edit') }}" class="sidebar-link">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            @endif
        </li>
        <li class="sidebar-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="sidebar-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>{{ __('Log Out') }}</span>
                </a>
            </form>
        </li>
    </ul>
</div>

{{-- <li class="sidebar-item">
    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth"
        aria-expanded="false" aria-controls="auth">
        <i class="lni lni-protection"></i>
        <span>Auth</span>
    </a>
    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">Login</a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">Register</a>
        </li>
    </ul>
</li>
<li class="sidebar-item">
    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi"
        aria-expanded="false" aria-controls="multi">
        <i class="lni lni-layout"></i>
        <span>Multi Level</span>
    </a>
    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two"
                aria-expanded="false" aria-controls="multi-two">
                Two Links
            </a>
            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Link 1</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Link 2</a>
                </li>
            </ul>
        </li>
    </ul>
</li> --}}
