<div id="sidebar"
    class="absolute md:relative md:flex flex-col w-64 bg-gray-800 transition-all h-screen ease-in-out transition-transform transform -translate-x-full md:translate-x-0 ease-in-out duration-300 z-50 h-screen">
    <div class="text-center tracking-widest border-b-2 border-gray-800 py-3 bg-gray-900 mb-8">
        @if (auth()->user()->id_role === 1)
            <a href="{{ route('admin.index') }}" class="text-2xl text-white font-bold uppercase">sigrep</a>
        @else
            <a href="#" class="text-2xl text-white font-bold uppercase">sigrep</a>
        @endif
    </div>
    <nav class="flex flex-col flex-1 px-1 overflow-y-auto text-sm text-gray-300">
        <ul class="flex flex-col justify-between space-y-[4rem]">
            @if (Auth::user()->hasRole('admin'))
                <div>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.') ? 'bg-gray-600' : '' }} hover:bg-gray-700 hover:text-white rounded">
                        <a href="{{ route('admin.dashboard.') }}" class="py-3 flex items-center">
                            <i class="bi bi-house-fill mr-4 text-base text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Panel') }}</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold rounded">
                        {{ __('Control de Usarios') }}
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.user-manager.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('admin.dashboard.user-manager.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-people-fill mr-4 text-xl"></i>
                            <span class="text-lg font-semibold">{{ __('Usuarios') }}</span>
                        </a>
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.registers.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('admin.dashboard.registers.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-journal-text mr-4 text-xl"></i>
                            <span class="text-lg font-semibold">{{ __('Registros') }}</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        {{ __('Control de Postulaciones') }}
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.applications.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('admin.dashboard.applications.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-award mr-4 text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Postulaciones') }}</span>
                        </a>
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.institutes.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('admin.dashboard.institutes.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-book mr-4 text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Institutos') }}</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        {{ __('Ajustes') }}
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('admin.dashboard.profile') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('admin.dashboard.profile.edit') }}" class="py-3 flex items-center">
                            <i class="bi bi-person-circle mr-4 text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Perfil') }}</span>
                        </a>
                    </li>
                </div>
            @else
                <div>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('user.dashboard.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 hover:text-white rounded">
                        <a href="{{ route('user.dashboard.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-house-fill mr-4 text-base text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Panel') }}</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold rounded">
                        {{ __('Control de Prácticas') }}
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('user.dashboard.forms.index') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('user.dashboard.forms.index') }}" class="py-3 flex items-center">
                            <i class="bi bi-people-fill mr-4 text-xl"></i>
                            <span class="text-lg font-semibold">{{ __('Postulaciones') }}</span>
                        </a>
                    </li>
                    <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        {{ __('Ajustes') }}
                    </li>
                    <li
                        class="px-4 cursor-pointer {{ request()->routeIs('user.dashboard.profile.edit') ? 'bg-gray-600' : '' }} hover:bg-gray-700 rounded">
                        <a href="{{ route('user.dashboard.profile.edit') }}" class="py-3 flex items-center">
                            <i class="bi bi-person-circle mr-4 text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Perfil') }}</span>
                        </a>
                    </li>
                </div>
            @endif
            <div class="border-t pt-3 border-gray-700">
                <li class="px-4 cursor-pointer hover:bg-gray-700 rounded">
                    <form class="flex items-center w-full" id="logout-form" action="{{ route('logout') }}"
                        method="POST">
                        @csrf
                        <a class="flex items-center w-full py-3" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left mr-4 text-lg"></i>
                            <span class="text-lg font-semibold">{{ __('Cerrar Sesión') }}</span>
                        </a>
                    </form>
                </li>
            </div>
        </ul>
    </nav>
</div>

{{-- <div id="sidebar-content" class="d-flex flex-column position-fixed top-0">
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
                    <span>{{ __('Cerrar Sesión') }}</span>
                </a>
            </form>
        </li>
    </ul>
</div> --}}
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
