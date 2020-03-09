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

        $builder->on('autenticacao-and-autorizacao')->addItem('Níveis de acesso', [
            'icon' => 'fa-users',
            'description' => 'Níveis de acesso do sistema',
            'url' => 'auth/roles'
        ]);

        $builder->on('autenticacao-and-autorizacao')->addItem('Permissões', [
            'icon' => 'fa-key',
            'description' => 'Permissões dos níveis de acesso dentro do sistema',
            'url' => 'auth/permissions'
        ]);

        $builder->on('autenticacao-and-autorizacao')->addItem('Usuários', [
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

        $builder->on('plugins')->addItem('Localização', [
            'icon' => 'map-outline'
        ]);
        
        $builder->on('plugins')->on('localizacao')->addItem('Estados', [
            'url' => 'estados',
            'activeLink' => 'admin/estados*'
        ]);

        $builder->on('plugins')->on('localizacao')->addItem('Cidades', [
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
