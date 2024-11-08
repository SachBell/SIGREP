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