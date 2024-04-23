@extends('layout.layout')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Anime List</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Anime List</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="product__page__filter">
                                        <p>Order by:</p>
                                        <select>
                                            <option value="">A-Z</option>
                                            <option value="">1-10</option>
                                            <option value="">10-50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           @foreach ( $animes as $anime)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">

                                    <a href="<?php echo url('/animeDetails/' . $anime->id)?>">
                                       <div class="product__item__pic set-bg" data-setbg="{{ $anime->posterLink }}">
                                           <div class="ep">{{ $anime->rate }} / 10</div>
                                           <div class="comment"><i class="fa fa-calendar"></i> {{ $anime->releaseYear }}</div>
                                           <div class="view"><i class="fa fa-eye"></i> {{  $anime->Views }}</div>
                                       </div>
                                    </a>
                                    <div class="product__item__text">
                                        <ul>
                                           @foreach ($anime->find($anime->id)->categories as $categorie)
                                             <li>{{ $categorie->nom }}</li>
                                           @endforeach 
                                        </ul>
                                        <h5><a href="">{{ $anime->titre }}</a></h5>
                                    </div>
                                </div>
                            </div>
                          @endforeach 
                        </div>
                    </div>
                    <div class="product__pagination">
                        <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Anime Views</h5>
                            </div>

                            <div class="filter__gallery">
                                @foreach ($topAnimeVieweds as $topAnimeViewed)
                                    <a href="<?php echo url('/animeDetails/' . $topAnimeViewed['anime']->id)?>">
                                        <div class="product__sidebar__view__item set-bg" data-setbg="{{ $topAnimeViewed['anime']->posterLink }}" style="position: relative ; background-position: center">
                                            <div class="ep">{{ $topAnimeViewed['rate'] }} / 10</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{ $topAnimeViewed['totalViews']}}</div>
                                            <h5 style="color: white ; font-weight:900 ; position:absolute ; bottom:0 ; width:100%; padding:10px ; background-color: rgba(0, 0, 0, 0.5);">{{ $topAnimeViewed['anime']->titre }}</h5>
                                        </div>
                                    </a>
                                @endforeach 
                           </div>
                        </div>
                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>Last Episodes</h5>
                            </div>
                            @foreach ( $lastEpisodes as $lastEpisode)
                                  <a href="<?php echo url('/episodeWatching/' . $lastEpisode->id)?>">
      
                                      <div class="product__sidebar__comment__item">
                                               
                                               <div class="product__sidebar__comment__item__pic">
                                                   <img style="width:110px ; height:150px" src="{{ $lastEpisode->posterLink }}" alt="">
                                               </div>
                                               <div class="product__sidebar__comment__item__text">
                                                   <ul>
                                                      @foreach ( $animes->find($lastEpisode->anime_id)->categories as $categorie)
                                                         <li>{{ $categorie->nom }}</li>
                                                      @endforeach
                                                   </ul>
                                                   <h5 style="color:white">Ep <?php echo $lastEpisode->episodeNumber . ' : '?> {{ $lastEpisode->titre }}</a></h5>
                                                   <h5 style="color:white">Anime : {{ $lastEpisode->anime_titre }}</a></h5>
                                                   <span><i class="fa fa-eye"></i> {{ $lastEpisode->views }} Viewes</span>
                                               </div>
                                      </div>
      
                                  </a>     
                        
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Product Section End -->
@endsection