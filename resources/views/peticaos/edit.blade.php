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
        .tab-content {
            float: left;
        }
        .radioBtn .notActive{
            color: #3276b1;
            background-color: #fff;
        }
        .idioma-ativo .btn-success,
        .idioma-ativo .btn-danger{
            border:1px solid #c0c0c0 !important;
        }
        .gravar{
            margin-top:15px;
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


          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#portugues" aria-controls="portugues" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-pt-br-admin.png') }}"> Português</a></li>
            <li role="presentation"><a href="#espanhol" aria-controls="espanhol" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-es-admin.png') }}"> Espanhol</a></li>
            <li role="presentation"><a href="#italiano" aria-controls="italiano" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-it-admin.png') }}"> Italiano</a></li>
            <li role="presentation"><a href="#ingles" aria-controls="ingles" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-en-admin.png') }}"> Inglês</a></li>
            <li role="presentation"><a href="#frances" aria-controls="frances" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-fr-admin.png') }}"> Francês</a></li>
            <li role="presentation"><a href="#alemao" aria-controls="alemao" role="tab" data-toggle="tab"><img src="{{ asset('assets/img/flag-de-admin.png') }}"> Alemão</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="portugues">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
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
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo', $item_br[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao', $item_br[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                                                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="espanhol">
                <!--
                <div class="col-xs-12 col-sm-12 col-md-3 idioma-ativo">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="radioBtn btn-group btn-group-justified">
                                <a id="ativo_es_y" class="btn btn-success notActive" data-toggle="ativo_es" data-title="Y">Ativado</a>
                                <a id="ativo_es_n" class="btn btn-danger active" data-toggle="ativo_es" data-title="N">Desativado</a>
                            </div>
                        -->
                            {{ Form::hidden('ativo_es', $item->ativo_es, array('class'=>'ativo_es', 'id'=>'ativo_es')) }}
                        <!--
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ Form::checkbox('redirecionar_es', 'y') }} Redirecionar
                            </span>
                            {!! Form::text('redirecionar_url_es', null, array('placeholder' => 'URL de Redirecionamento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Link:</strong>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            {!! Form::text('slug_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug_es }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao_es', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo_es', $item_es[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao_es', $item_es[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags_es', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo_es', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao_es', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="italiano">
                <!--
                <div class="col-xs-12 col-sm-12 col-md-3 idioma-ativo">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="radioBtn btn-group btn-group-justified">
                                <a id="ativo_it_y" class="btn btn-success notActive" data-toggle="ativo_it" data-title="Y">Ativado</a>
                                <a id="ativo_it_n" class="btn btn-danger active" data-toggle="ativo_it" data-title="N">Desativado</a>
                            </div>
                            -->
                            {{ Form::hidden('ativo_it', $item->ativo_it, array('class'=>'ativo_it', 'id'=>'ativo_it')) }}
                            <!--
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ Form::checkbox('redirecionar_it', 'y') }} Redirecionar
                            </span>
                            {!! Form::text('redirecionar_url_it', null, array('placeholder' => 'URL de Redirecionamento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title_it', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Link:</strong>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            {!! Form::text('slug_it', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug_it }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao_it', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo_it', $item_it[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao_it', $item_it[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags_it', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo_it', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao_it', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="ingles">
                <!--
                <div class="col-xs-12 col-sm-12 col-md-3 idioma-ativo">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="radioBtn btn-group btn-group-justified">
                                <a id="ativo_en_y" class="btn btn-success notActive" data-toggle="ativo_en" data-title="Y">Ativado</a>
                                <a id="ativo_en_n" class="btn btn-danger active" data-toggle="ativo_en" data-title="N">Desativado</a>
                            </div>
                            -->
                            {{ Form::hidden('ativo_en', $item->ativo_en, array('class'=>'ativo_en', 'id'=>'ativo_en')) }}
                            <!--
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ Form::checkbox('redirecionar_en', 'y') }} Redirecionar
                            </span>
                            {!! Form::text('redirecionar_url_en', null, array('placeholder' => 'URL de Redirecionamento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title_en', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Link:</strong>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            {!! Form::text('slug_en', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug_en }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao_en', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo_en', $item_en[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao_en', $item_en[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags_en', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo_en', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao_en', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="frances">
                <!--
                <div class="col-xs-12 col-sm-12 col-md-3 idioma-ativo">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="radioBtn btn-group btn-group-justified">
                                <a id="ativo_en_y" class="btn btn-success notActive" data-toggle="ativo_en" data-title="Y">Ativado</a>
                                <a id="ativo_en_n" class="btn btn-danger active" data-toggle="ativo_en" data-title="N">Desativado</a>
                            </div>
                            -->
                            {{ Form::hidden('ativo_fr', $item->ativo_fr, array('class'=>'ativo_fr', 'id'=>'ativo_fr')) }}
                            <!--
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ Form::checkbox('redirecionar_fr', 'y') }} Redirecionar
                            </span>
                            {!! Form::text('redirecionar_url_fr', null, array('placeholder' => 'URL de Redirecionamento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title_fr', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Link:</strong>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            {!! Form::text('slug_fr', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug_fr }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao_fr', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo_fr', $item_fr[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao_fr', $item_fr[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags_fr', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo_fr', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao_fr', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                               
            </div>
            <div role="tabpanel" class="tab-pane fade" id="alemao">
                <!--
                <div class="col-xs-12 col-sm-12 col-md-3 idioma-ativo">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="radioBtn btn-group btn-group-justified">
                                <a id="ativo_en_y" class="btn btn-success notActive" data-toggle="ativo_en" data-title="Y">Ativado</a>
                                <a id="ativo_en_n" class="btn btn-danger active" data-toggle="ativo_en" data-title="N">Desativado</a>
                            </div>
                            -->
                            {{ Form::hidden('ativo_de', $item->ativo_de, array('class'=>'ativo_de', 'id'=>'ativo_de')) }}
                            <!--
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ Form::checkbox('redirecionar_de', 'y') }} Redirecionar
                            </span>
                            {!! Form::text('redirecionar_url_de', null, array('placeholder' => 'URL de Redirecionamento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Titulo:</strong>
                        {!! Form::text('title_de', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Link:</strong>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            {!! Form::text('slug_de', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" title="Visualizar" onclick="javascript:window.open('{{ env('APP_URL') }}/{{ $item->slug_fr }}');"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        {!! Form::textarea('descricao_de', null, array('placeholder' => 'Descrição','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        {!! Form::textarea('conteudo_de', $item_de[0]->conteudo, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Petição:</strong>
                        {!! Form::textarea('peticao_de', $item_de[0]->peticao, array('placeholder' => 'Conteúdo','class' => 'form-control')) !!}
                    </div>
                </div>                               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Twitter Hashtags:</strong>
                        {!! Form::text('twitterhashtags_de', null, array('placeholder' => 'Twitter Hashtags','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Titulo:</strong>
                        {!! Form::text('facebooktitulo_de', null, array('placeholder' => 'Titulo de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Facebook Descricao:</strong>
                        {!! Form::text('facebookdescricao_de', null, array('placeholder' => 'Descrição de Compartilhamento Facebook','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ATENÇÂO AO ATUALIZAR</strong>
                        <p>O facebook cria um cache da pagina a ser compartilhada, quando vc altera não atualiza automaticamente, salve, acesse a URL abaixo e click em Extrair Novamente</p>
                        <a href="https://developers.facebook.com/tools/debug/" target="_blank">Atualizar no Facebook</a>
                    </div>
                </div>                               
            </div>
          </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 gravar">
            <div class="panel panel-default text-center"> 
                <div class="panel-body">
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>                  
                </div>       
            </div>
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
    <script>
        $(document).ready(function() {
            $('.container').on('click', '.radioBtn a', function() {
              var sel = $(this).data('title');
              var tog = $(this).data('toggle');
              $(this).parent().next('.' + tog).prop('value', sel);
              $(this).parent().find('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
              $(this).parent().find('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
             });
        });        
    </script>    
    <script>
        $(document).ready(function() {
            if($('#ativo_es').val()=='Y'){
                $('#ativo_es_y').addClass('active').removeClass('notActive');
                $('#ativo_es_n').addClass('notActive').removeClass('active');
            }
            if($('#ativo_it').val()=='Y'){
                $('#ativo_it_y').addClass('active').removeClass('notActive');
                $('#ativo_it_n').addClass('notActive').removeClass('active');
            }
            if($('#ativo_en').val()=='Y'){
                $('#ativo_en_y').addClass('active').removeClass('notActive');
                $('#ativo_en_n').addClass('notActive').removeClass('active');
            }            
        });        
    </script>    
@endsection