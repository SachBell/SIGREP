<div x-data="{ show: @entangle('isOpen') }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
<<<<<<< HEAD
    x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    style="display: none;">

    <div class="container">
        <div class="h-full max-w-lg p-6 mx-auto bg-white rounded-box">
            <h2 class="mb-5 text-xl font-medium text-gray-800">Insersión Masiva de Usuarios</h2>

            <nav wire:ignore class="tab tabs-bordered" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button"
                    class="tab active-tab:tab-active {{ request()->routeIs('manage-users.index') ? 'active' : 'hidden' }}"
                    id="tabs-basic-item-1" data-tab="#tabs-basic-1" aria-controls="tabs-basic-1"
                    aria-selected="{{ request()->routeIs('manage-users.index') ? 'true' : 'false' }}">
                    <span class="icon-[tabler--users] size-5 mr-2"></span>
                    <span class="font-medium">Estudiantes</span>
                </button>
                <button type="button"
                    class="tab active-tab:tab-active {{ request()->routeIs('manage-users.index') ? '' : 'hidden' }}"
                    id="tabs-basic-item-2" data-tab="#tabs-basic-2" aria-controls="tabs-basic-2"
                    aria-selected="{{ request()->routeIs('manage-users.index') ? 'true' : 'false' }}">
                    <span class="icon-[tabler--school] size-5 mr-2"></span>
                    <span class="font-medium">Docentes</span>
                </button>
                <button type="button"
                    class="tab active-tab:tab-active active {{ request()->routeIs('convenants.index') ? '' : 'hidden' }}"
                    id="tabs-basic-item-3" data-tab="#tabs-basic-3" aria-controls="tabs-basic-3"
                    aria-selected="{{ request()->routeIs('convenants.index') ? 'true' : 'false' }}">
                    <span class="icon-[tabler--building] size-5 mr-2"></span>
                    <span class="font-medium">Convenios</span>
                </button>
            </nav>

            <div class="mt-4">
                <div id="tabs-basic-1" role="tabpanel" aria-labelledby="tabs-basic-item-1"
                    class="{{ request()->routeIs('manage-users.index') ? '' : 'hidden' }}" wire:ignore.self>
=======
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
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                    <form wire:submit.prevent="save('student')" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-container">
                            <div
<<<<<<< HEAD
                                class="flex flex-col justify-center border-2 border-dashed custom-upload bg-base-200/60 rounded-box border-base-content/20">
                                <div class="p-8 mt-5 text-center cursor-pointer drop-area">
                                    <input type="file" wire:model="file" class="hidden file-input" />
                                    <p class="mb-3 text-sm text-base-content/50">Sube un archivo (máx 2MB).</p>
                                    <span class="h-auto py-2 badge badge-soft badge-sm badge-primary text-nowrap">
                                        <span class="icon-[tabler--file-upload] size-4 shrink-0"></span>
                                        Arrastra o suelta aquí el archivo XLSX o CSV
                                    </span>
                                    <p class="my-2 text-xs text-base-content/50">o</p>
                                    <p class="text-sm font-medium cursor-pointer link link-animated link-primary">
                                        Buscar
                                        archivo</p>
                                    <div class="mx-8 mb-6 space-y-2 preview-list empty:m-0" wire:ignore></div>
                                </div>
                            </div>
                            <div class="mt-3 upload-error-container">
=======
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
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                                @error('file')
                                    <div class="alert alert-soft alert-error">{{ $message }}</div>
                                @enderror
                            </div>
<<<<<<< HEAD
                            <div class="inline-flex justify-end w-full gap-4 mt-4">
=======
                            <div class="w-full mt-4 inline-flex justify-end gap-4">
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                                <button type="button" wire:loading.attr="disabled" wire:click="closeModal"
                                    class="btn btn-sm">
                                    <span wire:loading.remove>Cancelar</span>
                                    <span wire:loading>Cancelar</span>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
<<<<<<< HEAD
                                    class="bg-blue-700 btn btn-sm btn-primary hover:bg-blue-800">
=======
                                    class="btn btn-sm btn-primary bg-blue-700 hover:bg-blue-800">
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                                    <span wire:loading.remove>Enviar</span>
                                    <span wire:loading>Procesando...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
<<<<<<< HEAD
                <div id="tabs-basic-2" role="tabpanel" aria-labelledby="tabs-basic-item-2"
                    class="{{ request()->routeIs('manage-users.index') ? 'hidden' : 'hidden' }}" wire:ignore.self>
=======

                <!-- Tab docentes -->
                <div id="tabs-basic-2" role="tabpanel" aria-labelledby="tabs-basic-item-2" class="hidden"
                    wire:ignore.self>
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                    <form wire:submit.prevent="save('teacher')" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-container">
                            <div
