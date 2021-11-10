<?php

use App\PaymentDate;
use Illuminate\Database\Seeder;

class PaymentDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentdate = new PaymentDate();
        $paymentdate->paymentdate_name = '翌々月5日';
        $paymentdate->save();
    }
}
