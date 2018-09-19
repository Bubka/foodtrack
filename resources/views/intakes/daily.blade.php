@extends('masterpage')

@section('content')
    <h1 class="mb-4">Daily intakes</h1>
    <h6>Energy: <span class="text-monospace">{{ $intakes->sum('kcal') }}kcal</span></h6>
    <div class="progress mb-3" style="height: 6px;">
        <div class="progress-bar {{ $progressColor['kcal'] }}" 
            role="progressbar"
            style="width: {{ $dailyStat['kcal'] }}%;" 
            aria-valuenow="{{ $dailyStat['kcal'] }}" 
            aria-valuemin="0" 
            aria-valuemax="100">
        </div>
    </div>
    <h6>Proteins: <span class="text-monospace">{{ $intakes->sum('protein') }}gr</span></h6>
    <div class="progress mb-3" style="height: 6px;">
        <div class="progress-bar {{ $progressColor['protein'] }}" 
            role="progressbar"
            style="width: {{ $dailyStat['protein'] }}%;" 
            aria-valuenow="{{ $dailyStat['protein'] }}" 
            aria-valuemin="0" 
            aria-valuemax="100">
        </div>
    </div>
    <h6>Lipids: <span class="text-monospace">{{ $intakes->sum('lipid') }}gr</span></h6>
    <div class="progress mb-3" style="height: 6px;">
        <div class="progress-bar {{ $progressColor['lipid'] }}" 
            role="progressbar"
            style="width: {{ $dailyStat['lipid'] }}%;" 
            aria-valuenow="{{ $dailyStat['lipid'] }}" 
            aria-valuemin="0" 
            aria-valuemax="100">
        </div>
    </div>

    @include('partials.alert_success')

    <br />

    <h3>Breakfast
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="breakfast">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($breakfastIntakes) > 0)
        <small class="float-right">{{ $breakfastIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $breakfastIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    <h3>Morning Snack
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="morningsnack">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($morningSnackIntakes) > 0)
        <small class="float-right">{{ $morningSnackIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $morningSnackIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    <h3>Lunch
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="lunch">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($lunchIntakes) > 0)
        <small class="float-right">{{ $lunchIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $lunchIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    <h3>Afternoon Snack
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="afternoonsnack">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($afternoonsnackIntakes) > 0)
        <small class="float-right">{{ $afternoonsnackIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $afternoonsnackIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    <h3>Diner
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="diner">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($dinerIntakes) > 0)
        <small class="float-right">{{ $dinerIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $dinerIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    <h3>Evening Snack
        <a class="text-body" href="#modalNewIntake" data-toggle="modal" data-target="#modalNewIntake" data-whatever="eveningsnack">
            <i class="fas fa-plus-square fa-sm fa-fw"></i>
        </a>
    @if (count($eveningSnackIntakes) > 0)
        <small class="float-right">{{ $eveningSnackIntakes->sum('kcal') }} kcal</small></h3>
        @include('partials.intake_table', array('intakes' => $eveningSnackIntakes))
    @else
        </h3><div class="mb-4 text-secondary">no intake here</div>
    @endif

    {{-- modal form --}}
    <div class="modal fade" id="modalNewIntake" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New intake for <span class="font-weight-bold" id="mealTitle"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="food-tab" data-toggle="tab" href="#foodTab" role="tab" aria-controls="food" aria-selected="true">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="recipe-tab" data-toggle="tab" href="#recipeTab" role="tab" aria-controls="recipe" aria-selected="false">Recipe</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="foodTab" role="tabpanel" aria-labelledby="food-tab">
                    <br />
                    <form id="addFoodForm" method="post" action="{{url('intake')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="meal" class="meal-name"/>
                        <input type="hidden" name="ate_on" value="{{ $intakeDate->format('Y-m-d') }}" />
                        <div class="form-group">
                            <label for="food">Food</label>
                            <br />
                            <input type="text" class="form-control" name="food" id="food" autocomplete="off" required>
                            <input type="hidden" name="suggestedId" id="suggestedId" value="" />
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Quantity</label>
                                <input type="text" class="form-control" name="weight" placeholder="weight" pattern="[0-9]*">
                            </div>
                            <div class="form-group col-6">
                                <label for="">&nbsp;</label>
                                <input type="text" class="form-control" name="number" placeholder="number" >
                            </div>
                        </div>
                    </form>    
                </div>
                <div class="tab-pane fade" id="recipeTab" role="tabpanel" aria-labelledby="recipe-tab">
                    <br />
                    <form id="addRecipeForm" method="post" action="{{url('intake/addRecipe')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="mealName" class="meal-name"/>
                        <input type="hidden" name="intakeDate" value="{{ $intakeDate->format('Y-m-d') }}" />
                        <div class="form-group">
                            <label for="recipe">Recipe</label>
                            <br />
                            <input type="text" class="form-control" name="recipe" id="recipe" autocomplete="off" required>
                            <input type="hidden" name="recipeSuggestedId" id="recipeSuggestedId" value="" />
                        </div>
                    </form>  
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="" id="submitbutton">Add</button>
            </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#modalNewIntake').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var mealName = button.data('whatever'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body .meal-name').val(mealName);
            $('#mealTitle').text(mealName);
            $('#submitbutton').attr('form', 'addFoodForm');
            $('#food-tab').tab('show');
        })

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if( $(e.target).is('#food-tab')) {
                $('#submitbutton').attr('form', 'addFoodForm');
            }
            else
            {
                $('#submitbutton').attr('form', 'addRecipeForm');
                //e.relatedTarget // previous active tab
            }
            
        })

    </script>

    @include('partials.suggest_script')
    
@endsection