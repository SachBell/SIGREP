<div class="space-y-4">
    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', ['admin', 'gestor-teacher'])): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.assign-students-modal', [])->html();
} elseif ($_instance->childHasBeenRendered('assign-students')) {
    $componentId = $_instance->getRenderedChildComponentId('assign-students');
    $componentTag = $_instance->getRenderedChildComponentTagName('assign-students');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('assign-students');
} else {
    $response = \Livewire\Livewire::mount('modals.assign-students-modal', []);
    $html = $response->html();
    $_instance->logRenderedChild('assign-students', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php endif; ?>
    <div class="w-full px-2 md:px-8" wire:ignore>
        <!-- Buscador y botón Nuevo Tutor (común) -->
        <div class="w-full grid grid-cols-1">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input w-auto ps-8 focus:border-blue-500 focus:ring-blue-500" wire:model="search"
                    type="text" role="combobox" aria-expanded="false"
                    <?php if(auth()->user()->hasAnyRole(['admin', 'gestor-teacher'])): ?> placeholder="Buscar Docente" <?php else: ?> placeholder="Buscar estudiante" <?php endif; ?> />
            </div>
        </div>
    </div>

    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', ['admin', 'gestor-teacher'])): ?>
        <div class="mt-4 space-y-2">
            <?php if($studentTutor->isEmpty()): ?>
                <div class="card min-h-60 w-full">
                    <div class="card-body items-center justify-center">
                        <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                        <span>No hay datos que mostrar</span>
                    </div>
                </div>
            <?php else: ?>
                <div class="max-w-[105rem] overflow-auto h-fit bg-white mx-4 rounded-lg shadow">
                    <table class="table">
                        <thead>
                            <tr>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                    <th class="text-sm whitespace-nowrap font-semibold py-5">Carrera</th>
                                <?php endif; ?>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Docente</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Estudiantes A Cargo</th>
                                <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-50">
                            <?php $__currentLoopData = $studentTutor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                        <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                            <?php echo e($data->career->name); ?>

                                        </td>
                                    <?php endif; ?>
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        <?php echo e($data->name . ' ' . $data->lastname); ?>

                                    </td>
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        <?php echo e($data->user->email); ?>

                                    </td>
                                    <td class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        <?php echo e($data->students_list ?: 'Sin asignaciones'); ?>

                                    </td>
                                    <td class="flex py-5 space-x-2">
                                        <?php if(auth()->user()->id === $data->id || auth()->user()->hasRole('admin')): ?>
                                            <button wire:click="$emit('openEdit', <?php echo e($data->id); ?>)"
                                                class="btn btn-circle btn-text btn-sm" aria-label="Editar tutor">
                                                <span class="icon-[tabler--user-plus] size-6"></span>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'tutor')): ?>
        <?php if(!$hasStudents): ?>
            <div class="card min-h-60 w-full">
                <div class="card-body items-center justify-center">
                    <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                    <span>No hay estudiantes asignados</span>
                </div>
            </div>
        <?php else: ?>
            <div class="px-2 md:px-4 py-8 md:mx-4 space-y-8">
                <?php $__currentLoopData = $studentTutor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $tutor->students_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="container px-6 py-10 mx-auto shadow rounded-box">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <h1 class="text-xl mb-4">
                                        <span class="font-medium">Estudiante ·</span>
                                        <?php echo e($student['name']); ?>

                                    </h1>
                                    <div class="inline-flex flex-col gap-1">
                                        <span class="text-gray-400">
                                            <span class="font-medium">Institución ·</span>
                                            <?php echo e($student['institution']); ?>

                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Fecha de Visita ·</span>
                                            <?php echo e($student['date']); ?>

                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Hora de Visita ·</span>
                                            <?php echo e($student['time']); ?>

                                        </span>
                                        <span class="text-gray-400">
                                            <span class="font-medium">Visita ·</span>
                                            <?php echo e($student['visits_made']); ?> de <?php echo e($student['required_visits']); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="md:col-span-2 md:col-start-3 lg:col-span-2 lg:col-start-4">
                                    <div class="inline-flex flex-col items-center gap-4">
                                        <?php if($student['visits_made'] >= $student['required_visits'] && $student['is_complete']): ?>
                                            
                                            <div class="badge badge-soft badge-success h-auto py-2 text-[1rem]">
                                                Visita completada
                                            </div>
                                        <?php elseif($student['is_dual'] && $student['visits_made'] >= $student['required_visits'] && $student['second_visit_completed']): ?>
                                            
                                            <div class="badge badge-soft badge-success">
                                                Visitas completadas
                                            </div>
                                        <?php else: ?>
                                            
                                            <?php if($student['visit_action'] === 'edit'): ?>
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="$emit('openEdit', <?php echo e($student['visit_id']); ?>, <?php echo e($student['tutor_students_id']); ?>)">
                                                    <span class="icon-[tabler--calendar-plus] size-6"></span>
                                                    <?php echo e($student['visit_button_text']); ?>

                                                </button>

                                                <button wire:click="$emit('openEditVisit', <?php echo e($student['visit_id']); ?>)">
                                                    Ver detalles
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="$emit('openCreate', <?php echo e($student['tutor_students_id']); ?>)">
                                                    <span class="icon-[tabler--calendar-plus] size-6"></span>
                                                    <?php echo e($student['visit_button_text']); ?>

                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/filters/tutor-filter.blade.php ENDPATH**/ ?>