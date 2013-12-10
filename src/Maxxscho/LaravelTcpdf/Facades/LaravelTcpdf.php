<?php namespace Maxxscho\LaravelTcpdf\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelTcpdf extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'pdf';
    }

}