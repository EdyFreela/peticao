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
  margin-top: 10px;
  display: block;
}

.assine-mobile {
    position: fixed;
    bottom: 0;
    width: 100%;
    border-top: 1px solid #f6f4f6;
    padding: 10px;
    background-color: #fff;
    display:none;
    z-index: 1000;
}
.assine-mobile button{
    width:100%;
}
/* Extra Small Devices, Phones */ 
@media only screen and (max-width : 770px) {
    .assine-mobile {
        display:block;
    }
    .panel-peticao-assinar{
        display:none;
    }
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default peticao-descricao">
                <div class="panel-body">
                    <h1>{{ $item->title }}</h1>
                    <h3>{{ formatDate($item->created_at) }}</h3>
                </div>
                <div class="panel-body">                    
                    <img src="{{ env('APP_URL')}}/{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" class="img-responsive">
                </div>
                <div class="panel-body">
                    <p>@lang('words.peticao_compartilhe')</p>
                    <div class="btn-group btn-group-lg btn-group-share" role="group" aria-label="...">
                      <button type="button" class="btn btn-default btn-share-facebook" data-url="{{ env('APP_URL')}}{{ $item->slug }}" data-href="{{ env('APP_URL')}}{{ $item->slug }}" data-image="{{ env('APP_URL')}}{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" data-title="{{ $item->title }}" data-desc="{{ $item->title }}"><i class="fa fa-facebook" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-twitter" onclick="javascript:MyPopUpWin('http://twitter.com/share?text={{ $item->title }}&url={{ env('APP_URL')}}{{ $item->slug }}&hashtags={{ $item->twitterhashtags }}, 300, 300');"><i class="fa fa-twitter" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default btn-share-email" data-toggle="modal" data-target="#modalShareByMail"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                    </div>                    
                </div>                
                <div class="panel-body">                    
                    {!! $item->conteudo !!}
                </div>
                <div class="panel-body btn-group-share-bottom">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                      <button type="button" class="btn btn-default btn-lg btn-share-facebook" data-url="{{ env('APP_URL')}}{{ $item->slug }}" data-href="{{ env('APP_URL')}}{{ $item->slug }}" data-image="{{ env('APP_URL')}}{{ env('IMAGEM_PETICAO_PATH')}}/{{ $item->imagem }}" data-title="{{ $item->title }}" data-desc="{{ $item->title }}"><i class="fa fa-facebook" aria-hidden="true"></i><span> @lang('words.peticao_compartilhe_bt_1')</span></button>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                      <button type="button" class="btn btn-default btn-lg btn-share-twitter" onclick="javascript:MyPopUpWin('http://twitter.com/share?text={{ $item->title }}&url={{ env('APP_URL')}}{{ $item->slug }}&hashtags={{ $item->twitterhashtags }}, 300, 300');"><i class="fa fa-twitter" aria-hidden="true"></i><span> @lang('words.peticao_compartilhe_bt_2')</span></button>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                      <button type="button" class="btn btn-default btn-lg btn-share-email" data-toggle="modal" data-target="#modalShareByMail"><i class="fa fa-envelope" aria-hidden="true"></i><span> @lang('words.peticao_compartilhe_bt_3')</span></button>
                    </div>
                </div>                
            </div>
            
        <div id="disqus_thread"></div>
        <script>

        //  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        //  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

        var disqus_config = function () {
            this.page.url = '{{ env('APP_URL')}}/{{ $item->slug }}'; // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = '{{ $item->slug }}';              // Replace PAGE_IDENTIFIER with your page's unique identifier variable

            // DISQUS Multilanguage
            <?php
                if (App::isLocale('en')) {
                    echo 'this.language = "en";';
                }
                if (App::isLocale('es')) {
                    echo 'this.language = "es";';
                }
                if (App::isLocale('it')) {
                    echo 'this.language = "it";';
                }                
                if (App::isLocale('pt-br')) {
                    echo 'this.language = "pt_BR";';
                }                                
            ?>
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://campanhas-ipco-org-br.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

        </div>
        <div class="col-md-4 peticao-assinar" id="peticao-assinar">
            <div class="panel panel-default panel-peticao-assinar">
                <div class="panel-heading text-center"><h2><strong>@lang('words.peticao_assine_title')</strong></h2></div>
                @if($item->mostrar_progresso!='N')
                <div class="panel-body">
                    <p>{{ $item->assinaturas_fisica + $item2['apoiantes'] }} @lang('words.peticao_assine_apoiantes')</p>
                    <div class="progress skill-bar ">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $item2['valuenow'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>                    
                    <h2 class="text-center">@lang('words.peticao_assine_objetivo') <?php echo number_format($item->objetivo, 0, ',', '.'); ?></h2>
                </div>
                @endif
                <div class="panel-body text-center"><button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalPeticao"><i class="fa fa-eye" aria-hidden="true"></i> @lang('words.peticao_assine_bt_ler')</button></div>
                <div class="panel-body">

                    {!! Form::open(array('url' => url('/', $item->slug), 'method'=>'POST')) !!}
                    {{ Form::hidden('peticao_id', $item->id) }}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group assinarnome">
                                {!! Form::text('nome', null, array('placeholder' => trans('words.peticao_assine_input_1'),'class' => 'form-control input-lg', 'id'=>'nome')) !!}
                                <span id="nomemsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group assinarsobrenome">
                                {!! Form::text('sobrenome', null, array('placeholder' => trans('words.peticao_assine_input_2'),'class' => 'form-control input-lg', 'id'=>'sobrenome')) !!}
                                <span id="sobrenomemsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group assinaremail">
                                {!! Form::text('email', null, array('placeholder' => trans('words.peticao_assine_input_3'),'class' => 'form-control input-lg', 'id'=>'email')) !!}
                                <span id="emailmsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-8">
                            <div class="form-group">
                                {!! Form::text('cidade', null, array('placeholder' => trans('words.peticao_assine_input_4'),'class' => 'form-control input-lg')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::text('estado', null, array('placeholder' => trans('words.peticao_assine_input_5'),'class' => 'form-control input-lg')) !!}
                            </div>
                        </div>                                                                                                
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg btn-assinar"><i class="fa fa-check" aria-hidden="true"></i> @lang('words.peticao_assine_submit')</button>
                    </div>                    
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    <p>@lang('words.peticao_assine_nota') <a href="{{ url('pg/politica-de-privacidade') }}">@lang('words.peticao_assine_link_politica')</a></p>
                </div>
            </div>
            <div class="panel panel-default peticao-banner-compartilhar">
                <div class="panel-body text-center">
                    <h1>@lang('words.peticao_banner_title')</h1>
                    <h2>@lang('words.peticao_banner_subtitle')</h2>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('words.peticao_assine_bt_fechar')</button>
        <button type="button" class="btn btn-primary" onclick="shareByMail('{{ $item->title }}','{{ env('APP_URL')}}/{{ $item->slug }}');">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalPeticao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">{{ $item->title }}</h3>
      </div>
      <div class="modal-body">
        {!! $item->peticao !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> @lang('words.peticao_assine_bt_fechar')</button>
      </div>
    </div>
  </div>
</div>
<!-- ASSINE MOBILE -->
<div class="assine-mobile"><button type="button" data-toggle="modal" data-target="#assineModal" class="btn btn-lg btn-danger" data-dismiss="modal">@lang('words.peticao_mobile_button')</button></div>

<div class="modal fade" id="assineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">{{ $item->title }}</h3>
      </div>
        {!! Form::open(array('url' => url('/', $item->slug), 'method'=>'POST')) !!}
        {{ Form::hidden('peticao_id', $item->id) }}      
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group assinarnome2">
                    {!! Form::text('nome', null, array('placeholder' => trans('words.peticao_assine_input_1'),'class' => 'form-control input-lg', 'id'=>'nome2')) !!}
                    <span id="nomemsg2"></span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group assinarsobrenome2">
                    {!! Form::text('sobrenome', null, array('placeholder' => trans('words.peticao_assine_input_2'),'class' => 'form-control input-lg', 'id'=>'sobrenome2')) !!}
                    <span id="sobrenomemsg2"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group assinaremail2">
                    {!! Form::text('email', null, array('placeholder' => trans('words.peticao_assine_input_3'),'class' => 'form-control input-lg', 'id'=>'email2')) !!}
                    <span id="emailmsg2"></span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-8">
                <div class="form-group">
                    {!! Form::text('cidade', null, array('placeholder' => trans('words.peticao_assine_input_4'),'class' => 'form-control input-lg')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4">
                <div class="form-group">
                    {!! Form::text('estado', null, array('placeholder' => trans('words.peticao_assine_input_5'),'class' => 'form-control input-lg')) !!}
                </div>
            </div>                                                                                                
        </div>
      </div>
      <div class="modal-body">
          <button type="submit" class="btn btn-success btn-lg btn-assinar-mobile"><i class="fa fa-check" aria-hidden="true"></i> Assinar</button>
      </div>
      {!! Form::close() !!}
      <div class="modal-body">
          <p>Nota: Ao assinar, você aceita receber atualizações do IPCO. Você pode cancelar sua inscrição a qualquer momento. <a href="{{ url('pg/politica-de-privacidade') }}">Política de Privacidade</a></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')
<script>
window.fbAsyncInit = function(){
    FB.init({
        appId: '152883385353924', status: true, cookie: true, xfbml: true }); 
    };
    (function(d, debug){var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if(d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; 
        js.async = true;js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
        ref.parentNode.insertBefore(js, ref);}(document, /*debug*/ false));
    function postToFeed(title, desc, url, image){
    var obj = {method: 'feed',link: url, picture: image, name: title, description: desc};
    function callback(response){}
    FB.ui(obj, callback);
}    
</script>

<script>
    // When the user scrolls the page, execute myFunction 
    window.onscroll = function() {myFunction()};

    // Get the header
    var header = document.getElementById("peticao-assinar");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
</script>
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

<script type="text/javascript">
  $('button.btn-assinar-mobile').on('click', function(){

      var nome      = $('#nome2').val();
      var sobrenome = $('#sobrenome2').val();
      var email     = $('#email2').val();
      var erroqtd   = 0;

      if(nome.length<=2){
        $('#nomemsg2').text('@lang('words.erro_nome')');
        $(".assinarnome2").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#nomemsg2').text('');
        $(".assinarnome2").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      if(sobrenome.length<=2){
        $('#sobrenomemsg2').text('@lang('words.erro_sobrenome')');
        $(".assinarsobrenome2").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#sobrenomemsg2').text('');
        $(".assinarsobrenome2").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var tstmail = re.test(email);

      if(tstmail==false){
        $('#emailmsg2').text('@lang('words.erro_email')');
        $(".assinaremail2").addClass( "has-error has-feedback" );
        erroqtd = 1;
      }else{
        $('#emailmsg2').text('');
        $(".assinaremail2").removeClass( "has-error has-feedback" );
        erroqtd = 0;
      }

      if(erroqtd == 1){
        return false;
      }            
  });
</script>

@endsection
