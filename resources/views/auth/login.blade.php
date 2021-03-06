@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center logo_block">
            <svg xmlns="http://www.w3.org/2000/svg" width="750" height="200"  viewBox="0 0 738.1 199" class="logo_svg">
                <g>
                    <path class="st0" d="M221.5,136.5c0,4.5,3.4,6.8,10.3,6.8h27c7.6,0,11.5,2.7,11.5,8.1c0,3.7-1.4,6.6-4,8.6
		c-2.7,2.1-6.5,3.1-11.3,3.1h-25.7c-9.6,0-16.9-2.4-21.9-7.1c-5-4.7-7.5-11.6-7.5-20.7c0-11.7,4-21.8,11.9-30.3s17.3-12.7,28.3-12.7
		c7.9,0,14.3,2.1,19.2,6.2c4.8,4.2,7.2,9.6,7.2,16.4c0,8.2-3.3,14.3-10,18.2c-3.7,2.2-9.2,3.4-16.6,3.4H221.5z M225.9,120h10
		c6.5,0,9.6-1.4,9.5-4.3c-0.2-3.2-2.3-4.8-6.3-4.8C233.5,110.9,229.1,113.9,225.9,120z"/>
                    <path class="st0" d="M318.9,93.6c2.7-0.8,5.2-1.3,7.3-1.3c7,0,12.7,2.6,17.1,7.9c4.4,5.2,6.6,12.1,6.6,20.4
		c0,16.2-6.2,28.8-18.7,37.8c-4.4,3.2-8.9,4.7-13.6,4.7h-8.6c-6,0-11.1-2.2-15.4-6.5c-2.5,4.3-6.6,6.5-12,6.5
		c-2.6,0-4.8-0.8-6.6-2.5c-1.8-1.7-2.7-3.8-2.7-6.2c0-1.8,0.5-3.9,1.5-6.3l1-2.5l38.1-94l1-2.5c2.8-6.8,7.2-10.2,13.2-10.2
		c2.7,0,5,0.8,6.9,2.5c1.8,1.7,2.8,3.7,2.8,6.1c0,1.9-0.5,4-1.5,6.3l-1,2.5L318.9,93.6z M300.7,138.2c3,3.9,6.6,5.8,10.6,5.8
		c2.9,0,5.4-0.8,7.4-2.5c2.8-2.2,5.2-5.6,7.3-10s3.1-8.4,3.1-11.9c0-2.7-0.8-5-2.4-6.7c-1.6-1.7-3.6-2.6-6.2-2.6
		c-5.8,0-10.4,4.3-13.8,12.8L300.7,138.2z"/>
                    <path class="st0" d="M363.4,116.6h14.9h1.7c5.8,0,8.6,2.6,8.6,7.7c0,5.2-2.9,7.8-8.6,7.8h-1.7h-14.9h-1.7c-2.5,0-4.6-0.7-6.2-2.1
		c-1.6-1.4-2.4-3.3-2.4-5.7c0-2.3,0.8-4.2,2.4-5.6c1.6-1.4,3.7-2.1,6.3-2.1H363.4z"/>
                    <path class="st0" d="M415.6,143.4h10.3c7.6,0,11.5,2.7,11.5,8.1c0,3.7-1.4,6.6-4,8.6c-2.7,2.1-6.5,3.1-11.3,3.1h-14.5
		c-5.3,0-9.5-1.1-12.6-3.3c-3.1-2.2-4.6-5.2-4.6-8.9c0-2,0.6-4.5,1.9-7.6l15-36.9l1-2.5c2.8-6.9,7.3-10.3,13.5-10.3
		c2.5,0,4.7,0.9,6.6,2.5c1.8,1.7,2.8,3.7,2.8,6.1c0,1.9-0.8,4.9-2.5,8.9L415.6,143.4z M427.6,64.6c3.5,0,6.5,1.2,9,3.7
		c2.5,2.5,3.7,5.4,3.7,9c0,3.5-1.2,6.5-3.7,9c-2.5,2.5-5.4,3.7-9,3.7c-3.5,0-6.5-1.2-9-3.7c-2.5-2.5-3.7-5.4-3.7-9
		c0-3.5,1.2-6.5,3.7-9C421.1,65.8,424.1,64.6,427.6,64.6z"/>
                    <path class="st0" d="M492.9,163.2h-26.4c-7.6,0-13.8-2.7-18.5-8c-4.8-5.3-7.1-12.3-7.1-20.7c0-11.3,3.9-21.2,11.7-29.6
		c7.8-8.4,17-12.6,27.6-12.6c7.2,0,13,2,17.5,6c4.5,4,6.7,9.2,6.7,15.6c0,4.5-1.1,8.2-3.4,11.1c-2.2,2.9-5.1,4.3-8.6,4.3
		c-5.6,0-8.4-2.6-8.4-7.8c0-0.8,0-1.5,0-2c0.1-0.7,0.1-1.3,0.1-1.9c0-4.2-2.1-6.4-6.3-6.4c-3.9,0-7.5,2.1-10.8,6.3
		c-3.2,4.2-4.9,8.9-4.9,14c0,4.3,1.3,7.4,4,9.1c2.6,1.8,7.1,2.7,13.4,2.7h17.2c7.7,0,11.6,2.7,11.6,8.1c0,3.6-1.4,6.5-4.1,8.6
		C501.4,162.1,497.6,163.2,492.9,163.2z"/>
                    <path class="st0" d="M553.8,92.3c8.8,0,16,2.8,21.7,8.4c5.7,5.6,8.5,12.7,8.5,21.3c0,6.5-1.5,12.9-4.5,19.3
		c-3,6.4-6.8,11.5-11.6,15.3c-3.2,2.5-6.4,4.2-9.8,5.1c-3.4,0.9-8.1,1.4-14.1,1.4c-9.9,0-16.6-1.2-20-3.5
		c-8.1-5.6-12.2-13.8-12.2-24.7c0-11.5,4.2-21.5,12.5-29.9C532.6,96.5,542.4,92.3,553.8,92.3z M551.6,111.7c-4.5,0-8.6,2.2-12.3,6.6
		c-3.7,4.4-5.5,9.3-5.5,14.6c0,7,3.9,10.6,11.8,10.6c4.6,0,8.2-1.4,10.6-4.3c4.1-4.7,6.2-10,6.2-16c0-3.5-1-6.2-3-8.4
		C557.4,112.8,554.8,111.7,551.6,111.7z"/>
                    <path class="st0" d="M656.2,143.4h10.9c7.7,0,11.6,2.7,11.6,8.1c0,3.7-1.4,6.6-4.1,8.6c-2.7,2.1-6.5,3.1-11.3,3.1h-19
		c-3.7,0-6.8-1.1-9.3-3.4c-2.5-2.2-3.8-5.1-3.8-8.5c0-2.1,0.8-5.2,2.5-9.3l8-19.8c0.8-2.1,1.3-3.7,1.4-5c0.1-1.5-0.5-2.7-1.8-3.7
		c-1.2-1-2.8-1.5-4.8-1.5c-6.2,0-11.3,4.7-15.1,14.1l-10.7,26.4c-3.2,8-8,12-14.4,12c-2.6,0-4.8-0.8-6.6-2.4
		c-1.8-1.6-2.7-3.5-2.7-5.8c0-1.7,0.5-3.7,1.5-6.1l1-2.5l18.4-45.3c2.4-5.9,6.4-8.8,12.1-8.8c4.7,0,8,2.1,10,6.2
		c6.5-5,12.7-7.5,18.6-7.5c5.7,0,10.4,1.6,14.1,4.9c3.7,3.3,5.5,7.4,5.5,12.5c0,2.8-0.7,5.9-2,9.2L656.2,143.4z"/>
                </g>
                <path class="st0" d="M199,99.5c0,55-44.5,99.5-99.5,99.5C44.5,199,0,154.5,0,99.5C0,44.5,44.5,0,99.5,0c39.3,0,73.4,22.8,89.5,56
	c-0.3,0.3-0.5,0.6-0.7,0.9l-2.9,3.6l-35.6,46.3l4.2-38c0.1-1.1,0.2-2.8,0.2-5.1c0-5.7-1.7-10.1-5.1-13.5c-3.4-3.3-8.1-5-13.9-5
	c-9.5,0-17.8,5.1-25,15.4L76.4,109l4.2-42.4c0.2-2.1,0.3-4,0.3-5.8c0-10.4-4.7-15.6-14.2-15.6c-6.4,0-11.4,2.2-15.1,6.6
	c-3.7,4.4-5.8,10.7-6.4,18.8L41,134.1c-0.1,0.8-0.2,1.8-0.2,3c0,8.3,2.2,15,6.5,20.3c4.3,5.2,9.9,7.9,16.7,7.9
	c7.9,0,15-4.7,21.5-14.1l30.9-44.3l-5,27.2c-0.3,1.9-0.4,3.8-0.4,5.6c0,7.2,2.3,13.2,6.8,18.2s10.1,7.4,16.6,7.4
	c8,0,15.7-4.7,23.2-14.1L199,99.1C199,99.2,199,99.3,199,99.5z"/>
                <g>
                    <path class="st0" d="M696.5,66c0,1.1-0.4,2-1.3,2.7c-0.8,0.7-2,1-3.4,1h-3.6c-1.6,0-2.7-0.6-3.3-1.9c-0.5,0.4-0.9,0.7-1.2,1
		c-0.3,0.2-0.6,0.4-0.9,0.6c-0.3,0.2-0.6,0.2-0.9,0.3c-0.3,0-0.7,0.1-1.1,0.1h-3.2c-2.1,0-3.7-0.7-5-2.2c-1.3-1.5-1.9-3.4-1.9-5.8
		c0-1.8,0.3-3.5,1-5.1c0.7-1.7,1.6-3.1,2.7-4.4c1.1-1.3,2.4-2.3,3.9-3.1c1.5-0.8,3-1.1,4.5-1.1c2.4,0,4.2,0.8,5.2,2.5
		c0.9-1.4,2.1-2.1,3.7-2.1c0.8,0,1.5,0.3,2,0.8c0.6,0.5,0.8,1.2,0.8,1.9c0,0.3,0,0.7-0.1,1.1c-0.1,0.4-0.3,0.9-0.5,1.5l-4.1,10h3.1
		c1.2,0,2.1,0.2,2.7,0.6C696.2,64.5,696.5,65.1,696.5,66z M685.8,55.4c0-0.5-0.3-1-0.7-1.3c-0.5-0.4-1.1-0.5-1.8-0.5
		c-0.7,0-1.4,0.2-2.1,0.7c-0.7,0.4-1.3,1-1.9,1.7c-0.6,0.7-1,1.5-1.4,2.4c-0.4,0.9-0.5,1.7-0.5,2.6c0,1.9,0.8,2.9,2.4,2.9h0.7
		c1.5,0,2.5-0.6,3-1.8l2-4.9c0.1-0.2,0.2-0.5,0.3-0.8C685.8,55.8,685.8,55.6,685.8,55.4z"/>
                    <path class="st0" d="M721.2,55.9c0,2.3-0.4,4.5-1.3,6.6c-0.9,2.1-2,3.8-3.5,5.1c-0.8,0.7-1.7,1.2-2.7,1.5c-0.9,0.3-2.2,0.4-3.8,0.4
		c-1,0-1.8,0-2.4-0.1c-0.6-0.1-1.2-0.2-1.6-0.3c-0.4-0.2-0.8-0.4-1.1-0.7c-0.3-0.3-0.7-0.7-1.1-1.1l-7.3,18
		c-0.5,1.3-1.1,2.3-1.8,2.9c-0.7,0.6-1.5,0.9-2.6,0.9c-0.7,0-1.4-0.2-1.9-0.7s-0.8-1.1-0.8-1.8c0-0.3,0-0.7,0.1-1.1
		c0.1-0.4,0.3-0.9,0.5-1.5l13.5-33.2c0.6-1.7,1.8-2.5,3.6-2.5c0.6,0,1.2,0.1,1.6,0.4c0.4,0.2,0.8,0.7,1.2,1.3
		c1.3-1.4,2.9-2.1,4.8-2.1c2,0,3.5,0.7,4.7,2.2C720.6,51.5,721.2,53.5,721.2,55.9z M714.7,56c0-0.8-0.2-1.5-0.7-2
		c-0.5-0.5-1.1-0.7-1.9-0.7c-1,0-1.8,0.3-2.5,0.8c-0.7,0.5-1.2,1.3-1.6,2.5l-2.1,5.1c0.5,0.8,0.9,1.3,1.3,1.5c0.4,0.2,1.1,0.4,2,0.4
		c0.8,0,1.4-0.1,1.9-0.3c0.4-0.2,0.9-0.6,1.3-1.3c0.6-0.8,1.1-1.8,1.6-3C714.5,57.9,714.7,56.9,714.7,56z"/>
                    <path class="st0" d="M737.2,66c0,1.2-0.4,2.1-1.3,2.7c-0.8,0.6-2,0.9-3.5,0.9H728c-1.6,0-2.9-0.3-3.9-1c-0.9-0.7-1.4-1.6-1.4-2.8
		c0-0.4,0-0.7,0.1-1c0.1-0.3,0.2-0.7,0.5-1.3l4.6-11.4c0.6-1.5,1.2-2.5,1.9-3.1c0.7-0.6,1.5-0.9,2.6-0.9c0.8,0,1.5,0.3,2.1,0.8
		c0.6,0.5,0.9,1.2,0.9,1.9c0,0.3,0,0.7-0.1,1c-0.1,0.3-0.3,0.9-0.6,1.7l-4,9.9h3.2c1.3,0,2.2,0.2,2.7,0.6
		C736.9,64.5,737.2,65.1,737.2,66z M738.1,43.2c0,1.1-0.4,2-1.1,2.8c-0.7,0.7-1.7,1.1-2.8,1.1c-1.1,0-2-0.4-2.8-1.1
		c-0.7-0.7-1.1-1.7-1.1-2.8c0-1.1,0.4-2,1.1-2.8c0.7-0.7,1.7-1.1,2.8-1.1c1.1,0,2,0.4,2.8,1.1C737.7,41.2,738.1,42.1,738.1,43.2z"/>
                </g>
            </svg>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
