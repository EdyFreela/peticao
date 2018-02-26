@extends('layouts.guest')

@section('style')
    <style>    
    #myCarousel .carousel-inner {
      height: 250px;
      border-top: 1px solid #eee;
      border-bottom: 1px solid #eee;
      border-left: 1px solid #eee;
      border-right: 1px solid #eee;
      margin-bottom: 10px;
    }    
    #myCarousel .nav a small {
      display:block;
    }
    #myCarousel .nav a {
      border-radius:0px;
    }
    #myCarousel a {
      color: #000;
    }
    #myCarousel p a {
      color: #337ab7;
    }    
    #myCarousel img {
      width: 100%;
    }
    #myCarousel h1 {
      font-size: 27px;
    }
    #myCarousel .item .descricao{
      font-size: 16px;
    }
    #myCarousel .nav-justified>li {
      padding-left: 5px;
      padding-right: 5px;
      width: 0%;
    }
    #myCarousel .nav-justified > li:first-child { 
      padding-left: 0 !important; 
    }
    #myCarousel .nav-justified > li:last-child { 
      padding-right: 0 !important; 
    }
    .nav-pills>li.active>a, 
    .nav-pills>li.active>a:focus, 
    .nav-pills>li.active>a:hover {
        color: #fff !important;
        background-color: #337ab7;
    }    

    .title-recents{
      border-bottom:1px solid #ddd;
      margin-bottom: 50px;
      margin-top: 40px;
      font-family: 'Merriweather', serif;
    }
    .peticao-recentes .titulo a{
      color: #000;
    }
    .peticao-recentes .titulo a h3{
      text-align: center;
    }    
    .peticao-recentes .titulo{
      min-height:150px;
    }
    .peticao-recentes .apoiantes{
      border-bottom: 1px solid #ddd;
    }
    .peticao-recentes .panel-heading{
      min-height:150px;
      background-position: center !important;
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
    @media only screen and (max-width : 770px) {
        #myCarousel{
          display:none;
        }
        .title-recents{
          display:none;
        }                    
    }       
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <!-- INI CAROUSEL -->

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
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
                              <div class="col-md-6 row"><a href="{{ url( $item->slug )}}"><img src="{{ env('APP_URL') }}/{{ env('IMAGEM_PETICAO_PATH') }}/{{ $item->imagem }}" alt="{{ $item->title }}"></a></div>
                              <div class="col-md-6">
                                <a href="{{ url( $item->slug )}}"><h1>{{ $item->title }}</h1></a>
                                <div class="descricao">{!! $item->descricao !!}</div>
                                <p><a href="{{ url( $item->slug )}}">Saiba Mais</a></p>
                              </div>
                            </div>
                            <?php $active++; ?>
                        @endforeach
                    @endif                    
                            
                  </div><!-- End Carousel Inner -->

                  <ul class="nav nav-pills nav-justified">
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
                              <li data-target="#myCarousel" data-slide-to="<?php echo $active2; ?>" class="<?php echo $active_txt2; ?>">
                                <img src="{{ env('APP_URL') }}/{{ env('IMAGEM_PETICAO_PATH') }}/{{ $item->imagem }}">
                                <a href="#">{{ $item->title }}</a>
                              </li>
                              <?php $active2++; ?>
                          @endforeach
                      @endif
                  </ul>

                </div><!-- End Carousel -->


            <!-- END CAROUSEL -->


            <div class="col-md-12 title-recents">
              <h2>Petições Recentes</h2>
            </div>

            @if($items2->count())
                <div class="row">
                  @foreach($items2 as $key => $item2)
                  <div class="col-md-4">
                    <div class="panel panel-default peticao-recentes">
                        <a href="{{ url($item2->slug) }}"><div class="panel-heading" style="background:url({{ asset('assets/img/peticao')}}/{{$item2->imagem}}); background-size:cover;"></div></a>
                        <div class="panel-body titulo">
                          <a href="{{ url($item2->slug) }}" class="titulo-peticoes-recentes"><h3>{{ $item2->title }}</h3></a>
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
  $(document).ready( function() {
      $('#myCarousel').carousel({
      interval: 7000
    });
    
    var clickEvent = false;
    $('#myCarousel').on('click', '.nav a', function() {
        clickEvent = true;
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active');    
    }).on('slid.bs.carousel', function(e) {
      if(!clickEvent) {
        var count = $('.nav').children().length -1;
        var current = $('.nav li.active');
        current.removeClass('active').next().addClass('active');
        var id = parseInt(current.data('slide-to'));
        if(count == id) {
          $('.nav li').first().addClass('active');  
        }
      }
      clickEvent = false;
    });
  });

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