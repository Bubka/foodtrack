<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Food;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recipes.index', ['recipes' => Recipe::paginate(5)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $recipe = new Recipe;

        $recipe->name = $request->name;
        $recipe->kcal = 0;
        $recipe->protein = 0;
        $recipe->carb = 0;
        $recipe->lipid = 0;

        $recipe->save();

        return redirect('recipe')->with('success', 'Recipe has been added');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::with('foods')->findOrFail($id);

        foreach( $recipe->foods as $food)
        {
            if( $food->pivot->number > 0)
            {
                $usedWeight = $food->pivot->number * $food->unitWeight;
            }
            else
            {
                $usedWeight = $food->pivot->weight;
            }

            $ingredients[$food->id]['kcal'] = round($usedWeight * ($food->kcal/100), 1);
            $ingredients[$food->id]['protein'] = round($usedWeight * ($food->protein/100), 1);
            $ingredients[$food->id]['carb'] = round($usedWeight * ($food->carb/100), 1);
            $ingredients[$food->id]['lipid'] = round($usedWeight * ($food->lipid/100), 1);
        }

        return view('recipes.show', compact(['recipe', 'ingredients']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        
        return view('recipes.edit',compact('recipe'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        
        $recipe->name = $request->name;
        //$this->refreshRecipe($recipe);
        $recipe->save();
        
        return redirect('recipe')->with('success', $recipe->name . ' has been updated');
    }


    /**
     * Add a food to the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function addFood(Request $request)
    {
        $recipe = Recipe::with('foods')->findOrFail($request->recipeId);
        $newFood = Food::findOrFail($request->suggestedId);

        $recipe->foods()->attach($newFood->id, ['weight' => $request->weight, 'number' => $request->number]);
        $recipe->save();

        $recipe = $recipe->fresh();
        $recipe->refreshRecipe();
       
        return redirect()->route('recipe.show', ['id' => $recipe->id])->with('success', $newFood->name . ' has been added to recipe' . $recipe->name);
    }


    /**
     * Remove a food to the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function removeFood(Request $request)
    {
        $recipe = Recipe::with('foods')->findOrFail($request->recipeId);
        $food = Food::findOrFail($request->foodId);

        $recipe->foods()->detach($food->id);
        $recipe->save();

        $recipe = $recipe->fresh();
        $recipe->refreshRecipe();
        
        return redirect()->route('recipe.show', ['id' => $recipe->id])->with('success', $food->name . ' has been removed from recipe' . $recipe->name);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->foods()->detach();
        $recipe->delete();
        
        return redirect('recipe')->with('success', $recipe->name . ' has been deleted');
    }


    /**
     * Refresh and store recipe's nutriment sums.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function refresh($id)
    {
        $recipe = Recipe::with('foods')->findOrFail($id);
        $recipe->refreshRecipe();

        return redirect()->route('recipe.show', ['id' => $recipe->id])->with('success', $recipe->name . ' has been refreshed');
    }

}
