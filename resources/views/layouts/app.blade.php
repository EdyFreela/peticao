<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Campanhas IPCO.org.br</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/ipco-campanha-app.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/selo-ipco.png') }}">

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
                    <li><a href="{{ url('/admin/assinantes') }}">Assinantes</a></li>
                    <li><a href="{{ url('/admin/newsletters') }}">Newsletter</a></li>
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
                                <li><a href="{{ url('/') }}"><i class="fa fa-btn fa-home"></i>Inicio</a></li>
                                <li><a href="{{ route('profile.edit',Auth::user()->id) }}"><i class="fa fa-btn fa-user" aria-hidden="true"></i> Perfil</a></li>
                                @if(\Auth::user()->admin==1)
                                    <li><a href="{{ url('/admin/usuarios') }}"><i class="fa fa-btn fa-lock" aria-hidden="true"></i> Administradores</a></li>
                                    <li><a href="{{ url('/admin/configuracoes') }}"><i class="fa fa-btn fa-cogs" aria-hidden="true"></i> Configurações</a></li>
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
