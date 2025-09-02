<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false]); ?>
<?php foreach (array_filter((['disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<select <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge([
    'class' => 'select py-2 px-3 h-auto border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm transition',
]); ?>>
    <?php echo e($slot); ?>

</select>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/components/select-input.blade.php ENDPATH**/ ?>