import Alpine from 'alpinejs'
document.addEventListener('DOMContentLoaded', () => {
    // Obtener el botón y la barra lateral
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('toggle');  // Alterna la clase d-none (ocultar) y d-block (mostrar)
    });
});

