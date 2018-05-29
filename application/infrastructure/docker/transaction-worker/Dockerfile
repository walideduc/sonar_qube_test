FROM php:7.2.0-cli

RUN apt-get update \
 && apt-get install \
 libcurl4-openssl-dev libssl-dev pkg-config cron -y

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN mkdir -p /var/www/html
ADD  . /var/www/html
WORKDIR /var/www/html

ADD infrastructure/docker/transaction-worker/etc/environment /etc/environment

ADD infrastructure/docker/transaction-worker/crontab /etc/cron.d/transaction-worker-cron
RUN chmod 0644 /etc/cron.d/transaction-worker-cron
RUN /usr/bin/crontab -u root /etc/cron.d/transaction-worker-cron
CMD cron -f