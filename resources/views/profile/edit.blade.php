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
            width: 200px;
            height: 200px;
            border-radius: 100%;
            border: 5px solid rgba(212, 214, 255, 0.5);
            background-color: #c4ccdf;
        }         
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
		    <div>
		        <ul class="breadcrumb">
		            <li class="completed"><a href="{{ url('admin') }}">Painel</a></li>
		            <li class="active"><a href="{{ route('profile.edit', $item->id) }}">Perfil</a></li>
		            <li><a href="javascript:void(0);">Editar</a></li>
		        </ul>
		    </div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2><i class="fa fa-user" aria-hidden="true"></i> Editar Perfil</h2>
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
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p><i class="fa fa-check" aria-hidden="true"></i> {{ $message }}</p>
        </div>
    @endif
    <div id="exTab2"> 
        <ul class="nav nav-tabs">
            <li class="active"><a  href="#1" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Dados Pessoais</a></li>
            <!-- <li><a href="#2" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i> Acessos</a></li> -->
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="1">

        	{!! Form::model($item, ['method' => 'PATCH','route' => ['profile.update', $item->id], 'files' => true]) !!}
        	<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                    <!-- <img src="{{ asset('/assets/img/default_avatar.jpg') }}" class="profile-login-avatar"> -->
                    <div class="form-group text-center">
                        <img id='img-upload' src="{{$item2}}" />
                        <div class="col-lg-12 col-sm-12 col-12" style="margin-top: -35px;">
                            <label class="btn btn-success btn-file">
                                <i class="fa fa-pencil" aria-hidden="true"></i><input name="avatar" type="file" style="display: none;" id="imgInp">
                            </label>
                        </div>                            
                    </div>
                    <h1>{{$item->name}}</h1>
                    <h4>{{$item->email}}</h4>
                    <hr>
                    <h5>Registrado desde:</h5>
                    <h5>{{formatDateBR($item->created_at)}} &bullet; {{time_elapsed_string($item->created_at)}}</h5>
                </div>
        		<div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Senha:</strong>
                        {!! Form::password('passw', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Confirmar Senha:</strong>
                        {!! Form::password('passw_confirmation', ['class' => 'form-control']) !!}     
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
                    </div>                                                           
                </div>
        	</div>
        	{!! Form::close() !!}

            </div>
            <div class="tab-pane" id="2">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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