@extends('masterpage')

@section('content')

    <h2 class="text-capitalize mb-4">{{ $intake->meal }} on {{ $intake->ate_on }}</h2>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('food.show', ['id' => $intake->food->id]) }}" >{{ $intake->food->name }}</a>
            @isset($intake->weight)
                <span class="badge badge-dark badge-pill">{{ $intake->weight }} gr</span>
            @endisset
            @isset($intake->number)
                <span class="badge badge-dark badge-pill">x{{ $intake->number }} ({{ $intake->food->unitWeight * $intake->number }}gr)</span>
            @endisset
        </li>
    </ul>
    <br />
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">kcal
            <span class="badge badge-dark badge-pill">{{ $intake->kcal }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">proteins
            <span class="badge badge-dark badge-pill">{{ $intake->protein }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">carbs
            <span class="badge badge-dark badge-pill">{{ $intake->carb }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">lipids
            <span class="badge badge-dark badge-pill">{{ $intake->lipid }}</span>
        </li>
    </ul>

    <div class="mt-3 row justify-content-center">
        <div class="col-5">
                <a href="{{action('IntakeController@edit', $intake->id)}}" class="btn btn-sm btn-block btn-outline-secondary">Edit</a>
        </div>
        <div class="col-5">
            <form action="{{action('IntakeController@destroy', $intake->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-sm btn-block btn-outline-secondary" type="submit">Delete</button>
            </form>
        </div>
    </div>

@endsection
