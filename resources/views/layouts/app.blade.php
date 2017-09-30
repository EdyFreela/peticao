<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Petição On-Line</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        body > .container{
            min-height: 750px;
        }

        .fa-btn {
            margin-right: 6px;
        }
        /* NAVBAR */
        .dropdown-toggle-login{
            margin: 0;
            padding: 0;
        }
        .dropdown-toggle-login > div{
            float:left;
            margin-top: -3px;
            margin-right: 5px;
        }
        .dropdown-toggle-login > div > p{
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 1.2;
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
            color: #555;
            cursor: default;
            background-color: #fff;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-top: 2px solid orange;
        }        
        .tab-content {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 20px;
        }                      

        /* CONTENT HEADER */
        .breadcrumb {
            padding: 0px;
            background: #f5f5f5;
            list-style: none; 
            overflow: hidden;
            margin-top: 0px;
            margin-bottom: 10px;
            border-radius: 0px;
        }
        .breadcrumb>li+li:before {
            padding: 0;
        }
        .breadcrumb li { 
            float: left;
            background-color: #d4d4d4;
        }
        .breadcrumb li.active a {
            background: brown;                   /* fallback color */
            background: #d4d4d4; ; 
        }
        .breadcrumb li.completed a {
            background: brown;                   /* fallback color */
            background: hsl(0, 0%, 69%); 
        }
        .breadcrumb li.active a:after {
            border-left: 30px solid #d4d4d4; ;
        }
        .breadcrumb li.completed a:after {
            border-left: 30px solid hsl(0, 0%, 69%);
        } 

        .breadcrumb li a {
            color: white;
            text-decoration: none; 
            padding: 5px 0 5px 45px;
            position: relative; 
            display: block;
            float: left;
            font-size:11px;
        }
        .breadcrumb li a:after { 
            content: " "; 
            display: block; 
            width: 0; 
            height: 0;
            border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
            border-bottom: 50px solid transparent;
            border-left: 30px solid hsla(0, 0%, 83%, 1);
            position: absolute;
            top: 50%;
            margin-top: -50px; 
            left: 100%;
            z-index: 2; 
        }   
        .breadcrumb li a:before { 
            content: " "; 
            display: block; 
            width: 0; 
            height: 0;
            border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
            border-bottom: 50px solid transparent;
            border-left: 30px solid white;
            position: absolute;
            top: 50%;
            margin-top: -50px; 
            margin-left: 1px;
            left: 100%;
            z-index: 1; 
        }   
        .breadcrumb li:first-child a {
            padding-left: 15px;
        }
        .breadcrumb li a:hover { background: #5cb85c  ; }
        .breadcrumb li a:hover:after { border-left-color: #5cb85c   !important; }

        h2{
            font-weight: 300;
        } 

        .container > .row > .col-md-12 > .row > .col-lg-12 > .pull-left > h2,
        .container > .row > .col-md-12 > .row > .col-lg-12 > .pull-right > a{
            margin-top:10px;
            margin-bottom: 20px;
        }

        .table > tbody > tr > td > p {
            padding-top: 8px;
            padding-bottom: 0px;
            margin-bottom: 0px;
        }
        
        .modal {
          text-align: center;
        }

        @media screen and (min-width: 768px) { 
          .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }
        }

        .modal-dialog {
          display: inline-block;
          text-align: left;
          vertical-align: middle;
        }
        footer {
            margin-top: 50px;
            padding-top: 20px;
            padding-bottom: 40px;
            background-color: #d1d1d1;
            text-align: center;
            color: #fff;
            font-size: 12px;
        }               
    </style>

    @yield('style')

</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Petição Online
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                @if (Auth::guest())
                    
                @else
                    <li><a href="{{ url('/admin/peticoes') }}">Petições</a></li>
                @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Acesso</a></li>
                        <li><a href="{{ url('/register') }}">Registrar</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle dropdown-toggle-login" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div>
                                    <p><strong>{{ Auth::user()->name }}</strong></p>
                                    @if(\Auth::user()->admin==1)
                                        <p>Administrador</p>
                                    @else
                                        <p>Usuário</p>
                                    @endif                                          
                                </div>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/') }}"><i class="fa fa-btn fa-home"></i>Inicio</a></li>
                                @if(\Auth::user()->admin==1)
                                    <li><a href="{{ url('/admin/configuracoes') }}"><i class="fa fa-cogs" aria-hidden="true"></i> Configurações</a></li>
                                @endif                                
                                <li role="separator" class="divider"></li>                                
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Sair</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            Sistema de Petição Online<br>
            Instituto Plínio Corrêa de Oliveira<br>
            &copy <?php echo date('Y'); ?> Todos os Direitos Reservados<br>
            by <a href="https://edydias.com.br" target="_blank">EdyDias</a>
        </div>
    </footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.js" crossorigin="anonymous"></script>
    <script>
        window.fbAsyncInit = function(){
        FB.init({
            appId: '{{ env('FACEBOOK_APP_ID') }}', status: true, cookie: true, xfbml: true }); 
        };
        (function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if(d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; 
            js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
            ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
        function postToFeed(title, desc, url, image){
        var obj = {method: 'feed',link: url, picture: 'http://www.url.com/images/'+image,name: title,description: desc};
        function callback(response){}
        FB.ui(obj, callback);
        }        
    </script>
    @yield('script')

</body>
</html>
