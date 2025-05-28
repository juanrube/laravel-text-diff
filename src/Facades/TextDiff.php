<?php

namespace Juanrube\TextDiff\Facades;

use Illuminate\Support\Facades\Facade;

class TextDiff extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'textdiff';
    }
}