# Starter Project

![License](https://img.shields.io/badge/license-MIT-blue.svg)

## Descripción

Este proyecto "Starter" es un punto de partida para el desarrollo de aplicaciones web utilizando PHP, Smarty, y Bootstrap. Proporciona una estructura básica y organizada que facilita el desarrollo de aplicaciones escalables y bien estructuradas. Está diseñado para ahorrar tiempo en la configuración inicial de proyectos web, permitiendo a los desarrolladores centrarse en la lógica y funcionalidad de sus aplicaciones.

## Características

- **Lenguajes de Programación**: PHP, HTML, CSS, JavaScript.
- **Motor de Plantillas**: Smarty - separa la lógica de la aplicación de la presentación.
- **Framework CSS**: Bootstrap - para interfaces de usuario responsivas y modernas.
- **Arquitectura**: Modelo-Vista-Controlador (MVC) para una mejor organización del código.
- **Gestión de Dependencias**: Composer para la instalación y gestión de paquetes.
- **Rutas**: Manejo sencillo de rutas utilizando un archivo de configuración dedicado.
- **Formularios**: Incluye un formulario de contacto con envío de emails integrado.
- **Configuración Flexible**: Configuraciones centralizadas para facilidad de uso y mantenimiento.

## Estructura de Carpetas

El proyecto está organizado de la siguiente manera:

/mi_proyecto
│
├── /app
│ ├── /controllers # Controladores que manejan la lógica de la aplicación
│ ├── /models # Modelos que interactúan con la base de datos
│ └── /views # Vistas específicas (si es necesario)
│
├── /templates # Plantillas Smarty
│ ├── /layouts # Plantillas base y layouts generales
│ └── /partials # Componentes parciales como el header, footer, etc.
│
├── /configs # Configuraciones y rutas
│ ├── config.php # Configuración general
│ └── routes.php # Definición de rutas
│
├── /public # Archivos públicos accesibles desde el navegador
│ ├── /css # Archivos CSS personalizados
│ ├── /js # Archivos JavaScript personalizados
│ ├── /images # Imágenes del sitio
│ └── index.php # Punto de entrada principal
│
├── /vendor # Dependencias instaladas por Composer
│
├── /inc # Inicialización de Smarty y otras utilidades
│ ├── init_smarty.php # Inicialización de Smarty
│ └── functions.php # Funciones auxiliares
│
└── composer.json # Configuración de Composer


## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. **Clonar el Repositorio**:
   ```bash
   git clone https://github.com/nardbyte/starter.git
   cd starter

Instalar Dependencias:
Asegúrate de tener Composer instalado y ejecuta:
composer install
Configurar el Entorno:
Copia el archivo de configuración config.example.php a config.php y ajusta las configuraciones según tu entorno (base de datos, URL base, etc.).

Configurar el Servidor Web:
Configura tu servidor web (Apache/Nginx) para apuntar al directorio /public como la raíz del documento.

Verifica la Configuración:
Accede a la URL configurada para asegurarte de que todo esté funcionando correctamente.

Uso
Rutas: Las rutas de la aplicación se definen en inc/routes.php. Puedes agregar nuevas rutas y asociarlas con controladores y métodos específicos.
Plantillas: Las plantillas se encuentran en el directorio templates/. Puedes crear nuevas plantillas y extenderlas desde layouts/base.tpl para mantener una estructura consistente.
Controladores: Los controladores se encuentran en app/controllers/. Aquí es donde se maneja la lógica de la aplicación.
Contacto
Este proyecto incluye una página de contacto donde los usuarios pueden enviar mensajes. También puedes realizar solicitudes de modificaciones o mejoras directamente en nuestro repositorio de GitHub: nardbyte/starter.

Licencia
Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para obtener más detalles.

Contribuciones
Las contribuciones son bienvenidas. Si tienes alguna sugerencia o mejora, por favor, abre un issue o envía un pull request.

