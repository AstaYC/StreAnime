@extends('layout.layout')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Watch List</span>
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
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Anime Watch List</h4>
                                    </div>
                                    @if (count($animes) == 0)
                                    <br>
                                    <div style="color: white"><i class="fa fa-exclamation-circle"></i>  There Is No Animes In Watch List ! </div>
                                   @endif
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
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">

                                    <a href="<?php echo url('/animeDetails/' . $anime->id)?>">
                                       <div class="product__item__pic set-bg" data-setbg="{{ $anime->posterLink }}">
                                           <div class="comment"><i class="fa fa-calendar"></i> {{ $anime->releaseYear }}</div>
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
                    <br>

                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Anime Film Watch List</h4>
                                    </div>
                                    @if (count($animeFilms) == 0)
                                    <br>
                                    <div style="color: white"><i class="fa fa-exclamation-circle"></i>  There Is No Anime Films In Watch List ! </div>
                                   @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ( $animeFilms as $animeFilm)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                  <a href="<?php echo url('/animeFilmDetails/' . $animeFilm->id)?>">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $animeFilm->posterLink }}">
                                        <div class="comment"><i class="fa fa-calendar"></i> {{ $animeFilm->releaseYear }}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{ $animeFilm->views }}</div>
                                    </div>
                                  </a>
                                    <div class="product__item__text">
                                        <ul>
                                           @foreach ($filmsCategories->find($animeFilm->anime_id)->categories as $categorie)
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
            </div>
        </div>
    </section>
<!-- Product Section End -->
@endsection