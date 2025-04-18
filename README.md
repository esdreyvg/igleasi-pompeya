
# 🕊️ Sistema de Administración Parroquial

Este sistema permite gestionar de manera eficiente los aspectos administrativos de una **iglesia católica**, incluyendo sacramentos, eventos/misas, cursos y próximamente más módulos. Está desarrollado en **PHP puro**, sin frameworks, utilizando la **arquitectura de 3 capas** (Presentación, Lógica de Negocio, Acceso a Datos).

---

## 📦 Estructura del Proyecto

```
/presentacion/       # Interfaz de usuario (formularios, tablas, etc.)
/logica/             # Lógica de negocio y validaciones
/datos/              # Acceso a la base de datos (DAO)
/modelos/            # Modelos de entidad (POPOs)
/conexion/           # Clase de conexión PDO
index.php            # Página principal del sistema
README.md            # Este archivo
```

---

## ✅ Funcionalidades Actuales

### 1. 🎉 Sacramentos
- Registrar sacramentos recibidos por los feligreses
- Editar, eliminar o listar sacramentos por persona
- Campos: tipo, fecha, lugar, ministro

### 2. ⛪ Eventos
- Crear y gestionar eventos como misas, retiros, celebraciones
- Campos: nombre, fecha, hora, lugar, descripción

### 3. 📚 Cursos
- Crear cursos para formación cristiana (Primera Comunión, padres, adolescentes, etc.)
- Campos: título, descripción, público objetivo, fecha de inicio/fin, cupos

---

## 🛠️ Instalación

### Opción 1: XAMPP

1. Clona o descarga este repositorio dentro de la carpeta `htdocs` de XAMPP.
2. Asegúrate de que Apache y MySQL estén activos desde el panel de control de XAMPP.
3. Crea una base de datos MySQL (ej: `iglesia_db`) usando phpMyAdmin.
4. Importa los archivos `.sql` correspondientes.
5. Edita `/conexion/Conexion.php` para usar tus credenciales de MySQL:

```php
$host = "localhost";
$db = "iglesia_db";
$user = "root";
$pass = "";
```

6. Accede al sistema en tu navegador:
```
http://localhost/iglesia-admin/index.php
```

### Opción 2: Docker

1. Crea un archivo `docker-compose.yml` como este:

```yaml
version: '3.8'
services:
  web:
    image: php:8.1-apache
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html/
  db:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: iglesia_db
    ports:
      - "3306:3306"
```

2. Ejecuta:
```bash
docker-compose up -d
```

3. Accede a `http://localhost:8080` para ver la aplicación.

---

## ✨ Tecnologías

- PHP puro (sin frameworks)
- MySQL
- HTML y formularios simples
- Arquitectura MVC simplificada en 3 capas

---

## 🚀 Próximas funcionalidades sugeridas

- Gestión de feligreses y usuarios
- Inscripción de feligreses a cursos
- Registro de asistencia
- Reportes imprimibles
- Certificados sacramentales automáticos
- Control de usuarios con login y permisos

---

## 🤝 Contribución

¿Te interesa mejorar el sistema? ¡Genial! Puedes ayudar:

1. Clonando el repo
2. Creando una nueva rama
3. Enviando un Pull Request con tu mejora

---

## 🪪 Licencia

Este sistema es de uso libre y puede ser adaptado por cualquier parroquia o institución sin fines de lucro.

---

Desarrollado con 🙏 y ❤️ para apoyar la misión de la Iglesia.