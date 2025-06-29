@echo off
echo ================================
echo   MotorSpeed - Instalacion
echo ================================
echo.

echo Verificando si Composer esta instalado...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Composer no esta instalado.
    echo.
    echo Descarga Composer desde: https://getcomposer.org/download/
    echo.
    echo Alternativamente, puedes:
    echo 1. Descargar el proyecto completo con vendor/ incluido
    echo 2. O usar XAMPP/WAMP directamente sin Composer
    echo.
    pause
    exit /b 1
)

echo Composer encontrado! Instalando dependencias...
echo.

composer install

if %errorlevel% equ 0 (
    echo.
    echo ================================
    echo   Instalacion completada!
    echo ================================
    echo.
    echo Proximos pasos:
    echo 1. Configura tu base de datos en .env
    echo 2. Copia .env.example a .env si no existe
    echo 3. Accede a: http://localhost/modulo-2/public
    echo.
) else (
    echo.
    echo ERROR: Hubo un problema instalando las dependencias.
    echo.
)

pause
