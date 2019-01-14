<nav class="navbar navbar-expand-sm bg-primary navbar-dark">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2" aria-controls="navbar2" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="d-inline">
    <a href="{{ url('/') }}" title="{{ config('app.name', 'Laravel') }}">
<img src="{{ asset('img/logos/market.png') }}" style="width:50px;height:50px" />
</a>
  <a class="navbar-brand" href="{{ url('/') }}" title="{{ config('app.name', 'Laravel') }}">
    {{ config('app.name', 'Laravel') }}
  </a>
</div>
  <div class="collapse navbar-collapse justify-content-end" id="navbar2">

    <form method="POST" action="{{ route('search') }}"
    style="display:flex;flex:1"
    >
      @csrf
      <div class="input-group">
        <input class="form-control  mr-sm-1" autofocus
        name="q" title="Search here" 
        required="required" 
        type="text" placeholder="Search">
        <div class="input-group-append">
          <span class="input-group-button">
            <button type="submit" title="Search" class="btn btn-outline-light text-light my-2 my-sm-0"><i class="fa fa-search"></i></button></span>
        </div>
      </div>
    </form>

    <div class="d-inline">
      @guest
      <ul class="nav navbar-nav navbar-right">
        <li class=nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
          @if (Route::has('register'))
          <a class="btn btn-sm nav-link btn-outline-default pr-0" href="{{ route('register') }}">{{ __('Register') }}</a>
          @endif
        </li>
      </ul>

      @else
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item ml-2">
          <a href="#" class="nav-link">
          <i class="fa fa-bell-o" title="Notification"></i>
        </a>
        </li>

        @if( Auth::user()->admin)
        <li class="nav-item ml-2">
          <a href="{{ route('admin')}}" class="nav-link">
          <i class="fa fa-user-o" title="Tools"></i>
        </a>
        </li>
        @endif

        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" 
          role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user-circle-o"></i> {{ Auth::user()->firstname . ' ' . Auth::user()->middlename . ' ' . Auth::user()->lastname }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="{{ route('home') }}">
            <i class="fa fa-tachometer"></i> Dashboard</a>

            <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">
              <i class="fa fa-user-o"></i> Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" 
            method="POST" 
            style="display: none;"
            >
            @csrf
          </form>

        </div>

      </li>
    </ul>
    @endguest
  </div>
</div>
</nav>
