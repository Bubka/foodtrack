<?php

namespace App\Http\Controllers;

use App\Intake;
use App\Food;
use App\Recipe;
Use App\Http\Requests\IntakeRequest;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class IntakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('intakes.index', ['intakes' => Intake::with('food')->paginate(5)]);
    }

    /**
     * Display all intakes of a day
     *
     * @return void
     */
    public function daily(Request $request)
    {
        // Define intake dates : today or the one provided in querystring plus previous and next dates
        $days = getPrevCurrentNextDays($request->day);

        $intakes = Intake::with('food')->whereDate('ate_on', '=', $days['intakeDate']->toDateString())->get();

        $objective['kcal'] = 2500;
        $objective['protein'] = 140;
        $objective['lipid'] = 70;

        $dailyStat['kcal'] = round($intakes->sum('kcal') * 100 / $objective['kcal']);
        $dailyStat['protein'] = round($intakes->sum('protein') * 100 / $objective['protein']);
        $dailyStat['lipid'] = round($intakes->sum('lipid') * 100 / $objective['lipid']);

        switch($dailyStat['kcal'])
        {
            case ($intakes->sum('kcal') < $objective['kcal'] * 0.5 ):
                $progressColor['kcal'] = 'bg-danger';
            break;

            case ($intakes->sum('kcal') < $objective['kcal'] * 0.9 ):
                $progressColor['kcal'] = 'bg-warning';
            break;

            default:
                $progressColor['kcal'] = 'bg-success';
        }

        switch($dailyStat['protein'])
        {
            case ($intakes->sum('protein') < $objective['protein'] * 0.5 ):
                $progressColor['protein'] = 'bg-danger';
            break;

            case ($intakes->sum('protein') < $objective['protein'] * 0.9 ):
                $progressColor['protein'] = 'bg-warning';
            break;

            default:
                $progressColor['protein'] = 'bg-success';
        }

        switch($dailyStat['lipid'])
        {
            case ($intakes->sum('lipid') < $objective['lipid'] * 0.5 ):
                $progressColor['lipid'] = 'bg-danger';
            break;

            case ($intakes->sum('lipid') < $objective['lipid'] * 0.9 ):
                $progressColor['lipid'] = 'bg-warning';
            break;

            default:
                $progressColor['lipid'] = 'bg-success';
        }

        $breakfastIntakes = $intakes->where('meal', 'breakfast');
        $morningSnackIntakes = $intakes->where('meal', 'morningsnack');
        $lunchIntakes = $intakes->where('meal', 'lunch');
        $afternoonsnackIntakes = $intakes->where('meal', 'afternoonsnack');
        $dinerIntakes = $intakes->where('meal', 'diner');
        $eveningSnackIntakes = $intakes->where('meal', 'eveningsnack');

        return view('intakes.daily', [  'intakes' => $intakes,
                                        'dailyStat' => $dailyStat,
                                        'progressColor' => $progressColor,
                                        'breakfastIntakes' => $breakfastIntakes,
                                        'morningSnackIntakes' => $morningSnackIntakes,
                                        'lunchIntakes' => $lunchIntakes,
                                        'afternoonsnackIntakes' => $afternoonsnackIntakes,
                                        'eveningSnackIntakes' => $eveningSnackIntakes,
                                        'dinerIntakes' => $dinerIntakes,
                                        'days' => $days
                                    ]);

    }


    /**
     * import meal from source to target day
     *
     * @param  \App\Http\Requests\IntakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function importMeal(Request $request)
    {

        // get intakes dates
        $days = getPrevCurrentNextDays($request->day);

        $days['sourceDay'] = Carbon::createFromFormat('Y-m-d', $request->sourceDay);
        $days['targetDay'] = Carbon::createFromFormat('Y-m-d', $request->targetDay);

        // check meal name to import
        $meals = $this->meals();

        if(!array_key_exists($request->meal, $meals))
        {
            return back()->with('error', 'The meal you want to import do not exists');
        }

        $importedMealIntakes = Intake::with('food')->where( 'meal', '=', $request->meal )
                                    ->whereDate('ate_on', '=', $days['sourceDay']
                                    ->toDateString())
                                    ->get();

        if($importedMealIntakes->count() > 0)
        {
            foreach($importedMealIntakes as $importedMealIntake)
            {
                $intake = new Intake;

                $intake->food_id = $importedMealIntake->food_id;
                $intake->ate_on = $days['targetDay']->format('Y-m-d');
                $intake->meal = $request->meal;
                $intake->kcal = $importedMealIntake->kcal;
                $intake->protein = $importedMealIntake->protein;
                $intake->carb = $importedMealIntake->carb;
                $intake->lipid = $importedMealIntake->lipid;
                $intake->weight = $importedMealIntake->weight;
                $intake->number = $importedMealIntake->number;

                $intake->save();
            }

            return back()->with('success', 'Meal successfully imported');
        }
        else
        {
            return back()->with('error', 'The meal you want to import is empty');
        }
    }


    /**
     * Add recipe's ingredient as intakes
     *
     * @return \Illuminate\Http\Response
     */
    public function addRecipe(Request $request)
    {
        $recipe = Recipe::with('foods')->findOrFail($request->recipeSuggestedId);

        foreach( $recipe->foods as $food)
        {
            $intake = new Intake;

            if( $food->pivot->number > 0)
            {
                $usedWeight = $food->pivot->number * $food->unitWeight;
            }
            else
            {
                $usedWeight = $food->pivot->weight;
            }

            $intake->food_id = $food->id;
            $intake->ate_on = $request->intakeDate;
            $intake->meal = $request->mealName;
            $intake->kcal = round($usedWeight * ($food->kcal/100), 1);
            $intake->protein = round($usedWeight * ($food->protein/100), 1);
            $intake->carb = round($usedWeight * ($food->carb/100), 1);
            $intake->lipid = round($usedWeight * ($food->lipid/100), 1);
            $intake->weight = $food->pivot->weight;
            $intake->number = $food->pivot->number;

            $intake->save();
        }

        return redirect('intake/daily/' . $request->intakeDate)->with('success', 'Recipe\'s ingredients have been added');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intakes.create', ['foods' => Food::all(), 'meals' => $this->meals()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IntakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IntakeRequest $request)
    {
        $food = Food::findOrFail($request->suggestedId);

        if( $request->number > 0)
        {
            if( !isset($food->unitWeight))
            {
                return back()->with('error', 'This food does not have unit weight');
            }
            else $ateWeight = $request->number * $food->unitWeight;
        }
        else
        {
            $ateWeight = $request->weight;
        }

        $intake = new Intake;

        $intake->food_id = $request->suggestedId;
        $intake->ate_on = $request->ate_on;
        $intake->meal = $request->meal;
        $intake->kcal = round($ateWeight * ($food->kcal/100), 1);
        $intake->protein = round($ateWeight * ($food->protein/100), 1);
        $intake->carb = round($ateWeight * ($food->carb/100), 1);
        $intake->lipid = round($ateWeight * ($food->lipid/100), 1);
        $intake->weight = $request->weight;
        $intake->number = $request->number;

        $intake->save();

        return redirect(url()->previous() . '#' . $request->meal)->with('success', 'Intake has been added');
        //return redirect('intake')->with('success', 'Intake has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Intake  $intake
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intake = Intake::with('food')->findOrFail($id);

        return view('intakes.show', compact(['intake']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Intake  $intake
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $intake = Intake::findOrFail($id);
        $foods = Food::all();
        $meals = $this->meals();

        return view('intakes.edit',compact('intake','id', 'foods', 'meals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Intake  $intake
     * @return \Illuminate\Http\Response
     */
    public function update(IntakeRequest $request, $id)
    {
        $intake = Intake::findOrFail($id);
        $food = Food::findOrFail($request->food_id);

        if( $request->number > 0)
        {
            $ateWeight = $request->number * $food->unitWeight;
        }
        else
        {
            $ateWeight = $request->weight;
        }

        $intake->food_id = $request->food_id;
        $intake->ate_on = $request->ate_on;
        $intake->meal = $request->meal;
        $intake->kcal = round($ateWeight * ($food->kcal/100), 1);
        $intake->protein = round($ateWeight * ($food->protein/100), 1);
        $intake->carb = round($ateWeight * ($food->carb/100), 1);
        $intake->lipid = round($ateWeight * ($food->lipid/100), 1);
        $intake->weight = $request->weight;
        $intake->number = $request->number;

        $intake->save();

        return redirect('intake')->with('success', $intake->meal . "on" . $intake->ate_on . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Intake  $intake
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intake = Intake::findOrFail($id);
        $intake->delete();

        return back()->with('success', 'Intake has been deleted');
    }


    /**
     * get meals list with their time
     *
     * @return array
     */
    protected function meals()
    {
        return [
            'breakfast' => '08h',
            'morningsnack' => '10h',
            'lunch' => '12h',
            'afternoonsnack' => '16h',
            'diner' => '19h',
            'eveningsnack' => '22h'
        ];
    }
}
