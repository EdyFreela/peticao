@extends('layouts.guest')

@section('style')
    <style>
    .carousel-inner>.item>a>img, .carousel-inner>.item>img {
        width: 100%;
        height: 340px;
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
                            <h3>{{ $item->title }}</h3>
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

        </div>
    </div>
</div>
@endsection
