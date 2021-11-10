<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->last_name = 'シスマック';
        $admin->first_name = '管理者';
        $admin->username = '管理者１';
        $admin->mail_address = 'admin@sysmac.co.jp';
        $admin->password = bcrypt('password');
        $admin->save();
    }
}
