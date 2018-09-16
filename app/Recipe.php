<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [
        'name',
        'kcal',
        'protein',
        'carb',
        'lipid'
    ];


    /**
     * Get the foods used in the given recipe
     *
     * @return void
     */
    public function foods()
    {
        return $this->belongsToMany('App\Food')
            ->withPivot('weight', 'number')
    	    ->withTimestamps();
    }


    /**
     * Undocumented function
     *
     * @param Recipe $recipe
     * @return void
     */
    public function refreshRecipe()
    {
        $this->kcal = 0;
        $this->protein = 0;
        $this->carb = 0;
        $this->lipid = 0;

        foreach( $this->foods as $food)
        {
            if( $food->pivot->number > 0)
            {
                $usedWeight = $food->pivot->number * $food->unitWeight;
            }
            else
            {
                $usedWeight = $food->pivot->weight;
            }

            $this->kcal += round($usedWeight * ($food->kcal/100));
            $this->protein += round($usedWeight * ($food->protein/100),1);
            $this->carb += round($usedWeight * ($food->carb/100),1);
            $this->lipid += round($usedWeight * ($food->lipid/100),1);
        }

        $this->save();
    }


}
