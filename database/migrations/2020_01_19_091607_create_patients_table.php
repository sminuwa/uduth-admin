<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('uid', 100);
			$table->string('name', 100)->nullable();
			$table->string('age', 100)->nullable();
			$table->string('gender', 100)->nullable();
			$table->string('address', 100)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('companion', 100)->nullable();
			$table->string('hospital_referral_name', 100)->nullable();
			$table->string('referral_letter', 250)->nullable();
			$table->string('patient_type')->nullable();
			$table->string('file_no', 100)->nullable();
			$table->integer('sync_status', 100)->default(0);
			$table->integer('user_id');
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
		Schema::drop('patients');
	}

}
