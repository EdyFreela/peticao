@extends('layouts.external')

@section('style')
<style>
  .link-embed{
      color:#3a3a3a;
  }
  .link-embed:hover{
      color:#3a3a3a;
      text-decoration: none;
  }    
  .apoiadores p{
      margin: 0px;
  }
  .apoiadores img{
      width: 30px;
  }
  .titulo h1, .footer h1 {
      margin: 0px;
      font-size: 18px;
  }
  .apoiadores, .titulo, .descricao, .footer{
      padding:10px;
  }
  .block-with-text {
    overflow: hidden;
    position: relative; 
    line-height: 1.2em;
    max-height: 6.9em; 
    text-align: justify;  
    margin-right: -1em;
    padding-right: 1em;
  }
  .block-with-text:before {
    content: '...';
    position: absolute;
    right: 0;
    bottom: 0;
  }
  .block-with-text:after {
    content: '';
    position: absolute;
    right: 0;
    width: 1em;
    height: 1em;
    margin-top: 0.2em;
    background: white;
  }
  .footer h1 {
      margin-top: 5px;
  }
  .footer > div {
      padding-left: 0px;
      padding-right: 0px;
  }   
</style>
@endsection

@section('content')

<a href="{{ env('APP_URL')}}{{ $item->slug }}" target="_blank" class="link-embed">
    @if($item->mostrar_progresso!='N')
    <div class="apoiadores">
        <img id="full" src="{{ asset('assets/img/selo-ipco.png') }}" style="float: left; margin-bottom: 10px; margin-right:10px;"> <p style="margin-top: 5px;"><i class="fas fa-users"></i> <?php echo number_format(($item->assinaturas_fisica + $item2['apoiantes']), 0, ',', '.'); ?> {{ $item_interface[0]['embedar_apoiantes'] }}</p>
    </div>
    @else
    <div class="apoiadores" style="float:left;">
        <img id="full" src="{{ asset('assets/img/selo-ipco.png') }}" style="float:left; margin-bottom: 10px;"> <p style="float:left; margin-left: 10px; font-size: 20px; font-weight: bold;">{{ $item->facebooktitulo }}</p>
    </div>
    @endif
    <div class="imagem">
        <img src="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" class="img-responsive">
    </div>
    @if($item->mostrar_progresso!='N')
    <div class="titulo">
        <h1>{{ $item->facebooktitulo }}</h1>
    </div>
    <div class="descricao">
        <div class="block-with-text">
        {{ $item->facebookdescricao }}
        </div>
    </div>    
    @else
    <div class="descricao" style="max-height: 170px; min-height: 170px;">
        <div class="block-with-text">
        {{ $item->facebookdescricao }}
        </div>
    </div>
    @endif

    {!! Form::open(array('route' => 'peticaos.embedForm','method'=>'POST')) !!}
    {{ Form::hidden('peticao_id', $item->id) }}
    {{ Form::hidden('peticao_slug', $item->slug) }}
    <div class="footer">
        <div class="col-xs-6 col-md-6 col-lg-6 text-left">
            <input type="submit" class="btn btn-danger" value="{{ $item_interface[0]['embedar_assine_ja'] }}">
        </div>
        <div class="col-xs-6 col-md-6 col-lg-6 text-right">
            <h1>ipco.org.br</h1>
        </div>
    </div>
    {!! Form::close() !!}
</a>

@endsection