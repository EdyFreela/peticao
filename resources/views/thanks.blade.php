@extends('layouts.guest')

@section('style')
<style>
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
</style>
@endsection

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
                <div class="panel-heading text-center"><h1>Ajude-nos a continuar!</h1></div>
                <div class="panel-body">
                    <p>Caro <strong>{{ $input->nome }} {{ $input->sobrenome }}</strong>,</p>

                    <p>Para manter nossas campanhas e caravanas precisamos da ajuda de pessoas como você!</p>

                    <p>Considere patrocinar essas iniciativas com uma pequena quantia mensal. É graças a Deus mas também à ajuda de nossos amigos e simpatizantes que conseguimos tornar possível nossa ação!</p>

                    <p>Sua doação será usada para imprimir os panfletos, criar os cartazes, faixas e banners e abastecer nossos carros para percorrer o Brasil defendendo os valores básicos da Civilização Cristã.</p>

                    <p>Que Nossa Senhora Aparecida recompense sua doação com muitas graças.</p>

                    <hr>

                    <p>Ao doar para o Instuto você garante:</p>

                    <ul>
                        <li>Que o único compromisso do Instuto Plinio Corrêa de Oliveira seja com a Verdade, e não com patrocinadores que indicam a linha que devemos seguir ou as ações a serem realizadas;</li>
                        <li>Sua doação servirá exclusivamente de esmulo para o fortalecimento de ações de mobilização em defesa deste País e para a divulgação do legado moral e intelectual de Plínio Corrêa de Oliveira;</li>
                        <li>Que sempre haja quem lute por um País onde ideias que culminem na destruição da família NUNCA prevaleçam.</li>
                        <li>Nosso compromisso com a saúde moral da sociedade e em defesa da vida.</li>
                    </ul>

                    <p>Obrigado por não ser omisso ou acomodado!</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h1>Por favor, compartilhe essa iniciativa nas redes sociais</h1></div>
                <div class="panel-body">
                    <p>Você poderia reservar poucos minutos para compartilhar essa petição com seus amigos e sua família? Para nós fazermos a diferença, precisamos de mais pessoas como você para também fazer algo!</p>
                    <p>Cada voz, por mais que seja única, conta nessa batalha espiritual. Então, eu estou escrevendo para pedir para que você compartilhe essa petição com todos os seus amigos que poderiam participar desse esforço. Quem sabe, toda sua lista de contatos!?</p>
                    <p>Simplesmente envie essa mensagem para seus amigos. É simples.</p>
                    <p>Estou contando com você porque não posso fazer isso sozinho.</p>
                    <p>Possa Deus, Nosso Senhor, abençoar e recompensar sua ajuda!</p>
                    <p>Allysson Vidal</p>
                    <p>Ação Jovem IPCO</p>
                </div>
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h1>Doação – Sua contribuição garante a nossa independência!</h1></div>
                <div class="panel-body">
                    <p><strong>Sua contribuição garante a nossa independência</strong> e a manutenção de nossas atividades, como as <strong>conferências – promovidas em São Paulo e em diversas cidades do Brasil</strong> – e especialmente as caravanas (<a href="https://ipco.org.br/o-que-sao-as-caravanas/" target="_blank">clique aqui</a>).</p>
                    <p>Os voluntários da <strong>Ação Jovem do IPCO</strong> estão continuamente em Caravanas que percorrem todo o território nacional em defesa da família natural, baseada no casamento monogâmico e indissolúvel entre um homem e uma mulher, contra o aborto, e alertando ao povo brasileiro sobre o perigo de uma legislação socialista que, sob pretexto de defender a natureza, visa apenas coibir a propriedade privada e a livre iniciativa, pilares de uma ordem verdadeiramente Cristã.</p>
                    <p><strong>Faça com que a Caravana vá mais longe. Ajude as atividades do Instituto Plinio Corrêa de Oliveira!</strong></p>
                    <p>As doações podem ser feitas diretamente na <strong>conta corrente</strong> indicada abaixo ou através do <strong>PayPal</strong> ou <strong>Pagseguro e não há valor mínimo exigido.</strong></p>
                    <p><strong>Sua contribuição fará do Brasil um país com futuro promissor para seu filhos e netos:</strong></p>
                </div>                
                <div class="panel-body text-center">
                    <h2>1) Doação Mensal</h2>
                    <p>Faça sua doação mensal no <strong>valor que preferir</strong> via Paypal ou Pagseguro (Neste último há opção de imprimir boleto):</p>
                    <form action="https://pagseguro.uol.com.br/v2/pre-approvals/request.html" method="post" target="_blank">
                    <table width="100%" height="105px" border="1" cellpadding="4" cellspacing="0" style="font-family: Tahoma; font-size: 9pt; border: 1px solid black; border-collapse: collapse;">
                        <colgroup>
                            <col width="200">
                            <col width="*">
                        </colgroup>
                        <tbody><tr>
                            <td>
                                Doação mensal 
                                <select name="code">
                                    <option value="63AC8BE39E9EC50444FD6FB70E3B1117">R$ 30,00</option>
                                    <option value="99A883709595DED9949B3F9E403877CC">R$ 40,00</option>
                                    <option value="4DABF3E708081DC2245BDFA72C086218">R$ 50,00</option>
                                    <option value="9A81DB615454038884BD6F84FA96125B">R$ 60,00</option>
                                    <option value="DBE29C43EAEAAF2CC4BE6F8D2D37386D">R$ 70,00</option>
                                    <option value="5C281A139A9A5B71142F0FB2E614858A">R$ 80,00</option>
                                    <option value="9B1FA9A8A0A0D18FF42A5FB573647F4C">R$ 90,00</option>
                                    <option value="CCF6305C292984B224C54FB888647129">R$ 100,00</option>
                                    <option value="2153A809BEBE44FDD493BF9EBEFDFE0E">R$ 150,00</option>
                                    <option value="74E2F29B090919544440AF8F6807591B">R$ 200,00</option>
                                    <option value="B049C4E2D2D2AF8BB488FFA9778E465A">R$ 250,00</option>
                                    <option value="DFA9DE5E4F4F23A664E69F8ABCC1C102">R$ 300,00</option>
                                    <option value="09AD9BB92C2C871554840F8060CAD7DC">R$ 350,00</option>
                                    <option value="3F6F84361D1D454EE4612FA19875A1EA">R$ 400,00</option>
                                    </select>
                            </td>
                            <td align="center" valign="middle">
                                <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/120x53-doar.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!">
                            </td>
                        </tr>
                    </tbody></table>

                    </form>

                    <form name="_xclick20" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                <input type="hidden" name="business" value="caravana@ipco.org.br">
                                <input type="hidden" name="currency_code" value="BRL">
                                <input type="hidden" name="no_shipping" value="1">

                    <table width="100%" border="1" cellpadding="4" cellspacing="0" style="font-family: Tahoma; font-size: 9pt; border: 1px solid black; border-collapse: collapse;">
                        <colgroup>
                            <col width="200">
                            <col width="*">
                        </colgroup>
                        <tbody><tr>
                            <td>
                                Doação mensal 
                                <select name="a3">
                                    <option value="30.00">R$ 30,00</option>
                                <option value="40.00">R$ 40,00</option>
                                    <option value="50.00">R$ 50,00</option>
                                    <option value="60.00">R$ 60,00</option>
                                    <option value="70.00">R$ 70,00</option>
                                    <option value="80.00">R$ 80,00</option>
                                    <option value="90.00">R$ 90,00</option>
                                    <option value="100.00">R$ 100,00</option>
                                    <option value="150.00">R$ 150,00</option>
                                    <option value="200.00">R$ 200,00</option>
                                    <option value="250.00">R$ 250,00</option>
                                    <option value="300.00">R$ 300,00</option>
                                    <option value="350.00">R$ 350,00</option>
                                    <option value="400.00">R$ 400,00</option>
                                    </select>
                            </td>
                            <td align="center" valign="middle" style="height:62px;">
                    <input type="hidden" name="item_name" value="Doacao Instituto PCO">
                                <input type="hidden" name="item_number" value="DoacaoMensal">
                                <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira mais fácil e segura de efetuar pagamentos online!">
                                <input type="hidden" name="t3" value="M">                       
                                <input type="hidden" name="p3" value="1">
                            </td>
                        </tr>
                    </tbody></table>
                                <input type="hidden" name="src" value="1">
                                <input type="hidden" name="sra" value="1">
                    </form>


                </div>
                <div class="panel-body text-center">
                    <hr>
                    <h2>2) Doação Única</h2>
                    <p>Faça sua doação mensal no <strong>valor que preferir</strong> via Paypal ou Pagseguro (Neste último há opção de imprimir boleto):</p>
                    <div class="col-md-6">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick">
                        <input name="hosted_button_id" type="hidden" value="RET9EUG2J2K7C">
                        <input alt="PayPal - A maneira fácil e segura de enviar pagamentos online!" name="submit" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" type="image">
                        <img src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" alt="" width="1" height="1" border="0"></form>
                    </div>
                    <div class="col-md-6">
                        <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick">
                        <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                        <input type="hidden" name="currency" value="BRL">
                        <input type="hidden" name="receiverEmail" value="caravana@ipco.org.br">
                        <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/120x53-doar.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!">
                        </form>
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
