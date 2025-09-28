FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
  libpng-dev \
  libjpeg-dev \
  libfreetype-dev \
  libzip-dev \
  libicu-dev \
  libxml2-dev \
  libssl-dev \
  zip \
  unzip \
  git \
  curl \
  bash \
  gcc \
  g++ \
  make \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
  --with-freetype \
  --with-jpeg \
  && docker-php-ext-install \
  gd \
  zip \
  intl \
  pdo \
  pdo_mysql \
  mysqli \
  xml \
  opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/project

RUN mkdir -p /var/www/html/storage/property-images
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

RUN mkdir -p /var/www/project/.docker
