@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- logo and title -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $subdomain->fullname }}</span>
                        <div class="row">
                            <div class="col s2">
                                <img src="{{ $subdomain->image }}" alt="sub-logo" class="subdomain-logo"/>
                            </div>
                            <div class="col s10">
                                <p>{{ $subdomain->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- description -->
        @if(!Auth::check())
            <div class="row">
                <div class="col s12">
                    <div class="card" id="login">
                        <div class="card-content">
                            <span class="card-title">@lang('menu.login')</span>
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="row {{ $errors->has('nickname') ? ' has-danger' : '' }}">

                                    <div class="col m8 offset-m2">
                                        <input class="form-control" type="text" placeholder="@lang('layout.email_nickname')"
                                               name="nickname">

                                        @if ($errors->has('nickname'))
                                            <span class="form-control-feedback">
                                                <strong>{{ $errors->first('nickname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="col m8 offset-m2">
                                        <input class="form-control" type="password" placeholder="@lang('layout.password')"
                                               name="password">
                                        @if ($errors->has('password'))
                                            <span class="form-control-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col m8 offset-m2">
                                        <div class="checkbox">
                                            <input type="checkbox" name="remember" id="remember" class="filled-in">
                                            <label for="remember">@lang('layout.remember_me')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col m8 offset-m2">
                                        <a class="btn btn-social-icon btn-vk"       href="{{ route('social::redirect', ['provider' => 'vkontakte']) }}"><span class="fa fa-vk"></span></a>
                                        <a class="btn btn-social-icon btn-google"   href="{{ route('social::redirect', ['provider' => 'google']) }}"><span class="fa fa-google"></span></a>
                                        <a class="btn btn-social-icon btn-facebook" href="{{ route('social::redirect', ['provider' => 'facebook']) }}"><span class="fa fa-facebook"></span></a>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col m8 offset-m2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i> @lang('menu.login')
                                        </button>

                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">@lang('layout.forgot_password')</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
    @endif
    <!-- news -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">@lang('menu.news')</div>
                        @each('partial.news_item', $subdomain->news()->orderBy('created_at', 'desc')->take(3)->get(), 'news_item')
                    </div>
                    <div class="card-action">
                        <a href="{{ url('news') }}" class="btn btn-success pull-right">@lang('layout.latest_news')</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">@lang('layout.supported_by')</div>
                        <div class="row">
                            @foreach($subdomain->sponsors as $sponsor)
                                <div class="col m4">
                                    <div class="card horizontal">
                                        <div class="card-image">
                                            <img src="{{ $sponsor->image }}" alt="sponsor-logo" class="sponsor-logo" />
                                        </div>

                                        <div class="card-stacked">
                                            <div class="card-content">
                                                {{ $sponsor->description }}
                                            </div>
                                            <div class="card-action">
                                                <a href="{{ $sponsor->link }}">{{ $sponsor->name }}</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('sponsors') }}" class="btn btn-success pull-right">@lang('layout.all_sponsors')</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">@lang('layout.sub_teachers_mentors')</div>
                        <div class="row">
                            @foreach($subdomain->users()->teacher()->inRandomOrder()->take(3)->get() as $teacher)
                                <div class="col m4">
                                    <div class="card horizontal">
                                        <div class="card-image">
                                            <img src="{{ $teacher->avatar }}" alt="sponsor-logo" class="sponsor-logo" />
                                        </div>

                                        <div class="card-stacked">
                                            <div class="card-content">
                                                {{ $teacher->description }}
                                            </div>
                                            <div class="card-action">
                                                <a href="{{ url('user', ['id' => $teacher->id]) }}">{{ $teacher->name }}</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('teachers') }}" class="btn btn-success pull-right">@lang('layout.all_teachers_mentors')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
