@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <ul class="breadcrumb">
                    <li class="completed"><a href="{{ url('admin/peticoes') }}">Painel</a></li>
                    <li class="active"><a href="{{ route('usuarios.index') }}">Administradores</a></li>
                    <li><a href="javascript:void(0);">Visualizar</a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-lock" aria-hidden="true"></i> Visualizar Administrador</h2>
                    </div>
                </div>
            </div>          
        </div>
    </div>
    <div class="row">        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                Nome:
                <h4>{{$item[0]->name}}</h4>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                E-Mail:
                <h4>{{$item[0]->email}}</h4>    
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                Criado em:
                <h4>{{formatDateTimeBR($item[0]->created_at)}}</h4>    
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                Atualizado em:
                <h4>{{formatDateTimeBR($item[0]->updated_at)}}</h4>    
            </div>
        </div>                
    </div>  
</div>
@endsection
