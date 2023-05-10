<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellidos',200);
            $table->string('documento',8);
            $table->string('email',50);
            $table->string('telefono',15);
            $table->string('direccion',150);
            $table->date('fecha_nacimiento');
            $table->integer('compras')->default(0);;
            $table->boolean('estado')->default(0);
            $table->dateTime('ultima_compra')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
