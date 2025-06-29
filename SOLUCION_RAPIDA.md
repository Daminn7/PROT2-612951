# 🚨 SOLUCIÓN RÁPIDA - Error de vendor

## ❌ **Error común:**
```
Failed to open stream: No such file or directory in vendor/composer/autoload_real.php
```

## ✅ **Solución en 2 pasos:**

### **Windows:**
1. Abrir terminal en la carpeta del proyecto
2. Ejecutar: `instalar.bat`

### **Manual:**
1. Eliminar carpeta `vendor` (si existe)
2. Ejecutar: `composer install`

### **Sin Composer:**
1. Descargar desde: https://getcomposer.org/download/
2. Instalar Composer (5 minutos)
3. Ejecutar: `composer install`

## 🎯 **¿Por qué pasa esto?**

La carpeta `vendor` contiene dependencias que pueden corromperse al:
- Comprimir/descomprimir archivos
- Transferir entre diferentes sistemas operativos
- Subir/bajar de repositorios Git

## 📱 **Después de la instalación:**

- **URL**: http://localhost/NOMBRE_PROYECTO/public
- **Admin**: Configurar en base de datos
- **Email**: Configurar SMTP en .env (opcional)

---
**⏱️ Tiempo total de solución: 2-5 minutos**
