<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GendersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PaymentDatesTableSeeder::class);
        $this->call(ClosingDatesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(StatusTableSeeder::class);
    }

}
