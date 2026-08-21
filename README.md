# BookMedik v5
Sistema de Gestión de Citas y Expedientes Médicos desarrollado con **PHP 8**, **MySQL**, **LegoBox v5 Architecture** y **CoreUI v5**.

 Sitios Oficiales: [Evilnapsis](http://evilnapsis.com) | [Portafolio BookMedik](http://evilnapsis.com/portfolio/bookmedik/)

---

##  Novedades en la Versión 5.0 (`LegoBox v5 Architecture`)

- **Arquitectura Limpia LegoBox v5 (`lb-min-5`)**:
  - **Front Controller & Routing**: Enrutamiento de URLs amigables con `FastRoute 1.3` en [index.php](file:///c:/xampp/htdocs/bookmedik/index.php) y [.htaccess](file:///c:/xampp/htdocs/bookmedik/.htaccess).
  - **Capa de Controladores y Servicios**: Separación clara de la lógica de negocio (`App\Service\*`) y manejo de solicitudes HTTP (`App\Controller\*`).
  - **Mini-ORM Active Record**: Base de datos conectada vía `PDO` con Prepared Statements nativos (`LbModel`).
  - **Cargas PSR-4**: Autoloading de clases PHP optimizado.
- **Motor de Vistas Twig 3**:
  - Vistas completamente desacopladas de la lógica PHP en la carpeta `public/`.
- **Diseño de Interfaz Avanzado (CoreUI v5)**:
  - **Sidebar Navegable Colapsable** con menú organizado.
  - **Soporte de Tema Claro / Oscuro**: Selector dinámico de tema (*Light / Dark / Auto*) en el Header.
  - **Alertas Emergentes Interactivas**: Notificaciones nativas con **SweetAlert2**.
- **Módulo de Calendario Interactivo (`/calendar`)**:
  - Integración de **FullCalendar** con vistas por Mes, Semana y Día, localización en español y redirección a edición de citas al hacer clic.
- **Exportación de Reportes a PDF**:
  - Generación de comprobantes de cita e informes filtrados en formato **PDF** con FPDF (`/reservation/{id}/pdf` y `/reports/pdf`).
- **Seguridad**:
  - Protección global contra ataques **CSRF**.
  - Hashes de contraseñas seguros con **Bcrypt** (`password_hash`), con migración transparente automática de cuentas legacy (`sha1(md5())`).

---

## 🛠️ Requisitos e Instalación

1. **Servidor Web**: Apache / Nginx con módulo `mod_rewrite` habilitado (XAMPP, WAMP, Laragon, Docker, etc.).
2. **Versión de PHP**: PHP 8.0 o superior (extensiones `pdo_mysql`, `mbstring`, `json`).
3. **Base de Datos**: MySQL 5.7+ / MariaDB 10.2+.

### Pasos de Instalación:
1. Importa el esquema de la base de datos [schema.sql](file:///c:/xampp/htdocs/bookmedik/schema.sql) en MySQL:
   ```sql
   CREATE DATABASE bookmedik;
   USE bookmedik;
   -- Ejecutar contenido de schema.sql
   ```
2. Configura los parámetros de conexión en `core/controller/Database.php` si tus credenciales cambian:
   - Host: `localhost`
   - Usuario: `root`
   - Contraseña: `""`
   - Base de Datos: `bookmedik`
3. Abre la aplicación en tu navegador:
   `http://localhost/bookmedik/`
4. Accede con las credenciales por defecto:
   - **Usuario**: `admin`
   - **Contraseña**: `admin`

---

## 📂 Estructura del Proyecto

```
bookmedik/
├── assets/                  # CSS, JS, imágenes y librerías (coreui, fullcalendar)
├── core/
│   ├── app/
│   │   ├── controller/      # Controladores de solicitudes HTTP
│   │   ├── model/           # Modelos de datos PDO (LbModel)
│   │   ├── service/         # Servicios de lógica de negocio
│   │   └── routes.php       # Definición modular de rutas
│   └── controller/          # Componentes base LegoBox v5 (Database, LbModel, Session)
├── fpdf/                    # Generador de documentos PDF
├── public/                  # Plantillas Twig 3 y Layout maestro CoreUI v5
├── vendor/                  # Dependencias Composer (Twig 3, FastRoute 1.3)
├── .htaccess                # Reescribidor URL para Front Controller
├── composer.json            # Configuración Composer & Autoload PSR-4
├── index.php                # Front Controller & Router Principal
└── schema.sql               # Esquema oficial de base de datos MySQL
```

---

### Versiones Anteriores

#### Versión 4.0
- Plantilla de Administración con CoreUI 4, Bootstrap 5 y LegoBox 4.
- Actualización de vistas de citas, pacientes, médicos, áreas y usuarios.
- Compatibilidad con PHP 8.

#### Versión 2.0
- Gestión de Pacientes y Médicos.
- Creación de Citas: Asunto, Paciente, Médico, Fecha, Hora, Síntomas, Medicamentos y Costo.
- Integración de Especialidades y Estatus de Pago.
- Reportes filtrados y búsqueda avanzada.

---

###  Desarrollado por [Evilnapsis](http://evilnapsis.com)