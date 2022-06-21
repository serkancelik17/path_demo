FROM 		phusion/baseimage:master

VOLUME ["/var/www"]

EXPOSE 80
EXPOSE 443

ENV HOME /root

s
RUN apt-get dist-upgrade
RUN apt-get update
RUN apt-get install -y language-pack-en
ENV LANGUAGE en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8
RUN locale-gen en_US.UTF-8
RUN dpkg-reconfigure locales

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get install -y software-properties-common
# install curl, wget
RUN apt-get install -y curl wget imagemagick

# Configure repos
RUN add-apt-repository -y ppa:nginx/stable
RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN apt-get install php-mysql

RUN apt install -y netcat
RUN apt-get install -y nginx net-tools php7.3-dev php-pear php7.3-fpm php7.3-mysql php7.3-xdebug php7.3-xml php7.3-curl php7.3-gd php7.3-json php7.3-cli php7.3-curl php7.3-soap php7.3-intl php7.3-bcmath php7.3-mbstring php7.3-zip
RUN apt-get -y install gcc make autoconf libc-dev pkg-config
RUN apt-get -y install zlib1g-dev
RUN apt-get -y install libmemcached-dev
RUN apt-get -y install memcached unzip php-memcached php7.3-memcache php7.3-memcached
RUN apt-get -y install git
RUN apt-get -y install fish
RUN apt-get -y install mc
RUN apt-get -y install nano
RUN apt-get update
RUN apt-get install -y nodejs npm


COPY ./etc/php/7.3/mods-available/xdebug.ini "${PHP_INI_DIR}/conf.d"
RUN git config --global user.email "serkancelik1734@gmail.com"
RUN git config --global user.name "Serkan Celik"
RUN chown -R 1000:www-data /var/www

# Install screen
RUN apt-get install -y

RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.3/fpm/php-fpm.conf
RUN sed -i -e "s/short_open_tag = Off/short_open_tag = On/g" /etc/php/7.3/fpm/php.ini

# Tell Nginx to stay foregrounded
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Configure php for nginx
RUN echo "display_errors = 1;" >> /etc/php/7.3/fpm/php.ini
RUN echo "cgi.fix_pathinfo = 0;" >> /etc/php/7.3/fpm/php.ini
RUN echo "max_input_vars = 10000;" >> /etc/php/7.3/fpm/php.ini
RUN echo "date.timezone = Europe/Istanbul;" >> etc/php/7.3/fpm/php.ini
RUN echo "extension=memcache.so;" >> etc/php/7.3/fpm/php.ini
RUN mkdir /tmp/xdebug
RUN export PHP_IDE_CONFIG="serverName=localhost"

RUN chown -R www-data:www-data /var/www
WORKDIR /root


RUN rm -rf /usr/share/nginx/html/

RUN rm -rf /var/www/*

COPY etc /etc

ADD nginx.sh /etc/service/nginx/run
ADD php7.3-fpm.sh /etc/service/php7.3-fpm/run
RUN chmod a+x /etc/service/nginx/run
RUN chmod a+x /etc/service/php7.3-fpm/run
RUN apt-get autoremove -y
RUN apt-get clean -y
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

RUN touch /var/log/nginx/project_error.log
RUN touch /var/log/nginx/project_access.log