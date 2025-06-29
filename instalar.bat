@echo off
echo ================================
echo   MotorSpeed - Instalacion
echo ================================
echo.

echo Verificando si existe vendor corrupto...
if exist vendor (
    echo Eliminando vendor corrupto...
    rmdir /s /q vendor
    echo Vendor eliminado.
    echo.
)

echo Verificando si Composer esta instalado...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Composer no esta instalado.
    echo.
    echo *** SOLUCION RAPIDA ***
    echo 1. Descarga Composer desde: https://getcomposer.org/download/
    echo 2. Ejecuta este script nuevamente
    echo.
    echo *** PARA EVALUADORES ***
    echo Si solo necesitas revisar el codigo, puedes:
    echo - Ver los archivos directamente en el repositorio
    echo - Instalar Composer (5 minutos) para ver funcionando
    echo.
    pause
    exit /b 1
)

echo Composer encontrado! Instalando dependencias...
echo.

composer install --no-dev --optimize-autoloader

if %errorlevel% equ 0 (
    echo.
    echo ================================
    echo   Instalacion completada!
    echo ================================
    echo.
    echo El proyecto esta listo para usar:
    echo.
    echo *** XAMPP/WAMP ***
    echo URL: http://localhost/modulo-2/public
    echo.
    echo *** Servidor de desarrollo ***
    echo Ejecuta: php spark serve
    echo URL: http://localhost:8080
    echo.
    echo *** Base de datos ***
    echo 1. Configura .env con tus credenciales
    echo 2. Importa la base de datos si tienes un dump
    echo.
) else (
    echo.
    echo ERROR: Hubo un problema instalando las dependencias.
    echo Intenta ejecutar manualmente: composer install
    echo.
)

pause
