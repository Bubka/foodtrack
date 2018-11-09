@extends('masterpage')

@section('content')

    <h2>Edit intake for <b>{{ $intake->meal }} on {{ $intake->ate_on }}</b></h2><br />

    @include('partials.alerts')

    <form method="post" action="{{action('IntakeController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="meal" value="{{ $intake->meal }}" />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="food_id">Food</label>
                <select class="custom-select" id="food_id" name="food_id" required>
                    @foreach ($foods as $food)
                        <option
                            value="{{ $food->id }}"
                            @if ($food->id == $intake->food_id)
                                selected
                            @endif
                        >{{ $food->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="ate_on">Ate on</label>
            <input type="text" class="form-control" name="ate_on" value="{{$intake->ate_on}}">
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="meal">Meal time</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @foreach ($meals as $meal => $mealTitle)
                    <label class="btn btn-outline-secondary @if ($intake->meal == $meal) active @endif">
                        <input type="radio" name="meal" autocomplete="off" value="{{ $meal }}"> {{ $mealTitle }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="">Quantity</label>
                <input type="text" class="form-control" name="weight"  value="{{$intake->weight}}" placeholder="weight" pattern="[0-9]*">
            </div>
            <div class="form-group col-6">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" name="number" value="{{$intake->number}}" placeholder="unit">
            </div>
        </div>

        <div class="col-8 mx-auto pt-4" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block">Update Intake</button>
        </div>
    </form>

@endsection