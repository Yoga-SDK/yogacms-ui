<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estado_id')
                  ->unsigned()
                  ->references('id')
                  ->on('estados')
                  ->onDelete('cascade');
            $table->string('nome');
            $table->integer('ibge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades');
    }
}
