xxx.kocal.fr
==============

Sources of [xxx.kocal.fr](https://xxx.kocal.fr), a web interface that display adult-content videos' metadata 
(from [pr0n_crawler](https://github.com/Kocal/pr0n_crawler)), made with Laravel framework.

Requirements
--------------

- Apache or nginx (https://laravel.com/docs/5.4#web-server-configuration),
- PHP 7.0+ (PHP 5.6+ should works too),
- MySQL 5.5+,
- A MySQL database created and filled by using [pr0n_crawler](https://github.com/Kocal/pr0n_crawler).

Installation
-------------

```bash
$ composer install
$ cp .env.example .env 
# Edit your .env with DB credentials
$ php artisan key:generate
```
### Laravel-shield

[laravel-shield](https://github.com/vinkla/laravel-shield#usage) is used to 
provide a quick and simple HTTP authentication that protect the administration
area (/admin).

You should generate a hashed username and password by using 
[`htpasswd`](https://tldr.ostera.io/htpasswd) command line tool or 
[`password_hash()`](https://secure.php.net/manual/en/function.password-hash.php) PHP function:

```bash
$ php -r 'echo password_hash("your-username", PASSWORD_DEFAULT);'
$ php -r 'echo password_hash("your-password", PASSWORD_DEFAULT);'
```

Then, edit your `.env` with previous values:

```
SHIELD_USER=your-hashed-user
SHIELD_PASSWORD=your-hashed-password
```
