# Path Demo Project

Bu demo projesi Path Product & Software House için Serkan Çelik tarafından yapılmışmır. Symfony 5.4 üzerine kurulu JWT Token ve Orders Entity den oluşmaktadır. Amaç 3 müşteri ve müşteri siparişleri arasındaki kurguyu API üzerine olarak challenge hazırlanmıştır.

## Hızlı Bakış

* [Kurulum](#kurulum)
* [Kullanım](#kullanım)

## Kurulum

Kurulum için  bilgisayarınızda docker kurulu olmalıdırcomposer kullanmanız gerekmektedir. Docker'a sahip değilseniz windows için [Buradan](https://www.docker.com/) indirebilirsiniz.

Öncelikle  proje dizinimize gidip docker imajımızı (PHP 7.3 ve nginx) oluşturmamız gerekmektedir.

```shell script

docker build ./docker -t php73_nginx

```

Docker imaj dosyamızı ayağa kaldıralım.

```shell script

docker-compose up -d

```

Böylelikle containerlarımız ayağa kalkmış oldu. php73_nginx containerimizin içine girip composer i calıştırılım.;

```shell script
docker exec -it XX(CONTAINER ID ilk iki harf) bash
cd /var/www
composer install

```

## Kullanım

API Endpointleri


| Endpoint         | Method | Açıklama                                  |
| ------------------ | -------- | --------------------------------------------- |
| /api/login_check | POST   | JWT token için kullanılır.             |
| /api/orders      | GET    | Tüm siparişleri listeler. |
| /api/orders/{order} | GET   | Bir siparişin detaylarını gösterir  |
| /api/orders       | POST  | Yeni bir sipariş oluşturur.   |   
| /api/orders/{order} | PUT | Siparişi günceller. |
