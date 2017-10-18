@extends('layouts.app')


@section('style')
    <style>
        .btn-admin{
            border-radius: 50%;
            width: 34px;
            height: 34px;            
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <ul class="breadcrumb">
                    <li class="completed"><a href="{{ url('admin/peticoes') }}">Painel</a></li>
                    <li><a href="javascript:void(0);">Assinantes</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-users" aria-hidden="true"></i> Gestão de Assinantes</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('assinantes.create') }}"><i class="fa fa-asterisk" aria-hidden="true"></i> Novo Assinante</a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p><i class="fa fa-check" aria-hidden="true"></i> {{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <th width="1%" class="text-center">#</th>
                    <th width="*">Nome</th>
                    <th width="250px">E-Mail</th>
                    <th width="80px" class="text-center">Petições</th>
                    <th width="80px" class="text-center">Excluir</th>
                </thead>
                <tbody>
                    @if($items->count())
                        @foreach($items as $key => $item)
                            <tr>
                                <td class="text-center"><p>{{ ++$key }}</p></td>
                                <td><p>{{$item->nome}} {{$item->sobrenome}}</p></td>
                                <td><p>{{ $item->email }}</p></td>
                                <td class="text-center"><a class="btn btn-primary btn-md" href="{{ route('assinantes.edit',$item->email) }}" title="Petições Assinadas"><i class="fa fa-check-square-o" aria-hidden="true"></i></a></td>
                                <td class="text-center">
                                    {!! Form::open(['id' => 'item-delete-'.$item->id, 'method' => 'DELETE','route' => ['assinantes.destroy', $item->email],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['data-id' => $item->id, 'class' => 'btn btn-danger btn-md', 'title' => 'Excluir Assinante de todas petições']) !!}
                                    {!! Form::close() !!}                                    
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Não há usuário cadastrado.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {!! $items->render() !!}
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
