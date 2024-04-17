@extends('layout/layout')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Anime List</a>
                        <a href="./categories.html">Anime Detail</a>
                        <a href="./categories.html">Season Detail</a>
                        <span>Episode Watching</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        <video id="player" playsinline controls data-poster="{{ $episode->posterLink }}">
                            <source src="{{ $episode->mediaLink }}" type="video/mp4" />
                            <!-- Captions are optional -->
                            <track kind="captions" label="English captions" src="#" srclang="en" default />
                        </video>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__title">
                         <h3>Ep {{ $episode->episodeNumber . ' : ' }}{{ $episode->titre .' ' }} ({{ $episode->anime_titre }})</h3>
                    </div>
                    <div class="anime__details__widget">    
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Anime:</span>{{ $episode->anime_titre }}</li>
                                    <li><span>Season:</span>Se{{ $episode->seasonNumber . ' : ' }}{{ $episode->season_titre }}</li>

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Ep Number:</span> {{ $episode->episodeNumber }}</li>
                                    <li><span>Release Year:</span>{{ $episode->releaseYear }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="#">
                            <textarea placeholder="Your Comment"></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection('content')