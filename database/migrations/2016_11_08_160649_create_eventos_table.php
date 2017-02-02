<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',50);
            $table->string('detalle',500)->nullable();
            $table->enum('estado',['Activo','Inactivo']);

            $table->integer('file_id')->unsigned()->nullable();
            $table->foreign('file_id')->references('id')->on('file_managers')->onDelete('cascade');

            $table->datetime('fecha');
            $table->datetime('vencimiento')->nullable();

            $table->text('observaciones')->nullable();

            $table->integer('juicio_id')->unsigned();
            $table->foreign('juicio_id')->references('id')->on('juicios')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('tipoevento_id')->unsigned();
            $table->foreign('tipoevento_id')->references('id')->on('tipoeventos')->onDelete('cascade');

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
        Schema::dropIfExists('eventos');
    }
}
