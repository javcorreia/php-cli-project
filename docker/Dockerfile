FROM php:8.1-cli

# specify bash as main shell for commands
SHELL ["/bin/bash", "-c"]

# INSTALL COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

# INSTALL PHP ZIP EXTENSION
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get -q -y install git unzip zlib1g-dev libzip-dev \
    && docker-php-ext-install zip \
    && apt-get clean

# bachrc file with some alias
COPY ./.bashrc /.bashrc

# source it
RUN source /.bashrc

WORKDIR /app
