@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <ul class="breadcrumb">
                    <li class="completed"><a href="{{ url('admin') }}">Painel</a></li>
                    <li class="active"><a href="{{ route('assinantes.index') }}">Assinantes</a></li>
                    <li><a href="javascript:void(0);">Novo</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-users" aria-hidden="true"></i> Novo Assinante</h2>
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
    {!! Form::open(array('route' => 'assinantes.store','method'=>'POST', 'files' => true)) !!}
    <div class="row">        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>E-Mail:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Senha:</strong>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>         
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Confirmar Senha:</strong>
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
        </div>
    </div>
    {!! Form::close() !!}   
</div>
@endsection