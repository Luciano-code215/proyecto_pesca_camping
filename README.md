
# Reglas de negocio

- El usuario debe estar registrado para comprar.
- El stock se controla por unidades almacenadas.
- Solo administradores pueden acceder al panel administracion.
- Los pedidos se registran con estado inicial "Pendiente".

---

# Autor

Desarrollado por Pedotti Luciano y Sanchez Abraham.


# Manual de Usuario — PARANA PESCA
**Tienda Online de artículos de pesca y camping**
Versión 1.0 | Junio 2026

---

## Índice

1. [Introducción]
2. [Registro e Inicio de Sesión]
3. [Navegación General]
4. [Catálogo de Productos]
5. [Carrito de Compras]
6. [Mis Compras]
7. [Formulario de Consultas]
8. [Panel de Administración]

---

## 1. Introducción

PARANA PESCA es una tienda online de venta de artículos de pesca y camping. La misma tiene la propiedad de navegar por el catálogo, agregar productos al carrito, realizar pedidos y hacer consultas directamente desde el sitio. Pudiendo acceder a secciones especificas como contacto, o quienes somos.

**URL de acceso:** `http://proyecto_pesca_camping.test`

---

## 2. Registro e Inicio de Sesión

### Registrarse

1. Ir a Cuenta --> Crear cuenta
2. Completar: nombre completo, email, contraseña y repetir comntraseña.
3. Hacer clic en **Registrarme**
4. El sistema crea la cuenta y aparece un modal que indica que el usuario se registro exitosamente.
5. Al dar "ok" se redirige al inicio.

### Iniciar sesión

1. Ir a Cuenta --> Iniciar sesion
2. Ingresar email y contraseña registrados
3. Hacer clic en **Iniciar sesión**
4. El token de sesión se guarda en el navegador automáticamente

### Cerrar sesión

- Hacer clic en el botón **Cerrar sesion** en el navbar
- El sistema elimina el token y la sesión

---

## 3. Navegación General

El navbar superior contiene:

| Inicio | `/` | Hero, productos destacados y CTA |
| Quiénes Somos | `/quienes_somos` | Historia, equipo y valores |
| Comercialización | `/comercializacion` | Pagos, envíos y tiempos |
| Consultas | `/contacto` | FAQ y formulario de consulta |
| Terminos y usos | `/terminos_y_usos` | Un Aviso Legal de del sitio web, los servicios ofrecidos y las políticas de privacidad.
| Productos | `/productosPub` | Todos los productos disponibles |

El **ícono de carrito** en el navbar muestra la cantidad de productos agregados y abre el panel lateral.
Los iconos de redes sociales (Whatsapp / Instagram) remiten a una ventana a parte como manera de comunicación.

---

## 4. Catálogo de Productos

En `/productosPub` se muestran todas las categorías a las que pertenecen los productos en existencia pudiendo filtrar por los mismos.

Cada tarjeta muestra:
- Imagen del articulo
- Nombre del producto
- Precio
- Descripcion
- Botón **Agregar al carrito** para añadir al carrito

---

## 5. Carrito de Compras

El carrito se abre desde el ícono en el navbar y muestra:

- Lista de productos agregados donde cada item contiene imagen, nombre, precio, stock disponible, cantidad solicitada y subtotal.
- Botón para eliminar cada ítem.
- Total a pagar
- Botón **Finalizar compra**: Despliega un modal que informa que el personal se contactara por mail para coordinar la entrega.
- Vuelve al catalogo de productos.

---

## 6. Mis Compras

En `/mis-compras` se puede ver el historial de compras:

- Lista de todos los pedidos ordenados por nro de orden.
- Fecha y hora del pedido
- Estado de cada pedido:
	- Esperando pago
	- Pendiente envió
	- Entregada
	- Cancelada
	- Pagada
- Total de cada pedido
- Detalle

---

## 7. Formulario de Consultas

En `/consultas/form-consultas` hay un formulario para enviar preguntas:

