<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArrivalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('arrivals')->insert([
            'store_id' => 1,
            'product_id' => 1,
            'count' => 3,
            'weight' => 150,
            'date' => Carbon::now()
        ]);
    }
}
