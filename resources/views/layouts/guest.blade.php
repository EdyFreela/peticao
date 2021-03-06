<?php

if($_SERVER['REQUEST_URI']=='/'){
    $title = trans('words.title');
}else if($_SERVER['REQUEST_URI']=='/register'){
    $item = new stdClass();
    $item->title = 'Registre-se IPCO.org.br';
    $item->facebooktitulo = 'Registre-se IPCO.org.br';
    $item->facebookdescricao = 'Registre-se em Campanhas IPCO.org.br';
    $item->slug = 'register';
    $item->imagem = 'xxx';
    $title = $item->title;
}else if($_SERVER['REQUEST_URI']=='/password/reset'){
    $item = new stdClass();
    $item->title = 'Redefinir Senha IPCO.org.br';
    $item->facebooktitulo = 'Redefinir Senha IPCO.org.br';
    $item->facebookdescricao = 'Redefinir Senha em Campanhas IPCO.org.br';
    $item->slug = 'password/reset';
    $item->imagem = 'xxx';
    $title = $item->title;    
}else{
    $title = $item->title;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
if($_SERVER['REQUEST_URI']!='/'){
    ?>
    <meta name="title" content="{{ $item->facebooktitulo }}">
    <meta name="description" content="{{ $item->facebookdescricao }}">
    <meta property="og:url" content="{{ env('APP_URL')}}{{ $item->slug }}" />
    <meta property="og:title" content="{{ $item->facebooktitulo }}" />
    <meta property="og:description" content="{{ $item->facebookdescricao }}" />
    <meta property="og:image" content="{{ env('APP_URL')}}{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" />
    <meta property="og:type" content="article" />
    <meta property="article:published_time" content="<?php echo date('Y-m-d H:i:s'); ?>">
    <meta property="fb:app_id" content="152883385353924">
    <?php
}
?>

    <title><?php echo $title?></title>

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
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
        @media (min-width: 768px){
            .navbar-nav>li>a {
                padding-top: 6px;
            }
            .navbar-nav>.dropdown-login>a div:first-child{
                padding-right:10px;
            }            
        }
        .language-login{
            margin-bottom: 0;
        }
        .language-login p{
            font-size: 10px;
            color: #9d9d9d;
            margin-bottom: 5px;
            margin-top: 15px;
            text-align: right;
            line-height: 1.2em;
        }
        .language-large{
            list-style: none;
        }
        .language-large li{
            display:inline-block;
            padding-left:2px;
            padding-right:2px;
        }
        .language-large li a img{
            border: 2px solid transparent;
            border-radius: 100%;
        }
        .language-large li a img:hover{
            border: 2px solid #ffffff87;
            border-radius: 100%;
        }        
        .language-login .dropdown-login div{
            float:left;
        } 
        .language-login .dropdown-login div p{
            font-size: 16px;            
            margin: 5px 0px 0px 0px;
            padding: 0;
        }       
        .navbar-nav-links .language-mobile{
            display:none;
        }
        .navbar-nav-links .language-mobile p{
            font-size: 12px;
            color: #9d9d9d;
            margin-bottom: 5px;
            margin-top: 10px;
            padding-right: 10px;
            text-align: center;
        }
        .navbar-nav-links .language-mobile ul{
            list-style: none;
            margin: 0;
            padding: 0px 0px 10px 15px;
            border-bottom: 1px solid #263347;    
        }
        .navbar-nav-links .language-mobile li{
            display:inline-block;
        }
        .navbar-nav-links .language-mobile li .flag-en,
        .navbar-nav-links .language-mobile li .flag-es,
        .navbar-nav-links .language-mobile li .flag-it,
        .navbar-nav-links .language-mobile li .flag-fr,
        .navbar-nav-links .language-mobile li .flag-de{
            width:35px;
            padding-right: 10px;
        }
        .navlinks {
            list-style: none;
            margin: 0;
            padding: 0;
            display: inline-flex;
            font-size: 18px;
        }
        .navlinks li a{
            color: #9d9d9d;
        }
        .navlinks li a:hover{
            color: #fff;
            text-decoration: none;
        }
        .navlinks li:first-child {
            padding-right: 20px;
        }
        .navlinks li:last-child {
            padding-left: 20px;
        }                                  
        @media only screen and (max-width : 770px) {
            .navbar-nav-links .language-mobile{
                display:block;
            }
            .language-large, .language-large-title{
                display:none;
            }
            .language-login{
                float: left !important;
                margin: 0;
                padding: 0;
            }       
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
                <ul class="nav-left">
                    <li>
                        <ul class="titulo-ipco-full">
                            <li><span>I</span>NSTITUTO <span>P</span>LINIO <span>C</span>ORRÊA DE <span>O</span>LIVEIRA</li>
                            <li>
                                <ul class="navlinks">
                                    <li><a id="quemsomos" href="https://ipco.org.br/quem-somos" target="_blank">@lang('words.header_link_1')</a></li>
                                    <li><a id="faleconosco" href="https://ipco.org.br/fale-conosco" target="_blank">@lang('words.header_link_2')</a></li>
                                    <li><a id="doacao" href="https://ipco.org.br/doacao" target="_blank">@lang('words.header_link_3')</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-nav-links">
                            <li class="language-mobile">
                                {!! Form::open(array('url' => url('/pg/language/'), 'name' => 'formLanguage', 'id' => 'formLanguage', 'method'=>'POST')) !!}
                                {{ Form::hidden('language', 'pt-br', array('id'=> 'language')) }}                       
                                <ul>
                                    <li><p>@lang('words.header_link_4')</p></li>
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('en');"><img src="{{ asset('/assets/img/flag-en.png') }}" class="flag-en"></a></li>
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('es');"><img src="{{ asset('/assets/img/flag-es.png') }}" class="flag-es"></a></li>
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('it');"><img src="{{ asset('/assets/img/flag-it.png') }}" class="flag-it"></a></li>
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('fr');"><img src="{{ asset('/assets/img/flag-fr.png') }}" class="flag-fr"></a></li>
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('de');"><img src="{{ asset('/assets/img/flag-de.png') }}" class="flag-de"></a></li>                  
                                    <li><a href="javascript:void(0);" onclick="changeLanguage('pt-br');"><img src="{{ asset('/assets/img/flag-pt-br.png') }}" class="flag-pt-br"></a></li>
                                </ul>
                                {!! Form::close() !!}
                            </li>                  
                            <li class="language-mobile"><a id="quemsomos" href="https://ipco.org.br/quem-somos" target="_blank">@lang('words.header_link_1')</a></li>
                            <li class="language-mobile"><a id="faleconosco" href="https://ipco.org.br/fale-conosco" target="_blank">@lang('words.header_link_2')</a></li>
                            <li class="language-mobile"><a id="doacao" href="https://ipco.org.br/doacao" target="_blank">@lang('words.header_link_3')</a></li>
                            <!--
                                // DOAÇÃO
                                <li><a id="doacao" href="{{ url('/doacao/doe') }}">Doação</a></li>
                            -->
                        </ul>                             
                    </li>
                </ul>
                <ul class="nav-right language-login">
                    <li>
                        <div style="float:right;">
                            {!! Form::open(array('url' => url('/pg/language/'), 'name' => 'formLanguageMobile', 'id' => 'formLanguageMobile', 'method'=>'POST')) !!}
                            {{ Form::hidden('languageMobile', 'pt-br', array('id'=> 'languageMobile')) }}                            
                            <p class="language-large-title">@lang('words.header_link_4')</p>
                            <ul class="language-large">
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('en');"><img src="{{ asset('/assets/img/flag-en.png') }}" class="flag-en"></a></li>
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('es');"><img src="{{ asset('/assets/img/flag-es.png') }}" class="flag-es"></a></li>
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('it');"><img src="{{ asset('/assets/img/flag-it.png') }}" class="flag-it"></a></li>
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('fr');"><img src="{{ asset('/assets/img/flag-fr.png') }}" class="flag-fr"></a></li>
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('de');"><img src="{{ asset('/assets/img/flag-de.png') }}" class="flag-de"></a></li>                   
                                <li><a href="javascript:void(0);" onclick="changeLanguageMobile('pt-br');"><img src="{{ asset('/assets/img/flag-pt-br.png') }}" class="flag-pt-br"></a></li>
                            </ul>
                            {!! Form::close() !!}                            
                        </div>
                        <div>
                            <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                    <li><a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i> Acesso</a></li>
                                    <li><a href="{{ url('/register') }}"><i class="far fa-edit"></i> Registrar</a></li>
                                @else                               
                                    <li class="dropdown dropdown-login">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <div>
                                            <p><strong>{{ Auth::user()->name }}</strong></p>                                          
                                        </div>
                                        <div>
                                            @if(\Auth::user()->avatar==null)
                                                <img src="{{ asset('/assets/img/user/default_avatar.jpg') }}" class="dropdown-login-avatar">
                                            @else
                                                <img src="{{ Auth::user()->avatar }}" class="dropdown-login-avatar">
                                            @endif
                                        </div>
                                        <span class="caret"></span>
                                      </a>
                                      <ul class="dropdown-menu">
                                        @if(\Auth::user()->admin==1)
                                            <li><a href="{{ url('/admin/peticoes') }}"><i class="fas fa-tachometer-alt"></i> Painel</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ route('profile.edit',Auth::user()->id) }}"><i class="fas fa-btn fa-user" aria-hidden="true"></i> Perfil</a></li> 
                                            <li role="separator" class="divider"></li>
                                        @else
                                            
                                        @endif
                                        <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                                      </ul>
                                    </li>
                                @endif
                            </ul>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <h4>@lang('words.footer_title')</h4>
                        <div class="col-xs-3 col-md-2">
                            <img src="{{ url('assets/img/selo-ipco.png') }}">
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <p>@lang('words.footer_text') <a href="mailto:campanhas@ipco.org.br">campanhas@ipco.org.br</a></p>
                        </div>
                </div>
                <div class="col-xs-12 col-md-5 text-right footer-siganos">
                    <h4>@lang('words.footer_siga')</h4>
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default btn-siga-facebook" onclick="window.open('https://www.facebook.com/Inst.PCO')"><i class="fab fa-facebook-f" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-google" onclick="window.open('https://plus.google.com/u/0/+InstitutoPlinioCorr%C3%AAadeOliveiraIPCO')"><i class="fab fa-google-plus-g" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-feed" onclick="window.open('http://feeds.feedburner.com/feedipco')"><i class="fas fa-rss" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-twitter" onclick="window.open('https://twitter.com/InstitutoPCO')"><i class="fab fa-twitter" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-siga-youtube" onclick="window.open('https://www.youtube.com/user/caravanaipco')"><i class="fab fa-youtube" aria-hidden="true"></i></button>
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
        function changeLanguageMobile(id){
            $("#languageMobile").val(id);
            $("#formLanguageMobile").submit();
        }
        function changeLanguage(id){
            $("#language").val(id);
            $("#formLanguage").submit();
        }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108397451-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-108397451-1');
    </script>    

    @yield('script')

</body>
</html>
