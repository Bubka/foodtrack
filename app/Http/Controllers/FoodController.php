<?php

namespace App\Http\Controllers;

use App\Food;
use App\Recipe;
use App\Http\Requests\FoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $food = Food::withCount('recipes', 'intakes')->findOrFail($id);

        // $recipes = Recipe::whereHas('foods', function ($query) {
        //     $query->where('id', '=', $food->id);
        // })->get();



        if( $food->recipes_count > 0 ) {
            foreach($food->recipes as $recipe)
            {
                $recipe->foods()->detach($food->id);
            }
        }

        if( $food->intakes_count > 0 ) {
            foreach($food->intakes as $intake)
            {
                $intake->delete();
            }
        }

        $food->delete();

        return redirect('food')->with('success','The food has been deleted');
    }


    public function feed()
    {

        $foods[] = array(  'name' => 'Abricot' , 'kcal' => 44 , 'protein' => 1 , 'carb' => 10, 'lipid' => 0 , 'baseWeight' => 100 , 'unitWeight' => 40 );
        $foods[] = array(  'name' => 'Abricots secs' , 'kcal' => 193 , 'protein' => 2 , 'carb' => 42, 'lipid' => 0,3 , 'baseWeight' => 100 , 'unitWeight' => 8 );
        $foods[] = array(  'name' => 'Aiguillettes de poulet picard' , 'kcal' => 117 , 'protein' => 23,2 , 'carb' => 2,7, 'lipid' => 1,4 , 'baseWeight' => 100 , 'unitWeight' => 39 );
        $foods[] = array(  'name' => 'Aubergine' , 'kcal' => 35 , 'protein' => 1 , 'carb' => 8, 'lipid' => 1 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Avocat' , 'kcal' => 220 , 'protein' => 2 , 'carb' => 3,5, 'lipid' => 22 , 'baseWeight' => 100 , 'unitWeight' => 200 );
        $foods[] = array(  'name' => 'Banane' , 'kcal' => 90 , 'protein' => 1,5 , 'carb' => 20, 'lipid' => 0 , 'baseWeight' => 100 , 'unitWeight' => 110 );
        $foods[] = array(  'name' => 'Betteraves' , 'kcal' => 43 , 'protein' => 2,3 , 'carb' => 7,2, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Beurre de cacahuette bio' , 'kcal' => 609 , 'protein' => 26 , 'carb' => 8,9, 'lipid' => 52 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Beurre doux Carrefour' , 'kcal' => 743 , 'protein' => 0,8 , 'carb' => 0,5, 'lipid' => 82 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Bière 33cl' , 'kcal' => 42 , 'protein' => 0 , 'carb' => 3,2, 'lipid' => 0 , 'baseWeight' => 100 , 'unitWeight' => 330 );
        $foods[] = array(  'name' => 'Biscottes bio complètes carrefour' , 'kcal' => 378 , 'protein' => 15 , 'carb' => 64, 'lipid' => 5 , 'baseWeight' => 100 , 'unitWeight' => 8 );
        $foods[] = array(  'name' => 'Blanc de poulet le gaulois' , 'kcal' => 106 , 'protein' => 24 , 'carb' => 0,1, 'lipid' => 1 , 'baseWeight' => 100 , 'unitWeight' => 150 );
        $foods[] = array(  'name' => 'Blanc poulet rôti (sans la peau)' , 'kcal' => 104 , 'protein' => 22 , 'carb' => 0, 'lipid' => 4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Boulettes de viande Picard' , 'kcal' => 179 , 'protein' => 14 , 'carb' => 3,1, 'lipid' => 12 , 'baseWeight' => 100 , 'unitWeight' => 30 );
        $foods[] = array(  'name' => 'Boulgour' , 'kcal' => 316 , 'protein' => 13 , 'carb' => 61, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Brocolis cuits' , 'kcal' => 29 , 'protein' => 2,1 , 'carb' => 2,8, 'lipid' => 0,5 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Caprice des dieux' , 'kcal' => 333 , 'protein' => 15,3 , 'carb' => 0,8, 'lipid' => 30 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Carotte crue' , 'kcal' => 30 , 'protein' => 1 , 'carb' => 6, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Carottes cuites' , 'kcal' => 31,3 , 'protein' => 0,8 , 'carb' => 5, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Carottes râpées jus de citron' , 'kcal' => 70 , 'protein' => 1 , 'carb' => 5, 'lipid' => 5,5 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Carpaccio de boeuf' , 'kcal' => 202 , 'protein' => 19 , 'carb' => 0, 'lipid' => 14 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Céleri rémoulade (saveurs du jardinier)' , 'kcal' => 140 , 'protein' => 2 , 'carb' => 4, 'lipid' => 13 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Chair à saucisses' , 'kcal' => 374 , 'protein' => 14 , 'carb' => 1, 'lipid' => 35 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Chaussée aux moines' , 'kcal' => 305 , 'protein' => 20 , 'carb' => 0, 'lipid' => 25 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Chili con carne' , 'kcal' => 120 , 'protein' => 7 , 'carb' => 12, 'lipid' => 4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Chocolat au lait Milka (au carré)' , 'kcal' => 530 , 'protein' => 6,3 , 'carb' => 59, 'lipid' => 29 , 'baseWeight' => 100 , 'unitWeight' => 4,2 );
        $foods[] = array(  'name' => 'Choux rouge' , 'kcal' => 36 , 'protein' => 2 , 'carb' => 7, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Choux-fleurs' , 'kcal' => 25 , 'protein' => 2 , 'carb' => 5, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Coleslaw' , 'kcal' => 115 , 'protein' => 1 , 'carb' => 6,5, 'lipid' => 9 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Compote de Pomme carrefour en pot' , 'kcal' => 78 , 'protein' => 0 , 'carb' => 18, 'lipid' => 0,5 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Concombre' , 'kcal' => 12 , 'protein' => 1 , 'carb' => 2, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'confiture gelée Bonne Maman' , 'kcal' => 240 , 'protein' => 0,4 , 'carb' => 59, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Courgettes' , 'kcal' => 33 , 'protein' => 1,3 , 'carb' => 6,5, 'lipid' => 0,2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Crème fraiche liquide 18% MG' , 'kcal' => 189 , 'protein' => 2,7 , 'carb' => 3,7, 'lipid' => 18 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Creusois' , 'kcal' => 428 , 'protein' => 6,7 , 'carb' => 50,1, 'lipid' => 22,4 , 'baseWeight' => 100 , 'unitWeight' => 320 );
        $foods[] = array(  'name' => 'Croque-monsieur ' , 'kcal' => 263 , 'protein' => 12 , 'carb' => 25,5, 'lipid' => 12,5 , 'baseWeight' => 100 , 'unitWeight' => 150 );
        $foods[] = array(  'name' => 'Dés d’épaule Fleury michon' , 'kcal' => 131 , 'protein' => 17 , 'carb' => 2, 'lipid' => 6,2 , 'baseWeight' => 100 , 'unitWeight' => 75 );
        $foods[] = array(  'name' => 'Ebly' , 'kcal' => 345 , 'protein' => 12 , 'carb' => 70, 'lipid' => 1,4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Emmental Français Entremont' , 'kcal' => 369 , 'protein' => 27 , 'carb' => 0, 'lipid' => 29 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Escalope milanaise' , 'kcal' => 271 , 'protein' => 23 , 'carb' => 13, 'lipid' => 14 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Feta' , 'kcal' => 293 , 'protein' => 14,6 , 'carb' => 0,8, 'lipid' => 25,8 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Filet de dinde' , 'kcal' => 114 , 'protein' => 24 , 'carb' => 0, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Filet mignon' , 'kcal' => 143 , 'protein' => 21 , 'carb' => 0, 'lipid' => 6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Filets de limandes' , 'kcal' => 181 , 'protein' => 13,5 , 'carb' => 11,6, 'lipid' => 8,7 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Flocon avoine' , 'kcal' => 375 , 'protein' => 13 , 'carb' => 60, 'lipid' => 7,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Foie gras' , 'kcal' => 507 , 'protein' => 10 , 'carb' => 2, 'lipid' => 51 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Frites' , 'kcal' => 300 , 'protein' => 4 , 'carb' => 40, 'lipid' => 15 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Fromage blanc 0% carrefour' , 'kcal' => 49 , 'protein' => 7,7 , 'carb' => 4,4, 'lipid' => 0,1 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Fromage blanc 3% MG' , 'kcal' => 70 , 'protein' => 6,3 , 'carb' => 4,5, 'lipid' => 3 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Fromage blanc 7% MH' , 'kcal' => 114 , 'protein' => 6,6 , 'carb' => 4,1, 'lipid' => 7,9 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Galettes de blé' , 'kcal' => 169 , 'protein' => 5,8 , 'carb' => 31, 'lipid' => 1,6 , 'baseWeight' => 100 , 'unitWeight' => 50 );
        $foods[] = array(  'name' => 'Glace Haagen Dazs' , 'kcal' => 273 , 'protein' => 4 , 'carb' => 27, 'lipid' => 16 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Grillades marinées Picard' , 'kcal' => 114 , 'protein' => 18 , 'carb' => 2,2, 'lipid' => 3,6 , 'baseWeight' => 100 , 'unitWeight' => 130 );
        $foods[] = array(  'name' => 'Haricots beurre très fins Auchan' , 'kcal' => 24 , 'protein' => 1,5 , 'carb' => 4,1, 'lipid' => 0,2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Haricots verts' , 'kcal' => 28 , 'protein' => 1,7 , 'carb' => 3,5, 'lipid' => 0,4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Huile' , 'kcal' => 900 , 'protein' => 0 , 'carb' => 0, 'lipid' => 100 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Huile d\'Olive Carrefour' , 'kcal' => 828 , 'protein' => 0 , 'carb' => 0, 'lipid' => 92 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Jambon blanc herta' , 'kcal' => 114 , 'protein' => 20 , 'carb' => 0,6, 'lipid' => 3,5 , 'baseWeight' => 100 , 'unitWeight' => 40 );
        $foods[] = array(  'name' => 'Jambon de pays carrefour' , 'kcal' => 216 , 'protein' => 30 , 'carb' => 1, 'lipid' => 10 , 'baseWeight' => 100 , 'unitWeight' => 12,5 );
        $foods[] = array(  'name' => 'Jambonneau tradition' , 'kcal' => 156 , 'protein' => 20 , 'carb' => 0,8, 'lipid' => 8 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Kiwi' , 'kcal' => 53 , 'protein' => 1,6 , 'carb' => 11, 'lipid' => 0,3 , 'baseWeight' => 100 , 'unitWeight' => 80 );
        $foods[] = array(  'name' => 'Knackis' , 'kcal' => 267 , 'protein' => 12,5 , 'carb' => 2, 'lipid' => 23 , 'baseWeight' => 100 , 'unitWeight' => 35 );
        $foods[] = array(  'name' => 'Lardons allumettes nature herta' , 'kcal' => 250 , 'protein' => 17 , 'carb' => 0,4, 'lipid' => 20 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Lasagnes surgelées Picard' , 'kcal' => 128 , 'protein' => 6,6 , 'carb' => 11, 'lipid' => 5,9 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Legumes du soleil Picard' , 'kcal' => 47 , 'protein' => 1,5 , 'carb' => 5,1, 'lipid' => 1,6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Lentilles' , 'kcal' => 303 , 'protein' => 25 , 'carb' => 38, 'lipid' => 0,7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Lentilles préparées Casino en boite' , 'kcal' => 84 , 'protein' => 6 , 'carb' => 12, 'lipid' => 0,4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Macaroni Panzani' , 'kcal' => 365 , 'protein' => 13 , 'carb' => 72, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Magret de canard' , 'kcal' => 170 , 'protein' => 20 , 'carb' => 0, 'lipid' => 10 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Maïs' , 'kcal' => 77 , 'protein' => 2,4 , 'carb' => 11,8, 'lipid' => 1,7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Mayonnaise' , 'kcal' => 660 , 'protein' => 11 , 'carb' => 2, 'lipid' => 72 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'McDo grande frites' , 'kcal' => 300 , 'protein' => 3,4 , 'carb' => 37, 'lipid' => 15 , 'baseWeight' => 100 , 'unitWeight' => 150 );
        $foods[] = array(  'name' => 'McDo nuggets' , 'kcal' => 249 , 'protein' => 16 , 'carb' => 17, 'lipid' => 13 , 'baseWeight' => 100 , 'unitWeight' => 18,2 );
        $foods[] = array(  'name' => 'Melon' , 'kcal' => 30 , 'protein' => 1 , 'carb' => 6, 'lipid' => 0,2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Merlu blanc du cap Picard' , 'kcal' => 71 , 'protein' => 17 , 'carb' => 0,5, 'lipid' => 0,5 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Miel' , 'kcal' => 316 , 'protein' => 1 , 'carb' => 78, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Mozzarella di bufala campana (casa azzura)' , 'kcal' => 265 , 'protein' => 14 , 'carb' => 0,6, 'lipid' => 22,9 , 'baseWeight' => 100 , 'unitWeight' => 150 );
        $foods[] = array(  'name' => 'Muesli carrefour bio floconneux 30 fruits secs' , 'kcal' => 358 , 'protein' => 11 , 'carb' => 58, 'lipid' => 6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Muffins nature carrefour' , 'kcal' => 222 , 'protein' => 10 , 'carb' => 41, 'lipid' => 1,4 , 'baseWeight' => 100 , 'unitWeight' => 62,5 );
        $foods[] = array(  'name' => 'Nectarine' , 'kcal' => 50 , 'protein' => 1 , 'carb' => 11, 'lipid' => 0,35 , 'baseWeight' => 100 , 'unitWeight' => 130 );
        $foods[] = array(  'name' => 'Noix (2 cerneaux)' , 'kcal' => 663 , 'protein' => 13 , 'carb' => 3,5, 'lipid' => 65 , 'baseWeight' => 100 , 'unitWeight' => 4 );
        $foods[] = array(  'name' => 'Nouilles carrefour' , 'kcal' => 352 , 'protein' => 12 , 'carb' => 72, 'lipid' => 1,2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Oeuf de poule élevé en plein air carrefour' , 'kcal' => 142 , 'protein' => 12,6 , 'carb' => 0,8, 'lipid' => 9,9 , 'baseWeight' => 100 , 'unitWeight' => 50 );
        $foods[] = array(  'name' => 'Oeuf dur' , 'kcal' => 146 , 'protein' => 13 , 'carb' => 1, 'lipid' => 11 , 'baseWeight' => 100 , 'unitWeight' => 50 );
        $foods[] = array(  'name' => 'Fromage Ossau Iraty' , 'kcal' => 355 , 'protein' => 22,4 , 'carb' => 0, 'lipid' => 29,5 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pain au chocolat' , 'kcal' => 430 , 'protein' => 7 , 'carb' => 50, 'lipid' => 20 , 'baseWeight' => 100 , 'unitWeight' => 75 );
        $foods[] = array(  'name' => 'Pain blanc' , 'kcal' => 270 , 'protein' => 9 , 'carb' => 50, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pain complet 3 céréales (Bjorg)' , 'kcal' => 201 , 'protein' => 5,2 , 'carb' => 34,3, 'lipid' => 2,6 , 'baseWeight' => 100 , 'unitWeight' => 70 );
        $foods[] = array(  'name' => 'Pain de mie complet sans croûte carrefour' , 'kcal' => 232 , 'protein' => 8,4 , 'carb' => 42, 'lipid' => 2,6 , 'baseWeight' => 100 , 'unitWeight' => 24 );
        $foods[] = array(  'name' => 'Pain hot-dog' , 'kcal' => 291 , 'protein' => 8,5 , 'carb' => 49, 'lipid' => 6,1 , 'baseWeight' => 100 , 'unitWeight' => 62 );
        $foods[] = array(  'name' => 'Pains au lait Pasquier' , 'kcal' => 365 , 'protein' => 7,4 , 'carb' => 55,2, 'lipid' => 11 , 'baseWeight' => 100 , 'unitWeight' => 35 );
        $foods[] = array(  'name' => 'Pasquier pains au lait' , 'kcal' => 364,5 , 'protein' => 9 , 'carb' => 54, 'lipid' => 12,5 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pâté de campagne' , 'kcal' => 314 , 'protein' => 14 , 'carb' => 4, 'lipid' => 27 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pates Penne' , 'kcal' => 359 , 'protein' => 12,5 , 'carb' => 71,2, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pates torsade Panzani' , 'kcal' => 365 , 'protein' => 13 , 'carb' => 72, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Petits ecoliers carrefour' , 'kcal' => 494 , 'protein' => 6,4 , 'carb' => 64, 'lipid' => 23 , 'baseWeight' => 100 , 'unitWeight' => 12,5 );
        $foods[] = array(  'name' => 'Petits pois' , 'kcal' => 64 , 'protein' => 4 , 'carb' => 12, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pizza poivron viande hachée (1/4)' , 'kcal' => 202 , 'protein' => 9,6 , 'carb' => 25, 'lipid' => 6,7 , 'baseWeight' => 100 , 'unitWeight' => 125 );
        $foods[] = array(  'name' => 'Pizza Sodebo 4 fromages' , 'kcal' => 243 , 'protein' => 13 , 'carb' => 26, 'lipid' => 9,5 , 'baseWeight' => 100 , 'unitWeight' => 471 );
        $foods[] = array(  'name' => 'Pizza Sodebo chèvre' , 'kcal' => 231 , 'protein' => 10 , 'carb' => 26, 'lipid' => 9 , 'baseWeight' => 100 , 'unitWeight' => 470 );
        $foods[] = array(  'name' => 'Poissons panés frais' , 'kcal' => 209 , 'protein' => 11,2 , 'carb' => 17,2, 'lipid' => 10,4 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Poissons panés surgelés Picard étroits' , 'kcal' => 184 , 'protein' => 12,6 , 'carb' => 16,8, 'lipid' => 7,3 , 'baseWeight' => 100 , 'unitWeight' => 30 );
        $foods[] = array(  'name' => 'Poivron' , 'kcal' => 26 , 'protein' => 0,9 , 'carb' => 5,2, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pomme de terre' , 'kcal' => 90 , 'protein' => 2 , 'carb' => 19, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pomme de terre roties' , 'kcal' => 150 , 'protein' => 2,3 , 'carb' => 20, 'lipid' => 7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pomme Pink Lady' , 'kcal' => 52 , 'protein' => 0,3 , 'carb' => 13, 'lipid' => 0,2 , 'baseWeight' => 100 , 'unitWeight' => 140 );
        $foods[] = array(  'name' => 'Pommes noisette Picard' , 'kcal' => 194 , 'protein' => 2,6 , 'carb' => 27,5, 'lipid' => 7,7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Pommes rissolées Picard' , 'kcal' => 186 , 'protein' => 2,9 , 'carb' => 26,7, 'lipid' => 6,7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Potes' , 'kcal' => 63 , 'protein' => 0,5 , 'carb' => 12,8, 'lipid' => 0,6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Purée de pomme de terre faite maison' , 'kcal' => 105 , 'protein' => 1,9 , 'carb' => 16,7, 'lipid' => 4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Purée Mousline (préparée avec beurre)' , 'kcal' => 76 , 'protein' => 2,6 , 'carb' => 13,1, 'lipid' => 1,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Quiche 3 fromages Carrefour' , 'kcal' => 271 , 'protein' => 8,8 , 'carb' => 20, 'lipid' => 17 , 'baseWeight' => 100 , 'unitWeight' => 130 );
        $foods[] = array(  'name' => 'Quiche lorraine' , 'kcal' => 280 , 'protein' => 8 , 'carb' => 20, 'lipid' => 18 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Quiche Lorraine Carrefour' , 'kcal' => 261 , 'protein' => 8,7 , 'carb' => 20, 'lipid' => 16 , 'baseWeight' => 100 , 'unitWeight' => 130 );
        $foods[] = array(  'name' => 'Radis' , 'kcal' => 17,8 , 'protein' => 1 , 'carb' => 3, 'lipid' => 0,2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Raisin blanc' , 'kcal' => 69 , 'protein' => 0,6 , 'carb' => 16, 'lipid' => 0,7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Ratatouille' , 'kcal' => 72 , 'protein' => 1,2 , 'carb' => 5, 'lipid' => 7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Ravioli carrefour' , 'kcal' => 259 , 'protein' => 8,4 , 'carb' => 38, 'lipid' => 7,6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Riz blanc' , 'kcal' => 349 , 'protein' => 8 , 'carb' => 77, 'lipid' => 1 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Rostis de Pomme de Terre et Cheddar' , 'kcal' => 118 , 'protein' => 3,9 , 'carb' => 10, 'lipid' => 6,2 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Rôti de bœuf' , 'kcal' => 140 , 'protein' => 26 , 'carb' => 0, 'lipid' => 4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Roti de porc fleury michon recette authentique' , 'kcal' => 120 , 'protein' => 23 , 'carb' => 0,7, 'lipid' => 2,8 , 'baseWeight' => 100 , 'unitWeight' => 45 );
        $foods[] = array(  'name' => 'Rôti de veau' , 'kcal' => 240 , 'protein' => 29 , 'carb' => 0, 'lipid' => 14 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Salade de fruits' , 'kcal' => 50 , 'protein' => 1 , 'carb' => 12, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Sauce citron' , 'kcal' => 211 , 'protein' => 1 , 'carb' => 3,8, 'lipid' => 21,1 , 'baseWeight' => 100 , 'unitWeight' => 16 );
        $foods[] = array(  'name' => 'Sauce curry doux' , 'kcal' => 160 , 'protein' => 0,7 , 'carb' => 22, 'lipid' => 7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Saucisses de Toulouse' , 'kcal' => 202 , 'protein' => 16 , 'carb' => 0, 'lipid' => 15 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Saucisses hot-dog liddle' , 'kcal' => 227 , 'protein' => 13 , 'carb' => 1, 'lipid' => 19 , 'baseWeight' => 100 , 'unitWeight' => 50 );
        $foods[] = array(  'name' => 'Saumon' , 'kcal' => 202 , 'protein' => 20,3 , 'carb' => 0,5, 'lipid' => 13,4 , 'baseWeight' => 100 , 'unitWeight' => 160 );
        $foods[] = array(  'name' => 'Semoule' , 'kcal' => 360 , 'protein' => 12 , 'carb' => 72, 'lipid' => 2 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Steack hachés Picard' , 'kcal' => 197 , 'protein' => 18,7 , 'carb' => 0, 'lipid' => 13,6 , 'baseWeight' => 100 , 'unitWeight' => 100 );
        $foods[] = array(  'name' => 'Steak de bœuf ' , 'kcal' => 148 , 'protein' => 28 , 'carb' => 0, 'lipid' => 4 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Sucre en demi-morceau' , 'kcal' => 400 , 'protein' => 0 , 'carb' => 100, 'lipid' => 0 , 'baseWeight' => 100 , 'unitWeight' => 3 );
        $foods[] = array(  'name' => 'Sushi saumon' , 'kcal' => 87 , 'protein' => 4,4 , 'carb' => 14,5, 'lipid' => 2 , 'baseWeight' => 100 , 'unitWeight' => 50 );
        $foods[] = array(  'name' => 'Taboulet' , 'kcal' => 170 , 'protein' => 5 , 'carb' => 20, 'lipid' => 6 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Tagliatelles fraiches' , 'kcal' => 280 , 'protein' => 11 , 'carb' => 53, 'lipid' => 2,1 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Tarte aux poireaux Picard' , 'kcal' => 220 , 'protein' => 5,5 , 'carb' => 19, 'lipid' => 13 , 'baseWeight' => 100 , 'unitWeight' => 180 );
        $foods[] = array(  'name' => 'Tarte framboises' , 'kcal' => 200 , 'protein' => 2 , 'carb' => 35, 'lipid' => 7 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Thon nature (dia)' , 'kcal' => 109 , 'protein' => 25 , 'carb' => 0, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Tomates nature' , 'kcal' => 21 , 'protein' => 0,8 , 'carb' => 4,6, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Tropicana orange sans pulpe' , 'kcal' => 48 , 'protein' => 0,8 , 'carb' => 10, 'lipid' => 0 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Viande hachée pur bœuf Picard' , 'kcal' => 248 , 'protein' => 17 , 'carb' => 0, 'lipid' => 20 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Vieux pané' , 'kcal' => 308 , 'protein' => 17 , 'carb' => 0, 'lipid' => 27 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Vin' , 'kcal' => 700 , 'protein' => 0 , 'carb' => 0, 'lipid' => 0 , 'baseWeight' => 10);
        $foods[] = array(  'name' => 'whey xnative' , 'kcal' => 393 , 'protein' => 77,7 , 'carb' => 7,06, 'lipid' => 5,9 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Yaourt au citron' , 'kcal' => 90 , 'protein' => 2,9 , 'carb' => 13, 'lipid' => 3 , 'baseWeight' => 100 , 'unitWeight' => 125 );
        $foods[] = array(  'name' => 'Yaourt danone nature' , 'kcal' => 51,4 , 'protein' => 3,8 , 'carb' => 6,8, 'lipid' => 1 , 'baseWeight' => 100 , 'unitWeight' => 125 );
        $foods[] = array(  'name' => 'Yaourt nature 0% carrefour' , 'kcal' => 42 , 'protein' => 4,5 , 'carb' => 5,6, 'lipid' => 0,2 , 'baseWeight' => 100 , 'unitWeight' => 125 );
        $foods[] = array(  'name' => 'Légumes pour couscous Carrefour' , 'kcal' => 24 , 'protein' => 1,3 , 'carb' => 4, 'lipid' => 0,3 , 'baseWeight' => 100);
        $foods[] = array(  'name' => 'Merguez' , 'kcal' => 279 , 'protein' => 13 , 'carb' => 0,5, 'lipid' => 25 , 'baseWeight' => 100 , 'unitWeight' => 60 );

        foreach( $foods as $food )
        {
            $newFood = new Food;

            $newFood->name = $food['name'];
            $newFood->kcal = $food['kcal'];
            $newFood->protein = $food['protein'];
            $newFood->carb = $food['carb'];
            $newFood->lipid = $food['lipid'];
            $newFood->baseWeight = $food['baseWeight'];

            if( isset($food['unitWeight']) )
            {
                $newFood->unitWeight = $food['unitWeight'];
            }

            $newFood->save();
            unset($newFood);
        }

        return redirect('food')->with('success','Foods have been imported');
    }
}
