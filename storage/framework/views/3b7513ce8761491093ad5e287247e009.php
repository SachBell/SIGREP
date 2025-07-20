<?php
    if (auth()->user()->hasRole('admin')) {
        $pageTitle = 'Administrador de Tutores';
    } elseif (auth()->user()->hasRole('gestor-teacher')) {
        $pageTitle = 'Gestión Tutores';
    } elseif (auth()->user()->hasRole('tutor')) {
        $pageTitle = 'Estudiantes Asignados';
    } else {
        $pageTitle = 'Panel de Tutores';
    }
?>
<?php $__env->startSection('title', $pageTitle); ?>
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
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'tutor')): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.visits-modal')->html();
} elseif ($_instance->childHasBeenRendered('TiNYTOY')) {
    $componentId = $_instance->getRenderedChildComponentId('TiNYTOY');
    $componentTag = $_instance->getRenderedChildComponentTagName('TiNYTOY');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('TiNYTOY');
} else {
    $response = \Livewire\Livewire::mount('modals.visits-modal');
    $html = $response->html();
    $_instance->logRenderedChild('TiNYTOY', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.visit-details-modal')->html();
} elseif ($_instance->childHasBeenRendered('7eIWLcs')) {
    $componentId = $_instance->getRenderedChildComponentId('7eIWLcs');
    $componentTag = $_instance->getRenderedChildComponentTagName('7eIWLcs');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('7eIWLcs');
} else {
    $response = \Livewire\Livewire::mount('modals.visit-details-modal');
    $html = $response->html();
    $_instance->logRenderedChild('7eIWLcs', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <?php endif; ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tigth">
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                <?php echo e(__('Administrador de Tutores')); ?>

                <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'gestor-teacher')): ?>
                <?php echo e(__('Gestión Tutores')); ?>

                <?php elseif (\Illuminate\Support\Facades\Blade::check('role', 'tutor')): ?>
                <?php echo e(__('Estudiantes Asignados')); ?>

            <?php endif; ?>
        </h2>
     <?php $__env->endSlot(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('filters.tutor-filter')->html();
} elseif ($_instance->childHasBeenRendered('sKES5I8')) {
    $componentId = $_instance->getRenderedChildComponentId('sKES5I8');
    $componentTag = $_instance->getRenderedChildComponentTagName('sKES5I8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('sKES5I8');
} else {
    $response = \Livewire\Livewire::mount('filters.tutor-filter');
    $html = $response->html();
    $_instance->logRenderedChild('sKES5I8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
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
<?php /**PATH C:\laragon\www\practicasisus\resources\views/Admin/tutor-student/index.blade.php ENDPATH**/ ?>