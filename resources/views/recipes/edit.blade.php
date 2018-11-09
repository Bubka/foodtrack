@extends('masterpage')

@section('content')

    <h1>Edit recipe</h1><br  />


    @include('partials.alerts')

    <form method="post" action="{{action('RecipeController@update', $recipe->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{$recipe->name}}" required>
        </div>
        <div class="col-8 mx-auto pt-4" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block">Update Recipe</button>
        </div>
    </form>

@endsection