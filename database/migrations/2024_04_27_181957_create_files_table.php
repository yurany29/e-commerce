<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('fileable_id')->unsigned(); //id del modelo
			$table->string('fileable_type'); //modelo con el que se relaciona
			$table->string('route'); //ruta don de se almacen alas imagenes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
