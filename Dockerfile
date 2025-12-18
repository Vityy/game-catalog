FROM php:8.5-apache
 
# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql
 
# Activer mod_rewrite (utile pour plus tard)
RUN a2enmod rewrite
 
# Définir le dossier public
WORKDIR /var/www/html
 
# Copier le projet dans le container
COPY . /var/www/html
 
# Droits (important sous Windows)
RUN chown -R www-data:www-data /var/www/html