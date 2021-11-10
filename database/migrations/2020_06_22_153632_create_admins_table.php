<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('username');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('mail_address')->unique();
            $table->string('password');
            $table->string('picture')->nullable();;
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            // $table->primary('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
