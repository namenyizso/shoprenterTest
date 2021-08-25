# Tesztfeladat - Shoprenter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Bevezetés
A feladat megoldásához MySQL adatbáziskezelőt és CodeIgniter 4 PHP keretrendszert használtam.

## Adatbázis
A projekt root mappába csatoltam az sql fájlt, de php spark cli paranccsal migráció is futtható. (php spark migrate)
Ehhez szükséges fájl megtalálható az app/Database/Migrations könyvtárban.

## API Használata
Ahogy a feladatban is megvolt adva, két endpoint használható:
- POST: secret (formData-val), létrehozza a secret text-et
- GET: secret/{hash}, lekérdezi a megadott Hash-el rendelkező secret adatait, amennyiben még van rá lehetőség.

## Készítette
Naményi Zsolt, shoprenter tesztfeladat révén.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
