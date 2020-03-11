<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('uid', 100);
			$table->string('name', 100);
			$table->date('dob')->nullable();
			$table->string('gender', 100);
			$table->string('email', 100);
			$table->string('phone', 100);
			$table->string('address', 250)->nullable();
			$table->string('experience', 100)->nullable();
			$table->string('specialisation', 100)->nullable();
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
		Schema::drop('doctors');
	}

}
