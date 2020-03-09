<?php

namespace YogaCMS\UI;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Admin;

class UIServiceProvider extends ServiceProvider
{

    /**
     * Load Components
     *
     */
    private function __loadComponents()
    {
        Blade::component(Components\Settings::class, 'admin-settings');
        Blade::component(Components\Sidebar::class, 'admin-sidebar');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(UI $extension)
    {
        if (! UI::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'ui');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/yogacms/ui')],
                'ui'
            );
        }

        $this->loadMigrationsFrom([__DIR__.'/../database/migrations']);

        $this->app->view->prependNamespace('admin', __DIR__.'/../resources/views');

        $this->app->booted(function () {
            UI::routes(__DIR__.'/../routes/web.php');
        });

        $this->app->singleton('YogaCMS\UI\Builders\SidebarBuilder', function($app) {
            return new \YogaCMS\UI\Builders\SidebarBuilder();
        });

        $this->app->singleton('YogaCMS\UI\Builders\SettingsBuilder', function($app) {
            return new \YogaCMS\UI\Builders\SettingsBuilder();
        });

        $this->__loadComponents();
    }
}
