@extends('layouts.app')

@section('style')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
		    <div>
		        <ul class="breadcrumb">
		            <li class="completed"><a href="{{ url('admin') }}">Painel</a></li>
		            <li class="active"><a href="{{ route('peticaos.index') }}">Petições</a></li>
		            <li><a href="javascript:void(0);">Novo</a></li>
		        </ul>
		    </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-check-square-o" aria-hidden="true"></i> Nova Petição</h2>
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
	{!! Form::open(array('route' => 'peticaos.store','method'=>'POST', 'files' => true)) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titulo:</strong>
                {!! Form::text('title', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagem:</strong>
                <label class="btn btn-default btn-file">
                {!! Form::file('imagem', null, array('placeholder' => 'Imagem','class' => 'form-control', 'style' => 'display: none;')) !!}
                </label>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Objetivo:</strong>
                {!! Form::text('objetivo', null, array('placeholder' => 'Objetivo','class' => 'form-control')) !!}
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
                {!! Form::textarea('peticao', null, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-Mail com a Petição:</strong>
                {!! Form::textarea('conteudomail', null, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-Mails de Destino: <span class="">Separar por virgula os destinatários</span></strong>
                {!! Form::text('mailpeticao', null, array('placeholder' => 'Objetivo','class' => 'form-control')) !!}
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
@endsection