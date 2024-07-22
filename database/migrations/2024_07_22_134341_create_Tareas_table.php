<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('tarea_completada')->nullable();
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
        Schema::dropIfExists('Tareas');
    }
}
