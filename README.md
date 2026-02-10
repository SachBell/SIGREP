

# **Introduccion**

<p align="center">SGPP (Sistema de Gestión Práctica Preprofesional) es un sistema diseñado para gestionar y automatizar los procesos de practicas pre preprofesionales, ya sean: <p>

 - Creación de periodos de postulación
 - Creación de Entidades Receptoras
 - Asignación y Gestión de Docentes Tutores
 - Emails de Sistema (Visitas, Asignaciones, Periodos)
 


## Instalación

Para instalar SGPP en su servidor institusional, descarge el comprimido con la version actualizada.

 - [Linux](https://github.com/sachbell/SIGREP/#Linux)
 - [Windows](https://github.com/sachbell/SIGREP/#Windows)

## #Linux

### Paso 1

Dirijase a la carpeta `var/www/https` y utilice el comando `git clone https://github.com/sachbell/sgpp.git`.

## Paso 2

Descomprima el archivo usando el comando `unzip nombre_del_archivo.zip` si quiere que se descomprima en otra carpeta use el mismo comando, pero adicionando `-d /ruta/al/destino`.

ej: `unzip nombre_del_archivo.zip -d /ruta/al/destino`

## Paso 3

Dirijase al directorio con `cd /var/www/https/ruta_del_sistema` y ejecute los siguientes comandos:

 - **Instalación de Dependencias**: `composer i`
 - **Generación de la Key**: `php artisan key:generate`
 - **Instalacion de node_modules**: `npm i`

## Paso 4

Utilice los siguientes comandos para iniciar todo los modulos del sistema tanto como el motor de estilos:

 - **Iniciacion de Estilos:** `npm run build`
 - **Migraciones:** `php artisan migrate`

Y listo su sistema esta configurado y listo para usarse.

## #Windows

### Paso 1

Dirijase a la carpeta del servidor local, esta puede variar dependiendo del motor que este usando: 

 - **Xampp:**  */htdocs*
 - **WampServer:**  */www/httpss*
 - **Laragon:**  */www/*

Ejecute el comando `git clone https://github.com/sachbell/sgpp.git` dentro de una terminal que apunte a su directorio de raíz.


## Paso 2

Descomprima el archivo dependiendo de la carpeta en donde desee instalar el sistema.

ej: `/www/institucion/sgpp/`

## Paso 3

Dirijase al directorio en donde descomprimió el sistema y en una terminal ejecute los siguientes comandos:

 - **Instalación de Dependencias**: `composer i`
 - **Generación de la Key**: `php artisan key:generate`
 - **Instalacion de node_modules**: `npm i`

## Paso 4

Utilice los siguientes comandos para iniciar todo los modulos del sistema tanto como el motor de estilos:

 - **Iniciacion de Estilos:** `npm run build`
 - **Migraciones:** `php artisan migrate`

Y listo su sistema esta configurado y listo para usarse.

## *Nota: A partir de la v3.7.0 se requerirá una licencia, por favor contáctese con el proveedor YggdrasillCode WA: 0962611395*
