<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroesTeams extends Model
{
    /**
     * @var string
     */
    protected $table = 'heroes_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hero_id',
        'team_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
