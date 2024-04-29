@extends('layout.layout')
@section('content')

    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/dragonSlayer.jpg') }}" style="background-position: center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Our News</h2>
                        <p>Welcome to the official streAnime News.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a target="_blank" href="{{ $lastAnimeNews->newsLink }}">
                                <div class="blog__item  set-bg" data-setbg="{{ $lastAnimeNews->posterLink }}">
                                    <div class="ep">{{ $lastAnimeNews->anime_titre }}</div>
                                    <div class="blog__item__text">
                                        <p style="color: black"><span class="icon_calendar"  style="color: black" ></span>{{ $lastAnimeNews->date }}</p>
                                        <h4><a style="color: rgb(0, 0, 0)" target="_blank" href="{{ $lastAnimeNews->newsLink }}">{{ $lastAnimeNews->titre }}</a></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @foreach ( $animeNews as $animeNew)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a target="_blanc" href="{{ $animeNew->newsLink }}">
                                    <div class="blog__item small__item set-bg" data-setbg="{{ $animeNew->posterLink }}">
                                        <div class="ep">{{ $animeNew->anime_titre }}</div>
                                        <div class="blog__item__text">
                                            <p style="color: black"><span class="icon_calendar" style="color: black"></span>{{ $animeNew->date }}</p>
                                            <h4><a style="color: rgb(0, 0, 0)" target="_blanc" href="{{ $animeNew->newsLink }}">{{ $animeNew->titre }}</a></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

 @endsection