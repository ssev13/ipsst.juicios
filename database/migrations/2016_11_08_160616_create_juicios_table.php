<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juicios', function (Blueprint $table) {
            $table->increments('id');

            $table->string('causa',200);
            $table->string('expediente',200)->unique();
            $table->string('expteipsst',200)->nullable();
            $table->string('descripcion',200);
            $table->string('observaciones',500)->nullable();

            $table->dateTime('fecha')->nullable();
            $table->dateTime('vencimiento')->nullable();

            $table->string('cuil',20)->nullable();
            $table->string('causante',100)->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('juzgado_id')->unsigned();
            $table->foreign('juzgado_id')->references('id')->on('juzgados')->onDelete('cascade');

            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');

            $table->integer('sentencia_id')->unsigned();
            $table->foreign('sentencia_id')->references('id')->on('sentencias')->onDelete('cascade');

            $table->integer('objeto_id')->unsigned();
            $table->foreign('objeto_id')->references('id')->on('objetos')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('juicios');
    }
}
