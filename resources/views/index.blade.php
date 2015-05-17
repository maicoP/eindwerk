<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KOTTER</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,700,400italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
    <link rel="stylesheet" href="css/custom.css" type="text/css">
</head>

<body id="top">
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
                        <a class="page-scroll" href="#">Contact</a>
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
            <div class="header_content">
                <img src="img/logo.png" alt="">
                <hr>
                <h2 class="slogan">De zoektocht naar je droomkot <br>werd plots een pak aangenamer.</h2>
                <a href="#download" class="btn btn-primary btn_download page-scroll">Download de gratis app</a>
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
                    <p class="info">Met meer dan 1000 exclusieve koten gelegen in Antwerpen 
                    zal je bij ons met zekerheid op het ideale kot van je dromen stuiten. Een aangename en gebruiksvriendelijke interface van de applicatie 
                    zorgt voor de unieke en prettige ervaring</p>
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
                        <p class="feature_text">Browse meer dan 1000 exclusieve koten</p>
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
                        <p class="feature_text">Contacteer een kot eigenaar rechtstreeks</p>
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
                    <a href="#" class="kot">
                        <img src="img/1.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="kot">
                        <img src="img/2.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="kot">
                        <img src="img/3.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="kot">
                        <img src="img/4.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="kot">
                        <img src="img/5.jpg" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="kot">
                        <img src="img/6.jpg" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg_download" id="download">
        <div class="container text-center">
            <div class="download_button">
                <h2>Ontdek je droomkot.</h2>        
                <p><a href=""><img class="download_mobile wow wobble"src="img/android.png" alt=""></a><a href=""><img class="wow wobble download_mobile" src="img/ios.png" alt=""></a></p>
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

</body>
</html>