<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed with 5 of
        for($i = 0; $i<5; $i++)
        {
            DB::table('powers')->insert([
                'name' => 'Power ' . $i,
            ]);
        }
    }
}
