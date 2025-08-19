<?php $__env->startSection('title', 'Convocatorias'); ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            <?php echo e(__('Convocatorias para Practicas Preprofesionles')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.call-modal')->html();
} elseif ($_instance->childHasBeenRendered('mrCyFXc')) {
    $componentId = $_instance->getRenderedChildComponentId('mrCyFXc');
    $componentTag = $_instance->getRenderedChildComponentTagName('mrCyFXc');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mrCyFXc');
} else {
    $response = \Livewire\Livewire::mount('modals.call-modal');
    $html = $response->html();
    $_instance->logRenderedChild('mrCyFXc', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <div class="flex flex-col gap-8">
        <div class="flex justify-end">
            <button onclick="Livewire.emit('openCreate')" class="btn btn-primary bg-blue-800 hover:bg-blue-900">
                <span class="icon-[tabler--apps] size-5"></span>
                <?php echo e(__('Nueva Convocatoria')); ?>

            </button>
        </div>
        <div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filters.call-card-filter')->html();
} elseif ($_instance->childHasBeenRendered('fKpJwM6')) {
    $componentId = $_instance->getRenderedChildComponentId('fKpJwM6');
    $componentTag = $_instance->getRenderedChildComponentTagName('fKpJwM6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fKpJwM6');
} else {
    $response = \Livewire\Livewire::mount('filters.call-card-filter');
    $html = $response->html();
    $_instance->logRenderedChild('fKpJwM6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/admin/app-calls/index.blade.php ENDPATH**/ ?>