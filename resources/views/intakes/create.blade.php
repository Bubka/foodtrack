@extends('masterpage')

@section('content')

    <h1>New intake</h1><br />

    @include('partials.form_error')
    @include('partials.alert_success')

    <form method="post" action="{{url('intake')}}">
        {{ csrf_field() }}
        

        <div class="form-group">
            <label for="food">Food</label>
            <br />
            <input type="text" class="form-control" name="food" id="food" autocomplete="off" required>
            <input type="hidden" name="suggestedId" id="suggestedId" value="" />
        </div>
        <div class="form-row">
            <div class="form-group col-5">
                <label for="ate_on">Ate on</label>
                <input type="text" class="form-control" id="ate_on" name="ate_on" value="{{ Illuminate\Support\Carbon::now()->format('Y-m-d') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="meal">Meal time</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                @foreach ($meals as $meal => $mealTitle)
                <label class="btn btn-outline-secondary">
                    <input type="radio" name="meal" autocomplete="off" value="{{ $meal }}"> {{ $mealTitle }}
                </label>
                @endforeach
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="">Quantity</label>
                <input type="text" class="form-control" name="weight" placeholder="weight">
            </div>
            <div class="form-group col-6">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" name="number" placeholder="number" >
            </div>
        </div>
        <div class="col-8 mx-auto pt-4" style="text-align: center;">
            <button type="submit" class="btn btn-primary btn-block">Add intake</button>
        </div>

    
    </form>

    <script type="text/javascript">
        const picker = datepicker( ('#ate_on'), {
            formatter: function(el, date, instance) {
                // This will display the date as `1/1/2017`.
                var d = date.getDate();
                var m = date.getMonth() + 1; //Month from 0 to 11
                var y = date.getFullYear();
                el.value = '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
            }
        });
    </script>

    @include('partials.suggest_script')

@endsection