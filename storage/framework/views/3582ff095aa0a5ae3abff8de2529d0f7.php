<?php $__env->startSection('title', 'Mi Progreso'); ?>
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
            <?php echo e(__('Mi Progreso')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-6xl mx-auto p-6">

        
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">Información General</h2>
            <p><strong>Estudiante:</strong> <?php echo e($user->name . ' ' . $user->lastnames ?? 'N/A'); ?></p>
            <p><strong>Carrera:</strong> <?php echo e($user->userData->careers->name ?? 'N/A'); ?></p>
            <p><strong>Período:</strong> <?php echo e($currentPeriod->name ?? 'No asignado'); ?></p>
        </div>

        
        <?php if($application): ?>
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Estado Actual</h2>
                <p><strong>Institución:</strong> <?php echo e($application->receivingEntities->name ?? 'N/A'); ?></p>
                <p><strong>Estado:</strong>
                    <span
                        class="inline-block px-2 py-1 text-sm rounded-full
                        <?php echo e($application->status_individual === 'Finalizado' ? 'bg-green-100 text-green-800' : ($application->status_individual === 'En Progreso' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')); ?>">
                        <?php echo e($application->status_individual); ?>

                    </span>
                </p>
            </div>
            
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Documentos</h2>
                <ul class="list-disc pl-6">
                    <li>
                        <a href="https://tecnologicosucre.edu.ec/web/practicas-pre-profesionales/" target="blank"
                            class="text-blue-600 hover:underline">
                            <?php echo e(__('Formatos para descargar')); ?>

                        </a>
                    </li>
                </ul>
            </div>

            
            <?php if($finalGrade): ?>
                <div class="bg-white shadow rounded-xl p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-2">Calificación Final</h2>
                    <p class="text-2xl font-bold text-green-600"><?php echo e($finalGrade->score); ?>/100</p>
                    <p class="text-gray-700">Observaciones: <?php echo e($finalGrade->comment ?? 'Ninguna'); ?></p>
                </div>
            <?php endif; ?>

            
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4">Línea de Tiempo</h2>
                <ol class="relative border-l border-gray-200">
                    <?php $__currentLoopData = $timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute w-3 h-3 bg-blue-500 rounded-full -left-1.5 border border-white"></span>
                            <h3 class="text-lg font-semibold text-gray-900"><?php echo e($item['title']); ?></h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                                <?php echo e(\Carbon\Carbon::parse($item['date'])->format('d/m/Y')); ?>

                            </time>
                            <p class="mb-4 text-base font-normal text-gray-600"><?php echo e($item['description']); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        <?php else: ?>
            <div class="bg-white shadow rounded-xl p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Estado Actual</h2>
                <p class="text-gray-500">Aún no te has registrado en una institución.</p>
            </div>
        <?php endif; ?>
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
<?php /**PATH C:\laragon\www\practicasisus\resources\views/dashboard/my-progres/index.blade.php ENDPATH**/ ?>