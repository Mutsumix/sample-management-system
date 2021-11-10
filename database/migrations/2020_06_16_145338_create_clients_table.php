<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->integer('client_id');
            $table->string('client_name');
            $table->string('kana_client_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->text('mail_address')->nullable();
            $table->string('url')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('office')->nullable();
            $table->string('contact_person_1')->nullable();
            $table->string('contact_phone_1')->nullable();
            $table->string('contact_mail_1')->nullable();
            $table->string('contact_person_2')->nullable();
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_mail_2')->nullable();
            $table->string('contact_person_3')->nullable();
            $table->string('contact_phone_3')->nullable();
            $table->string('contact_mail_3')->nullable();
            $table->integer('closingdate_id')->unsigned()->nullable();
            $table->integer('paymentdate_id')->unsigned()->nullable();
            $table->text('remark')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('device')->nullable();
            $table->boolean('delete_flag')->nullable();
            $table->timestamps();

            /**
             * Set primary key to a column
             */
            $table->primary('client_id');

            /**
             * Add foreign key constraints to columns
             *
             */
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('closingdate_id')->references('id')->on('closingdates');
            $table->foreign('paymentdate_id')->references('id')->on('paymentdates');

            /**
             * Add Soft Deletes
             *
             * it just mean that if we are deleting a row, then
             * it will not delete row. it will just add a value to
             * deeted_at column.
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
        Schema::dropIfExists('clients');
    }
}
