
<nav class="navbar navbar-expand-md navbar-light bg-light mb-3">
    <div class="container-fluid">
        <a href="/" class="navbar-brand mr-3 text-dark ">Battleships Game</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(Route::is('pages.play'))
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="{{route('pages.index')}}" class="nav-item nav-link {{ (Route::is('pages.index') ? ' class=active' : '') }}">Home</a>
                <a href="{{route('pages.play')}}" class="nav-item nav-link {{ (Route::is('pages.play') ? ' class=active' : '') }}">New Game</a>
                <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#showModal" >Show</a>
            </div>
        </div>
        @endif
    </div>
</nav>
