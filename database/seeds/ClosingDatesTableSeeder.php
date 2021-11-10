<?php

use App\ClosingDate;
use Illuminate\Database\Seeder;

class ClosingDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $closingdate = new ClosingDate();
        $closingdate->closingdate_name = '月末最終営業日';
        $closingdate->save();
    }
}
