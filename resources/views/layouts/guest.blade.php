<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entre em Ação!</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/ipco-campanha-guest.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/selo-ipco.png') }}">
    <style>
        .navbar-collapse{
            background-image: url("{{ asset('assets/img/bg-header.png') }}");
            background-repeat: no-repeat;
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
                    <div class="brand"><img id="full" src="{{ url('assets/img/selo-ipco-full.png') }}"></div>
                    <div class="brand"><img id="mini" src="{{ url('assets/img/selo-ipco-mini.png') }}"></div>
                    <div class="empresa">Instituto Plinio Corrêa de Oliveira</div>
                </a>

                <ul class="titulo-ipco-mini">
                    <li>IPCO.org.br</li>
                </ul>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="titulo-ipco-full">
                    <li><span>I</span>NSTITUTO <span>P</span>LÍNIO <span>C</span>ORRÊA DE <span>O</span>LIVEIRA</li>
                </ul>
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-nav-links">
                    <li><a id="quemsomos" href="https://ipco.org.br/quem-somos" target="_blank">Quem Somos</a></li>
                    <li><a id="faleconosco" href="https://ipco.org.br/fale-conosco" target="_blank">Fale Conosco</a></li>
                    <li><a id="doacao" href="https://ipco.org.br/doacao" target="_blank">Doação</a></li>
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
                                <div>
                                    @if(\Auth::user()->avatar==null)
                                        <img src="{{ asset('/assets/img/user/default_avatar.jpg') }}" class="dropdown-login-avatar">
                                    @else
                                        <img src="{{ asset('/assets/img/user') }}/{{ Auth::user()->avatar }}" class="dropdown-login-avatar">
                                    @endif
                                </div>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(\Auth::user()->admin==1)
                                    <li><a href="{{ url('/admin/peticoes') }}"><i class="fa fa-btn fa-tachometer"></i>Painel</a></li>
                                    <li role="separator" class="divider"></li>
                                @else
                                    
                                @endif
                                <li><a href="{{ route('profile.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-user" aria-hidden="true"></i> Perfil</a></li> 
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
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <h4>Ação Jovem IPCO</h4>
                        <div class="col-xs-3 col-md-2">
                            <img src="{{ url('assets/img/selo-ipco.png') }}">
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <p>A Ação Jovem do IPCO é o setor de promoção de campanhas e atividades públicas do Instituto Plinio Corrêa de Oliveira realizadas com o intuito de defender e preservar os pilares básicos da Civilização Cristã” Junte-se a nós! Saiba mais em <a href="mailto:campanhas@ipco.org.br">campanhas@ipco.org.br</a></p>
                        </div>
                </div>
                <div class="col-xs-12 col-md-5 text-right footer-siganos">
                    <h4>SIGA-NOS</h4>
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default btn-siga-facebook" onclick="window.open('https://www.facebook.com/Inst.PCO')"><i class="fa fa-facebook" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-google" onclick="window.open('https://plus.google.com/u/0/+InstitutoPlinioCorr%C3%AAadeOliveiraIPCO')"><i class="fa fa-google-plus" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-feed" onclick="window.open('http://feeds.feedburner.com/feedipco')"><i class="fa fa-rss" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-twitter" onclick="window.open('https://twitter.com/InstitutoPCO')"><i class="fa fa-twitter" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-youtube" onclick="window.open('https://www.youtube.com/user/caravanaipco')"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy text-center">
            &copy <?php echo date('Y'); ?> Instituto Plínio Correa de Oliveira</div>    
    </footer>


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
    window.fbAsyncInit = function(){
        FB.init({
            appId: 'xxxxx', status: true, cookie: true, xfbml: true }); 
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
