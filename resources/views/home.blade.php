@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user()->access_admin)
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <contacts-list></contacts-list>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <p>У Вас нет нужного доступа, свяжитесь с администратором</p>
            </div>
        @endif
    </div>
@endsection