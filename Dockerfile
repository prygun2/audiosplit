FROM php:7.4-fpm

ARG user
ARG uid
WORKDIR /var/www/html
COPY . .
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions zip bcmath gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y zip unzip && rm -rf /var/lib/apt/lists/*

#RUN composer init -y
#RUN find . -type d -exec chmod 775 {} +
#RUN find . -type f -exec chmod 664 {} +
#RUN chown -R www-data *

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user
