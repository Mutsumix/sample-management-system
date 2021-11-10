<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkplaceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplace_histories', function (Blueprint $table) {
            $table->increments('wphistory_id');
            $table->integer('workplace_id')->unsigned();
            $table->integer('version');
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
        Schema::dropIfExists('workplace_histories');
    }
}
