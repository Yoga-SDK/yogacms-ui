<?php

use YogaCMS\UI\Http\Controllers\SettingsController;
use YogaCMS\UI\Http\Controllers\EstadosController;
use YogaCMS\UI\Http\Controllers\CidadesController;

Route::get('settings', SettingsController::class.'@index');
Route::resource('estados', EstadosController::class);
Route::resource('cidades', CidadesController::class);
