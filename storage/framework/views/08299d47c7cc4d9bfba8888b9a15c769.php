<div class="space-y-4">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('posts-modal')->html();
} elseif ($_instance->childHasBeenRendered('l2892552842-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2892552842-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2892552842-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2892552842-0');
} else {
    $response = \Livewire\Livewire::mount('posts-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l2892552842-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
                                    <?php echo e($detail->userData->profiles->name . ' ' . $detail->userData->profiles->lastnames); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->id_card); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->phone_number); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->address); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->profiles->neighborhood); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->careers->name); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->semesters->semester); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->grades->grade); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->userData->daytrip); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php echo e($detail->applicationCalls->name); ?>

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
                                    <form class="delete-form"
                                        action="<?php echo e(route('student-posts.destroy', $detail->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-circle btn-text btn-sm"
                                            aria-label="Action button"><span
                                                class="icon-[tabler--trash] size-6"></span></button>
                                    </form>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/posts-filter.blade.php ENDPATH**/ ?>