<?php

namespace YogaCMS\UI\Models\Estados;

use Illuminate\Database\Eloquent\Model;
use YogaCMS\UI\Models\Cidades\Cidade;

class Estado extends Model
{
    /**
     * Table on database
     *
     */
    protected $table = 'estados';

    /**
     * Cidades deste estado
     *
     */
    function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
}
