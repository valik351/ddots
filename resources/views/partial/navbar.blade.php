
<header class="navbar navbar-dark bg-inverse navbar-static-top bd-navbar">
    <div class="container">


        <nav>
            <button class="navbar-toggler float-xs-right hidden-sm-up" type="button" data-toggle="collapse" data-target="#bd-main-nav" aria-controls="bd-main-nav" aria-expanded="false" aria-label="Toggle navigation"></button>

            <div class="collapse navbar-toggleable-xs" id="bd-main-nav">
                <a class="navbar-brand" href="{{ action('HomeController@index') }}">
                    {{ App\Subdomain::currentSubdomain()->fullname }}
                </a>
                <ul class="nav navbar-nav ">
                    <li class="nav-item {{ Request::is('teachers') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/teachers') }}">Teachers</a></li>
                    <li class="nav-item {{ Request::is('sponsors') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/sponsors') }}">Sponsors</a></li>

                    @if (Auth::check())
                        <li class="nav-item {{ Request::fullUrl() == route('frontend::user::profile', ['id' => Auth::user()->id]) ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ route('frontend::user::profile', ['id' => Auth::user()->id]) }}">Profile</a></li>
                    @endif

                    @if (Auth::check() && Auth::user()->hasRole(App\User::ROLE_TEACHER))
                        <li class="nav-item {{ Request::is('groups') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/groups') }}">Groups</a></li>
                        <li class="nav-item {{ Request::is('students') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/students') }}">Students</a></li>
                    @endif
                    @if(Auth::check())
                        <li class="nav-item {{ Request::is('contests') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/contests') }}">Contests</a></li>
                        <li class="nav-item {{ Request::is('messaging') ? 'active' : '' }}"><a class="nav-item nav-link" href="{{ url('/messaging') }}">Messaging</a></li>
                    @endif

                    @if (Auth::check())
                        <li class="nav-item float-md-right"><a class="nav-item nav-link" href="{{ url('/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                    @endif
                    @if (!Auth::check())
                        <li class="nav-item float-md-right"><a class="nav-item nav-link" href="{{ url('/register') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Register</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>