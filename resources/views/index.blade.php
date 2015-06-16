@extends('head')
@section('title')
    KOTTER
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
                <a class="navbar-brand page-scroll" href="#top">KOTTER</a>
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
            <div class="header_content">
                <img class="logo" src="img/logo.png" alt="">
                <hr>
                <h2 class="slogan">De app waarmee je je droomkot vindt in Antwerpen.</h2>
                <p><a href=""><img class="download_mobile" src="img/android.png" alt=""></a><a href=""><img class="download_mobile" src="img/ios.png" alt=""></a></p>
            </div>
        </div>
    </div>

    <div class="window bg_info" id="info">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                    <p><img src="img/phones.png" class="img-responsive img_phones" alt=""></p>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                    <h2>Je droomkot ligt bij ons te wachten.</h2>
                    <hr class="light">
                    <p class="info">Kotter is een onafhankelijk medium tussen student en koteigenaar. De kwaliteit van de koten wordt gegarandeerd door manuele selectie. Elk Kotter-kot vermeldt enkel de totaalprijs. Zo kom je niet voor verrassingen te staan en kan je eenvoudiger koten vergelijken.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="window bg_features" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="window_title">Een unieke ervaring</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="feature">
                        <i class="fa fa-4x fa-home wow bounceInDown icon_color"></i>
                        <p class="feature_text">Enkel totaalprijzen, alles inclusief</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="feature">
                        <i class="fa fa-4x fa-heart wow bounceIn icon_color icon_smaller" data-wow-delay=".1s"></i>
                        <p class="feature_text">Voeg eenvoudig koten toe aan je favorieten</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="feature">
                        <i class="fa fa-4x fa-phone wow bounceIn icon_color" data-wow-delay=".2s"></i>
                        <p class="feature_text">Contacteer een koteigenaar rechtstreeks</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="feature">
                        <i class="fa fa-4x fa-compass wow bounceInUp icon_color" data-wow-delay=".3s"></i>
                        <p class="feature_text">Meet de afstand naar jou universiteit of hogeschool</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="window no_padding" id="fotos">
        <div class="container-fluid">
            <div class="row no_gutter">
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/1.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/2.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/3.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/4.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/5.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="kot">
                        <img src="img/6.jpg" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class='contact_wrapper row'>
        <h2 class="window_title">Contact</h2>
        <p class='text-center'>Contacteer ons als u een koteigenaar bent die interesse heeft in Kotter,<br/> of als u een gebruiker bent met vragen.</p>
        {!!Form::open(['url' => '/message/send','action' => 'post','role' => 'form', 'class' => 'form-horizontal'])!!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class='col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 '>
                <div class="col-md-6 contact_group">
                    <input type="text" class="form-control contact_form col-md-10 " name="naam" value="{{ old('naam') }}" placeholder="Naam" required>
                    <input type="email" class="form-control contact_form col-md-10 " name="email" value="{{ old('email') }}" placeholder="Email" required>
                    <input type="text" class="form-control contact_form col-md-10 " name="bedrijf" value="{{ old('bedrijf') }}" placeholder="Bedrijf">
                </div>

                <div class="col-md-6 contact_group">
                        <textarea class="form-control contact_form col-md-10 " name="boodschap" rows="5" cols="50" placeholder="Boodschap" required></textarea>
                </div>
                
                <button type="button" class="btn btn_contact center-block" style="margin-right: 15px;">
                    Verzenden
                </button>
            </div>
              
        {!!Form::close()!!}
    </div>
    <div class="bg_download" id="download">
        <div class="container text-center">
            <div class="download_button">
                <!-- <h2>Ontdek je droomkot.</h2>    -->     
                <p><a href=""><img class="download_mobile wow wobble" src="img/android.png" alt=""></a><a href=""><img class="wow wobble download_mobile" src="img/ios.png" alt=""></a></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="footertext">KOTTER &copy; 2015 | Maico Paulussen &amp; Matthias Verhoeven</p>
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