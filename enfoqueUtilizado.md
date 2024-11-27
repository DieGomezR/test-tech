# Enfoque para Resolver los Retos

## Reto 1: Implementación de Autenticación

Para resolver el reto de la autenticación de usuarios, utilicé Tokens tanto en el backend (PHP) como en el frontend (Angular). En el backend, creé un sistema de autenticación que genera un token al iniciar sesión y lo valida en cada solicitud subsiguiente. Este token se almacena en el almacenamiento local del navegador y se envía en las cabeceras de las solicitudes del frontend.

En el frontend, implementé un servicio de autenticación que maneja el login, el almacenamiento del token y la verificación de la sesión del usuario.

## Reto 2: Creación y Gestión de Posts

Para la creación y gestión de posts, diseñé una estructura de categorías en el backend. Los usuarios pueden asociar sus posts a una categoría específica. Para la interacción con el backend, creé métodos en Angular que permiten al usuario crear posts con la validación correspondiente de campos obligatorios.

El frontend también incluye formularios modales para crear posts, donde validamos que los campos estén completos antes de enviarlos al backend.

Tambien permito la creacion de nuevas categorias/

## Reto 3: Interfaz de Usuario y Modularización

Para la interfaz, utilicé Angular con componentes modulares. Dividí la aplicación en varias partes: registro de usuarios, inicio de sesión, listado de posts, y formularios modales. Los modales para la creación de posts y categorías están en sus propios componentes para facilitar la reutilización.

Usé TailwindCSS para la disposición responsiva de los elementos y garantizar que la aplicación fuera accesible en dispositivos móviles.

## Conclusiones

El desarrollo del proyecto me permitió aprender y consolidar mis conocimientos sobre la integración de Angular con un backend en PHP, y la creación de una aplicación web modular y escalable. Los principales desafíos fueron la gestión de la autenticación en ambos entornos (frontend y backend) y el manejo de estados en Angular. Sin embargo, la modularización y la reutilización de componentes facilitaron la gestión de la UI.
