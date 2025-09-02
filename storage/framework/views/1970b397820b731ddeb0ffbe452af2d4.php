<?php $__env->startSection('title', 'Configuración'); ?>
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
            <?php echo e(__('Configuraciones Generales')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="h-full p-4 sm:p-8">
            <div class="flex flex-col lg:flex-row gap-5">
                <nav class="tabs tabs-bordered lg:tabs-vertical" aria-label="Tabs" role="tablist" data-tabs-vertical="false"
                    aria-orientation="horzontal">
                    <button type="button" class="tab active-tab:tab-active active" id="tabs-horizontal-item-1"
                        data-tab="#tabs-horizontal-1" aria-controls="tabs-horizontal-1" role="tab" aria-selected="true">
                        <span class="icon-[tabler--settings] size-5 me-2"></span>
                        <span class="font-medium">General</span>
                    </button>
                    <button type="button" class="tab active-tab:tab-active" id="tabs-horizontal-item-2"
                        data-tab="#tabs-horizontal-2" aria-controls="tabs-horizontal-2" role="tab"
                        aria-selected="false">
                        <span class="icon-[tabler--mail] size-5 me-2"></span>
                        <span class="font-medium">Correos</span>
                    </button>
                </nav>

                <div class="lg:ms-3 w-full">
                    <div id="tabs-horizontal-1" role="tabpanel" aria-labelledby="tabs-horizontal-item-1">
                        <?php echo $__env->make('Admin.settings.partials.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div id="tabs-horizontal-2" class="hidden" role="tabpanel" aria-labelledby="tabs-horizontal-item-2">
                        <?php echo $__env->make('Admin.settings.partials.emails', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
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
<?php /**PATH C:\laragon\www\practicasisus\resources\views/Admin/settings/index.blade.php ENDPATH**/ ?>