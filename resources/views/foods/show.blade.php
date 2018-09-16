@extends('masterpage')

@section('content')
    <h2 class="text-capitalize">{{ $food->name }}</h2>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">kcal
            <span class="badge badge-dark badge-pill">{{ $food->kcal }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">proteins
            <span class="badge badge-dark badge-pill">{{ $food->protein }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">carbs
            <span class="badge badge-dark badge-pill">{{ $food->carb }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">lipids
            <span class="badge badge-dark badge-pill">{{ $food->lipid }}</span>
        </li>
    </ul>
    <br />
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">Base weight
            <span class="badge badge-dark badge-pill">{{ $food->baseWeight }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">Unit weight
            <span class="badge badge-dark badge-pill">{{ $food->unitWeight }}</span>
        </li>
    </ul>

    <div class="mt-3 row justify-content-center">
        <div class="col-5">
            <a href="{{ action('FoodController@edit', $food->id)}}" class="btn btn-sm btn-block btn-outline-secondary">Edit</a>
        </div>
        <div class="col-5">
            <form action="{{action('FoodController@destroy', $food->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-sm btn-block btn-outline-secondary" type="submit">Delete</button>
            </form>
        </div>
    </div>
    
    
    
    @if (count($intakes))
    <h4 class="mt-4 text-capitalize">Intakes
        <span class="text-muted">({{ count($intakes) }})</span>
    </h4>
    <ul class="timeline">
        @foreach ($intakes as $intake)
        <li><a href="{{ route('intake.show', ['id' => $intake->id]) }}" >{{ $intake->meal }} on {{ $intake->ate_on }}</a></li>
        @endforeach
    </ul>
    @endif

@endsection
