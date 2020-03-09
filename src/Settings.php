<?php

namespace YogaCMS\UI;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade
{

    protected static function  getFacadeAccessor()
    {
        return 'YogaCMS\UI\Builders\SettingsBuilder';
    }
}
