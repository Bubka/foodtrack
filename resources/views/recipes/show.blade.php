@extends('masterpage')

@section('content')

    <h2>
        {{ $recipe->name }}
        {{-- <a class="btn btn-sm btn-primary" href="{{action('RecipeController@refresh', $recipe->id)}}" >Refresh</a> --}}
    </h2>
    @if ( count($recipe->foods) > 0 )
    <h4>
        <span class="badge badge-primary">
            <b>{{ $recipe->kcal }} kcal</b>
        </span>
        {{ $recipe->protein }}
        {{ $recipe->carb }}
        {{ $recipe->lipid }}
    </h4>
    @endif
    <br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <h4>Ingredients
        <a class="text-body" href="#modalNewIngredient" data-toggle="modal" data-target="#modalNewIngredient" >
            <i class="fas fa-plus-square fa-fw"></i>
        </a>
    </h4>
    @if ( count($recipe->foods) > 0 )
        <table class="table table-striped">
            <tbody>
                @foreach ($recipe->foods as $food)
                <tr>
                    <td>
                        <a href="{{action('FoodController@show', $food->id)}}" >{{ $food->name }}</a>
                         - @isset($food->pivot->weight)
                            {{ $food->pivot->weight }} gr
                        @endisset
                        @isset($food->pivot->number)
                            x {{ $food->pivot->number }}
                        @endisset
                        <span class="text-monospace" style="display: block;">
                            {{ $ingredients[$food->id]['kcal'] }} kcal |
                            {{ $ingredients[$food->id]['protein'] }} -
                            {{ $ingredients[$food->id]['carb'] }} -
                            {{ $ingredients[$food->id]['lipid'] }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ url('recipe/remove') }}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="recipeId" value="{{ $recipe->id }}" />
                            <input type="hidden" name="foodId" value="{{ $food->id }}" />
                            <button class="btn btn-outline-secondary btn-sm" type="submit">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-secondary">no ingredient yet</div>
    @endif
    <br />
    <div class="mt-3 row justify-content-center">
        <div class="col-5">
            <a href="{{ action('FoodController@edit', $recipe->id)}}" class="btn btn-block btn-sm btn-outline-secondary">Edit</a>
        </div>
        <div class="col-5">
            <form action="{{action('FoodController@destroy', $recipe->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-block btn-sm btn-outline-secondary" type="submit">Delete</button>
            </form>
        </div>
    </div>


    {{-- modal form --}}
    <div class="modal fade" id="modalNewIngredient" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addIngredientForm" method="post" action="{{ url('recipe/add') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="recipeId" value="{{ $recipe->id }}" />
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="food">Food</label>
                            <br />
                            <input type="text" class="form-control" name="food" id="food" autocomplete="off" required>
                            <input type="hidden" name="suggestedId" id="suggestedId" value="" />
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="weight">Weight</label>
                            <input type="text" class="form-control" name="weight" pattern="[0-9]*">
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="number">Quantity</label>
                            <input type="text" class="form-control" name="number">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="addIngredientForm" id="submitbutton">Add</button>
            </div>
            </div>
        </div>
    </div>


    @include('partials.suggest_script')

@endsection


