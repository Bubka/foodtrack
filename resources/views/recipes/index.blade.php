@extends('masterpage')

@section('content')
    <h1>
      Recipes
      <a href="{{ route('recipe.create') }}" class="text-dark">
          <i class="fas fa-plus-square fa-fw fa-xs"></i>
      </a>
    </h1>

    @include('partials.alert_success')

    <table class="table table-striped">
      <tbody>
        @foreach ($recipes as $recipe)
        <tr>
            <td>
              <a href="{{action('RecipeController@show', $recipe->id)}}" >{{ $recipe['name'] }}</a>
              <span style="display: block;">
                {{ $recipe['kcal'] }} kcal ::
                {{ $recipe['protein'] }} ·
                {{ $recipe['carb'] }} ·
                {{ $recipe['lipid'] }}
              </span>
            </td>
            <td style="text-align: right; ">
              <form action="{{action('RecipeController@destroy', $recipe->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <div class="btn-group" role="group">
                  <a href="{{action('RecipeController@edit', $recipe->id)}}" class="btn btn-sm btn-outline-secondary">
                      <i class="far fa-edit"></i>
                  </a>
                  <button id="submitDelete" class="btn btn-outline-secondary btn-sm" type="submit">
                      <i class="far fa-trash-alt"></i>
                  </button>
                </div>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $recipes->links() }}

<script type="text/javascrit">
  $(document).ready(function($){
    $('#submitDelete').on('submit',function(e){
       if(!confirm('Do you want to delete this item?')){
             e.preventDefault();
       }
     });
  });
</script>  

@endsection