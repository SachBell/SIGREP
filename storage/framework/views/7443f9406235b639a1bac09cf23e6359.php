<div class="space-y-4">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.convenant-modal')->html();
} elseif ($_instance->childHasBeenRendered('l3696958475-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3696958475-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3696958475-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3696958475-0');
} else {
    $response = \Livewire\Livewire::mount('modals.convenant-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l3696958475-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <div class="flex flex-col flex-wrap gap-3 sm:flex-row sm:items-center sm:justify-between" wire:ignore>
        <div class="dropdown relative inline-flex">
            <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-outline btn-secondary font-normal"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--clock]"></span>
                <?php echo e(__('Filtrar por estado')); ?>

                <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-10 p-0" role="menu"
                aria-orientation="vertical" aria-labelledby="dropdown-default">
                <li>
                    <a class="dropdown-item" href="" wire:click.prevent="$set('career', '')">Todos</a>
                </li>
                <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a wire:click.prevent="$set('career', <?php echo e($id); ?>)" class="dropdown-item"
                            href=""><?php echo e($name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="w-full max-w-lg relative flex justify-between md:justify-normal sm:w-auto sm:max-w-none gap-5">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input ps-8 focus:border-blue-500" wire:model="search" type="text" role="combobox"
                    aria-expanded="false" placeholder="Buscar convenio" />
            </div>
            <div class="relative">
                <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                    <span class="icon-[tabler--apps] size-5"></span>
                    <?php echo e(__('Nuevo Convenio')); ?>

                </button>
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        <?php if($convenants->isEmpty()): ?>
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
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Nombre</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Limite de Estudiantes</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Sector Productivo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Director</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Cédula</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Teléfono</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Inicio del Convenio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Fin del Convenio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Observaciones</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        <?php $__currentLoopData = $convenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $convenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                    <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                        <?php echo e($convenant->careers->first()->name); ?>

                                    </th>
                                <?php endif; ?>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->name); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->address); ?>

                                </th>
                                <th class="text-md normal-case text-center font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->user_limit); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->productive_sector); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->principalData->name . ' ' . $convenant->principalData->lastname); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->principalData->id_card); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->principalData->email); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->principalData->phone_number); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->convenant_start_date); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($convenant->convenant_end_date); ?>

                                </th>
                                <th
                                    class="text-md normal-case font-normal whitespace-nowrap max-w-[450px] text-ellipsis overflow-hidden py-5">
                                    <?php echo e($convenant->observations ?: 'N/A'); ?>

                                </th>
                                <th class="flex py-5">
                                    <button onclick="Livewire.emit('openEdit', <?php echo e($convenant->id); ?>)"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--pencil] size-6"></span>
                                    </button>
                                    <button onclick="Livewire.emit('delete', <?php echo e($convenant->id); ?>)" type="button"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--trash] size-6"></span></button>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($convenants->links()); ?>

        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/filters/convenant-filter.blade.php ENDPATH**/ ?>