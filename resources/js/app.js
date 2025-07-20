import './bootstrap';
import Alpine from 'alpinejs';
import "flyonui/flyonui";
// import './file-upload.js';

window.Alpine = Alpine;
Alpine.start();

Livewire.hook('message.processed', (message, component) => {
    // Buscar todas las instancias activas y destruirlas
    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        const instance = HSDropdown.getInstance(dropdown);
        if (instance) {
            instance.destroy();
        }
    });

    // Esperar 50ms y reinicializar los dropdowns nuevos
    setTimeout(() => {
        HSDropdown.autoInit();
    }, 50);
});

