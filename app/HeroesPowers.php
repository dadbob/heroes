<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroesPowers extends Model
{
    /**
     * @var string
     */
    protected $table = 'heroes_powers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hero_id',
        'power_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
