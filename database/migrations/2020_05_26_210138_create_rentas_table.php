<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->id();
            $table->datetime('acceso');                        
            $table->datetime('salida')->nullable();

            $table->string('placa',25)->nullable();
            $table->string('modelo',12)->nullable();
            $table->string('marca',18)->nullable();
            $table->string('color',15)->nullable();

            $table->enum('llaves',['NO','SI'])->default('NO');
            $table->decimal('total',10,2)->default(0);
            $table->decimal('efectivo',10,2)->default(0);
            $table->decimal('cambio',10,2)->default(0);

            $table->unsignedBigInteger('user_id');        
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('vehiculo_id')->nullable();        
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->unsignedBigInteger('tarifa_id')->nullable();        
            $table->foreign('tarifa_id')->references('id')->on('tarifas');

            $table->string('barcode',50)->nullable();
            $table->enum('estatus',['ABIERTO','CERRADO'])->default('ABIERTO');

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
        Schema::dropIfExists('rentas');
    }
}
