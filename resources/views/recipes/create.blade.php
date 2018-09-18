@extends('masterpage')

@section('content')

    <h1>New recipe</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('recipe')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="col-8 mx-auto pt-4" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block">Create Recipe</button>
        </div>
    </form>

    @include('partials.suggest_script')

@endsection
