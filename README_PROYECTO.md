# MotorSpeed - Sistema Web

Sistema web desarrollado con CodeIgniter 4 para la gestión de usuarios y autenticación.

## 🚀 Características

- Sistema de autenticación completo (login, registro, recuperación de contraseña)
- Gestión de perfiles de usuario
- Panel de administración
- Diseño responsive con Bootstrap
- Protección CSRF y validaciones
- Sistema de roles (Usuario/Administrador)

## 📋 Requisitos

- PHP 8.0 o superior
- Composer
- Servidor web (Apache/Nginx)
- Base de datos MySQL

## 🛠️ Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/TU_USUARIO/TU_REPOSITORIO.git
cd modulo-2
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar base de datos
1. Crear una base de datos MySQL
2. Copiar `.env.example` a `.env` (si no existe, crear el archivo)
3. Configurar las credenciales de la base de datos en `.env`:
```
database.default.hostname = localhost
database.default.database = tu_base_de_datos
database.default.username = tu_usuario
database.default.password = tu_contraseña
database.default.DBDriver = MySQLi
```

### 4. Configurar servidor
#### Con XAMPP/WAMP:
- Copiar el proyecto a `htdocs/`
- Acceder a `http://localhost/modulo-2/public`

#### Servidor de desarrollo de CodeIgniter:
```bash
php spark serve
```
Acceder a `http://localhost:8080`

## 📁 Estructura del Proyecto

```
modulo-2/
├── app/
│   ├── Controllers/
│   │   ├── Home.php
│   │   ├── LoginController.php
│   │   └── UsuarioController.php
│   ├── Models/
│   │   └── UsuariosModel.php
│   ├── Views/
│   │   ├── Layout/
│   │   ├── PROT3-612951/
│   │   └── usuarios/
│   └── Config/
├── public/
│   ├── css/
│   ├── js/
│   └── img/
└── writable/
```

## 🎯 Funcionalidades

### Autenticación
- **Login**: `/login`
- **Registro**: `/registrarse`
- **Recuperar contraseña**: `/formularioRecuperacion`
- **Cerrar sesión**: `/cerrarSesion`

### Gestión de Usuario
- **Perfil**: `/PROT3-612951/inicioSesion`
- **Modificar datos**: `/modificar-usuario`
- **Eliminar cuenta**: `/eliminar-cuenta`

### Administración
- **Panel admin**: `/admin`

## 🔧 Configuración de Email

Para el sistema de recuperación de contraseñas, configurar en `.env`:
```
email.protocol = smtp
email.SMTPHost = tu_servidor_smtp
email.SMTPUser = tu_email
email.SMTPPass = tu_contraseña
email.SMTPPort = 587
```

## 🎨 Tecnologías Utilizadas

- **Backend**: CodeIgniter 4
- **Frontend**: Bootstrap 5
- **Base de datos**: MySQL
- **Autenticación**: Sesiones PHP
- **Email**: CodeIgniter Email Library

## 👥 Uso

1. **Registro**: Los usuarios pueden registrarse con email
2. **Activación**: Se envía email de activación
3. **Login**: Acceso con email/usuario y contraseña
4. **Recuperación**: Sistema de reseteo por email
5. **Gestión**: Modificar perfil y eliminar cuenta

## 🔒 Seguridad

- Protección CSRF en formularios
- Validación de datos del servidor
- Contraseñas hasheadas con `password_hash()`
- Tokens de activación y recuperación
- Protección de rutas según roles

## 📝 Notas de Desarrollo

- **Migración realizada**: Sistema de autenticación separado en `LoginController`
- **Vistas migradas**: De `PROT2-612951` a `PROT3-612951`
- **Estilos**: Diseño negro consistente en toda la aplicación
- **Responsivo**: Compatible con dispositivos móviles

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama de feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.
