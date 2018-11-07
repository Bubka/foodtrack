@extends('masterpage')

@section('content')
<div class="dropdown float-right">
  <a class="btn btn-light " href="#" role="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu">
    <a class="dropdown-item" href="{{url('food/export')}}" >Export as JSON</a>
    <a class="dropdown-item" href="{{url('food/import')}}" >Import JSON</a>
  </div>
</div>
<h1>
  Foods
  <a href="{{ route('food.create') }}" class="text-dark">
    <i class="fas fa-plus-square fa-fw fa-xs"></i>
  </a>
</h1>

@include('partials.alert_success')
@include('partials.form_error')

<table class="table table-striped">
  <tbody>
    <tr>
      <td colspan="2">
        <form method="post" action="{{url('food/search')}}">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" class="form-control" name="q" aria-describedby="button-searchButton"
              @if ( null !== Request::input('q') )
                  value="{{ Request::input('q') }}"
              @endif
            >
            <div class="input-group-append">
              @if ( null !== Request::input('q') )
              <a href="{{ route('food.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times-circle fa-fw"></i>
              </a>
              @endif
              <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </form>
      </td>
    </tr>
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
      <td align="right">
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

@if ($showPagination)
  {{ $foods->links() }}
@endif

@endsection