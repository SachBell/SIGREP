<div class="w-full grid md:grid-cols-2 lg:grid-cols-3 place-items-center md:justify-center gap-8">
    <?php $__currentLoopData = $appCalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
            class="card w-full sm:max-w-md py-12 px-5 hover:shadow-lg transition duration-300 <?php if($call->status === 'Activo'): ?> bg-green-50 <?php elseif($call->status === 'Finalizado'): ?> bg-red-50 <?php endif; ?>">
            <div class="relative">
                <div
                    class="absolute top-0 left-0 h-full w-1 rounded-l-full
                    <?php if($call->status === 'Activo'): ?> bg-green-400
                    <?php elseif($call->status === 'Finalizado'): ?> bg-red-400 <?php endif; ?>">
                </div>
            </div>
            <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', ['admin', 'gestor-teacher'])): ?>
                <div class="absolute right-2 top-2">
                    <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                        <button id="dropdown-scrollable" type="button"
                            class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 size-10"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            <div class="indicator">
                                <span class="icon-[tabler--dots-vertical] text-base-content size-6"></span>
                            </div>
                        </button>
                        <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                            aria-orientation="horizontal" aria-labelledby="dropdown-scrollable">
                            <div class="overflow-auto text-base-content/80 max-h-56 max-md:max-w-30">
                                <div class="flex flex-col">
                                    <button onclick="Livewire.emit('openEdit', <?php echo e($call->id); ?>)"
                                        class="dropdown-item inline-flex items-center gap-2">
                                        <span class="icon-[tabler--pencil] size-5"></span>
                                        <?php echo e(__('Editar')); ?>

                                    </button>
                                    <form class="dropdown-item" action="<?php echo e(route('app-calls.destroy', $call->id)); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="inline-flex items-center gap-2">
                                            <span class="icon-[tabler--trash] size-5"></span>
                                            <?php echo e(__('Elimar')); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="flex justify-center">
                <figure
                    class="max-w-fit inline-flex mb-2 p-3 rounded-full <?php if($call->status === 'Activo'): ?> bg-green-100 <?php elseif($call->status === 'Finalizado'): ?> bg-red-100 <?php else: ?> bg-gray-100 <?php endif; ?>">
                    <span
                        class="icon-[tabler--speakerphone] size-16 <?php if($call->status === 'Activo'): ?> text-green-500/50 <?php elseif($call->status === 'Finalizado'): ?> text-red-600/70 <?php else: ?> text-gray-600 <?php endif; ?>"></span>
                </figure>
            </div>
            <div class="flex justify-end mb-4">
                <span
                    class="badge badge-default <?php if($call->status === 'Activo'): ?> badge-success bg-green-600 <?php else: ?> badge-error <?php endif; ?>">
                    <span class="icon-[tabler--circle-check-filled] size-4"></span>
                    <?php if($call->status === 'Activo'): ?>
                        <?php echo e(__('Activo')); ?>

                    <?php else: ?>
                        <?php echo e(__('Finalizado')); ?>

                    <?php endif; ?>
                </span>
            </div>
            <hr class="mb-2 border-gray-300/50">
            <div class="card-body">
                <h5 class="card-title text-lg font-semibold mb-5">
                    <?php echo e($call->name); ?>

                </h5>
                <div class="flex flex-col mb-5 gap-4">
                    <div class="flex justify-between gap-8 mb-5">
                        <div class="inline-flex items-center gap-4">
                            <span class="icon-[tabler--calendar-plus] size-6"></span>
                            <span class="font-medium"><?php echo e($call->start_date); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-4">
                            <span class="icon-[tabler--calendar-minus] size-6"></span>
                            <span class="font-medium"><?php echo e($call->end_date); ?></span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-start gap-3">
                        <div class="inline-flex items-center gap-4">
                            <span class="icon-[tabler--school] size-6"></span>
                            <span class="font-medium"><?php echo e($call->career->name); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-4">
                            <span class="icon-[tabler--users] size-6"></span>
                            <span class="font-medium">Registros: <?php echo e($registrationCounts[$call->id] ?? 0); ?> <span>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'student')): ?>
                <div class="card-footer">
                    <?php if($call->status == 'Activo'): ?>
                        <?php
                            $alreadyApplied =
                                auth()->user()->userData &&
                                auth()
                                    ->user()
                                    ->userData->applicationDetails->where('application_calls_id', $call->id)
                                    ->exists();
                        ?>

                        <button wire:click="$emit('openApplicationModal', <?php echo e($call->id); ?>)"
                            class="w-full py-3 h-auto btn btn-primary" <?php if($alreadyApplied): ?> disabled <?php endif; ?>>
                            <?php if($alreadyApplied): ?>
                                Ya postulado
                            <?php else: ?>
                                Postularme
                            <?php endif; ?>
                        </button>
                    <?php else: ?>
                        <button class="w-full py-3 h-auto btn btn-primary" disabled>
                            Postularme
                        </button>
                    <?php endif; ?>
                </div>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.application-modal')->html();
} elseif ($_instance->childHasBeenRendered('l3777865490-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3777865490-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3777865490-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3777865490-0');
} else {
    $response = \Livewire\Livewire::mount('modals.application-modal');
    $html = $response->html();
    $_instance->logRenderedChild('l3777865490-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/call-card.blade.php ENDPATH**/ ?>