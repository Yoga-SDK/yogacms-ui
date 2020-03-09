<?php

namespace YogaCMS\UI\Models\Cidades;

use Illuminate\Database\Eloquent\Model;
use YogaCMS\UI\Models\Estados\Estado;

class Cidade extends Model
{
    /**
     * Table on database
     *
     */
    protected $table = 'cidades';

    /**
     * Relação com estado
     *
     */
    function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
