@extends('masterpage')

@section('content')

    <h1>New food</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('food')}}">
    {{csrf_field()}}
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="kcal">KCal</label>
            <input type="text" class="form-control" name="kcal" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="protein">Proteins</label>
            <input type="text" class="form-control" name="protein" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="carb">Carbs</label>
            <input type="text" class="form-control" name="carb" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="lipid">Lipids</label>
            <input type="text" class="form-control" name="lipid" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="baseWeight">Base weight</label>
            <input type="text" class="form-control" name="baseWeight" value="100" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="unitWeight">Unit weight</label>
            <input type="text" class="form-control" name="unitWeight" >
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Add Food</button>
        </div>
    </div>
    </form>

@endsection