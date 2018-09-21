<table class="table table-sm">
    <tbody>
        @foreach ($intakes as $intake)
        <tr>
            <td>
                <a href="{{action('IntakeController@show', $intake->id)}}" >{{ $intake->food->name }}</a>
                <span class="">-
                    @isset($intake->weight)
                    {{ $intake['weight'] }}gr
                    @endisset
                    @isset($intake['number'])
                    x{{ $intake['number'] }}
                    @endisset
                </span>
            </td>
            <td style="text-align: right">
                <form action="{{action('IntakeController@destroy', $intake->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <div class="btn-group" role="group">
                        <a href="{{action('IntakeController@edit', $intake->id)}}" class="btn btn-sm btn-light">Edit</a>
                        <button class="btn btn-light btn-sm" type="submit">Delete</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach    
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">
                <span class="text-monospace text-muted float-right">
                    {{ $intakes->sum('protein') }} - {{ $intakes->sum('carb') }} - {{ $intakes->sum('lipid') }}
                </span>
            </td>
        </tr>
    </tfoot>
</table>
<br />