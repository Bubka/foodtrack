{{-- <nav class="navbar navbar-expand navbar-dark bg-dark"> --}}
<nav class="navbar sticky-top navbar-dark bg-dark">
    <div class="col-xs-4">
        <form class="form-inline">
            <a href="{{ route('intake.daily', ['day' => $days['prevDay']->format('Y-m-d')]) }}" class="btn btn-dark">
                <i class="fas fa-chevron-left fa-fw"></i>
            </a>
        </form>
    </div>
    <div class="col-xs-4">
        <a class="navbar-brand" href="{{ route('intake.daily', ['day' => $days['intakeDate']->format('Y-m-d')]) }}">
            {{ $days['intakeDate']->format('Y-m-d') }}
        </a>
    </div>
    <div class="col-xs-4">
        <form class="form-inline">
            <a href="{{ route('intake.daily', ['day' => $days['nextDay']->format('Y-m-d') ]) }}" class="btn btn-dark">
                <i class="fas fa-chevron-right fa-fw"></i>
            </a>
        </form>
    </div>
</nav>