
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ \Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (\Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ \Session::get('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (\Session::has('error') OR $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ \Session::get('error') }}
        @if ($errors->any())
        Some errors occured :
        <ul style="margin-bottom: 0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif