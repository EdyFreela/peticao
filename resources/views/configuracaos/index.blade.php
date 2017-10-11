@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div>
                <ul class="breadcrumb">
                    <li class="completed"><a href="{{ url('admin/peticoes') }}">Painel</a></li>
                    <li><a href="javascript:void(0);">Configurações</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-cogs" aria-hidden="true"></i> Configurações</h2>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <h3><strong>Whoops!</strong> Houve alguns problemas com a sua entrada.</h3>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p><i class="fa fa-check" aria-hidden="true"></i> {{ $message }}</p>
                </div>
            @endif            

            <div id="exTab2"> 
                <ul class="nav nav-tabs">
                    <li class="active"><a  href="#1" data-toggle="tab"><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail</a></li>
                    <li><a href="#2" data-toggle="tab"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="1">
                        {!! Form::model($mail, ['method' => 'PATCH','route' => ['configuracaos.update', 'mail']]) !!}   
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Driver:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'driver')
                                            {!! Form::text('driver', $val->value, array('placeholder' => 'Driver','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Host:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'host')
                                            {!! Form::text('host', $val->value, array('placeholder' => 'Host','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Port:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'port')
                                            {!! Form::text('port', $val->value, array('placeholder' => 'Port','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Usuário:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'username')
                                            {!! Form::text('username', $val->value, array('placeholder' => 'Usuário','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Senha:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'password')
                                            {!! Form::text('password', $val->value, array('placeholder' => 'Senha','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Encryption:</strong>
                                    @foreach($mail as $key => $val)
                                        @if ($val->name === 'encryption')
                                            {!! Form::text('encryption', $val->value, array('placeholder' => 'Encryption','class' => 'form-control')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
                            </div>                            
                        </div>
                        {!! Form::close() !!}


           
                    </div>

                    <div class="tab-pane" id="2">
                        <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')

<!-- ADITIONAL SCRIPT -->
<script type="text/javascript">

$('button.btn-danger').on('click', function(){

    var id        = $(this).data('id');
    var form_name = 'item-delete-' + id;
    var $inputs   = $('#' + form_name + ' :input');

    var values = {};
    $inputs.each(function() {
        values[this.name] = $(this).val();
    });

    var token = values._token;
    var url   = $('#' + form_name).attr('action');

    swal({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, deletar isso!',
        cancelButtonText: "Não, cancelar!"
    }).then(function (miss) {
        $.ajax({
            url: url,
            data: {_method: 'delete', _token :token},
            type: 'post',
            datatype: 'json',
            success: function (result) {
                swal({
                    title: 'Deletado!', 
                    text: 'Este registro foi deletado.', 
                    type: 'success',
                    allowOutsideClick: false
                }).then(function(result2){
                    if(result2 == true){
                        location.reload();
                    }
                });
            }
        });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal('Cancelado', 'Nenhuma registro foi deletado', 'error')
      }
    });

});
 
</script>

@endsection
