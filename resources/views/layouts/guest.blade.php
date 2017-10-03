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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/selo-ipco.png') }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        body > .container{
            min-height: 560px;
        }

        body > .container > .row{
            margin-top: 40px;
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
        .dropdown-login-avatar{
            width: 28px;
            border-radius: 100%
        }        
        .navbar-inverse {
            background-color: #081832;
        }
        .navbar-brand{
            padding: 4px 15px;
        }
        .navbar-brand .brand{
            float:left;
            width: 90px;
        }
        .navbar-brand .empresa{
            float:left;
            padding-top:20px;
            padding-top: 12px;
            padding-left: 10px;
            font-family: 'Merriweather', serif;
            color:#d19429;
        }                
        .navbar-brand .brand img{
            width:100%;
        }
        .navbar-nav-links{
            font-family: 'Merriweather', serif;
        }   

        h2{
            font-weight: 300;
        }
        /* TEMA IPCO */ 
        footer {
            background-color: #081832;
            margin-top: 30px;
            color:#fff;
        }
        footer .container{
            padding-bottom:20px;
        }
        footer h4{
            margin-top:30px;
            margin-bottom: 17px;
        }
        footer p{
            font-size:12px;
        }
        footer .copy{
            background-color: #000;
            font-size: 10px;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        footer img{
            width: 100%;
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
                    <div class="brand"><img src="{{ url('assets/img/selo-ipco.png') }}"></div>
                    <div class="empresa">Instituto Plinio Corrêa de Oliveira</div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-nav-links">
                    <li><a href="https://ipco.org.br/quem-somos" target="_blank">Quem Somos</a></li>
                    <li><a href="https://ipco.org.br/fale-conosco" target="_blank">Fale Conosco</a></li>
                    <li><a href="https://ipco.org.br/doacao" target="_blank">Doação</a></li>
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
            <div class="col-xs-7 col-md-7">
                <h4>SOBRE NÓS</h4>
                    <div class="col-xs-3 col-md-2">
                        <img src="{{ url('assets/img/selo-ipco.png') }}">
                    </div>
                    <div class="col-xs-9 col-md-10">
                        <p>O Instituto Plinio Corrêa de Oliveira é uma associação civil criada com o intuito de mobilizar a sociedade com vistas a preservar os pilares básicos da Civilização Cristã que estão ameaçados pela Revolução anti-cristã; Clique aqui e saiba mais!</p>
                        <p>Contato: contato@ipco.org.br</p>
                    </div>
            </div>
            <div class="col-md-5 col-md-5 text-right">
                <h4>SIGA-NOS</h4>
                <div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default"><i class="fa fa-facebook" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-google-plus" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-rss" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-twitter" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>
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
    @yield('script')

</body>
</html>
