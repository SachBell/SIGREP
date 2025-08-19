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
} elseif ($_instance->childHasBeenRendered('RPx3PAe')) {
    $componentId = $_instance->getRenderedChildComponentId('RPx3PAe');
    $componentTag = $_instance->getRenderedChildComponentTagName('RPx3PAe');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('RPx3PAe');
} else {
    $response = \Livewire\Livewire::mount('modals.visits-modal');
    $html = $response->html();
    $_instance->logRenderedChild('RPx3PAe', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('modals.visit-details-modal')->html();
} elseif ($_instance->childHasBeenRendered('e3uWFY5')) {
    $componentId = $_instance->getRenderedChildComponentId('e3uWFY5');
    $componentTag = $_instance->getRenderedChildComponentTagName('e3uWFY5');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e3uWFY5');
} else {
    $response = \Livewire\Livewire::mount('modals.visit-details-modal');
    $html = $response->html();
    $_instance->logRenderedChild('e3uWFY5', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
} elseif ($_instance->childHasBeenRendered('kKo8EgQ')) {
    $componentId = $_instance->getRenderedChildComponentId('kKo8EgQ');
    $componentTag = $_instance->getRenderedChildComponentTagName('kKo8EgQ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kKo8EgQ');
} else {
    $response = \Livewire\Livewire::mount('filters.tutor-filter');
    $html = $response->html();
    $_instance->logRenderedChild('kKo8EgQ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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