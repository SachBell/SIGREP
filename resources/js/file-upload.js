import Dropzone from 'dropzone';

window.Dropzone = Dropzone;

window.addEventListener('load', () => {
    // Forzamos inicialización (necesario si no se inicializa automáticamente)
    window.HSFileUpload?.init?.();

    const instance = window.HSFileUpload?.getInstance('#file-upload-limit', true);

    if (!instance || !instance.element) {
        console.warn('HSFileUpload no está disponible o el elemento no existe');
        return;
    }

    const { element } = instance;

    element.dropzone.on('error', (file, response) => {
        if (file.size > element.concatOptions.maxFilesize * 1024 * 1024) {
            const filePreview = file.previewElement;

            const successEls = filePreview.querySelectorAll('[data-file-upload-file-success]');
            const errorEls = filePreview.querySelectorAll('[data-file-upload-file-error]');
            if (successEls) successEls.forEach(el => (el.style.display = 'none'));
            errorEls.forEach(el => (el.style.display = ''));
            window.HSStaticMethods?.autoInit(['tooltip']);
        }
    });
});
