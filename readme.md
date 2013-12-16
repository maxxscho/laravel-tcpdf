# Laravel TCPDF

A simple [Laravel 4](http://www.laravel.com) service provider with some basic configuration for including the [TCPDF library](http://www.tcpdf.org/)

## Installation

The Laravel TCPDF service provider can be installed via [composer](http://getcomposer.org) by requiring the `maxxscho/laravel-tcpdf` package in your project's `composer.json`. (The installation may take a while, because the package requires TCPDF. Sadly its .git folder is very heavy)

```json
{
    "require": {
        "maxxscho/laravel-tcpdf": "dev-master"
    }
}
```

Next, add the service provider to `app/config/app.php`.

```php
'providers' => [
    //..
    'Maxxscho\LaravelTcpdf\LaravelTcpdfServiceProvider',
]
```

That's it! You're good to go.

## Configuration

Laravel-TCPDF comes with some basic configuration.
If you want to override the defaults, you can publish the config, like so:

    php artisan config:publish maxxscho/laravel-tcpdf

Now access `app/config/packages/maxxscho/laravel-tcpdf/config.php`to customize.

## Assets

There is a 'blank' image in the assets folder of the package,
which is in certain circumstances needed by TCPDF.
Publish the assets, like so:

    php artisan asset:publish maxxscho/laravel-tcpdf

