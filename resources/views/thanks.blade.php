@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success text-center" role="alert">
                @if(session()->has('message'))
                    {!! session()->get('message') !!}
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Deus o abençoe por se importar!</h1>
                    <p>Caro {{ $input->nome }} {{ $input->sobrenome }},</p>

                    <p>Agora, bons pais estão se preparando para uma reunião do conselho escolar. Imagine o impacto de 20.000 petições para parar esta agenda transgênero.</p>

                    <p>Se você me ajudar, acho que podemos reunir 20 mil.</p>

                    <p>- Por favor, compartilhe a petição nas mídias sociais.</p>
                    <p>- Compartilhe o e-mail original que lhe enviei.</p> 
                    <p>- Use o P.S. na mensagem que vou enviar.</p>

                    <p>Deus abençoe.</p>
                    <p>~ John Ritchie</p>

                    <p>Realmente apreciamos o seu apoio.</p>
                    <p>- A equipe da TFP Student Action</p>
                </div>
            </div>            
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h1>Procurando por outras maneiras de ajudar?</h1></div>
                <div class="panel-body text-center">
                    <h2>Compartilhe esta petição</h2>
                    <p>Digamos a palavra, compartilhe isso nas mídias sociais hoje!</p>
                </div>
                <div class="panel-body text-center">
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
