@extends('app')

@section('title') Play @parent @endsection

@section('content')
<div class="container-fluid d-flex flex-wrap justify-content">
    <div class="col-md-8">
        <table class="table table-borderless  table-condensed table-responsive-sm w-auto">
            <thead class="table-light">
            <tr>
                <th>#</th>
                @for ($i = 'A'; $i <= 'J'; $i ++)
                <th class="table-light">{{$i}}</th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 10; $i ++)
            <tr>
                <td>{{$i}}</td>
                @for ($k = 'A'; $k <= 'J'; $k ++)
                <td><input type="button" class="btn btn-block btn-info" onclick="fire('{{$i}}','{{$k}}')" value=" "
                           id="{{$i}}{{$k}}"></td>
                @endfor
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered table-condensed ">
            <thead>
            <tr>
                <th>Ship name:</th>
                <th>Ship size</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ships as $ship)
            <tr>
                <td>{{$ship->getName()}}<img src="{{asset('/images/Battleship.png')}}" alt="ship" width="64"></td>
                <td>{{$ship->getLength()}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <h3 id="msg"></h3>
        <h3 id="messageShots"></h3>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ship positions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body w-100">
                <div class="container-fluid d-flex py-9">
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
                                @if($coordinate===$k.$i )
                              <span class="d-none">{{$k++ }}</span>
                                <td class="text-danger">X</td>
                                @endif
                                @endforeach
                                <td></td>
                                @endfor
                            </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