<<<<<<< HEAD
                                class="flex flex-col justify-center border-2 border-dashed custom-upload bg-base-200/60 rounded-box border-base-content/20">
                                <div class="p-8 mt-5 text-center cursor-pointer drop-area">
                                    <input type="file" wire:model="file" class="hidden file-input" />
                                    <p class="mb-3 text-sm text-base-content/50">Sube un archivo (máx 2MB).</p>
                                    <span class="h-auto py-2 badge badge-soft badge-sm badge-primary text-nowrap">
                                        <span class="icon-[tabler--file-upload] size-4 shrink-0"></span>
                                        Arrastra o suelta aquí el archivo XLSX o CSV
                                    </span>
                                    <p class="my-2 text-xs text-base-content/50">o</p>
                                    <p class="text-sm font-medium cursor-pointer link link-animated link-primary">
                                        Buscar
                                        archivo</p>
                                    <div class="mx-8 mb-6 space-y-2 preview-list empty:m-0" wire:ignore></div>
                                </div>
                            </div>
                            <div class="mt-3 upload-error-container">
=======
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
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                                @error('file')
                                    <div class="alert alert-soft alert-error">{{ $message }}</div>
                                @enderror
                            </div>
<<<<<<< HEAD
                            <div class="inline-flex justify-end w-full gap-4 mt-4">
=======
                            <div class="w-full mt-4 inline-flex justify-end gap-4">
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                                <button type="button" wire:loading.attr="disabled" wire:click="closeModal"
                                    class="btn btn-sm">
                                    <span wire:loading.remove>Cancelar</span>
                                    <span wire:loading>Cancelar</span>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
<<<<<<< HEAD
                                    class="bg-blue-700 btn btn-sm btn-primary hover:bg-blue-800">
                                    <span wire:loading.remove>Enviar</span>
                                    <span wire:loading>Procesando...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="tabs-basic-3" role="tabpanel" aria-labelledby="tabs-basic-item-3"
                    class="{{ request()->routeIs('convenants.index') ? '' : 'hidden' }}" wire:ignore.self>
                    <form wire:submit.prevent="save('convenant')" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-container">
                            <div
                                class="flex flex-col justify-center border-2 border-dashed custom-upload bg-base-200/60 rounded-box border-base-content/20">
                                <div class="p-8 mt-5 text-center cursor-pointer drop-area">
                                    <input type="file" wire:model="file" class="hidden file-input" />
                                    <p class="mb-3 text-sm text-base-content/50">Sube un archivo (máx 2MB).</p>
                                    <span class="h-auto py-2 badge badge-soft badge-sm badge-primary text-nowrap">
                                        <span class="icon-[tabler--file-upload] size-4 shrink-0"></span>
                                        Arrastra o suelta aquí el archivo XLSX o CSV
                                    </span>
                                    <p class="my-2 text-xs text-base-content/50">o</p>
                                    <p class="text-sm font-medium cursor-pointer link link-animated link-primary">
                                        Buscar
                                        archivo</p>
                                    <div class="mx-8 mb-6 space-y-2 preview-list empty:m-0" wire:ignore></div>
                                </div>
                            </div>
                            <div class="mt-3 upload-error-container">
                                @error('file')
                                    <div class="alert alert-soft alert-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="inline-flex justify-end w-full gap-4 mt-4">
                                <button type="button" wire:loading.attr="disabled" wire:click="closeModal"
                                    class="btn btn-sm">
                                    <span wire:loading.remove>Cancelar</span>
                                    <span wire:loading>Cancelar</span>
                                </button>
                                <button type="submit" wire:loading.attr="disabled"
                                    class="bg-blue-700 btn btn-sm btn-primary hover:bg-blue-800">
=======
                                    class="btn btn-sm btn-primary bg-blue-700 hover:bg-blue-800">
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
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
<<<<<<< HEAD
            <div class="flex flex-col gap-2 p-3 mt-5 shadow-lg rounded-box bg-base-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-8 h-8 text-sm border rounded-lg bg-base-200">📄
                        </div>
                        <div>
                            <p class="w-48 overflow-hidden text-sm font-medium truncate" data-file-name></p>
                            <p class="text-xs text-base-content/50" data-file-size></p>
                            <p class="hidden text-xs text-error" data-file-error>Archivo demasiado grande.</p>
=======
            <div class="rounded-box bg-base-100 shadow-lg p-3 flex flex-col gap-2 mt-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 flex items-center justify-center border rounded-lg bg-base-200 text-sm">📄
                        </div>
                        <div>
                            <p class="text-sm font-medium truncate w-48 overflow-hidden" data-file-name></p>
                            <p class="text-xs text-base-content/50" data-file-size></p>
                            <p class="hidden text-error text-xs" data-file-error>Archivo demasiado grande.</p>
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
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
<<<<<<< HEAD
                    const path = window.location.pathname;

                    if (path.includes('/manage-users')) {
                        const btnStudents = document.querySelector('#tabs-basic-item-1');
                        if (btnStudents) btnStudents.click();
                    } else if (path.includes('/convenants')) {
                        const btnConvenants = document.querySelector('#tabs-basic-item-3');
                        if (btnConvenants) btnConvenants.click();
                    }
=======
                    const btnStudents = document.querySelector('#tabs-basic-item-1');
                    if (btnStudents) btnStudents.click();
>>>>>>> 9e5d704e057e3d033f377ff567fc7a188a2e3b5f
                });
            });
        </script>
    </div>
</div>
