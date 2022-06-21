#!/bin/sh
export HOME="/root"
exec /etc/init.d/php7.3-fpm start > /dev/null 2>&1
