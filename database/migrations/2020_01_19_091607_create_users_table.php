<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('fullname', 100);
			$table->string('username', 100);
			$table->string('password', 100);
			$table->string('dob', 100)->nullable();
			$table->string('gender', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('picture', 250)->nullable()->default('user.jpg');
			$table->string('account_name', 100)->nullable();
			$table->string('account_number', 100)->nullable();
			$table->string('account_type', 100)->nullable();
			$table->string('remember_token')->nullable();
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
		Schema::drop('users');
	}

}
