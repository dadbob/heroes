<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Powers extends Model
{
    /**
     * @var string
     */
    protected $table = 'powers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
