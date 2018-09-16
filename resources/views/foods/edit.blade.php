@extends('masterpage')

@section('content')

    <h2>Edit <b>{{ $food->name }}</b></h2><br  />

    
    @include('partials.form_error')

    <form method="post" action="{{action('FoodController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
            <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{$food->name}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="kcal">KCal</label>
                <input type="text" class="form-control" name="kcal" value="{{$food->kcal}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="protein">Proteins</label>
                <input type="text" class="form-control" name="protein" value="{{$food->protein}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="carb">Carbs:</label>
                <input type="text" class="form-control" name="carb" value="{{$food->carb}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="lipid">Lipids:</label>
                <input type="text" class="form-control" name="lipid" value="{{$food->lipid}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="baseWeight">Base weight</label>
                <input type="text" class="form-control" name="baseWeight" value="{{$food->baseWeight}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="unitWeight">Unit weight</label>
                <input type="text" class="form-control" name="unitWeight" value="{{$food->unitWeight}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Update Food</button>
            </div>
        </div>
    </form>

@endsection