# Sistema de Gestión de Prácticas Preprofesionales (SIGREP)

Este es un aplicativo web desarrollado para el **Instituto Superior Universitario Sucre**, con el objetivo de facilitar la gestión de postulaciones a prácticas preprofesionales. La plataforma permite a los estudiantes postularse y actualizar su información, mientras que los docentes pueden gestionar y generar documentos relacionados con el proceso.

**NOTA: ** Este proyecto solo sirve para una carrera, proximamente será expandido para que sea global.

## 📌 Características Principales
- Registro y actualización de información estudiantil.
- Gestión de postulaciones a prácticas.
- Generación de documentos en PDF y Excel.
- Sistema de roles y permisos (estudiante, docente, administrador).
- Interfaz responsiva y accesible.

## 🛠 Tecnologías y Librerías Utilizadas
El sistema se ha desarrollado utilizando las siguientes tecnologías:

### **Backend**
- [Laravel 10](https://laravel.com/) - Framework PHP basado en MVC.
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) - Autenticación y autorización basada en tokens.
- [Eloquent ORM](https://laravel.com/docs/10.x/eloquent) - Manejo de base de datos.
- [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) - Generación de documentos PDF.
- [maatwebsite/excel](https://laravel-excel.com/) - Exportación de datos a Excel.

### **Frontend**
- [Tailwind CSS](https://tailwindcss.com/) - Estilos y diseño responsivo.
- [Bootstrap Icons](https://icons.getbootstrap.com/) - Iconos para mejorar la interfaz.
- [Animate.css](https://animate.style/) - Animaciones para una mejor experiencia de usuario.

### **Herramientas Adicionales**
- [Laravel Breadcrumbs](https://github.com/diglactic/laravel-breadcrumbs) - Migas de pan para navegación.
- [PHPUnit](https://phpunit.de/) - Pruebas unitarias.
- [Laravel Dusk](https://laravel.com/docs/10.x/dusk) - Pruebas end-to-end.

## 🏗 Metodología de Desarrollo
El desarrollo del sistema se realizó utilizando **Scrum**, organizando el trabajo en sprints de dos semanas. Se usó **GitHub** para el control de versiones, asignación de tareas y revisión de código mediante _pull requests_.

## 👥 Colaboradores
- [@SachBell](https://www.github.com/SachBell)

## 📝 Instalación y Configuración
1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/sigrep.git
   ```
2. Acceder al directorio del proyecto:
   ```bash
   cd sigrep
   ```
3. Instalar dependencias:
   ```bash
   composer install
   npm install
   ```
4. Configurar el archivo de entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Configurar base de datos y ejecutar migraciones:
   ```bash
   php artisan migrate --seed
   ```
6. Levantar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## ✅ Pruebas Realizadas
Se realizaron las siguientes pruebas para garantizar el correcto funcionamiento del sistema:
- **Pruebas de Caja Negra**: Validación de funcionalidades sin conocimiento del código.
- **Pruebas de Caja Blanca**: Verificación del flujo lógico y estructura del código.
- **Pruebas de Integración**: Evaluación del comportamiento entre módulos del sistema.
- **Pruebas de Carga**: Simulaciones con alto número de usuarios y datos.

## 📌 Versión
- **Versión actual:** v3.1.1-BETA
- **Historial de versiones:** Disponible en la sección de _Releases_ de GitHub.

## 📄 Licencia
Este proyecto está bajo la licencia [MIT](LICENSE).

---
> *Si tienes alguna duda o sugerencia, no dudes en abrir un _issue_ en el repositorio.*
