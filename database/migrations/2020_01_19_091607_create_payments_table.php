<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('patient_id');
            $table->integer('service_id');
            $table->string('service_type');
            $table->string('service_amount');
			$table->string('payment_type');
			$table->string('payment_status');
			$table->integer('user_id');
			$table->integer('receipt_no')->nullable();
			$table->integer('sync_status')->default(0);
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
		Schema::drop('payments');
	}

}
