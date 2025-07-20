<?php
    $templates = \App\Models\EmailTemplate::all()->keyBy('key');
?>

<div class="space-y-6">
    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form method="POST" action="<?php echo e(route('settings.emailsUpdate')); ?>"
            class="max-w-4xl bg-white border rounded shadow-md p-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="hidden" name="key" value="<?php echo e($template->key); ?>">

            <h2 class="text-lg font-semibold mb-2">
                <?php if($key === 'tutor_assignment_student'): ?>
                    Asignación de Tutor - Estudiante
                <?php elseif($key === 'tutor_assignment_teacher'): ?>
                    Asignación de Tutor - Docente
                <?php elseif($key === 'visit_assignment'): ?>
                    Asignación de Visita
                <?php elseif($key === 'call_opening'): ?>
                    Aviso de Apertura de Convocatoria
                <?php endif; ?>
            </h2>
            <p class="text-sm text-slate-500 mb-4">
                <?php echo e($template->description); ?>

            </p>

            <div class="mb-4">
                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'subject_'.e($template->key).'','value' => 'Asunto del correo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'subject_'.e($template->key).'','value' => 'Asunto del correo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'subject_'.e($template->key).'','name' => 'subject','type' => 'text','class' => 'mt-1 block w-full','value' => ''.e(old('subject', $template->subject)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'subject_'.e($template->key).'','name' => 'subject','type' => 'text','class' => 'mt-1 block w-full','value' => ''.e(old('subject', $template->subject)).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
            </div>

            <div class="mb-4">
                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'body_'.e($template->key).'','value' => 'Cuerpo del correo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'body_'.e($template->key).'','value' => 'Cuerpo del correo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                <textarea id="body_<?php echo e($template->key); ?>" name="body" rows="4"
                    class="textarea w-full border border-gray-300 rounded p-2 shadow-sm focus:border-blue-700 focus:ring-blue-600"><?php echo e(old('body', $template->body)); ?></textarea>

                <p class="text-xs text-slate-400 mt-1">
                    Variables disponibles:
                    <?php if($key === 'tutor_assignment_student'): ?>
                        <code>{student_name}</code>, <code>{tutor_name}</code>, <code>{career}</code>
                    <?php elseif($key === 'tutor_assignment_teacher'): ?>
                        <code>{tutor_name}</code>, <code>{students_list}</code>
                    <?php elseif($key === 'visit_assignment'): ?>
                        <code>{student_name}</code>, <code>{visit_number}</code>, <code>{visit_date}</code>,
                        <code>{visit_time}</code>
                    <?php elseif($key === 'call_opening'): ?>
                        <code>{student_name}</code>, <code>{call_title}</code>, <code>{deadline}</code>
                    <?php endif; ?>
                </p>
            </div>

            <div class="text-end">
                <?php if(session()->has('success_' . $template->key)): ?>
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-2"
                        style="display: none;">
                        <span class="text-sm text-green-600"><?php echo e(session('success_' . $template->key)); ?></span>
                    </div>
                <?php endif; ?>
                <button type="submit"
                    class="btn btn-md h-auto py-1.5 bg-blue-800 text-white border border-none hover:bg-blue-900">
                    Guardar
                </button>
            </div>
        </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/Admin/settings/partials/emails.blade.php ENDPATH**/ ?>