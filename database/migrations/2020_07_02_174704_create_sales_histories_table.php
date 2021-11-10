<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_histories', function (Blueprint $table) {
            $table->increments('shistory_id');
            $table->integer('workplace_id')->unsigned();
            $table->date('shistory_date')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_smc')->nullable();
            $table->text('shistory_memo')->nullable();
            $table->integer('remind_year')->nullable();
            $table->integer('remind_month')->nullable();
            $table->string('remind_day')->nullable();
            $table->string('remind_memo')->nullable();
            $table->boolean('done_flag')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('device')->nullable();
            $table->timestamps();

            /**
             * Set primary key to a column
             */
            // $table->primary(['shistory_id', 'workplace_id']);

            /**
             * Add foreign key constraints to columns
             */
            $table->foreign('workplace_id')->references('workplace_id')->on('workplaces');

            /**
             * Add soft deletes
             */
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_histories');
    }
}
