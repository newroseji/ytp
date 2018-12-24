<header class="blog-header py-3">
<div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1 d-none d-sm-block">
            <a class="text-muted" href="{{ route('about') }}">{{ __('About') }}</a>
          </div>
          <div class="col-4 text-center">

          <a class="blog-header-logo text-dark" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" 
              width="20" height="20" viewBox="0 0 24 24" 
              fill="none" stroke="currentColor" 
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            
            <!-- Authentication Links -->
            @guest
              <a class="btn btn-sm btn-outline-default" href="{{ route('login') }}">{{ __('Login') }}</a>
              
              @if (Route::has('register'))
                <a class="btn btn-sm btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
              @endif
            @else
            <ul class="nav navbar-nav navbar-righ">
            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    

                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="/settings">Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" 
                                        method="POST" 
                                        style="display: none;"
                                    >
                                        @csrf
                                    </form>
                                    
                                </div>
                                
                            </li>
                        @endguest
          </div>

        </div>
        </header>