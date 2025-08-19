<div class="space-y-4">
    <div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.posts-modal')->html();
} elseif ($_instance->childHasBeenRendered('l3692960448-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3692960448-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3692960448-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3692960448-0');
} else {
    $response = \Livewire\Livewire::mount('modals.posts-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l3692960448-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.final-grade-modal')->html();
} elseif ($_instance->childHasBeenRendered('l3692960448-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3692960448-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3692960448-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3692960448-1');
} else {
    $response = \Livewire\Livewire::mount('modals.final-grade-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l3692960448-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
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
                    <a class="dropdown-item" href="">Todos</a>
                </li>
            </ul>
        </div>
        <div class="w-full max-w-lg relative flex justify-between md:justify-normal sm:w-auto sm:max-w-none gap-5">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input ps-8 focus:border-blue-500" wire:model="search" type="text" role="combobox"
                    aria-expanded="false" placeholder="Buscar registro" />
            </div>
            <div class="relative">
                <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                    <span class="icon-[tabler--apps] size-5"></span>
                    <?php echo e(__('Nuevo Registro')); ?>

                </button>
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        <?php if($appDetail->isEmpty()): ?>
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
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Estado</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Nombres Y Apellidos</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Cédula</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Teléfono</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Domicilio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Sector/Barrio</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Carrera</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Semestre</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Paralelo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Jornada</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Perido de Postulación</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Entidad Receptora</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Dirección</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Fecha de postulación</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        <?php $__currentLoopData = $appDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php switch($detail->status_individual):
                                        case ('En Progreso'): ?>
                                            <span class="badge badge-soft badge-warning"><?php echo e($detail->status_individual); ?></span>
                                        <?php break; ?>

                                        <?php case ('Finalizado'): ?>
                                            <span class="badge badge-soft badge-success"><?php echo e($detail->status_individual); ?></span>
                                        <?php break; ?>

                                        <?php default: ?>
                                            <span class="badge badge-soft badge-default">Sin Estado</span>
                                    <?php endswitch; ?>
                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e(($detail->userData->profiles->name ?? 'N/A') . ' ' . ($detail->userData->profiles->lastnames ?? 'N/A')); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->id_card ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->phone_number ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->address ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->neighborhood ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->careers->name ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->semesters->semester ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->grades->grade ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->daytrip ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->applicationCalls->name ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->receivingEntities->name ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->receivingEntities->address ?? 'N/A'); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->created_at); ?>

                                </th>
                                <th class="flex py-5">
                                    <button onclick="Livewire.emit('openEdit', <?php echo e($detail->id); ?>)"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--pencil] size-6"></span>
                                    </button>
                                    <button onclick="Livewire.emit('delete', <?php echo e($detail->id); ?>)" type="button"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--trash] size-6"></span></button>
                                    <?php if($detail->status_individual != 'Finalizado'): ?>
                                        <button
                                            wire:click="$emit('openFinalGradeModal', <?php echo e($detail->tutorStudent?->id ?? 'null'); ?>)"
                                            type="button" class="btn btn-circle btn-text btn-sm"
                                            aria-label="Action button">
                                            <span class="icon-[tabler--book] size-6"></span>
                                        </button>
                                    <?php endif; ?>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($appDetail->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/filters/posts-filter.blade.php ENDPATH**/ ?>