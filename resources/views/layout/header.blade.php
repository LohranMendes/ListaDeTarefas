<nav class="navbar">
    <div class="d-flex align-items-center justify-content-center">
        <a class="navbar-brand" href="{{route("home")}}">
            <span class="title-nav px-3">LisTArefas</span>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="text-nav" href="{{route("home")}}">
                <x-bi-house-fill class="icons-tam d-inline-block"/>Inicial</a>
            </li>
        </ul>
    </div>
    @if(Auth::check())
        <div class="text-end px-5">
            <div class="nav-item dropdown">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="perfilDropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-nav"><b>{{Auth::user()->usuario}}</b> </span>
                </button>
                <div class="dropdown-menu" aria-labelledby="perfilDropdown">
                    <a class="text-nav dropdown-item" href="{{route("mt")}}">Minhas Tarefas</a>
                    <a class="text-nav dropdown-item" href="{{route("logout")}}">Sair</a>
                </div>
            </div>
        </div>
    @else
        @if(Request::url() != route('login'))
            <div class="text-end px-5">
                <a class="text-nav btn btn-outline-light" href="{{route("login")}}"><b>Login</b></a>
            </div>
        @endif
    @endif
</nav>