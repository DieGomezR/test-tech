# Proyecto de Gestión de Posts con Autenticación

Este es un proyecto de una aplicación de gestión de posts con autenticación de usuarios (registro, login, creación de posts y categorías), desarrollado en Angular para el frontend y con un backend en Node.js que maneja las operaciones de la API.

## Tecnologías utilizadas

- **Frontend**: Angular
- **Backend**: PHP
- **Base de Datos**: PostgresSQL
- **Autenticación**: Tokens Basicos
- **API**: RESTful

## Características

- Registro y login de usuarios.
- Creación de posts y categorías.
- Visualización y filtrado de posts por categoría.
- Interfaz con modales para creación de posts y categorías.
- Almacenamiento de tokens en el almacenamiento local para mantener la sesión.
- Redirección automática al dashboard si el usuario ya está autenticado.

## Estructura del Proyecto

- **Frontend (Angular)**:
  - `src/app/components`: Componentes principales de la aplicación.
  - `src/app/dashboard`: Inicializacion de los componentes.
  - `src/app/guard`: Componentes para la autenticacion.
  - `src/app/navbar`: Layout de la navbar.
  - `src/app/services`: Componentes compartidos entre diferentes vistas.


- **Backend (PHP)**:
  - `routes`: Rutas para manejar la API de posts y usuarios.
  - `controllers`: Lógica de la API para interactuar con la base de datos.
  - `models`: Modelos de datos para posts y usuarios.
  - `services`: Servicios para la autenticacion.
  - `config`: Configuración de la base de datos y otros parámetros.
  - `test`: Codigo para testeo.

## Instalación

### 1. Clonar el repositorio

Primero, clona este repositorio en tu máquina local:

```bash
git clone https://github.com/tu-usuario/nombre-del-repositorio.git
```

### 2. Configuracion del backend (PHP)

Clona el repositorio del backend en tu máquina local:
   ```bash
   git clone <url_del_repositorio_backend>
   cd <nombre_del_directorio_backend>
```
Crea una base de datos en MySQL o PostgreSQL y configura los parámetros de conexión en el archivo de configuración de tu backend.

Instala las dependencias necesarias usando Composer:
```bash
composer install
```
No olvidar el config de la base de datos (Este ejemplo fue con postgres en entorno local)

### 3. Configuracion del Frontend (Angular)

Entrar en la carpeta que se encuentra el frontend

```bash
cd <nombre_del_directorio_frontend>
```

Instalar las dependencias de Angular:
```bash
npm install
```

Si estás utilizando una API en local, asegúrate de que la URL en las solicitudes coincida con la del backend.

# Ejecucion
### Backend
Inicia el servidor de PHP utilizando el servidor integrado:

```bash
php -S localhost:8000
```
Si estás utilizando un servidor Apache o Nginx, asegúrate de configurar correctamente las rutas y los archivos .htaccess o el archivo de configuración correspondiente.

### Frontend
Inicia el servidor de desarrollo de Angular:

```bash
ng serve
```
Abre tu navegador y navega a http://localhost:4200 para ver la aplicación en acción.

# Funcionalidades
### Autenticación
- **Registro**: Los usuarios pueden registrarse proporcionando su nombre, correo electrónico y contraseña.
- **Inicio de sesión**: Los usuarios pueden iniciar sesión con su correo electrónico y contraseña.
- **Token**: Después de iniciar sesión, se genera un token que se almacena localmente y se utiliza para autenticar futuras solicitudes.
### Gestión de Posts
 - Los usuarios autenticados pueden crear, leer y eliminar posts.
- Los posts están organizados por categorías.
### Gestión de Categorías
- Los usuarios pueden crear nuevas categorías para organizar los posts.

# Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo LICENSE para más detalles.

