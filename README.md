# Dashboard de Cervepar

![version](https://img.shields.io/badge/version-1.0.0-blue.svg) 
![license](https://img.shields.io/badge/license-MIT-blue.svg)

## Tabla de Contenido
* Pre requisitos
* Instalación
* Configuración ENV
* Servicios

## Pre requisitos

Para correr la aplicación es necesario contar con:

 - PHP corriendo en su version 8 como mínimo
 - PostgreSQL corriendo en cualquier version
 - Cámaras con registro ANPR


## Instalación
1. Clonar el repositorio inicial
2. Generar una base de datos dentro de PostgreSQL
3. Correr en la terminal `composer install`
4. Copiar `.env.example` a `.env` y actualiza los datos de la configuración, principalmente el de la base de datos
5. Correr en la terminal `php artisan key:generate`
6. Correr en la terminal `php artisan migrate --seed` para crear la base de datos
7. Añadir el siguiente comando a los CRON Jobs del sistema `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

## Configuración ENV
Adicionalmente es necesario configurar las siguientes variables en el archivo `.env`:

    SW_URL= URL del web service para captación de cámaras.
    SW_USER= Usuario del sistema de cámaras.
    SW_PASS= Contraseña del sistema de cámaras.
    SW_EVENT= Evento de captura de variables, ejemplo: '["4867"]'
    LOCALIDAD= Nombre del centro de distribución (Entre comillas dobles).
    DOCKS= Código interno del sistema para los docks de Descarga

## Servicios
Para el uso de los servicios es necesario que los ANPR sean dirigidos a la siguiente ruta:
`{RutaDeTuApp}/api/ingresarMovil`