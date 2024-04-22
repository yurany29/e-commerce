<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('category_id');
			$table->string('name');
			$table->string('price');
			$table->string('description');
			$table->integer('stock');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('products');
	}
};