**Campos:**
- Nombre *(requerido)*
- Email *(requerido)*
- Asunto *(requerido en la página de consultas)*
- Mensaje *(requerido)*

Al enviar, si todos los campos son válidos, se muestra una pantalla de confirmación. El botón **entendido** redirige al inicio.

---

## 8. Panel de Administración

Accesible desde `/admin/dashboard` (solo usuarios administradores).

### Secciones disponibles

| Dashboard | `/admin/dashboard` | Estadísticas generales |
| Productos | `/admin/productos` | Inventario de articulos |
| Categorías | `/admin/categorias` | Registro de categorías de productos añadidas y la opción de añadir una nueva. 
| Pedidos/Ventas | `/admin/pedidos` | Ver y gestionar pedidos |
| Contactos | `/admin/contactos` | Correros recibidos desde el formulario de la web publica |
| Usuarios | `/panel-admin-usuarios` | Lista de usuarios registrados |
| Consultas | `/admin/consultas` | Interacciones con usuarios registrados del sitio |
| Gestionar usuarios | `/admin/usuarios` | (Funcion exclusiva de admin) Listado de usuarios registrados pudiendo cambiar el estado de los mismos y añadir nuevo admin


### Gestión de consultas

- Filtro por estado: Pendientes /  Respondidas
- Al abrir una consulta se marca como **leída** automáticamente


# Especificación de Requisitos de Software (ERS) 
## PARANA PESCA — Tienda Online de venta de artículos de pesca y camping.

**Versión:** 1.0
**Fecha:** Junio 2026
**Autor:** Equipo de desarrollo

---

## Índice

