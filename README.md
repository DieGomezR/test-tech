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

# Estructura de la Base de Datos

El proyecto utiliza una base de datos **PostgreSQL** para almacenar la información de los usuarios, posts y categorías. A continuación se detalla la estructura de la base de datos y los scripts SQL para crear las tablas necesarias.

### 1. Tabla de Usuarios (`users`)

Esta tabla almacena la información de los usuarios, incluyendo sus credenciales para la autenticación.

```sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);
```
- **id**: Identificador único para cada usuario.
- **name**: Nombre del usuario.
- **email**: Correo electrónico del usuario, debe ser único.
- **password**: Contraseña cifrada del usuario.
- **created_at**: Fecha de creación del usuario.

### Tabla de Categorías (categories)

Esta tabla almacena las categorías que los usuarios pueden seleccionar para sus posts.

```sql
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);
```

- **id**: Identificador único para cada categoría.
- **name**: Nombre de la categoría.
- **description**: Descripción de la categoría.
- **created_at**: Fecha de creación de la categoría.

### Tabla de Posts (posts)

Esta tabla almacena los posts creados por los usuarios, que pueden ser categorizados.

```sql
CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    category_id INT REFERENCES categories(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);
```
- **id**: Identificador único para cada post.
- **title**: Título del post.
- **content**: Contenido del post.
- **user_id**: Referencia al usuario que creó el post.
- **category_id**: Referencia a la categoría seleccionada para el post.
- **created_at**: Fecha de creación del post.


## Relaciones entre las Tablas
- **posts.user_id**: Relaciona un post con el usuario que lo creó.
- **posts.category_id**: Relaciona un post con una categoría.
- **categories**: Puede haber muchas categorías, pero cada post pertenece solo a una categoría.

# Instalacion
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
