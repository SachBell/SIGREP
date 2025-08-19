<div class="w-full flex justify-end items-center py-3 md:py-0">
    <?php if (! ($breadcrumbs->isEmpty())): ?>
        <nav class="w-full">
            <ol class="p-4 rounded flex flex-wrap text-lg text-gray-800">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($breadcrumb->url): ?>
                        <li class="inline-flex items-center gap-3">
                            <a href="<?php echo e($breadcrumb->url); ?>"
                                class="text-gray-600 hover:text-gray-700 hover:underline focus:text-gray-600 focus:transition-colors duration-300">
                                <?php if($loop->first): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                <?php else: ?>
                                    <?php echo e($breadcrumb->title); ?>

                                <?php endif; ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="text-gray-800">
                            <?php echo e($breadcrumb->title); ?>

                        </li>
                    <?php endif; ?>

                    <?php if (! ($loop->last)): ?>
                        <li class="text-gray-500 px-2">
                            /
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav>
    <?php endif; ?>
    <button type="button" class="btn btn-lg btn-text max-md:btn-square lg:hidden" aria-haspopup="dialog"
        aria-expanded="false" aria-controls="multilevel-with-separator" data-overlay="#multilevel-with-separator">
        <span class="icon-[tabler--menu-2] size-7 text-gray-800"></span>
    </button>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/vendor/breadcrumbs/tailwind.blade.php ENDPATH**/ ?>