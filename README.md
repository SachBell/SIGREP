
# Sistema De Gestión de Prácticas Preprofesionales

Este es un aplicativo web para el Instituto Superior Universitario Sucre. La finalidad de este es facilitar la gestión por parte de los estudiantes que quieran tomar prácticas, como el gestionamiento por parte de los docentes.


## Autores

- [@SachBell](https://www.github.com/SachBell)


## Tecnologías y librerías que usamos
 - [Laravel](https://laravel.com/)
 - [Tailwind](https://tailwindcss.com/)
 - [laravel/breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)
 - [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
 - [diglactic/laravel-breadcrumbs](https://github.com/diglactic/laravel-breadcrumbs)
 - [maatwebsite/excel](https://laravel-excel.com/)
 - [Animate.css](https://animate.style/)


## Descripción
Este aplicativo web fue hecho para facilitar el gestionamiento de postulación de prácticas preprofesionales. Tanto la petición de estas, como la de escoger a las instituciones en las que realizar las prácticas. 

Cuenta con un sistema completo se desarrollo con **Laravel** en conjunto con **Laravel Breeze** para las acciones de inicio de sesión, register, verificación de correo, entre otras cosas. Tomando eso de punto de partida, decidimos usar **Tailwind** que es una librería de manejo de css, para el estilizado de las diferentes vistas que ofrece nuestra aplicación. En conjunto para utilizar animaciones de una manera mucho más fácil, decidimos usar **Animate.css** que ofrece animaciones ya listas para su uso. Y para terminar y darle un estilo más profesional usamos **Laravel-breadcrumbs** para crear una barra de navegación de migas de pan, esto para que el usuario sepa en que sección del aplicativo esta.

Para la parte realmente importante, que es el creador de solicitudes. Usamos **Laravel-dompdf** para realizar el documento de solicitud de prácticas.
Para el de registros de postulación utilizamos **Maatwebsite/exel** para que nos diera una matríz descargable acerca de los registros de cada estudiante y en las instituciones en las que se encuntran realizando dichas prácticas.


## Pruebas Realizadas