<?php

namespace YogaCMS\UI\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Configurações')
            ->description('configurações da plataforma')
            ->body(view('ui::pages.settings'));
    }
}
