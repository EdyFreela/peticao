@extends('layouts.external')

@section('style')
<style>
.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #d0d0d0;
    border-radius: 4px;
    -webkit-box-shadow: none;
    box-shadow: inset none;
}
.progress .skill {
  font: normal 12px "Open Sans Web";
  line-height: 35px;
  padding: 0;
  margin: 0 0 0 20px;
  text-transform: uppercase;
}
.progress .skill .val {
  float: right;
  font-style: normal;
  margin: 0 20px 0 0;
}
.progress-bar {
  text-align: left;
  transition-duration: 3s;
}
.peticao-descricao{
    border: 0px solid;
    font-family: 'Merriweather', serif;
}
.peticao-assinar .panel-default>.panel-heading {
    color: #fff;
    background-color: #e6222e;
}
.peticao-assinar .panel-peticao-assinar .panel-body{
    background-color: #eee;
}

.btn {
    border: 0px solid transparent;
}

.panel-comente textarea{
    height: 70px;
}
.panel-comentarios img{
    width:48px;
    height:48px;
    float:left;
    margin-right:10px;
    margin-bottom:10px;
    display:block;
}
#nomemsg, #sobrenomemsg, #emailmsg{
    font-weight: bold;
    color: #a94442;
    margin-top: 2px;
    display: block;
}
#full{
    width: 30px;
    float:left;
}
.title{
    float:left;
    font-size: 18px;
    margin-top: 5px;
    margin-bottom: 0px;
    margin-left: 10px;
}
.title-peticao{
    font-size: 18px;
    text-align: center;
    min-height: 70px;
    margin: 0;
}
</style>
@endsection

@section('content')

    {!! Form::open(array('url' => url('/', $slug), 'method'=>'POST')) !!}
    {{ Form::hidden('peticao_id', $id) }}
    {{ Form::hidden('peticao_embed', 'Y') }}
    {{ Form::hidden('peticao_slug', $slug) }}

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <img id="full" src="{{ asset('assets/img/selo-ipco.png') }}"> <h1 class="title">ipco.org.br</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 title-peticao">{!! $title !!}</div>
        </div>        
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group assinarnome">
                    {!! Form::text('nome', null, array('placeholder' => trans('words.peticao_assine_input_1'),'class' => 'form-control input-md', 'id'=>'nome')) !!}
                    <span id="nomemsg" class="small"></span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group assinarsobrenome">
                    {!! Form::text('sobrenome', null, array('placeholder' => trans('words.peticao_assine_input_2'),'class' => 'form-control input-md', 'id'=>'sobrenome')) !!}
                    <span id="sobrenomemsg" class="small"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group assinaremail">
                    {!! Form::text('email', null, array('placeholder' => trans('words.peticao_assine_input_3'),'class' => 'form-control input-md', 'id'=>'email')) !!}
                    <span id="emailmsg" class="small"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-8">
                <div class="form-group">
                    {!! Form::text('cidade', null, array('placeholder' => trans('words.peticao_assine_input_4'),'class' => 'form-control input-md')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    {!! Form::text('estado', null, array('placeholder' => trans('words.peticao_assine_input_5'),'class' => 'form-control input-md')) !!}
                </div>
            </div>
        </div>                                                                                                
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success btn-md btn-assinar"><i class="fa fa-check" aria-hidden="true"></i> @lang('words.peticao_assine_submit')</button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <hr>
            </div>
        </div>                    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <small>@lang('words.peticao_assine_nota') <a href="{{ url('pg/politica-de-privacidade') }}">@lang('words.peticao_assine_link_politica')</a></small>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('script')

<script type="text/javascript">
  $('button.btn-assinar').on('click', function(){

      var nome      = $('#nome').val();
      var sobrenome = $('#sobrenome').val();
      var email     = $('#email').val();
      var erroqtd   = 0;

      if(nome.length<=2){
        $('#nomemsg').text('@lang('words.erro_nome')');
        $(".assinarnome").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#nomemsg').text('');
        $(".assinarnome").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      if(sobrenome.length<=2){
        $('#sobrenomemsg').text('@lang('words.erro_sobrenome')');
        $(".assinarsobrenome").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#sobrenomemsg').text('');
        $(".assinarsobrenome").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var tstmail = re.test(email);

      if(tstmail==false){
        $('#emailmsg').text('@lang('words.erro_email')');
        $(".assinaremail").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#emailmsg').text('');
        $(".assinaremail").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      if(erroqtd == 1){
        return false;
      }            
  });
</script>

@endsection
