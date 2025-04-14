<header class="bg-gray-800 md:basis-[260px] lg:z-10">
    <aside id="multilevel-with-separator"
        class="bg-gray-800 overlay md:shadow-none overlay-open:translate-x-0 drawer drawer-start hidden max-w-64 md:flex md:translate-x-0"
        tabindex="-1">

        <div class="drawer-header">
            <div class="flex items-center gap-3">
                <h3 class="text-white text-xl font-semibold">SIGREP ISUS</h3>
            </div>
        </div>

        <div class="drawer-body px-2 pt-4">
            <ul class="bg-transparent menu space-y-0.5 [&_.nested-collapse-wrapper]:space-y-0.5 [&_ul]:space-y-0.5 p-0">
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <a class="text-white sidebar-link" href="{{ route('admin.dashboard.') }}">
                            <span class="icon-[tabler--home] size-5"></span>
                            {{ __('Inicio') }}
                        </a>
                    </li>
                    <li class="text-white space-y-0.5">
                        <a class="sidebar-link collapse-toggle collapse-open:bg-base-content/10 open" id="menu-app"
                            data-collapse="#menu-app-collapse">
                            <span class="icon-[tabler--users] size-5"></span>
                            {{ __('Usuarios') }}
                            <span
                                class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
                        </a>
                        <ul id="menu-app-collapse"
                            class="collapse w-auto overflow-hidden transition-[height] duration-300 open"
                            aria-labelledby="menu-app">
                            <li>
                                <a class="sidebar-link text-white"
                                    href="{{ route('admin.dashboard.user-manager.index') }}">
                                    <span class="icon-[tabler--user-cog] size-5"></span>
                                    User Manager
                                </a>
                            </li>
                            <li>
                                <a class="sidebar-link text-white"
                                    href="{{ route('admin.dashboard.rolespermissions.index') }}">
                                    <span class="icon-[tabler--user-check] size-5"></span>
                                    Roles & Permissions
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard.institutes.index') }}" class="text-white sidebar-link">
                            <span class="icon-[tabler--school] size-5"></span>
                            {{ __('Institutos') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard.registers.index') }}" class="text-white sidebar-link">
                            <span class="icon-[tabler--clipboard-data] size-5"></span>
                            {{ __('Registros') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard.applications.index') }}" class="text-white sidebar-link">
                            <span class="icon-[tabler--apps] size-5"></span>
                            {{ __('Postulaciones') }}
                        </a>
                    </li>
                    <div class="text-white divider py-6 divider-neutral">Account</div>
                    <li>
                        <a class="text-white" href="{{ route('admin.dashboard.profile.edit') }}">
                            <span class="icon-[tabler--user] size-5"></span>
                            {{ __('Perfil') }}
                        </a>
                    </li>
                    <li>
                        <form class="hidden" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        <a class="text-white" href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon-[tabler--logout-2] size-5"></span>
                            {{ __('Sign Out') }}
                        </a>
                    </li>
                    <div class="text-white divider py-6 divider-neutral">Miscellaneous</div>
                    <li>
                        <a class="text-white" href="#">
                            <span class="icon-[tabler--users-group] size-5"></span>
                            Support
                        </a>
                    </li>
                @else
                    <li class="text-white">
                        <a href="{{ route('user.dashboard.index') }}">
                            <span class="icon-[tabler--home] size-5"></span>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.dashboard.forms.index') }}" class="text-white sidebar-link">
                            <span class="icon-[tabler--apps] size-5"></span>
                            {{ __('Postulaciones') }}
                        </a>
                    </li>
                    <div class="text-white divider py-6 divider-neutral">Account</div>
                    <li class="text-white">
                        <a href="{{ route('user.dashboard.profile.edit') }}">
                            <span class="icon-[tabler--user] size-5"></span>
                            {{ __('Perfil') }}
                        </a>
                    </li>
                    <li class="text-white">
                        <form class="flex items-center w-full" id="logout-form" action="{{ route('logout') }}"
                            method="POST">
                            @csrf
                            <a class="flex items-center gap-2" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icon-[tabler--logout-2] size-5"></span>
                                {{ __('Sign Out') }}
                            </a>
                        </form>
                    </li>
                    <div class="text-white divider py-6 divider-neutral">Miscellaneous</div>
                    <li class="text-white">
                        <a href="#">
                            <span class="icon-[tabler--users-group] size-5"></span>
                            Support
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
</header>
