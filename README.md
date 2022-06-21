# PATH Demo Project

Create nginx image
docker build ./docker -t php73_nginx

Run docker with docker-compose.yml
docker-compose up -d

Change php version in image
update-alternative --config php

cd /var/www

in working directory
composer install