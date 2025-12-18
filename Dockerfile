FROM php:8.5-apache

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer mod_rewrite
RUN a2enmod rewrite

# Dire à Apache que le DocumentRoot est /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Mettre à jour toutes les configs Apache
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
  /etc/apache2/sites-available/*.conf \
  /etc/apache2/apache2.conf \
  /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Copier le projet
COPY . /var/www/html

# Droits corrects
RUN chown -R www-data:www-data /var/www/html