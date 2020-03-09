<?php

namespace YogaCMS\UI;

use Illuminate\Support\Facades\Facade;

class Sidebar extends Facade
{

    protected static function  getFacadeAccessor()
    {
        return 'YogaCMS\UI\Builders\SidebarBuilder';
    }
}
