#!/bin/bash

# Define a porta padrão do Railway ou 8080
PORT_NUMBER=${PORT:-8080}

echo "Iniciando PHP na porta $PORT_NUMBER..."

# O parâmetro -d display_errors=Off impede que avisos quebrem os headers
php -d display_errors=Off -S 0.0.0.0:$PORT_NUMBER -t public
