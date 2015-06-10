@extends('head')
@section('title')
    KOTTER - Login
@stop
@section('content')
    <nav id="top_nav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile_nav">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="/">KOTTER</a>
            </div>
            <div class="collapse navbar-collapse" id="mobile_nav">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {!!Link_to('/auth/login','Koten toevoegen? login')!!}
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   <div class="header_wrapper">
        <div class="header">
            <div class="header_content login_content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">Login</div>
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Oeps!</strong> Er was een probleem met jou gegevens.<br><br>
                                        <ul>
                                            
                                            @foreach ($errors->all() as $error)
                                                @if($error == 'These credentials do not match our records.')
                                                    <li>Deze gegevens zijn niet correct</li>
                                                @else
                                                    <li>{{$error}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">E-Mail</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Wachtwoord</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember"> Hou mij aangemeld
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary btn_login" style="margin-right: 15px;">
                                                Login
                                            </button>

                                            <div><a href="/password/email">wachtwoord vergeten?</a></div>
                                            
                                        </div>
                                        <div class="col-md-6 col-md-offset-3"><br>
                                        	<p>U bent koteigenaar en wenst koten toe te voegen? <br> <a href="/auth/register">Contacteer ons.</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/wow.min.js"></script><!--animeer items vanaf user scrolled-->
    <script src="js/custom.js"></script>

@stop