<?php

use App\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = new Gender();
        $gender->gender_name = '男';
        $gender->save();
        $gender = new Gender();
        $gender->gender_name = '女';
        $gender->save();
    }
}
