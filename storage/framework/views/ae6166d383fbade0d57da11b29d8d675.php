<div x-data="{ show: <?php if ((object) ('isOpen') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('isOpen'->value()); ?>')<?php echo e('isOpen'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('isOpen'); ?>')<?php endif; ?> }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex justify-center items-center bg-black/50"
    style="display: none;">

    <div class="container">
        <div class="max-w-lg h-full mx-auto bg-white rounded-box p-6">
            <h2 class="text-xl font-medium mb-5 text-gray-800">Insersión Masiva de Usuarios</h2>

            <!-- Tabs FlyonUI -->
            <nav wire:ignore class="tab tabs-bordered" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="tab active-tab:tab-active active" id="tabs-basic-item-1"
                    data-tab="#tabs-basic-1" aria-controls="tabs-basic-1" role="tab" aria-selected="true">
                    <span class="icon-[tabler--users] size-5 mr-2"></span>
                    <span class="font-medium">Estudiantes</span>
                </button>
                <button type="button" class="tab active-tab:tab-active" id="tabs-basic-item-2" data-tab="#tabs-basic-2"
                    aria-controls="tabs-basic-2" role="tab" aria-selected="false">
                    <span class="icon-[tabler--school] size-5 mr-2"></span>
                    <span class="font-medium">Docentes</span>
                </button>
            </nav>

            <div class="mt-4">
                <!-- Tab estudiantes -->
                <div id="tabs-basic-1" role="tabpanel" aria-labelledby="tabs-basic-item-1" wire:ignore.self>
                    <form wire:submit.prevent="save('student')" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="upload-container">
                            <div
                                class="custom-upload bg-base-200/60 rounded-box flex flex-col justify-center border-2 border-dashed border-base-content/20">
                                <div class="drop-area text-center cursor-pointer p-8 mt-5">
                                    <input type="file" wire:model="file" class="hidden file-input" />
                                    <p class="text-base-content/50 mb-3 text-sm">Sube un archivo (máx 2MB).</p>
                                    <span class="badge badge-soft badge-sm py-2 h-auto badge-primary text-nowrap">
                                        <span class="icon-[tabler--file-upload] size-4 shrink-0"></span>
                                        Arrastra o suelta aquí
                                    </span>
                                    <p class="text-base-content/50 my-2 text-xs">o</p>
                                    <p class="link link-animated link-primary font-medium text-sm cursor-pointer">Buscar
                                        archivo</p>
                                    <div class="preview-list mx-8 mb-6 space-y-2 empty:m-0" wire:ignore></div>
                                </div>
                            </div>
                            <div class="upload-error-container mt-3">
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-soft alert-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="w-full mt-4 inline-flex justify-end gap-4">
                                <button type="button" wire:loading.attr="disabled" wire:click="closeModal"
                                    class="btn btn-sm">
                                    <span wire:loading.remove>Cancelar</span>
                                    <span wire:loading>Cancelar</span>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
                                    class="btn btn-sm btn-primary bg-blue-700 hover:bg-blue-800">
                                    <span wire:loading.remove>Enviar</span>
                                    <span wire:loading>Procesando...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tab docentes -->
                <div id="tabs-basic-2" role="tabpanel" aria-labelledby="tabs-basic-item-2" class="hidden"
                    wire:ignore.self>
                    <form wire:submit.prevent="save('teacher')" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="upload-container">
                            <div
                                class="custom-upload bg-base-200/60 rounded-box flex flex-col justify-center border-2 border-dashed border-base-content/20">
                                <div class="drop-area text-center cursor-pointer p-8 mt-5">
                                    <input type="file" wire:model="file" class="hidden file-input" />
                                    <p class="text-base-content/50 mb-3 text-sm">Sube un archivo (máx 2MB).</p>
                                    <span class="badge badge-soft badge-sm py-2 h-auto badge-primary text-nowrap">
                                        <span class="icon-[tabler--file-upload] size-4 shrink-0"></span>
                                        Arrastra o suelta aquí
                                    </span>
                                    <p class="text-base-content/50 my-2 text-xs">o</p>
                                    <p class="link link-animated link-primary font-medium text-sm cursor-pointer">Buscar
                                        archivo</p>
                                    <div class="preview-list mx-8 mb-6 space-y-2 empty:m-0" wire:ignore></div>
                                </div>
                            </div>
                            <div class="upload-error-container mt-3">
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-soft alert-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="w-full mt-4 inline-flex justify-end gap-4">
                                <button type="button" wire:loading.attr="disabled" wire:click="closeModal"
                                    class="btn btn-sm">
                                    <span wire:loading.remove>Cancelar</span>
                                    <span wire:loading>Cancelar</span>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
                                    class="btn btn-sm btn-primary bg-blue-700 hover:bg-blue-800">
                                    <span wire:loading.remove>Enviar</span>
                                    <span wire:loading>Procesando...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Template de preview -->
        <template id="preview-template">
            <div class="rounded-box bg-base-100 shadow-lg p-3 flex flex-col gap-2 mt-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 flex items-center justify-center border rounded-lg bg-base-200 text-sm">📄
                        </div>
                        <div>
                            <p class="text-sm font-medium truncate w-48 overflow-hidden" data-file-name></p>
                            <p class="text-xs text-base-content/50" data-file-size></p>
                            <p class="hidden text-error text-xs" data-file-error>Archivo demasiado grande.</p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-circle btn-text" wire:loading.attr="disabled"
                        data-remove>
                        <span wire:loading.remove>&times;</span>
                        <span wire:loading>&times;</span>
                    </button>
                </div>
            </div>
        </template>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll(".drop-area").forEach(dropArea => {
                    const fileInput = dropArea.querySelector(".file-input");
                    const previewList = dropArea.querySelector(".preview-list");
                    const template = document.getElementById("preview-template").content;

                    // Click para abrir selector
                    dropArea.addEventListener("click", e => {
                        if (e.target.closest("[data-remove]") || e.target.closest(".preview-list"))
                            return;
                        fileInput.click();
                    });

                    // Drag & drop
                    dropArea.addEventListener("dragover", e => {
                        e.preventDefault();
                        dropArea.classList.add("border-primary");
                    });

                    dropArea.addEventListener("dragleave", () => dropArea.classList.remove("border-primary"));

                    dropArea.addEventListener("drop", e => {
                        e.preventDefault();
                        dropArea.classList.remove("border-primary");
                        if (!e.dataTransfer.files || !e.dataTransfer.files.length) return;


                        fileInput.files = e.dataTransfer.files;

                        const event = new Event('change', {
                            bubbles: true
                        });
                        fileInput.dispatchEvent(event);

                        renderPreview(fileInput.files[0]);
                    });

                    // Cambio en input
                    fileInput.addEventListener("change", () => {
                        if (!fileInput.files || !fileInput.files.length) return;
                        renderPreview(fileInput.files[0]);
                    });

                    function renderPreview(file) {
                        previewList.innerHTML = "";
                        const frag = template.cloneNode(true);
                        const node = frag.firstElementChild;

                        node.querySelector("[data-file-name]").textContent = file.name;
                        node.querySelector("[data-file-size]").textContent = (file.size / 1024).toFixed(1) +
                            " KB";

                        node.querySelector("[data-remove]").addEventListener("click", () => {
                            fileInput.value = "";
                            previewList.innerHTML = "";
                        });

                        previewList.appendChild(node);
                    }
                });

                document.addEventListener('reset-file-previews', () => {
                    document.querySelectorAll('.preview-list').forEach(el => {
                        el.innerHTML = '';
                    });
                });

                document.addEventListener('reset-tabs', () => {
                    const btnStudents = document.querySelector('#tabs-basic-item-1');
                    if (btnStudents) btnStudents.click();
                });
            });
        </script>
    </div>
</div>
<?php /**PATH C:\laragon\www\practicasisus\resources\views/livewire/modals/file-modal.blade.php ENDPATH**/ ?>