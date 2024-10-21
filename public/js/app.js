document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evitar el envío normal del formulario

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Cargar las credenciales desde el archivo JSON
    fetch('../../credentials.json')
        .then(response => response.json())
        .then(data => {
            // Validar las credenciales
            if (username === data.username && password === data.password) {
                // Guardar sesión de usuario (opcional, puede usar localStorage)
                localStorage.setItem('loggedIn', 'true');

                // Redirigir al dashboard
                window.location.href = 'dashboard';
            } else {
                document.getElementById('error').textContent = 'Credenciales incorrectas';
            }
        })
        .catch(error => console.error('Error al cargar el archivo JSON:', error));
});
