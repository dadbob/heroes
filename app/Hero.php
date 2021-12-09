<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    /**
     * @var string
     */
    protected $table = 'heroes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'publisher',
        'real_name',
        'hero_name',
        'appearance_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
