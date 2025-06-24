<?php $__env->startSection('title', 'Inicio'); ?>
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
            <?php echo e(__('Bienvenido de nuevo ' . auth()->user()->name)); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="flex">
        <div class="stats w-full bg-slate-100/50 max-xl:stats-vertical mx-auto">
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                <div class="stat py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users-group] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600"><?php echo e(Auth::user()->count()); ?></div>
                    <div class="stat-title font-medium text-lg">Número de Usuarios</div>
                    <div class="stat-desc">Total de usuarios registrados</div>
                </div>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', ['admin', 'gestor-teacher'])): ?>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--building] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600"><?php echo e($convenant); ?></div>
                    <div class="stat-title font-medium text-lg">Convenios Activos</div>
                    <div class="stat-desc">Total de convenios activos</div>
                </div>

                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600"><?php echo e($posts); ?></div>
                    <div class="stat-title font-medium text-lg">Postulaciones</div>
                    <div class="stat-desc">Total de postulaciones</div>
                </div>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'gestor-teacher')): ?>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">4</div>
                    <div class="stat-title font-medium text-lg">Solicitudes</div>
                    <div class="stat-desc">Total de solicitudes</div>
                </div>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'tutor')): ?>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600"><?php echo e($count ?? 0); ?></div>
                    <div class="stat-title font-medium text-lg">Estudiantes</div>
                    <div class="stat-desc">Total de estudiantes a cargo</div>
                </div>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--users] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">4</div>
                    <div class="stat-title font-medium text-lg">Solicitudes</div>
                    <div class="stat-desc">Total de solicitudes</div>
                </div>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                <div class="stat items-center py-12">
                    <div class="stat-figure text-base-content/75 flex p-2 bg-slate-300/20 rounded-full">
                        <span class="icon-[tabler--building] size-9"></span>
                    </div>
                    <div class="stat-value text-blue-600">12</div>
                    <div class="stat-title font-medium text-lg">Tickets Activos</div>
                    <div class="stat-desc">Total de tickets activos</div>
                </div>
            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\practicasisus\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>