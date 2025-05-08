@props(['keys'])
<tbody id="table-body" class="bg-gray-100">
    @if (Request::routeIs('admin.dashboard.user-manager*'))
        @foreach ($keys as $registro)
            <tr class="border-gray-200">
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->name }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->email }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    @foreach ($registro->roles as $role)
                        @if ($role->name == 'admin')
                            <span class="badge badge-soft badge-error">
                                {{ $role->name ?? 'Sin Role' }}
                            </span>
                        @else
                            <span class="badge badge-soft badge-success">
                                {{ $role->name ?? 'Sin Role' }}
                            </span>
                        @endif
                    @endforeach
                </td>
                <td class="flex py-5">
                    <div class="relative group">
                        <a href="{{ route('admin.dashboard.user-manager.edit', $registro->id) }}"
                            class="btn btn-circle btn-text btn-sm">
                            <span class="icon-[tabler--pencil] size-6"></span>
                        </a>
                        <span
                            class="absolute left-1/2 -translate-x-1/2 -top-8 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                            Editar
                        </span>
                    </div>

                    <div class="relative group">
                        <form class="delete-form"
                            action="{{ route('admin.dashboard.user-manager.destroy', $registro->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-circle btn-text btn-sm">
                                <span class="icon-[tabler--trash] size-6"></span>
                            </button>
                        </form>
                        <span
                            class="absolute left-1/2 -translate-x-1/2 -top-8 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                            Eliminar
                        </span>
                    </div>

                    <div class="relative group">
                        <form action="{{ route('admin.dashboard.user-manager.resetPassword', $registro->id) }}"
                            method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-circle btn-text btn-sm">
                                <span class="icon-[tabler--refresh] size-6"></span>
                            </button>
                        </form>
                        <span
                            class="absolute text-balance lg:text-nowrap left-1/2 -translate-x-1/2 -top-8 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded">
                            Resetear Contraseña
                        </span>
                    </div>

                </td>
            </tr>
        @endforeach
    @endif
    @if (Request::routeIs('admin.dashboard.institutes*'))
        @foreach ($keys as $registro)
            <tr class="border-gray-200">
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->name }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->address }}
                </td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->user_limit }}</td>
                <td class="flex py-5">
                    <a href="{{ route('admin.dashboard.institutes.edit', $registro->id) }}"
                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                            class="icon-[tabler--pencil] size-6"></span>
                    </a>
                    <form class="delete-form" action="{{ route('admin.dashboard.institutes.destroy', $registro->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                class="icon-[tabler--trash] size-6"></span></button>
                    </form>
                    @include('components.alert-confirm')
                </td>
            </tr>
        @endforeach
    @endif
    @if (Request::routeIs('admin.dashboard.registers*'))
        @foreach ($keys as $registro)
            <tr class="border-gray-200">
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->id_card }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->name }}
                </td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->lastname }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->phone_number }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->address }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->neighborhood }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->semesters->semester }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->grades->grade }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->userData->daytrip }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->applicationCalls?->application_title ?: 'N/A' }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->institutes->name }}</td>
                <td class="text-md whitespace-nowrap py-5">
                    {{ $registro->institutes->address }}</td>
                <td class="flex py-5">
                    <a href="{{ route('admin.dashboard.registers.edit', $registro->id) }}"
                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                            class="icon-[tabler--pencil] size-6"></span>
                    </a>
                    <form class="delete-form" action="{{ route('admin.dashboard.registers.destroy', $registro->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                class="icon-[tabler--trash] size-6"></span></button>
                    </form>
                    @include('components.alert-confirm')
                </td>
            </tr>
        @endforeach
    @endif
</tbody>
