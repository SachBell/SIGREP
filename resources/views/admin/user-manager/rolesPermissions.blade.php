@section('title', 'Roles y Permisos')
<x-dashboard-layout>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Rol</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ $role->permissions->pluck('name')->implode(', ') ?: 'No tiene permisos asignados.' }}
                    </td>
                    <td>
                        <a href="">
                            <span class="icon-[tabler--pencil] size-6"></span>
                        </a>
                        <a href="">
                            <span class="icon-[tabler--trash] size-6"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-dashboard-layout>
