#Laravel 5 WebArtisan

A package for Laravel 5 to interact with the CLI

Inspired by [oly-ir/web-artisan](https://github.com/Oly-ir/web-artisan)

[![Build Status](https://travis-ci.org/JN-Jones/web-artisan.png?branch=l5)](https://travis-ci.org/JN-Jones/web-artisan)
[![Latest Stable Version](https://poser.pugx.org/jones/web-artisan/v/stable.png)](https://packagist.org/packages/jones/web-artisan)
[![Total Downloads](https://poser.pugx.org/jones/web-artisan/downloads.png)](https://packagist.org/packages/jones/web-artisan)
[![Latest Unstable Version](https://poser.pugx.org/jones/web-artisan/v/unstable.png)](https://packagist.org/packages/jones/web-artisan)

If anyone has any ideas on how to make this framework agnostic, please contact me or open a pull request.

##Installation

Add `jones/web-artisan` as a requirement to `composer.json`:

```javascript
{
    ...
    "require": {
        ...
        "jones/web-artisan": "dev-l5"
        ...
    },
}
```

Update composer:

```
$ php composer.phar update
```

Add the provider to your `config/app.php`:

```php
'providers' => array(

    ...
    'Jones\WebArtisan\WebArtisanServiceProvider',

),
```

Publish package assets:

```
$ php artisan vendor:publish
```

##Configuration

 * `enable`: Enable WebArtisan
 * `base_url`: Here you can select under which url WebArtisan is accessable
 * `password`: Select a password to interact with WebArtisan
 * `ips`: An Array with IP's which can access WebArtisan
 * `auth_filter`: If you want to protect WebArtisan with a filter, you can enter the name of it here