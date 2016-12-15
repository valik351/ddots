@extends('layouts.main')

@section('content')
    <div class="container">

        <!-- logo and title -->
        <div class="container">
            <div>
                <a class="navbar-brand" href="{{ action('HomeController@index') }}">
                    <img src="{{ asset('frontend-bundle/media/dots.png') }}">
                </a>
            </div>
            <div>
                <h4>
                    <p>
                        С 16 февраля 2016 тестирующая система DOTS доступна для преподавателей информатики Харькова
                        и Харьковской области. Теперь все, кто преподаёт программирование, сможет зарегистрировать в
                        системе своих учеников, объединять их в группы и проводить практикумы по программированию с
                        использованием тестирующей системы. </p>
                </h4>
            </div>
        </div>

        <!-- description -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Что такое dots?</div>
                    <div class="card-block">
                        <p class="text-justify">
                            <b>Dots</b> - это тестирующая система для dots.org.ua, написаная на Python, sh и C и
                            интенсивно
                            использующая все возможности Docker контейнеров и Cgroup подсистемы ядра, запуская
                            компиляторы и
                            тестируя пользовательские решения в отдельных Docker контейнерах. Такой подход делает DDots
                            максимально гибкой и модульной системой. <br> <br>

                            Один DDots обрабатывает одно решение в единицу времени и предзагружает два решения в очередь
                            для
                            уменьшения задержек, связанных с сетью. Таким образом, для нагрузки нескольких ядер
                            рекомендуется запускать N контейнеров DDots (это делается автоматически, Makefile
                            автоматически
                            определяет количество доступных ядер и использует все возможности). <br><br>
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- news -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">News</div>
                    @each('partial.news_item', \App\News::main()->orderBy('created_at', 'desc')->take(3)->get(), 'news_item')
                    <div class="card-block">
                        <a href="{{ url('news') }}" class="btn btn-success pull-right">Latest news</a>
                    </div>

                </div>

            </div>
        </div>

        <hr class="hidden-border">
        <!-- news -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">@lang('layout.description_2')</div>

                    @foreach(\App\Subdomain::get() as $subdomain)
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="{{ $subdomain->getUrl() }}"><img src="{{ $subdomain->image }}"
                                                                              alt="sponsor-logo" class="sponsor-logo"/></a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ $subdomain->getUrl() }}">{{ $subdomain->title }}</a>
                                </div>
                                <div class="col-sm-4">
                                    {{ $subdomain->description }}
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <div class="card-block">
                        <a href="#" class="btn btn-success pull-right">@lang('layout.all_subdomains')</a>
                    </div>
                </div>

            </div>
        </div>

        <hr class="hidden-border">
        <!-- news -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">@lang('layout.supported_by')</div>
                    <div class="card-block">
                        @foreach(\App\Sponsor::main()->inRandomOrder()->take(3)->get() as $sponsor)

                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="{{ $sponsor->link }}"><img
                                                src="{{ $sponsor->image }}"
                                                alt="sponsor-logo" class="sponsor-logo"/></a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ $sponsor->link }}">{{ $sponsor->name }}</a>
                                </div>
                                <div class="col-sm-4">
                                    {{ $sponsor->description }}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <a href="{{ url('sponsors') }}"
                           class="btn btn-success pull-right">@lang('layout.all_sponsors')</a>
                    </div>
                </div>

            </div>
        </div>


        <hr class="hidden-border">
        <!-- news -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">@lang('layout.sub_teachers_mentors')</div>
                    <div class="card-block">
                        @foreach(App\User::teacher()->inRandomOrder()->take(3)->get() as $teacher)
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="{{ url('user', ['id' => $teacher->id]) }}"><img
                                                src="{{ $teacher->avatar }}"
                                                alt="sponsor-logo" class="sponsor-logo"/></a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ url('user', ['id' => $teacher->id]) }}">{{ $teacher->name }}</a>
                                </div>
                                <div class="col-sm-4 breaking-word">
                                    {{ $teacher->description }}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <a href="{{ url('teachers') }}"
                           class="btn btn-success pull-right">@lang('layout.all_teachers_mentors')</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
