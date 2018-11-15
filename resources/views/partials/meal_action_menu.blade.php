        <div class="small float-right" >
            <div class="dropdown">
                {{ $intakes->sum('kcal') }} kcal&nbsp;
              <a class="btn btn-light btn-sm" href="#" role="button" id="actionMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionMenu">
                <a class="dropdown-item" href="{{url('recipe/from/' . $days['intakeDate']->format('Y-m-d') . '/' . $meal . '/')}}" >Save as recipe</a>
            @if (!$days['intakeDate']->isSameDay($days['today']))
                <a class="dropdown-item" href="{{url('intake/import/' . $days['intakeDate']->format('Y-m-d') . '/' . $meal . '/on/' . $days['today']->format('Y-m-d'))}}" >Reuse as today's {{ $meal }} </a>
            @endif
              </div>
            </div>
        </div>