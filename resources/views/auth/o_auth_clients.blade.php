@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Passport</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Auth::user()->access_api)
                            <div id="app">
                                <passport-clients></passport-clients>
                                <passport-authorized-clients></passport-authorized-clients>
                                <passport-personal-access-tokens></passport-personal-access-tokens>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>У Вас нет нужного доступа, свяжитесь с администратором</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection