<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    protected $fillable = [
        'name',
        'kcal',
        'protein',
        'carb',
        'lipid',
        'baseWeight',
        'unitWeight'
    ];

    /**
     * 
     * a food can have multiple intakes
     * 
     */
    public function intakes()
    {
        return $this->hasMany(Intake::class);
    }


    /**
     * Get the recipes that use the given food
     *
     * @return void
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }

}
