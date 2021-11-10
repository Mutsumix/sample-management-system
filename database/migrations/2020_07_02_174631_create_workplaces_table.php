<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplaces', function (Blueprint $table) {
            $table->increments('workplace_id');
            $table->integer('client_id');
            $table->integer('employee_id');
            $table->string('workplace')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('station')->nullable();
            $table->time('commuting_time')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_mail')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->integer('contracttime_floor')->nullable();
            $table->integer('contracttime_roof')->nullable();
            $table->integer('reduction')->nullable();
            $table->integer('increase')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('device')->nullable();
            $table->timestamps();

            /**
             * Set primary key to a column
             */
            // $table->primary(['workplace_id', 'client_id', 'employee_id']);

            /**
             * Add foreign key constraints to columns
             */
            $table->foreign('client_id')->references('client_id')->on('clients');
            $table->foreign('employee_id')->references('employee_id')->on('employees');

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
        Schema::dropIfExists('workplaces');
    }
}
