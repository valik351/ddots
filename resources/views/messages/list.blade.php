@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="btn btn-primary" href="{{ route('frontend::messages::new') }}" role="button">New dialog</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    @if($dialog_users)
                    <div class="x_content">
                        <table class="table">
                            <tbody>

                            @foreach($dialog_users as $user)
                                <tr>
                                    <td class="wrap-text">{{ $user->name }}</td>
                                    <td>
                                        <a href="{{ route('frontend::messages::dialog', ['id' => $user->id]) }}">{{ $user->getLastMessageWith(Auth::user()->id)->sender->name }}
                                            : {{ $user->getLastMessageWith(Auth::user()->id)->text }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection