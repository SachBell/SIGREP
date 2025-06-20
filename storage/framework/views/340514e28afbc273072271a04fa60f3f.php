<div x-data="{ show: <?php if ((object) ('isOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('isOpen'->value()); ?>')<?php echo e('isOpen'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('isOpen'); ?>')<?php endif; ?>.defer }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 my-0" style="display: none;">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl p-6 space-y-4 max-h-[100vh] overflow-y-auto">
        <h2 class="text-xl font-semibold">
            <?php echo e($entityID ? 'Editar asignación de estudiantes' : 'Asignar estudiantes'); ?>

        </h2>

        <?php if($entityID && $model): ?>
            <div class="bg-blue-50 p-3 rounded-md mb-4">
                <p class="font-medium">Docente:</p>
                <p><?php echo e($model->name); ?></p>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                    <p class="text-sm text-gray-600">Carrera: <?php echo e($model->career->name ?? 'Sin carrera asignada'); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-4">
            <div class="text-sm text-gray-500">
                Mostrando <?php echo e($students->count()); ?> estudiantes
                <?php if(auth()->user()->hasRole('gestor-teacher')): ?>
                    (de su carrera)
                <?php endif; ?>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="selectAll" class="checkbox checkbox-sm" wire:model="selectAll">
                <label for="selectAll">Seleccionar todos</label>
            </div>
        </div>

        <form wire:submit.prevent="save">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border rounded-md">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2"></th>
                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                <th class="px-4 py-2">Carrera</th>
                            <?php endif; ?>
                            <th class="px-4 py-2">Cédula</th>
                            <th class="px-4 py-2">Nombres y Apellidos</th>
                            <th class="px-4 py-2">Semestre</th>
                            <th class="px-4 py-2">Paralelo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <input type="checkbox" class="checkbox checkbox-sm" wire:model="selectedStudents"
                                        value="<?php echo e($student->id); ?>">
                                </td>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                    <td class="px-4 py-2">
                                        <?php echo e($student->userData->careers->name ?? 'Sin carrera'); ?>

                                    </td>
                                <?php endif; ?>
                                <td class="px-4 py-2">
                                    <?php echo e($student->id_card); ?>

                                </td>
                                <td class="px-4 py-2">
                                    <?php echo e($student->name); ?> <?php echo e($student->lastnames); ?>

                                </td>
                                <td class="px-4 py-2">
                                    <?php echo e($student->userData->semesters->semester ?? 'Sin semestre'); ?>

                                </td>
                                <td class="px-4 py-2">
                                    <?php echo e($student->userData->grades->grade ?? 'Sin grado'); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                                    No hay estudiantes disponibles para asignar
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($errors->any()): ?>
                <div class="mt-4 bg-red-50 text-red-700 p-3 rounded-md">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="flex justify-end gap-2 mt-4">
                <button wire:click="closeModal" type="button" class="btn btn-outline">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    <?php if($this->shouldDisableSaveButton): echo 'disabled'; endif; ?>>
                    <span wire:loading.class="hidden">
                        <?php echo e(__('Guardar Asignaciones')); ?>

                    </span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisusGlobal\resources\views/livewire/tutor/assign-students-modal.blade.php ENDPATH**/ ?>