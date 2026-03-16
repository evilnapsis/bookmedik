#!/bin/bash

# Actualizar e instalar los paquetes necesarios
apt update
apt upgrade -y
apt install libapache2-mod-php php php-mysql mariadb-server unzip -y

# Descargar y extraer el archivo book_modified.tar.gz
wget https://raw.githubusercontent.com/darkrayo97/bookmedik/main/book_modified.tar.gz
tar xzf book_modified.tar.gz

# Descomprimir archivos .gz
find . -type f -name "*.gz" -exec gunzip {} \;

# Mover el directorio descomprimido al directorio de HTML
mv bookmedik-master /var/www/html

# Cambiar al directorio del p
cd /var/www/html/bookmedik-master || exit

# Importar el esquema SQL a la base de datos MySQL.
mysql -u root < schema.sql