1. [Introducción](#1-introducción)
2. [Descripción General del Sistema](#2-descripción-general-del-sistema)
3. [Requisitos Funcionales](#3-requisitos-funcionales)
4. [Requisitos No Funcionales](#4-requisitos-no-funcionales)
5. [Casos de Uso Principales](#6-casos-de-uso-principales)

---

## 1. Introducción

### 1.1 Propósito

A continuación vamos a describir los requisitos funcionales y no funcionales de nuestro sistema gestor para el funcionamiento de nuestra pagina web PARANA PESCA.

### 1.2 Alcance

El sistema contempla:
- Sitio web público para clientes (catálogo, carrito, consultas)
- Panel de administración para gestión interna

### 1.3 Tecnologías utilizadas

| Framework backend | Laravel 11 |
| Autenticación | Laravel Sanctum |
| Base de datos | SQLITE |
| Frontend | Bootstrap 5 + Blade |
| Servidor de desarrollo | Laravel Herd |

---

## 2. Descripción General del Sistema

### 2.1 Perspectiva del producto

PARANA PESCA es un sistema de gestión de compras online para la compra de materiales de pesca y camping. Presenta catalogo de productos, carrito de compras, y gestión de pedidos entre otros.


### 2.2 Tipos de usuarios

| **Visitante** | Usuario no autenticado | Con acceso a: Catálogo, información general de la pagina, formularios |
| **Cliente** | Usuario registrado | Se añade acceso a: Carrito, mis compras, mis consultas |
| **Administrador** | Staff | Unico rol con acceso a: Panel admin completo |

### 2.3 Entorno de operación

- Navegadores (Chrome, Firefox, Safari, Edge)
- Dispositivos: desktop, tablet y mobile (diseño responsivo)
- Requiere Conexión a internet.

---

## 3. Requisitos Funcionales

### RF-01 — Autenticación

| RF-01.1 | El sistema debe permitir el registro de nuevos usuarios con nombre, email y contraseña |
| RF-01.2 | El sistema debe autenticar usuarios mediante email y contraseña |
| RF-01.3 | El sistema debe emitir un token Sanctum al autenticarse exitosamente |
| RF-01.4 | El sistema debe revocar el token y destruir la sesión al cerrar sesion |
| RF-01.5 | El sistema debe proteger las rutas de panel admin mediante middleware de rol |

### RF-02 — Catálogo de productos

| RF-02.1 | El sistema debe generar una lista con los productos activos con imagen, nombre, precio y descripcion |
| RF-02.2 | El sistema debe permitir filtrar productos por categoría |
| RF-02.3 | El sistema debe exhibir con cada card de presentacion de producto un boton que permita añadir al carrito |


### RF-03 — Carrito de compras

| RF-03.1 | El sistema debe permitir agregar productos al carrito |
| RF-03.2 | El carrito debe persistir en el navegador |
| RF-03.3 | El sistema debe mostrar un contador con la cantidad de ítems en el navbar |
| RF-03.4 | El sistema debe permitir eliminar ítems del carrito |
| RF-03.5 | El sistema debe calcular el total acumulado en tiempo real |


### RF-04 — Gestión de pedidos (cliente)

| RF-04.1 | El cliente debe poder ver el historial de sus pedidos |
| RF-04.2 | El sistema debe mostrar el estado de cada pedido |
| RF-04.3 | El cliente debe poder ver el detalle completo de cada pedido |
| RF-04.4 | El detalle debe incluir productos, precio y estado |

### RF-05 — Consultas y contacto

| RF-05.1 | El sistema debe permitir enviar consultas sin estar registrado |
| RF-05.2 | El formulario debe capturar: nombre y apellido, email y mensaje |
| RF-05.3 | El sistema debe validar los campos requeridos antes de enviar |
| RF-05.4 | El sistema debe guardar la consulta en la base de datos |
| RF-05.5 | El sistema debe confirmar visualmente el envío exitoso |

### RF-06 — Panel de administración

| RF-06.1 | Solo usuarios con rol administrador pueden acceder al panel |
| RF-06.2 | El panel debe mostrar estadísticas generales en el dashboard |
| RF-06.3 | El administrador debe poder listar, crear, editar y eliminar productos |
| RF-06.4 | El administrador debe poder ver y gestionar pedidos |
| RF-06.5 | El administrador debe poder listar usuarios registrados |
| RF-06.6 | El administrador debe poder ver, marcar como leída/respondida y eliminar consultas |

---

## 4. Requisitos No Funcionales

### RNF-01 — Rendimiento
- Las páginas deben tener como mucho un tiempo máximo de carga de 2 segundos en momentos donde no haya estancamiento.

### RNF-02 — Seguridad
- Las contraseñas deben almacenarse con hasheos.
- El panel admin debe estar protegido por middleware de rol
- Las sesiones deben invalidarse al cerrar sesión.

### RNF-03 — Usabilidad
- El diseño debe ser completamente responsivo
- Los formularios deben mostrar errores en tiempo real
- El sistema debe dar info visual en toda acción (éxito, error)

### RNF-04 — Compatibilidad
- Compatible con Chrome, Firefox, Safari y Edge
- Compatible con dispositivos iOS y Android


---


## 5. Casos de Uso Principales

### CU-01: Realizar una compra

**Actor:** Cliente logueado
**Precondición:** Usuario registrado y su carrito debe tener al menos un producto

1. Cliente navega el catálogo
2. Agrega al carrito
3. Abre el carrito y hace clic en "Finalizar compra"
4. Se informa con un modal que el personal se comunicara por correo para coordinar la entrega.

**Postcondición:** Pedido registrado en estado "esperando pago"

---

### CU-02: Gestionar una consulta (Admin)

**Actor:** Administrador
**Precondición:** Autenticado como admin

1. Admin accede a `admin/consultas`
2. Sistema carga lista de consultas.
3. Admin selecciona una consulta
4. Sistema la abre.
5. Admin lee el mensaje
6. Admin hace clic en "responder", escribe la devolución y presiona 'enviar respuesta'

**Postcondición:** Consulta marcada como leída y respondida

---


# Instrucciones para Levantar el Proyecto
## PARANA PESCA — Guía de Instalación y Configuración

---

## Requisitos previos

Tener instalado en el sistema:

| Herramienta | Versión mínima | Verificar con |
|---|---|---|
| PHP | 8.2+ | `php -v` |
| Composer | 2.x | `composer -V` |
| npm | 9+ | `npm -v` |
| SQLITE | 8.0+ | `mysql --version` |
| Laravel Herd | Última | — |
| Git | — | `git --version` |

---

## 1. Clonar el repositorio

```bash
git clone http://proyecto_pesca_camping.test
```

---

## 2. Instalar dependencias PHP

```bash
composer install
```

# Autenticación con Sanctum

Instalar Sanctum

```bash
composer require laravel/sanctum
```

Publicar configuración

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## 3. Instalar dependencias Node

```bash
npm install
```

---

## 4. Configurar el archivo de entorno

Copiar el archivo de ejemplo:

```bash
cp .env.example .env
```

Editar `.env` con los datos del entorno local:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:tsIrxCQm0vHW1d9rsGS96cDmJUKlFwdJ17xlHRZ+LwU=
APP_DEBUG=true
APP_URL=http://proyecto_pesca_camping.test
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
DB_DATABASE=database/database.sqlite
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=file
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

```

---

## 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

---

---

## 7. Ejecutar las migraciones

```bash
php artisan migrate
```



## 8. Crear el enlace de almacenamiento

```bash
php artisan storage:link
```

---

## 9. Configurar Laravel Herd

1. Abrir **Laravel Herd**
2. Ir a **Sites** → **Add site**
3. Seleccionar la carpeta del proyecto
4. El dominio se configura automáticamente como `proyecto_pesca_camping.test`
5. Verificar que PHP 8.2+ esté seleccionado para el sitio

Alternativamente, si usás el servidor integrado de Laravel:

```bash
php artisan serve

```

---

## 10. Compilar los assets

Para desarrollo (con hot reload):

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

---

## 11. Crear un usuario administrador

Opción A — desde Tinker:

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name'     => 'Admin',
    'email'    => 'admin@goleadorfc.com',
    'password' => bcrypt('password123'),
    'role'     => 'admin',
]);
```

Opción B — Ingresar con usuario administrador previamente cargado

    'email' => 
    'password' => 

---

## 12. Verificar que todo funciona

```bash
# Listar todas las rutas registradas
php artisan route:list

# Verificar rutas de API
php artisan route:list | grep api
```

Acceder en el navegador:
- Sitio público: `http://proyecto_pesca_camping.test`
- Panel admin: `http://proyecto_pesca_camping.test/admin/dashboard`
- Login: `http://proyecto_pesca_camping.test/crear_cuenta`

---

## Estructura del proyecto

```
proyecto_pesca_camping/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   
│   │   └── Middleware/
│   └── Models/
│       
├── database/
│   ├── migrations/
│  
├── public/
│   ├── css/
│   │         estilos
│                  
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── admin.blade.php
│   │   │   
│   │   ├── components/
│   │   │   ├── 
│   │   ├── carrito.blade.php
│   │   ├── comercializacion.blade.php
│   │   ├── consulta_cliente.blade.php
│   │   ├── contacto_cliente.blade.php
│   │   ├── contacto.blade.php
│   │   ├── en_construccion.blade.php
│   │   ├── footer.blade.php
│   │   ├── ingresar.blade.php
│   │   ├── inicio.blade.php
│   │   ├── mis_compras.blade.php
│   │   ├── mis-consultas.blade.php
|    |   ├── navbar.blade.php
|    |   ├── productosPub.blade.php
|    |   ├── quienes_somos.blade.php
|    |   └── terminos_y_usos.blade.php
|   
│   └── css/
│       └── app.css              
├── routes/
│   ├── web.php
│   └── api.php
└── vite.config.js
```

---

## Rutas API principales

GET | '/contacto'

GET | '/crear_cuenta'

POST | '/crear_cuenta'

GET | '/ingresar'

POST | '/ingresar'

GET | '/pesca'

GET | '/camping'

GET | '/comercializacion'

GET | '/quienes_somos'

GET | '/terminos_y_usos'

GET | '/productosPub'

GET | '/en_construccion'

GET | 'contacto/form-contacto'

POST | '/contacto'

---

