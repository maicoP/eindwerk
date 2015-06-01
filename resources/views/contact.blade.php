@extends('head')

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
                        <a class="page-scroll" href="/contact">Contact</a>
                    </li>
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
                            <div class="panel-heading">Contact</div>
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Oeps!</strong> Er was een probleem met jou gegevens.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {!!Form::open(['url' => '/message/send','action' => 'post','role' => 'form', 'class' => 'form-horizontal'])!!}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Naam</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="naam" value="{{ old('naam') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">E-Mail adres</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Bedrijf</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="bedrijf" value="{{ old('bedrijf') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Boodschap</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="boodschap" rows="4" cols="50"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary col-md-12" style="margin-right: 15px;">
                                                Verzenden
                                            </button>
                                            
                                        </div>
                                    </div>
                                {!!Form::close()!!}
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