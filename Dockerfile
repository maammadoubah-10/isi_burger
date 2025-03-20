# Étape 1 : Utiliser une image de base avec PHP et Apache
FROM php:8.2-apache

# Étape 2 : Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copier les fichiers du projet dans le conteneur
WORKDIR /var/www/html
COPY . .

# Étape 5 : Installer les dépendances Laravel
RUN composer install --no-dev --prefer-dist

# Étape 6 : Donner les permissions correctes au stockage et bootstrap
RUN chmod -R 777 storage bootstrap/cache

# Étape 7 : Exposer le port 80 pour le serveur Apache
EXPOSE 80

# Étape 8 : Lancer Apache au démarrage du conteneur
CMD ["apache2-foreground"]
