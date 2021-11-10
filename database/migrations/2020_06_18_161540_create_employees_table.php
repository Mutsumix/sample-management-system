<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            // 基本情報
            $table->integer('employee_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('kana_last_name')->nullable();
            $table->string('kana_first_name')->nullable();
            $table->string('office')->nullable();
            /**
             * if you need a foreign key constraint then
             * the column should be unsigned integer
             */
            $table->integer('status_id')->unsigned()->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('gender_id')->unsigned()->nullable();
            $table->string('blood_type')->nullable();
            $table->string('my_number')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('station')->nullable();
            $table->string('commuting_route')->nullable();
            $table->integer('fare')->nullable();
            $table->date('join_date')->nullable();
            $table->date('leave_date')->nullable();
            // 健康保険・厚生年金
            $table->string('insurance_number')->nullable();
            $table->string('reference_pension_number')->nullable();
            $table->string('basic_pension_number')->nullable();
            $table->date('hi_acquisition_date')->nullable();
            $table->date('hi_loss_date')->nullable();
            $table->boolean('existence_of_dependents')->nullable();
            // 健康保険・厚生年金 配偶者
            $table->string('spouses_name')->nullable();
            $table->date('spouses_birth_date')->nullable();
            $table->string('spouses_my_number')->nullable();
            // 健康保険・厚生年金 扶養１
            $table->string('dep1_name')->nullable();
            $table->date('dep1_birth_date')->nullable();
            $table->string('dep1_my_number')->nullable();
            $table->integer('dep1_gender_id')->unsigned()->nullable();
            $table->string('dep1_relationship')->nullable();
            $table->date('dep1_acquisition_date')->nullable();
            $table->date('dep1_loss_date')->nullable();
            // 健康保険・厚生年金 扶養２
            $table->string('dep2_name')->nullable();
            $table->date('dep2_birth_date')->nullable();
            $table->string('dep2_my_number')->nullable();
            $table->integer('dep2_gender_id')->unsigned()->nullable();
            $table->string('dep2_relationship')->nullable();
            $table->date('dep2_acquisition_date')->nullable();
            $table->date('dep2_loss_date')->nullable();
            // 健康保険・厚生年金 扶養３
            $table->string('dep3_name')->nullable();
            $table->date('dep3_birth_date')->nullable();
            $table->string('dep3_my_number')->nullable();
            $table->integer('dep3_gender_id')->unsigned()->nullable();
            $table->string('dep3_relationship')->nullable();
            $table->date('dep3_acquisition_date')->nullable();
            $table->date('dep3_loss_date')->nullable();
            // 健康保険・厚生年金 扶養４
            $table->string('dep4_name')->nullable();
            $table->date('dep4_birth_date')->nullable();
            $table->string('dep4_my_number')->nullable();
            $table->integer('dep4_gender_id')->unsigned()->nullable();
            $table->string('dep4_relationship')->nullable();
            $table->date('dep4_acquisition_date')->nullable();
            $table->date('dep4_loss_date')->nullable();

            // 雇用保険
            $table->string('ei_number')->nullable();
            $table->date('ei_acquisition_date')->nullable();
            $table->date('ei_loss_date')->nullable();

            // その他情報
            $table->string('ec_name')->nullable();
            $table->string('ec_kana_name')->nullable();
            $table->string('ec_relationship')->nullable();
            $table->text('ec_address')->nullable();
            $table->string('ec_phone')->nullable();
            $table->string('fg1_name')->nullable();
            $table->string('fg1_kana_name')->nullable();
            $table->string('fg1_relationship')->nullable();
            $table->text('fg1_address')->nullable();
            $table->string('fg1_phone')->nullable();
            $table->string('fg2_name')->nullable();
            $table->string('fg2_kana_name')->nullable();
            $table->string('fg2_relationship')->nullable();
            $table->text('fg2_address')->nullable();
            $table->string('fg2_phone')->nullable();
            $table->text('remark')->nullable();
            // $table->datetime('add_date')->nullable();
            $table->string('created_by')->nullable();
            // $table->datetime('update_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('device')->nullable();
            $table->string('picture')->nullable();

            $table->timestamps();

            /**
             * Set primary key to a column
             */
            $table->primary('employee_id');

            /**
             * Add foreign key constraints to there columns
             */
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('dep1_gender_id')->references('id')->on('genders');
            $table->foreign('dep2_gender_id')->references('id')->on('genders');
            $table->foreign('dep3_gender_id')->references('id')->on('genders');
            $table->foreign('dep4_gender_id')->references('id')->on('genders');

            /**
             * Add Soft Deletes.
             *
             * Logical Deletion
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
        Schema::dropIfExists('employees');
    }
}
