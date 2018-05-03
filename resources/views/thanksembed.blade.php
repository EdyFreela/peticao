@extends('layouts.external')

@section('style')
<style>
#logo{
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
.alert-success h2 {
    font-size: 18px;
}
.doacao h1 {
    font-size: 17px;
}
.doacao p {
    font-size: 12px;
}
.alert {
    padding: 5px;
    margin-bottom: 0px;
}
</style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <img id="logo" src="{{ asset('assets/img/selo-ipco.png') }}"> <h1 class="title">ipco.org.br</h1>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="alert alert-success text-center" role="alert">
            @if(session()->has('message'))
                {!! session()->get('message') !!}
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 doacao">
        <h1>Doação – Sua contribuição garante a nossa independência! </h1>
        <p>Sua contribuição garante a nossa independência e a manutenção de nossas atividades, como as conferências – promovidas em São Paulo e em diversas cidades do Brasil – e especialmente as caravanas</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ url('/doacao')}}" class="btn btn-success btn-md" target="blank">Faça sua Doação</a>
    </div>


@endsection

@section('script')

@endsection
