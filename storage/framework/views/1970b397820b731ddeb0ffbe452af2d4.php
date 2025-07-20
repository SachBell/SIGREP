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
            <div class="flex">
                <nav class="tabs tabs-bordered tabs-vertical" aria-label="Tabs" role="tablist" data-tabs-vertical="true"
                    aria-orientation="horizontal">
                    <button type="button" class="tab active-tab:tab-active" id="tabs-vertical-item-1"
                        data-tab="#tabs-vertical-1" aria-controls="tabs-vertical-1" role="tab" aria-selected="true">
                        Home
                    </button>
                    <button type="button" class="tab active-tab:tab-active active" id="tabs-vertical-item-2"
                        data-tab="#tabs-vertical-2" aria-controls="tabs-vertical-2" role="tab"
                        aria-selected="false">
                        Profile
                    </button>
                    <button type="button" class="tab active-tab:tab-active " id="tabs-vertical-item-3"
                        data-tab="#tabs-vertical-3" aria-controls="tabs-vertical-3" role="tab"
                        aria-selected="false">
                        Messages
                    </button>
                    <button type="button" class="tab active-tab:tab-active " id="tabs-vertical-item-3"
                        data-tab="#tabs-vertical-4" aria-controls="tabs-vertical-3" role="tab"
                        aria-selected="false">
                        Messages
                    </button>
                </nav>

                <div class="ms-3 w-full">
                    <div id="tabs-vertical-1" class="hidden" role="tabpanel" aria-labelledby="tabs-vertical-item-1">
                        <?php echo $__env->make('Admin.settings.partials.convenants', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div id="tabs-vertical-2" role="tabpanel" aria-labelledby="tabs-vertical-item-2">
                        <?php echo $__env->make('Admin.settings.partials.emails', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div id="tabs-vertical-3" class="hidden" role="tabpanel" aria-labelledby="tabs-vertical-item-3">
                        <p class="text-base-content/80"> <span class="text-base-content font-semibold">Messages:</span>
                            View your recent messages,
                            chat with friends, and manage your conversations. </p>
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