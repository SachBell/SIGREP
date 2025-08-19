<div class="space-y-4">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.users-modal')->html();
} elseif ($_instance->childHasBeenRendered('l306302914-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l306302914-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l306302914-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l306302914-0');
} else {
    $response = \Livewire\Livewire::mount('modals.users-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l306302914-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <div class="flex flex-col flex-wrap gap-3 sm:flex-row sm:items-center sm:justify-between" wire:ignore>
        <div class="dropdown relative inline-flex">
            <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-outline btn-secondary font-normal"
                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--clock]"></span>
                <?php echo e(__('Filtrar por rol')); ?>

                <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
            </button>
            <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-10 p-0" role="menu"
                aria-orientation="vertical" aria-labelledby="dropdown-default">
                <li>
                    <a class="dropdown-item" href="" wire:click.prevent="$set('role', '')">Todos</a>
                </li>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="dropdown-item" href=""
                            wire:click.prevent="$set('role', <?php echo \Illuminate\Support\Js::from($name)->toHtml() ?>)"><?php echo e($name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="w-full max-w-lg relative flex justify-between md:justify-normal sm:w-auto sm:max-w-none gap-5">
            <div class="relative">
                <span
                    class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                <input class="input ps-8 focus:border-blue-500" wire:model="search" type="text" role="combobox"
                    aria-expanded="false" placeholder="Buscar usuario" />
            </div>
            <div class="relative">
                <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                    <span class="icon-[tabler--apps] size-5"></span>
                    <?php echo e(__('Nuevo Usuario')); ?>

                </button>
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        <div class="overflow-auto bg-white mx-4 rounded-lg shadow">
            <?php if($users->isEmpty()): ?>
                <div class="card min-h-60 w-full">
                    <div class="card-body items-center justify-center">
                        <span class="icon-[tabler--brand-google-drive] mb-2 size-8"></span>
                        <span>No hay datos que mostrar</span>
                    </div>
                </div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Usuario</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Correo</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Role</th>
                            <th class="text-sm whitespace-nowrap font-semibold py-5">Acciones</th>
                        </tr>
                    </thead>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody class="bg-gray-50">
                            <tr>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5"><?php echo e($user->name); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5"><?php echo e($user->email); ?>

                                </th>
                                <th class="text-md normal-case font-normal whitespace-nowrap py-5">
                                    <?php switch($user->getRoleNames()->first()):
                                        case ($user->getRoleNames()->first() == 'admin'): ?>
                                            <span class="badge badge-soft badge-error">
                                                <?php echo e($user->getRoleNames()->first()); ?>

                                            </span>
                                        <?php break; ?>

                                        <?php case ($user->getRoleNames()->first() == 'gestor-teacher'): ?>
                                            <span class="badge badge-soft badge-warning">
                                                <?php echo e($user->getRoleNames()->first()); ?>

                                            </span>
                                        <?php break; ?>

                                        <?php case ($user->getRoleNames()->first() == 'tutor'): ?>
                                            <span class="badge badge-soft badge-info">
                                                <?php echo e($user->getRoleNames()->first()); ?>

                                            </span>
                                        <?php break; ?>

                                        <?php default: ?>
                                            <span class="badge badge-success badge-soft">
                                                <?php echo e($user->getRoleNames()->first()); ?>

                                            </span>
                                    <?php endswitch; ?>
                                </th>
                                <th class="flex py-5">
                                    <button onclick="Livewire.emit('openEdit', <?php echo e($user->id); ?>)"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--pencil] size-6"></span>
                                    </button>
                                    <button onclick="Livewire.emit('delete', <?php echo e($user->id); ?>)"
                                        class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                            class="icon-[tabler--trash] size-6"></span></button>
                                </th>
                            </tr>
                        </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php echo e($users->links()); ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/filters/users-filter.blade.php ENDPATH**/ ?>