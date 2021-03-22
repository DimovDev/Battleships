@extends('app')

@section('title') Show @parent @endsection

@section('content')
<div class="container-fluid d-flex ">
    <div class="col-md-8">
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th>#</th>
                @for ($i = 'A'; $i <= 'J'; $i ++)
                <th>{{$i}}</th>
                @endfor
            </tr>
            </thead>
            <tbody>

            @for ($i = 1; $i <= 10; $i ++)
            <tr>
                <td>{{$i}}</td>
                @for ($k = 'A'; $k <= 'J'; $k ++)
                    @foreach($mergedCoordinates as $coordinate)
                    @if($coordinate==$k.$i)
                <td class ="">X</td>

                    @endif
                    @endforeach
                @endfor
            </tr>
            @endfor
            </tbody>
        </table>
    </div>

</div>
@endsection
