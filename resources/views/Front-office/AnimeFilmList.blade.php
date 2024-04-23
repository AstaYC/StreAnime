@extends('layout.layout')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Anime Film List</span>
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
                                        <h4>Anime Film List</h4>
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
                           @foreach ( $animeFilms as $animeFilm)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                  <a href="<?php echo url('/animeFilmDetails/' . $animeFilm->id)?>">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $animeFilm->posterLink }}">
                                        <div class="ep">{{ $animeFilm->rate }} / 10</div>
                                        <div class="comment"><i class="fa fa-calendar"></i> {{ $animeFilm->releaseYear }}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{ $animeFilm->views }}</div>
                                    </div>
                                  </a>
                                    <div class="product__item__text">
                                        <ul>
                                           @foreach ($animes->find($animeFilm->anime_id)->categories as $categorie)
                                             <li>{{ $categorie->nom }}</li>
                                           @endforeach 
                                        </ul>
                                        <h5><a href="">{{ $animeFilm->titre }} ({{ $animeFilm->anime_titre }})</a></h5>
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
                                <h5>Top Anime Films Views</h5>
                            </div>

                            <div class="filter__gallery">
                                @foreach ($topAnimeFilmViewers as $topAnimeFilmViewer)
                                    <a href="<?php echo url('/animeFilmDetails/' . $topAnimeFilmViewer->id)?>">
                                        <div class="product__sidebar__view__item set-bg" data-setbg="{{ $topAnimeFilmViewer->posterLink }}" style="position: relative ; background-position: center">
                                            <div class="ep">{{ $topAnimeFilmViewer->rate }} / 10</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{ $topAnimeFilmViewer->views}}</div>
                                            <h5 style="color: white ; font-weight:900 ; position:absolute ; bottom:0 ; width:100%; padding:10px ; background-color: rgba(0, 0, 0, 0.5);">{{ $topAnimeFilmViewer->titre }} ({{ $topAnimeFilmViewer->anime_titre }})</h5>
                                        </div>
                                    </a>
                                @endforeach 
                           </div>
                        </div>
                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>Last Anime Film</h5>
                            </div>
                            @foreach ( $lastAnimeFilms as $lastAnimeFilm)
                                <a href="<?php echo url('/animeFilmWatching/' . $lastAnimeFilm->id)?>">
    
                                    <div class="product__sidebar__comment__item">
                                             
                                             <div class="product__sidebar__comment__item__pic">
                                                 <img style="width:110px ; height:150px" src="{{ $lastAnimeFilm->posterLink }}" alt="">
                                             </div>
                                             <div class="product__sidebar__comment__item__text">
                                                 <ul>
                                                    @foreach ( $animes->find($lastAnimeFilm->anime_id)->categories as $categorie)
                                                       <li>{{ $categorie->nom }}</li>
                                                    @endforeach
                                                 </ul>
                                                 <h5 style="color:white"> {{ $lastAnimeFilm->titre }}</h5>
                                                 <h5 style="color:white">Anime : {{ $lastAnimeFilm->anime_titre }}</h5>
                                                 <span><i class="fa fa-eye"></i> {{ $lastAnimeFilm->views }} Viewes</span>
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