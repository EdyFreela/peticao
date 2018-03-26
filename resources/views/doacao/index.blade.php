@extends('layouts.guest')

@section('style')
<style>
    .setup-content .steps{
        padding-bottom: 20px;
    }
    .setup-content .txt,
    .setup-content .links{
        width:50%;
        float:left;
    }
    .setup-content .setup-panel{
        list-style: none;
        padding: 0;
    }
    .setup-content .setup-panel li{
        display:inline-block;
    }
    #step-1 .panel-body{
        padding:15px 50px;
    }
    #step-1 .input-group{
        margin:20px 0px;
    }
    #step-1 .input-group input{
        text-align: center;
    }
    #step-1 .btn-group{
        margin:20px 0px;
    }
    .setup-content .panel-heading,
    .setup-content .panel-footer{
        padding: 25px 15px;
    }
    .links .setup-panel a{
        display: block;
        background-color: #337ab7;
        width: 30px;
        height: 30px;
        text-align: center;
        font-size: 11px;
        color: #fff;
        border-radius: 100%;
        line-height: 31px;
    }
    .links .setup-panel a:hover{
        background-color: #337ab7;
    }
    .links .setup-panel .disabled a{
        background-color: #c0c0c0;
    }    
</style>
@endsection

@section('content')
<div class="container">

    <div class="row setup-content" id="step-1">
        <div class="row col-md-5 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="steps">
                        <div class="txt">
                            Passos 1 de 2
                        </div>
                        <div class="links">
                            <ul class="setup-panel text-right">
                                <li class="active">
                                    <a href="#step-1">1</a>
                                </li>
                                <li class="disabled">
                                    <a href="#step-2">2</a>
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1>Você pode fazer a diferença!</h1>
                    <p>Todas as pessoas que você ajuda a alcançar estão equipadas para se envolver na guerra cultural</p>
                    <div class="input-group input-group-lg input-doe-valor">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="number" class="form-control" placeholder="10" aria-describedby="basic-addon1" value="10" name="doevalor" id="doevalor">
                      <span class="input-group-addon" id="basic-addon2">,00</span>
                    </div>
                    <div><span id="doevalormsg"></span></div>                
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group btn-group-lg" role="group">
                            <button id="activate-creditcard" type="button" class="btn btn-primary">Cartão de Crédito</button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group">
                            <button id="activate-paypal" type="button" class="btn btn-primary">PayPal</button>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <i class="fa fa-lock"></i> Esta doação é segura e confidencial.
                </div>        
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-2">
        
        <div class="row col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="steps">
                        <div class="txt">
                            Passos 2 de 2
                        </div>
                        <div class="links">
                            <ul class="setup-panel text-right">
                                <li class="active">
                                    <a href="#step-1">1</a>
                                </li>
                                <li class="disabled">
                                    <a href="#step-2">2</a>
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h3>Informações de Pagamento</h3>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group doecardnumber">
                                <input placeholder="Numero do Cartão" class="form-control input-lg" id="cardnumber" name="cardnumber" type="text">
                                <span id="cardnumbermsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group doecardmonth">
                                <select class="form-control input-lg" id="cardmonth" name="cardmonth">
                                    <option value="">Mês</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <span id="cardmonthmsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group doecardyear">
                                <select class="form-control input-lg" id="cardyear" name="cardyear">
                                    <option value="">Ano</option>
                                    <?php 
                                        for ($year = date('Y'); $year <= date('Y')+10; $year++) {
                                            echo '<option value="'.$year.'">'.$year.'</option>';
                                        } 
                                    ?>
                                </select>
                                <span id="cardyearmsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group doecardcvv">
                                <input placeholder="Digito" class="form-control input-lg" id="cardcvv" name="cardcvv" type="text">
                                <span id="cardcvvmsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Doação Recorrente</h3>
                            <input type="checkbox" name="doerecorrente"> Gostaria de fazer isso uma doação mensal recorrente.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Informações de Faturamento</h3>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group doenome">
                                <input placeholder="Nome" class="form-control input-lg" id="doenome" name="doenome" type="text">
                                <span id="nomemsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group doesobrenome">
                                <input placeholder="Sobrenome" class="form-control input-lg" id="doesobrenome" name="doesobrenome" type="text">
                                <span id="sobrenomemsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="checkbox" name="doerecorrente"> Gostaria de doar em nome da minha organização.
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group doeemail">
                                <input placeholder="Email" class="form-control input-lg" id="doeemail" name="doeemail" type="text">
                                <span id="emailmsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group doetelefone">
                                <input placeholder="Telefone" class="form-control input-lg" id="doetelefone" name="doetelefone" type="text">
                                <span id="doetelefonemsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group doeendereco">
                                <input placeholder="Endereço" class="form-control input-lg" id="doeendereco" name="doeendereco" type="text">
                                <span id="doeenderecomsg"></span>
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group doecidade">
                                <input placeholder="Cidade" class="form-control input-lg" id="doecidade" name="doecidade" type="text">
                                <span id="doecidadecomsg"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group doeestado">
                                <input placeholder="Estado" class="form-control input-lg" id="doeestado" name="doeestado" type="text">
                                <span id="doeestadocomsg"></span>
                            </div>
                        </div>                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p>Marque esta caixa para verificar se você não é um spammer.</p>
                            <p>Isto é para sua segurança.</p>                           
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {!! app('captcha')->display()!!}
                            {!! $errors->first('g-recaptcha-response','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="checkbox" name="newsletter"> Envie-me as manchetes diárias gratuitas da IPCO.org.br
                        </div>                        
                    </div>

                </div>
                <div class="panel-footer text-center">
                    <i class="fa fa-lock"></i> Esta doação é segura e confidencial.
                </div>        
            </div>
        </div>

    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <h1 class="text-center"> STEP 3</h1>
            </div>
        </div>
    </div>
    

</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        
        var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');

        allWells.hide();

        navListItems.click(function(e)
        {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this).closest('li');
            
            if (!$item.hasClass('disabled')) {
                navListItems.closest('li').removeClass('active');
                $item.addClass('active');
                allWells.hide();
                $target.show();
            }
        });
        
        $('ul.setup-panel li.active a').trigger('click');
        
        // DEMO ONLY //
        $('#activate-creditcard').on('click', function(e) {
            
            var doevalor = $('#doevalor').val();
            var erroqtd  = 0;

            if(doevalor.length==0){             
                $('#doevalormsg').text('Digite um Valor');
                $(".input-doe-valor").addClass( "has-error has-feedback" );
                return false;
            }

            if(doevalor<10){             
                $('#doevalormsg').text('O Valor deve ser acima de R$10,00');
                $(".input-doe-valor").addClass( "has-error has-feedback" );
                return false;
            }

            $('ul.setup-panel li:eq(1)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-2"]').trigger('click');
            //$(this).remove();
        })

        $('#activate-paypal').on('click', function(e) {
            console.log('paypal');
            $('ul.setup-panel li:eq(2)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-3"]').trigger('click');
            //$(this).remove();
        })            
    });    
</script>
<script src="https://www.google.com/recaptcha/api.js"></script>
@endsection
