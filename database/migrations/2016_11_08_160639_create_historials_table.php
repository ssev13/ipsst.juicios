<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',50);
            $table->string('detalle',500);
            $table->enum('estado',['Activo','Inactivo']);

            $table->datetime('fecha');
            $table->string('tipo');

            $table->string('observaciones',500)->nullable();
            
            $table->integer('juicio_id')->unsigned();
            $table->foreign('juicio_id')->references('id')->on('juicios')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('historials');
    }
}
