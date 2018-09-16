@extends('masterpage')

@section('content')

    <h1>New recipe</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('recipe')}}">
        {{ csrf_field() }}

        <div class="row">
            <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success">Create Recipe</button>
            </div>
        </div>
    
    </form>

    @include('partials.suggest_script')

@endsection