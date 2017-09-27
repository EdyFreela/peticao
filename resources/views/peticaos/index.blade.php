@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div>
                <ul class="breadcrumb">
                    <li class="completed"><a href="{{ url('admin') }}">Painel</a></li>
                    <li><a href="javascript:void(0);">Petições</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-check-square-o" aria-hidden="true"></i> Gestão de Petições</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('peticaos.create') }}"><i class="fa fa-asterisk" aria-hidden="true"></i> Nova Petição</a>
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
                    <th width="1%">#</th>
                    <th width="*">Titulo</th>
                    <th width="100px">Objetivo</th>
                    <th width="100px">Assinaturas</th>
                    <th width="150px">Data de Criação</th>
                    <th width="80px" class="text-center">Visualizar</th>
                    <th width="80px" class="text-center">Editar</th>
                    <th width="80px" class="text-center">Excluir</th>
                </thead>
                <tbody>
                    @if($items->count())
                        @foreach($items as $key => $item)
                            <tr>
                                <td><p>{{ ++$key }}</p></td>
                                <td><p>{{ $item->title }}</p></td>
                                <td><p>{{ $item->objetivo }}</p></td>
                                <td><p>{{ $item->total }}</p></td>
                                <td><p>{{ formatDate($item->created_at) }}</p></td>
                                <td class="text-center"><a class="btn btn-info btn-md" href="{{ URL::to('/') . '/' . $item->slug }}" target="blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                <td class="text-center"><a class="btn btn-primary btn-md" href="{{ route('peticaos.edit',$item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                <td class="text-center">
                                    {!! Form::open(['id' => 'item-delete-'.$item->id, 'method' => 'DELETE','route' => ['peticaos.destroy', $item->id],'style'=>'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['data-id' => $item->id, 'class' => 'btn btn-danger btn-md']) !!}
                                    {!! Form::close() !!}                                    
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Não há petição cadastrada.</td>
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
