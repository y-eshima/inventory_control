<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '江島康成',
            'email' => 'yasu130312@icloud.com',
            'password' => 'yasu0312',
            'role' => 1,
            'store_id' => 1,
        ]);
    }
}
