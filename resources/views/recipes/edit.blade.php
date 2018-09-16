@extends('masterpage')

@section('content')

    <h1>Edit recipe</h1><br  />

    
    @include('partials.form_error')

    <form method="post" action="{{action('RecipeController@update', $recipe->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">

        <div class="row">
            <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{$recipe->name}}" required>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-md-6">
            <button type="submit" class="btn btn-success">Update Recipe</button>
            </div>
        </div>
    </form>

@endsection