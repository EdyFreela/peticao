@extends('layouts.guest')

@section('style')
    <style>    
    .carousel-inner>.item>a>img, .carousel-inner>.item>img {
        width: 100%;
        height: 340px;
    }
    .carousel-caption a{
      color:#fff;
    }    
    .carousel-caption h3{
      font-size: 32px;
    }
    .title-recents{
      border-bottom:1px solid #ddd;
      margin-bottom: 50px;
      margin-top: 40px;
      font-family: 'Merriweather', serif;
    }
    .peticao-recentes .titulo{
      min-height:150px;
    }
    .peticao-recentes .apoiantes{
      border-bottom: 1px solid #ddd;
    }
    .peticao-recentes .panel-heading{
      min-height:150px;
    }
    .vcenter {
        padding-top: 35px;
    }
    #newsmsg{
      font-weight: bold;
      color: #a94442;
      margin-top: 10px;
      display: block;
    }    
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                @if($items->count())
                <?php $active2=0; ?>
                    @foreach($items as $key => $item)
                        <?php 
                        if($active2==0){
                            $active_txt2='active';
                        }else{
                            $active_txt2='';
                        }
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $active2; ?>" class="<?php echo $active_txt2; ?>"></li>
                        <?php $active2++; ?>
                    @endforeach
                @endif
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">

                @if($items->count())
                <?php $active=0; ?>
                    @foreach($items as $key => $item)
                        <?php 
                        if($active==0){
                            $active_txt='active';
                        }else{
                            $active_txt='';
                        }
                        ?>
                        <div class="item <?php echo $active_txt; ?>">
                          <img src="{{ env('APP_URL') }}/{{ env('IMAGEM_PETICAO_PATH') }}/{{ $item->imagem }}" alt="{{ $item->title }}">
                          <div class="carousel-caption">
                            <a href="{{ url( $item->slug )}}"><h3>{{ $item->title }}</h3></a>
                          </div>
                        </div>
                        <?php $active++; ?>
                    @endforeach
                @endif

              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
              </a>
            </div>

            <div class="col-md-12 title-recents">
              <h2>Petições Recentes</h2>
            </div>

            @if($items2->count())
                <div class="row">
                  @foreach($items2 as $key => $item2)
                  <div class="col-md-4">
                    <div class="panel panel-default peticao-recentes">
                        <div class="panel-heading" style="background:url({{ asset('assets/img/peticao')}}/{{$item2->imagem}}); background-size:cover;"></div>
                        <div class="panel-body titulo">
                          <h3>{{ $item2->title }}</h3>
                        </div>
                        <div class="panel-footer">
                          <a href="{{ url($item2->slug) }}" class="btn btn-success" style="width: 100%;">Assine esta petição</a>
                        </div>                                                
                    </div>
                  </div>
                  @endforeach
                </div>
            @endif

            {!! Form::open(array('route' => 'newsletter.store', 'method'=>'POST', 'id'=>'newsform')) !!}
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default peticao-newsletter">
                  <div class="panel-body newsletter">
                    <div class="col-md-7">
                      <h1>A luta começa com você.</h1>
                      <h2>Tenha certeza de nunca perder uma campanha importante!</h2>
                    </div>
                    <div class="col-md-5 vcenter">                     
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          @if ($message = Session::get('newsletter'))
                              <div class="alert alert-success">
                                  <p><i class="fa fa-check" aria-hidden="true"></i> {{ $message }}</p>
                              </div>
                          @endif                        
                          <div class="form-group newsemail">
                              {!! Form::text('email', null, array('placeholder' => 'E-Mail','class' => 'form-control', 'id'=>'email')) !!}
                              <span id="newsmsg"></span>
                          </div>
                      </div>                      
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <button class="btn btn-warning col-xs-12 col-sm-12 col-md-12">Cadastre-se para receber nossas atualizações!</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
  $('button.btn-warning').on('click', function(){
      var email = $('#email').val();
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var validate = re.test(email);

      if(validate==false){
        $('#newsmsg').text('E-Mail inválido');
        $(".newsemail").addClass( "has-error has-feedback" );
        return false;
      }
  });
</script>

@endsection