@extends('masterpage')

@section('content')

    <h1>New recipe</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('recipe')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-form-label-lg">Name</label>
            <input type="text" class="form-control form-control-lg" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">Create Recipe</button>
    </form>

    @include('partials.suggest_script')

@endsection
