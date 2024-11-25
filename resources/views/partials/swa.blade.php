@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@if (session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: '¡Alerta!',
            text: '{{ session('info') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: '¡Alerta!',
            text: '{{ session('warning') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Por favor, completa todos los campos obligatorios.',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif