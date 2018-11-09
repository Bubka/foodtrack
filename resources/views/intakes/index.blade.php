@extends('masterpage')

@section('content')
    <div class="dropdown float-right">
      <a class="btn btn-light " href="#" role="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu">
        <a class="dropdown-item" href="{{url('food/export')}}" >Reuse last breakfast</a>
        <a class="dropdown-item" href="{{url('food/import')}}" >Reuse last morning snack</a>
        <a class="dropdown-item" href="{{url('food/import')}}" >Reuse last lunch</a>
        <a class="dropdown-item" href="{{url('food/import')}}" >Reuse last afternoon snack</a>
        <a class="dropdown-item" href="{{url('food/import')}}" >Reuse last diner</a>
        <a class="dropdown-item" href="{{url('food/import')}}" >Reuse last evening snack</a>
      </div>
    </div>
    <h1>
        Intakes
        <a href="{{ route('intake.create') }}" class="text-dark">
            <i class="fas fa-plus-square fa-fw fa-xs"></i>
        </a>
    </h1>

    @include('partials.alerts')

    <table class="table table-striped">
            <tbody>
              @foreach ($intakes as $intake)

              <tr>
                <td>
                    <a href="{{action('FoodController@show', $intake->food->id)}}" >{{ $intake->food->name }}</a>
                    &#64;{{ $intake->meal }} on <a href="{{ url('intake/daily/' . $intake->ate_on) }}" >{{ $intake->ate_on }}</a>
                  <span style="display: block;">
                    @isset($intake->weight)
                      {{ $intake['weight'] }} gr
                    @endisset
                    @isset($intake->number)
                      x {{ $intake->number }}
                    @endisset
                     - {{ $intake['kcal'] }} kcal ::
                    {{ $intake['protein'] }} ·
                    {{ $intake['carb'] }} ·
                    {{ $intake['lipid'] }}
                  </span>
                </td>
                <td>
                  <form action="{{action('IntakeController@destroy', $intake->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="foodId" value="{{ $intake->id }}" />
                    <div class="btn-group" role="group">
                      {{-- <a href="{{action('IntakeController@edit', $intake->id)}}" class="btn btn-sm btn-outline-secondary">Edit</a>
                      <button class="btn btn-outline-secondary btn-sm" type="submit">Del.</button> --}}

                      <a href="{{action('IntakeController@edit', $intake->id)}}" class="btn btn-sm btn-outline-secondary">
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
          {{ $intakes->links() }}

@endsection