<?php

namespace App\Http\Controllers;

use App\Food;
use App\Recipe;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestFood(Request $request)
    {
        return Food::where('name', 'LIKE', '%'.$request->q.'%')->get(['name', 'id', 'kcal', 'protein', 'carb', 'lipid']);
    }


    public function suggestRecipe(Request $request)
    {
        return Recipe::where('name', 'LIKE', '%'.$request->q.'%')->get(['name', 'id', 'kcal', 'protein', 'carb', 'lipid']);
    }
}
