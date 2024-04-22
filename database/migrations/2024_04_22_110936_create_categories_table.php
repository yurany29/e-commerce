<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name')->unique();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	public function down()
	{
		Schema::dropIfExists('categories');
	}
};
