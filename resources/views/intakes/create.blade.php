@extends('masterpage')

@section('content')

    <h1>New intake</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('intake')}}">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="form-group col-md-4">
                <label for="food">Food</label>
                <br />
                <input type="text" class="form-control" name="food" id="food" autocomplete="off" required>
                <input type="hidden" name="suggestedId" id="suggestedId" value="" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
            <label for="ate_on">Ate on</label>
            <input type="text" class="form-control" name="ate_on" value="{{ Illuminate\Support\Carbon::now()->format('Y-m-d') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="meal">Meal time</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @foreach ($meals as $meal => $mealTitle)
                    <label class="btn btn-outline-secondary">
                        <input type="radio" name="meal" autocomplete="off" value="{{ $meal }}"> {{ $mealTitle }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="weight">Weight</label>
                <input type="text" class="form-control" name="weight">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="number">quantity</label>
                <input type="text" class="form-control" name="number">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success">Add Intake</button>
            </div>
        </div>
    </form>

    @include('partials.suggest_script')

@endsection