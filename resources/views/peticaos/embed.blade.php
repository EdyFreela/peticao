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
    .apoiadores p img{
        width: 30px;
    }
    .titulo h1, .footer h1 {
        margin: 0px;
        font-size: 18px;
    }
    .apoiadores, .titulo, .descricao, .footer{
        padding:10px;
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
    <div class="apoiadores">
        <p><img id="full" src="{{ asset('assets/img/selo-ipco.png') }}"> <?php echo number_format(($item->assinaturas_fisica + $item2['apoiantes']), 0, ',', '.'); ?> Apoiadores
    </div>
    <div class="imagem">
        <img src="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" class="img-responsive">
    </div>
    <div class="titulo">
        <h1>{{ $item->facebooktitulo }}</h1>
    </div>
    <div class="descricao">
        {{ $item->facebookdescricao }}
    </div>
    <div class="footer">
        <div class="col-xs-6 col-md-6 col-lg-6 text-left">
            <button type="button" class="btn btn-danger">Leia mais</button>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-6 text-right">
            <h1>ipco.org.br</h1>
        </div>
    </div>
</a>

@endsection