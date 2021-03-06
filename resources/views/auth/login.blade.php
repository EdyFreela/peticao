@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <div class="login-header text-center">
                <img src="{{ url('assets/img/selo-ipco.png') }}">
            </div>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12">E-Mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" tabindex="1">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6">Senha</label>
                            <label for="password" class="col-md-6"><a href="{{ url('/password/reset') }}">Esqueceu sua Senha?</a></label>
                            
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" tabindex="2">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Me Lembre
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-login" tabindex="3">
                                    <i class="fas fa-sign-in-alt"></i> Acesso
                                </button>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <a href="redirect" class="btn btn-primary col-sm-12 col-md-12 col-lg-12">
                                    <i class="fab fa-facebook-square"></i> Acessar com Facebook
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <a href="{{ url('/register') }}">Crie uma Conta</a>
                </div>
            </div>

            <div class="login-footer">
                <a href="{{ url('/pg/termos-de-uso') }}">Termos</a>
                <a href="{{ url('/pg/politica-de-privacidade') }}">Privacidade</a>
                <a href="https://ipco.org.br/fale-conosco" target="_blank">Contate-nos</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(function(){
    $("#email").focus();
});
</script>
@endsection
