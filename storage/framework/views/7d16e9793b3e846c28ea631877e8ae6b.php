<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body>

    <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="grid grid-cols-1 lg:grid-cols-[250px,_1fr] min-h-screen">

        <main class="lg:col-start-2 overflow-y-auto">
            <div class="w-full">
                <?php if(Breadcrumbs::exists()): ?>
                    <span class="opacity-50 breadcrumb">
                        <?php echo e(Breadcrumbs::render()); ?>

                    </span>
                <?php endif; ?>
            </div>

            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <div class="px-8 py-12">
                <div>
                    <?php echo e($slot); ?>

                </div>
            </div>
        </main>
    </div>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/layouts/app.blade.php ENDPATH**/ ?>