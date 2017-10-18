@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
		    <div>
		        <ul class="breadcrumb">
		            <li class="completed"><a href="{{ url('admin/peticoes') }}">Painel</a></li>
		            <li class="active"><a href="{{ route('assinantes.index') }}">Assinantes</a></li>
		            <li><a href="javascript:void(0);">Editar</a></li>
		        </ul>
		    </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-check-square-o" aria-hidden="true"></i> Editar Assinantes</h2>
                    </div>
                </div>
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

    <table class="table table-bordered table-hover">
        <thead>
            <th width="1%" class="text-center">#</th>
            <th width="*">Petição</th>
            <th width="150px" class="text-center">Data de Criação</th>
            <th width="80px" class="text-center">Excluir</th>
        </thead>
        <tbody>
            
        @foreach($items as $key => $item)
            <tr>
                <td class="text-center"><p>{{ ++$key }}</p></td>
                <td><p>{{ $item->title }}</p></td>
                <td class="text-center"><p>{{ formatDate($item->created_at) }}</p></td>
                <td class="text-center">
                    {!! Form::open(['id' => 'item-delete-'.$item->id, 'method' => 'DELETE','route' => ['assinantes.destroy', $item->id],'style'=>'display:inline']) !!}
                    {!! Form::button('<i class="fa fa-trash"></i>', ['data-id' => $item->id, 'class' => 'btn btn-danger btn-md', 'title' => 'Excluir Assinante']) !!}
                    {!! Form::close() !!}                                    
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

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
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            },
        });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal('Cancelado', 'Nenhuma registro foi deletado', 'error')
      }
    });

});
 
</script>

@endsection