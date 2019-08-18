FROM php:7.3-fpm
# build-args defaults to a production image variant

ARG TIMEZONE
ENV TIMEZONE=$TIMEZONE
RUN ln -sf "/usr/share/zoneinfo/$TIMEZONE" /etc/localtime \
	&& DEBIAN_FRONTEND=noninteractive dpkg-reconfigure tzdata \
	&& DEBIAN_FRONTEND=noninteractive apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
		libicu-dev \
		libpq-dev \
		libzip-dev \
		unzip \
	&& docker-php-ext-install \
		intl \
		pgsql \
		pdo_pgsql \
		zip \
	&& docker-php-ext-enable \
		opcache \
	&& sed -e 's/access.log/;access.log/' -i /usr/local/etc/php-fpm.d/docker.conf \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
		&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer verification failed!'; } echo PHP_EOL;" \
		&& php composer-setup.php --filename=composer --install-dir=/usr/local/bin \
		&& php -r "unlink('composer-setup.php');"
COPY ./.docker/bin/wait-for-it /usr/local/bin/
COPY ./.docker/php.ini /usr/local/etc/php/

ARG IS_PROD_BUILD=true
ENV IS_PROD_BUILD=$IS_PROD_BUILD
RUN if [ "$IS_PROD_BUILD" != true ]; then \
		pecl install xdebug; \
		docker-php-ext-enable xdebug; \
	fi

# Prepare app workdir & tools, switch to unprivileged user
WORKDIR /app
RUN mkdir -p \
		public/bundles \
		var/cache \
		var/logs \
	&& chown -R www-data:www-data \
		/app \
	&& chown www-data:www-data \
		/var/www

USER www-data
RUN composer global require hirak/prestissimo

# Install app dependencies
ARG APP_DEBUG=0
ARG APP_ENV=prod
ENV APP_DEBUG=$APP_DEBUG \
	APP_ENV=$APP_ENV
COPY ./composer.json ./composer.lock ./
RUN composer install --no-autoloader --no-interaction --no-scripts --no-suggest \
	&& composer clearcache

# Copy app sources & initialize app
COPY ./bin ./bin/
COPY ./config ./config/
COPY ./migrations ./migrations/
COPY ./public ./public/
COPY ./src ./src/
COPY ./tests ./tests/
RUN composer dump-autoload --optimize
