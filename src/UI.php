<?php

namespace YogaCMS\UI;

use Encore\Admin\Extension;

class UI extends Extension
{
    /**
     * Library Name
     *
     */
    public $name = 'ui';

    /**
     * Views Folder
     *
     */
    public $views = __DIR__.'/../resources/views';

    /**
     * Assets Folder
     *
     */
    public $assets = __DIR__.'/../resources/assets';

    /**
     * Boot Menu Settings
     *
     */
    static function bootSettings()
    {
        $builder = Settings::__init__();
        $builder->addItem('Autenticação & Autorização');

        $builder->on('Autenticação & Autorização')->addItem('Níveis de acesso', [
            'icon' => 'fa-users',
            'description' => 'Níveis de acesso do sistema',
            'url' => 'auth/roles'
        ]);

        $builder->on('Autenticação & Autorização')->addItem('Permissões', [
            'icon' => 'fa-key',
            'description' => 'Permissões dos níveis de acesso dentro do sistema',
            'url' => 'auth/permissions'
        ]);

        $builder->on('Autenticação & Autorização')->addItem('Usuários', [
            'icon' => 'fa-user',
            'description' => 'Usuários com acesso ao painel administrativo',
            'url' => 'auth/users'
        ]);
    }

    /**
     * Boot Menu Basics
     *
     */
    static function bootMenu()
    {
        $builder = Sidebar::__init__();

        $builder->addItem('Plugins');

        $builder->on('Plugins')->addItem('Localização', [
            'icon' => 'map-outline'
        ]);
        
        $builder->on('Plugins')->on('Localização')->addItem('Estados', [
            'url' => 'estados',
            'activeLink' => 'admin/estados*'
        ]);

        $builder->on('Plugins')->on('Localização')->addItem('Cidades', [
            'url' => 'cidades',
            'activeLink' => 'admin/cidades*'
        ]);

        $builder->addFooterItem('Sair', [
            'icon' => 'power-outline',
            'url'  => 'auth/logout'
        ]);

        $builder->addFooterItem('Configurações', [
            'icon' => 'settings-outline',
            'url'  => 'settings'
        ]);
    }

    /**
     * Boot Yoga UI
     *
     */
    static function boot()
    {
        static::bootSettings();
        static::bootMenu();
        return parent::boot();
    }
}
