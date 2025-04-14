@props(['action'])

<div id="form-modal" class="overlay modal overlay-open:opacity-100 hidden [--overlay-backdrop:static]" role="dialog"
    tabindex="-1" aria-overlay="true">
    <div class="modal-dialog overlay-open:opacity-100">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">User details</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close"
                    data-overlay="#form-modal"><span class="icon-[tabler--x] size-4"></span></button>
            </div>
            <div class="modal-body pt-0">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-center bg-white">
                        <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                            <div class="w-full md:flex">
                                <div class="p-3">
                                    <label for="fileUpload"
                                        class="relative border-dotted h-48 w-[400px] rounded-lg border-dashed border-2 border-gray-700 bg-gray-100 flex justify-center items-center cursor-pointer">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center">
                                                <i class="icon-[tabler--cloud-upload] size-[4rem] text-gray-700"></i>
                                                <span class="block text-gray-400 font-normal mt-2">Arrastra el archivo
                                                    aquí</span>
                                            </div>
                                        </div>

                                        <!-- Input File (ahora dentro de la etiqueta label y sin visibilidad) -->
                                        <input type="file" id="fileUpload"
                                            class="opacity-0 absolute inset-0 w-full h-full" name="file"
                                            onchange="displayFileName()">
                                    </label>

                                    <!-- Mostrar nombre del archivo -->
                                    <div id="fileName" class="mt-4 text-center text-gray-600 font-medium"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function displayFileName() {
                            const fileInput = document.getElementById('fileUpload');
                            const fileNameDisplay = document.getElementById('fileName');

                            // Verificar si un archivo fue seleccionado
                            if (fileInput.files.length > 0) {
                                fileNameDisplay.textContent = `Archivo seleccionado: ${fileInput.files[0].name}`;
                            }
                        }
                    </script>
                    <div class="modal-footer">
                        <a href="" class="btn btn-soft btn-secondary"
                            data-overlay="#form-modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
