# Laravel TCPDF

[![Build Status](https://travis-ci.org/maxxscho/laravel-tcpdf.png?branch=master)](https://travis-ci.org/maxxscho/laravel-tcpdf)

A simple [Laravel 4](http://www.laravel.com) service provider with some basic configuration for including the [TCPDF library](http://www.tcpdf.org/)

## Installation

The Laravel TCPDF service provider can be installed via [composer](http://getcomposer.org) by requiring the `maxxscho/laravel-tcpdf` package in your project's `composer.json`. (The installation may take a while, because the package requires TCPDF. Sadly its .git folder is very heavy)

```json
{
    "require": {
        "maxxscho/laravel-tcpdf": "0.*"
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

Here is a little example:

```php
PDF::SetTitle('Hello World');

PDF::AddPage();

PDF::Write(0, 'Hello World');

PDF::Output('hello_world.pdf');
```
For a list of all available function take a look at the [TCPDF Documentation](http://www.tcpdf.org/doc/code/classTCPDF.html)

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

## Extend/Overwrite

Extending or overwriting Laravel TCPDF is easy. Simply extend `\Maxxscho\LaravelTcpdf\LaravelTcpdf` with your own class.

## Custom Fonts

To add custom fonts set the fonts_directory in the config, relative to the public path. For example `'fonts/'`.
You have to convert a font for TCPDF.

Copy your custom font(s) to your fonts path, in our case `public/fonts/`.
In your terminal do this:

```
vendor/maxxscho/laravel-tcpdf/vendor/tecnick.com/tcpdf/tools/tcpdf_addfont.php -i public/fonts/yourfont.ttf -o public/fonts
```

This uses a little tool provided by TCPDF to convert fonts for TCPDF.
The `-i` flag is for the input fonts (comma-separated list)
and the `-o` flag is for the output directory.
Read here all about [TCPDF fonts](http://www.tcpdf.org/fonts.php) and how to convert them [the new way](http://queirozf.com/entries/adding-a-custom-font-to-tcpdf).
