# Prueba Técnica – Estados y Municipios de México

Proyecto desarrollado con **Laravel**, utilizando **Blade** para el frontend y **Controllers/Models** para el backend.  
La aplicación consume la API de **Copomex** para obtener los **estados de México** y, a partir de cada estado, listar sus **municipios**, 
aplicando buenas prácticas como **idempotencia** y **caching** para optimizar el consumo de la API.

---

##  Tecnologías utilizadas

- Laravel 9
- PHP 8.1
- Blade (Frontend)
- Bootstrap 5
- MySQL
- API Copomex
- Cache de Laravel (file)

---

##  Funcionalidades

- Consumo de la API de **Copomex** para obtener los estados de México.
- Inserción de estados en base de datos evitando duplicados (**idempotencia**).
- Listado de estados en una tabla con **Bootstrap DataTables**.
- Visualización de municipios por estado al dar clic en su nombre.
- Consumo de la API de municipios **sin persistirlos en base de datos**.
- Implementación de **cache por estado** para evitar múltiples llamadas a la API externa y reducir el consumo de créditos de Copomex.

---

##  Decisiones técnicas

### Idempotencia en la carga de estados
- El nombre del estado se utiliza como **clave única** en la base de datos.
- Se implementa una restricción `unique` a nivel BD.
- Se utiliza `updateOrCreate()` para garantizar que múltiples ejecuciones no generen registros duplicados.

### Optimización del consumo de la API (Municipios)
- Los municipios **no se almacenan en base de datos**, ya que no es un requerimiento.
- Se utiliza el **sistema de cache de Laravel** para guardar la respuesta de la API por estado.
- Si un estado ya fue consultado, los municipios se obtienen desde cache y no se vuelve a llamar a la API externa.
- Esto evita llamadas innecesarias y reduce el consumo de créditos de Copomex.

---

## ⚙️ Instalación y configuración

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/devluisteran/estados.git
cd estados

### 2️⃣ Instalar dependencias
composer install

### 3️⃣ Configurar el entorno

Copiar el archivo .env.example y crear el .env:

cp .env.example .env

Configurar la conexión a la base de datos en .env los siguientes datos vienen por default:

DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=

⚠️ La base de datos debe existir previamente.

### 4️⃣ Generar la key de la aplicación
php artisan key:generate

### 5️⃣ Ejecutar migraciones
php artisan migrate

### ▶️ Ejecución del proyecto
php artisan serve


Acceder desde el navegador a:

http://localhost:8000

