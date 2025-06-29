#!/bin/bash
echo "================================"
echo "   MotorSpeed - Instalación"
echo "================================"
echo

echo "Verificando si Composer está instalado..."
if ! command -v composer &> /dev/null; then
    echo "ERROR: Composer no está instalado."
    echo
    echo "Instala Composer desde: https://getcomposer.org/download/"
    echo
    echo "En Ubuntu/Debian: sudo apt install composer"
    echo "En macOS: brew install composer"
    echo
    exit 1
fi

echo "Composer encontrado! Instalando dependencias..."
echo

composer install

if [ $? -eq 0 ]; then
    echo
    echo "================================"
    echo "   Instalación completada!"
    echo "================================"
    echo
    echo "Próximos pasos:"
    echo "1. Configura tu base de datos en .env"
    echo "2. Copia .env.example a .env si no existe"
    echo "3. Ejecuta: php spark serve"
    echo "4. Accede a: http://localhost:8080"
    echo
else
    echo
    echo "ERROR: Hubo un problema instalando las dependencias."
    echo
fi
