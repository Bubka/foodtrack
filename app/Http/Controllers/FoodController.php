<?php

namespace App\Http\Controllers;

use App\Food;
use App\Http\Requests\FoodRequest;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('foods.index', ['foods' => Food::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Requests\FoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {        
        Food::create($request->all());

        // return back()->with('success', 'Food has been added');
        return redirect('food')->with('success', 'Food has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::findOrFail($id);
        $intakes = $food->intakes;

        return view('foods.show', compact(['food', 'intakes']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('foods.edit',compact('food','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FoodRequest  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        $food = Food::findOrFail($id);
        $food->update($request->all());

        return redirect('food')->with('success', $food->name . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::finfindOrFaild($id);
        $food->delete();

        return redirect('food')->with('success','The food has been deleted');
    }
}
