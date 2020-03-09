<?php

namespace YogaCMS\UI\Components;

use Illuminate\View\Component;
use YogaCMS\UI\Settings as SettingsBuilder;

class Settings extends Component
{

    /**
     * Sidebar builder
     *
     */
    public $builder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->builder = SettingsBuilder::__init__();
    }

    /**
     * Get the view / contents that represent the component.
     *
     */
    public function render()
    {
        return view('admin::components.settings');
    }
}
