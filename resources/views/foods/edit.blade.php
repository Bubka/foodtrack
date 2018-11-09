@extends('masterpage')

@section('content')

    <h2>Edit <b>{{ $food->name }}</b></h2><br  />


    @include('partials.alerts')

    <form method="post" action="{{action('FoodController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-row">
            <div class="form-group col-9">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{$food->name}}" required>
            </div>
            <div class="form-group col-3">
                <label for="">kcal</label>
                <input type="text" class="form-control" name="kcal" value="{{$food->kcal}}" pattern="[0-9]*" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label for="">Nutrients</label>
                <input type="text" class="form-control" name="protein" value="{{$food->protein}}" placeholder="proteins" required>
            </div>
            <div class="form-group col-4">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" name="carb" value="{{$food->carb}}" placeholder="carbs" required>
            </div>
            <div class="form-group col-4">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" name="lipid" value="{{$food->lipid}}" placeholder="lipids" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="">Weight</label>
                <input type="text" class="form-control" name="baseWeight" value="{{$food->baseWeight}}" placeholder="base" pattern="[0-9]*" required>
            </div>
            <div class="form-group col-6">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" name="unitWeight" value="{{$food->unitWeight}}" placeholder="unit" pattern="[0-9]*" >
            </div>
        </div>
        <div class="col-8 mx-auto pt-4" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block">Update Food</button>
        </div>
    </form>

@endsection