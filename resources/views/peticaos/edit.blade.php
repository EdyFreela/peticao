@extends('layouts.app')

@section('style')
    <style>
        .tab-content {
            min-height: 400px;
        }
        .btn-file{
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding-top: 10px;
        }
        #img-upload{
            width: 100%;
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
		            <li class="active"><a href="{{ route('peticaos.index') }}">Petições</a></li>
		            <li><a href="javascript:void(0);">Editar</a></li>
		        </ul>
		    </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-check-square-o" aria-hidden="true"></i> Editar Petição</h2>
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
	{!! Form::model($item, ['method' => 'PATCH','route' => ['peticaos.update', $item->id], 'files' => true]) !!}
	<div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Mostrar Progresso:</strong>
                {!! Form::select('mostrar_progresso', ['S' => 'Mostrar Progresso da Petição', 'N' => 'Não Mostrar Progresso da Petição'], $item->mostrar_progresso, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3">
            <div class="form-group">
                <strong>Objetivo:</strong>
                {!! Form::text('objetivo', null, array('placeholder' => 'Objetivo','class' => 'form-control')) !!}
            </div>
        </div>  
        <div class="col-xs-6 col-sm-6 col-md-3">
            <div class="form-group">
                <strong>Assinaturas Física:</strong>
                {!! Form::text('assinaturas_fisica', null, array('placeholder' => '0','class' => 'form-control')) !!}
            </div>
        </div>              
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default text-center"> 
                <div class="panel-body">
                    <div class="form-group text-center">
                        <img id='img-upload' src="{{ env('APP_URL') }}/{{ env('IMAGEM_PETICAO_PATH') }}/{{ $item->imagem }}" />
                        <div class="col-lg-12 col-sm-12 col-12" style="margin-top: -35px;">
                            <label class="btn btn-success btn-file">
                                <i class="fa fa-pencil" aria-hidden="true"></i><input name="imagem" type="file" style="display: none;" id="imgInp">
                            </label>
                        </div>                            
                    </div>                   
                </div>       
            </div>
        </div>        
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titulo:</strong>
                {!! Form::text('title', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descrição:</strong>
                {!! Form::textarea('descricao', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Link:</strong>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                    {!! Form::text('slug', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </span>
                </div>
            </div>
        </div>        
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Conteúdo:</strong>
                {!! Form::textarea('conteudo', null, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Petição:</strong>
                {!! Form::textarea('peticao', null, array('placeholder' => 'Petição','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Twitter Hashtags:</strong>
                {!! Form::text('twitterhashtags', null, array('placeholder' => 'Objetivo','class' => 'form-control')) !!}
            </div>
        </div>               
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
        </div>
	</div>
	{!! Form::close() !!}	
</div>
@endsection

@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
    </script>

    <script>
    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {

            var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            
            if( input.length ) {
                input.val(log);
            } else {
                //if( log ) alert(log);
            }
        
        });
        function readURL(input) {
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){

            readURL(this);
        });     
    });
    </script>
@endsection