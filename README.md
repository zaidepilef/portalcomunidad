# Portal Comunidad - Oficina Virtual

**Portal Comunidad - Oficina Virtual** es un servicio dedicado a la administración de **gastos comunes, usuarios y otros asuntos relevantes** dentro de una comunidad. Este sistema permite gestionar de manera eficiente la contabilidad, roles, pagos y la organización de la comunidad.

## 🚀 Características Principales

- **Gestión de Usuarios:** Registro y administración de residentes y administradores.
- **Roles y Permisos:** Sistema de roles para restringir y permitir accesos.
- **Administración de Gastos Comunes:** Control detallado de ingresos y egresos de la comunidad.
- **Asignación de Pagos:** Prorrateo equitativo y asignado según las necesidades.
- **Gestión de Empresas y Comunidades:** Soporte para múltiples comunidades administradas por diferentes empresas.
- **Reportes y Estadísticas:** Visualización de gastos, pagos pendientes y deudas.
- **Historial de Gastos:** Almacenamiento y consulta de registros de años anteriores.

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP 8, MySQL, Composer
- **Autenticación:** JWT (JSON Web Tokens)
- **Frameworks & Librerías:** PDO para gestión de base de datos, Firebase PHP JWT
- **Frontend (opcional):** HTML, CSS, JavaScript

## 📂 Estructura del Proyecto

```md
portal-comunidad/
├── public/             # Archivos accesibles públicamente
│   ├── index.php       # Entrada principal del sistema
├── src/                # Código fuente
│   ├── Controllers/    # Lógica del sistema
│   ├── Models/         # Consultas a la base de datos
│   ├── Views/          # Plantillas HTML/PHP
├── config/             # Configuración del sistema
│   └── config.php      # Configuración de base de datos
├── database/           # Migraciones y estructura SQL
├── tests/              # Pruebas unitarias
├── .env                # Variables de entorno
├── composer.json       # Dependencias PHP
└── README.md           # Documentación
```

## 📌 Instalación y Configuración

### **1. Clonar el Repositorio**
```sh
$ git clone https://github.com/tu-usuario/portal-comunidad.git
$ cd portal-comunidad
```

### **2. Instalar Dependencias**
```sh
$ composer install
```

### **3. Configurar el Archivo de Entorno (`.env`)**
Crea un archivo `.env` con los siguientes datos:
```env
DB_HOST=localhost
DB_NAME=portal_comunidad
DB_USER=root
DB_PASSWORD=secret
```

### **4. Configurar la Base de Datos**
```sh
$ php artisan migrate
```

### **5. Iniciar el Servidor**
```sh
$ php -S localhost:8000 -t public/
```
Accede en tu navegador a `http://localhost:8000`

## 🏗️ Contribuciones
Las contribuciones son bienvenidas. Puedes hacer un **fork** del repositorio y enviar un **pull request** con tus mejoras.

## 📄 Licencia
Este proyecto está bajo la licencia **MIT**.

---

**Desarrollado para mejorar la administración de comunidades con tecnología moderna.** 🏢📊💻

