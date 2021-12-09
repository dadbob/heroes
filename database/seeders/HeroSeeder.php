<?php

namespace Database\Seeders;

use App\Hero;
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
        $data = array(
            [
                'real_name' => 'Bruce Banner',
                'hero_name' => 'Hulk',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
            [
                'real_name' => 'Clark Kent',
                'hero_name' => 'Superman',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
            [
                'real_name' => 'Bruce Wayne',
                'hero_name' => 'Batman',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
            [
                'real_name' => 'Tony Stark',
                'hero_name' => 'Iron Man',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
            [
                'real_name' => 'Natasha Romanoff',
                'hero_name' => 'Black Widow',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
            [
                'real_name' => 'Steve Rogers',
                'hero_name' => 'Captain America',
                'publisher' => 'Marvel',
                'appearance_at' => '1976-01-31',
            ],
        );

        Hero::insert($data);

        for($i = 1; $i<6; $i++)
        {
            for($j = 1; $j<= 6; $j++)
            {
                DB::table('heroes_teams')->insert([
                    'hero_id' => $i,
                    'team_id' => $j,
                ]);
                DB::table('heroes_powers')->insert([
                    'hero_id' => $i,
                    'power_id' => $j,
                ]);
            }
        }
    }
}
