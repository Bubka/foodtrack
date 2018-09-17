@extends('masterpage')

@section('content')
<h1>
  Foods
  <a href="{{ route('food.create') }}" class="text-dark">
    <i class="fas fa-plus-square fa-fw fa-xs"></i>
  </a>
</h1>

@include('partials.alert_success')

<table class="table table-striped">
  <tbody>
    @foreach ($foods as $food)
    <tr>
      <td>
        <a href="{{action('FoodController@show', $food->id)}}">{{ $food->name }}</a>
        @isset($food['unitWeight'])
          <span class="text-muted">({{ $food['unitWeight'] }} gr)</span>
        @endisset
        <span style="display: block;">
          {{ $food['kcal'] }} kcal&#64;{{ $food['baseWeight'] }} gr ::
          {{ $food['protein'] }} ·
          {{ $food['carb'] }} ·
          {{ $food['lipid'] }}
        </span>
      </td>
      <td>
        <form action="{{action('FoodController@destroy', $food->id)}}" method="post">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="DELETE">
          <input type="hidden" name="foodId" value="{{ $food->id }}" />
          <div class="btn-group" role="group">
            <a href="{{action('FoodController@edit', $food->id)}}" class="btn btn-sm btn-outline-secondary">
                <i class="far fa-edit"></i>
            </a>
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="far fa-trash-alt"></i>
            </button>
          </div>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $foods->links() }}
@endsection