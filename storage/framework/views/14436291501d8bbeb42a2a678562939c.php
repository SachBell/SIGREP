<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | SIGREP</title>
    <script src="https://kit.fontawesome.com/be6056a694.js" crossOrigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body>
    
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        <div class="px-4">
            <img src="<?php echo e(asset('img/logo.png')); ?>" alt="logo.png" class="w-50 h-50 fill-current bg-white rounded"
                width="450px">
        </div>

        <main class="w-full sm:max-w-md mt-6 px-9 py-7 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <?php echo e($slot); ?>

        </main>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/layouts/guest.blade.php ENDPATH**/ ?>