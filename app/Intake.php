<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{

    protected $fillable = [
        'food_id',
        'ate_on',
        'meal',
        'kcal',
        'protein',
        'carb',
        'lipid',
        'weight',
        'number'
    ];

    /**
     * an Intake belongs to one food
     *
     * @return void
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

}
