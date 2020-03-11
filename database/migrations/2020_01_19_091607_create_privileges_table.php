<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrivilegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privileges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id');
			$table->integer('createUser')->default(0);
			$table->integer('updateUser')->default(0);
			$table->integer('deleteUser')->default(0);
			$table->integer('hospitalAccountPercentage')->default(0);
			$table->integer('managementAccountPercentage')->default(0);
			$table->integer('foresightAccountPercentage')->default(0);
			$table->integer('kalifaAccountPercentage')->default(0);
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
		Schema::drop('privileges');
	}

}
