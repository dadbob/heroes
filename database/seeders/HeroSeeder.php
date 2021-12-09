<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heroes')->insert([
            'real_name' => 'Bruce',
            'hero_name' => 'Hulk',
            'publisher' => 'Marvel',
            'appearance_at' => '1976-01-31',
        ]);

        for($j = 1; $j<6; $j++)
        {
            DB::table('heroes_teams')->insert([
                'hero_id' => 1,
                'team_id' => $j,
            ]);
            DB::table('heroes_powers')->insert([
                'hero_id' => 1,
                'power_id' => $j,
            ]);
        }
    }
}
