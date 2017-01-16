<header class="navbar navbar-dark bg-inverse navbar-static-top bd-navbar">

    <nav>
        <div class="nav-wrapper container">
            <a href="{{ action('HomeController@index') }}" class="brand-logo ">{{ App\Subdomain::currentSubdomain()->fullname }}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="{{ Request::is('teachers') ? 'active' : '' }}">
                    <a href="{{ url('/teachers') }}">@lang('menu.teachers')</a>
                </li>
                @if (Auth::check() && Auth::user()->hasRole(App\User::ROLE_TEACHER))
                    <li class="{{ Request::is('groups') ? 'active' : '' }}">
                        <a href="{{ url('/groups') }}">@lang('menu.groups')</a>
                    </li>
                    <li class="{{ Request::is('students') ? 'active' : '' }}">
                        <a href="{{ url('/students') }}">@lang('menu.students')</a>
                    </li>
                    <li class="{{ Request::is('problems') ? 'active' : '' }}">
                        <a href="{{ url('/problems') }}">@lang('menu.problems')</a>
                    </li>
                    <li class="{{ Request::is('disciplines') ? 'active' : '' }}">
                        <a href="{{ url('/disciplines') }}">@lang('menu.disciplines')</a>
                    </li>
                @endif

                @if(Auth::check())
                    <li class="{{ Request::is('contests') ? 'active' : '' }}">
                        <a href="{{ url('/contests') }}">@lang('menu.contests')</a>
                    </li>
                @endif

                @if (Auth::check())
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="menu_user_dropdown">{{ Auth::user()->nickname }} <i class="fa fa-caret-down"></i>
                        </a>
                    </li>
                @endif

                @if (!Auth::check())
                    <li>
                        <a href="{{ url('/register') }}">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            @lang('menu.register')
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

</header>

@if(Auth::check())
    <ul id="menu_user_dropdown" class="dropdown-content">
        <li class="{{ Request::fullUrl() == route('frontend::user::profile', ['id' => Auth::user()->id]) ? 'active' : '' }}">
            <a href="{{ route('frontend::user::profile', ['id' => Auth::user()->id]) }}">@lang('menu.profile')</a>
        </li>

        <li class="{{ Request::is('messaging') ? 'active' : '' }}">
            <a href="{{ url('/messaging') }}">@lang('menu.messaging')</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="{{ url('/logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                @lang('menu.logout')
            </a>
        </li>
    </ul>
@endif