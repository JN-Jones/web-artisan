#Laravel 4 WebArtisan

A package for Laravel 4 to interact with the CLI

This is a port from [oly-ir/web-artisan](https://github.com/Oly-ir/web-artisan)
[![Build Status](https://travis-ci.org/JN-Jones/web-artisan.png?branch=master)](https://travis-ci.org/JN-Jones/web-artisan)

If anyone has any ideas on how to make this framework agnostic, please contact me or open a pull request.

##Installation

Add `jones/web-artisan` as a requirement to `composer.json`:

```javascript
{
    ...
    "require": {
        ...
        "jones/web-artisan": "dev-master"
        ...
    },
}
```

Update composer:

```
$ php composer.phar update
```

Add the provider to your `app/config/app.php`:

```php
'providers' => array(

    ...
    'Jones\WebArtisan\WebArtisanServiceProvider',

),
```

Publish package assets:

```
$ php artisan asset:publish jones/web-artisan
```

(Optional) Publish package config:

```
$ php artisan config:publish jones/web-artisan
```

##Configuration

 * `enable`: Enable WebArtisan
 * `base_url`: Here you can select under which url WebArtisan is accessable
 * `password`: Select a password to interact with WebArtisan
 * `ips`: An Array with IP's which can access WebArtisan
 * `auth_filter`: If you want to protect WebArtisan with a filter, you can enter the name of it here