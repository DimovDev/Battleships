<nav class="py-2">
    <ul class="nav nav-pills float-right px-2">
        <li class="nav-item px-2 btn btn-outline-secondary" role="button" {{ (Request::is('/') ? ' class=active' : '') }}><a href="{{route('pages.index')}}">Home</a></li>
        <li class="nav-item px-2 btn btn-outline-primary" role="button" {{ (Request::is('play') ? ' class=active' : '') }}><a href="{{route('pages.play')}}">Play</a></li>
        <li class="nav-item px-2 btn btn-outline-success" role="button" {{ (Request::is('show') ? ' class=active' : '') }} data-toggle="modal" data-target="#showModal" >Show</li>
    </ul>
</nav>
