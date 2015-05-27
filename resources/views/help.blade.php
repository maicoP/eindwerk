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