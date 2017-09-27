@extends('layouts.guest')

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
.peticao-descricao .panel{
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
.peticao-assinar .peticao-banner-compartilhar{
    background-color: #333333;
    color:#fff;
}
.btn {
    border: 0px solid transparent;
}
.btn-share-facebook{
    background-color: #3b5998;
}
.btn-share-twitter{
    background-color: #00aced;
}
.btn-share-email{
    background-color: #e6222e;
}
.btn-share-facebook, 
.btn-share-twitter,
.btn-share-email{
    color:#fff;
}

</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 peticao-descricao">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>{{ $item->title }}</h1>
                    <h3>{{ formatDate($item->created_at) }}</h3>
                </div>
                <div class="panel-body">                    
                    <img src="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" class="img-responsive">
                </div>
                <div class="panel-body">

                    <p>Compartilhe esta petição:</p>
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default btn-share-facebook" data-href="{{ env('APP_URL')}}/{{ $item->slug }}" data-image="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" data-title="{{ $item->title }}" data-desc="Some description for this article"><i class="fa fa-facebook" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-twitter" onclick="javascript:MyPopUpWin('http://twitter.com/share?text={{ $item->title }}&url={{ env('APP_URL')}}/{{ $item->slug }}&hashtags={{ $item->twitterhashtags }}, 300, 300');"><i class="fa fa-twitter" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-email" data-toggle="modal" data-target="#modalShareByMail"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                    </div>                    
                </div>                
                <div class="panel-body">                    
                    {!! $item->conteudo !!}
                </div>
            </div>
        </div>
        <div class="col-md-4 peticao-assinar">
            <div class="panel panel-default panel-peticao-assinar">
                <div class="panel-heading text-center"><h2><strong>Assine está petição</strong></h2></div>
                <div class="panel-body">
                    <p>{{ $item2['apoiantes'] }} Apoiantes</p>
                    <div class="progress skill-bar ">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $item2['valuenow'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>                    
                    <h2 class="text-center">Objetivo {{ $item->objetivo}}</h2>
                </div>
                <div class="panel-body">{!! $item->peticao !!}</div>
                <div class="panel-body">
                    {!! Form::open(array('url' => '/assinar','method'=>'POST')) !!}
                    {{ Form::hidden('peticao_id', $item->id) }}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control input-lg')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                {!! Form::text('sobrenome', null, array('placeholder' => 'Sobrenome','class' => 'form-control input-lg')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {!! Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control input-lg')) !!}
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check" aria-hidden="true"></i> Assinar</button>
                    </div>                    
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    <p>Nota: Ao assinar, você aceita receber mensagens de e-mail da IPCO.org.br. Você pode cancelar sua inscrição a qualquer momento. <a href="{{ url('pg/politica-de-privacidade') }}">Política de Privacidade</a></p>
                </div>
            </div>
            <div class="panel panel-default peticao-banner-compartilhar">
                <div class="panel-body text-center">
                    <h1>A luta começa com você.</h1>
                    <h2>Certifique-se de compartilhar esta petição.</h2>
                    <h2>Deus te abençoê.</h2>
                    <div class="btn-group btn-group-lg" role="group" aria-label="...">
                      <button type="button" class="btn btn-default btn-share-facebook" data-href="{{ env('APP_URL')}}/{{ $item->slug }}" data-image="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" data-title="{{ $item->title }}" data-desc="Some description for this article"><i class="fa fa-facebook" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-twitter" onclick="javascript:MyPopUpWin('http://twitter.com/share?text={{ $item->title }}&url={{ env('APP_URL')}}/{{ $item->slug }}&hashtags={{ $item->twitterhashtags }}, 300, 300');"><i class="fa fa-twitter" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-email" data-toggle="modal" data-target="#modalShareByMail"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                    </div>                    
                </div>
            </div>

        </div>        
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalShareByMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Enviar esta página por e-mail</h3>
      </div>
      <div class="modal-body">
      {!! Form::open(array('route' => 'peticaos.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Seu Nome:</strong>
                    {!! Form::text('share_mail_nome', null, array('placeholder' => 'Seu Nome','class' => 'form-control', 'id' => 'share_mail_nome')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nome do Amigo:</strong>
                    {!! Form::text('share_mail_amigo_nome', null, array('placeholder' => 'Nome do Amigo','class' => 'form-control', 'id' => 'share_mail_amigo_nome')) !!}
                </div>
            </div> 
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>E-Mail do Amigo:</strong>
                    {!! Form::text('share_mail_amigo_mail', null, array('placeholder' => 'Nome do Amigo','class' => 'form-control', 'id' => 'share_mail_amigo_mail')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mensagem:</strong>
                    {!! Form::textarea('share_mail_mensagem', null, array('placeholder' => 'Conteúdo','class' => 'form-control', 'id' => 'share_mail_mensagem')) !!}
                </div>
            </div>            
        </div>     
      {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="shareByMail('{{ $item->title }}','{{ env('APP_URL')}}/{{ $item->slug }}');">Enviar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
    )     
});    
</script>
<script>
$('.btn-share-facebook').click(function(){
    elem = $(this);
    postToFeed(elem.data('title'), elem.data('desc'), elem.prop('href'), elem.data('image'));
    return false;
});
</script>
<script>
    function shareByMail($titulo, $url){
        //console.log($titulo + ' - ' + $url);
        var token                 = $('_token').val();
        var titulo                = titulo;
        var url                   = url;
        var share_mail_nome       = $('#share_mail_nome').val();
        var share_mail_amigo_nome = $('#share_mail_amigo_nome').val();
        var share_mail_amigo_mail = $('#share_mail_amigo_mail').val();
        var share_mail_mensagem   = $('#share_mail_mensagem').val();

        $.ajax({
            url: '{{ url('/mail/send') }}',
            data: {_method: 'post', 
                   _token :token, 
                   titulo: titulo,
                   url: url,
                   share_mail_nome: share_mail_nome,
                   share_mail_amigo_nome: share_mail_amigo_nome,
                   share_mail_amigo_mail: share_mail_amigo_mail,
                   share_mail_mensagem: share_mail_mensagem
               },
            type: 'post',
            datatype: 'json',
            success: function (result) {
                //$('#modalShareByMail').modal('toggle');
                console.log(result);
                return false;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //console.log(xhr.status);
                //console.log(thrownError);
            }
        });




    }
</script>
<script>
function MyPopUpWin(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2",
    "status=no,height=" + height + ",width=" + width + ",resizable=yes,left="
    + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
    + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}
</script>
@endsection
