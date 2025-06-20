@section('title', 'Inicio')
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            {{ __('Bienvenido de nuevo ' . auth()->user()->name) }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="stats w-full bg-slate-100/50 max-xl:stats-vertical mx-auto">
            @role('admin')
                <div class="stat py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users-group] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">{{ Auth::user()->count() }}</div>
                    <div class="stat-title font-medium text-lg">Número de Usuarios</div>
                    <div class="stat-desc">Total de usuarios registrados</div>
                </div>
            @endrole

            @hasanyrole(['admin', 'gestor-teacher'])
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--building] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">{{ $convenant }}</div>
                    <div class="stat-title font-medium text-lg">Convenios Activos</div>
                    <div class="stat-desc">Total de convenios activos</div>
                </div>

                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">{{ $posts }}</div>
                    <div class="stat-title font-medium text-lg">Postulaciones</div>
                    <div class="stat-desc">Total de postulaciones</div>
                </div>
            @endrole

            @role('gestor-teacher')
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">4</div>
                    <div class="stat-title font-medium text-lg">Solicitudes</div>
                    <div class="stat-desc">Total de solicitudes</div>
                </div>
            @endrole

            @role('tutor')
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">{{ $count ?? 0 }}</div>
                    <div class="stat-title font-medium text-lg">Estudiantes</div>
                    <div class="stat-desc">Total de estudiantes a cargo</div>
                </div>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">4</div>
                    <div class="stat-title font-medium text-lg">Solicitudes</div>
                    <div class="stat-desc">Total de solicitudes</div>
                </div>
            @endrole

            @role('admin')
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--building] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">12</div>
                    <div class="stat-title font-medium text-lg">Tickets Activos</div>
                    <div class="stat-desc">Total de tickets activos</div>
                </div>
            @endrole
        </div>
    </div>

</x-app-layout>
