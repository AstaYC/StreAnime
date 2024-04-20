@extends('layout/layout')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/animeFilmList">Anime Film List</a>
                        <a href="<?php echo url('/animeFilmDetails/' . $animeFilm->id)?>">Anime Film Detail</a>
                        <span>Anime Film Watching</span>
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
                        <video id="player" playsinline controls data-poster="{{ $animeFilm->posterLink }}" onplay="viewsIncr({{ $animeFilm->id }})">
                            <source src="{{ $animeFilm->mediaLink }}" type="video/mp4" />
                            <!-- Captions are optional -->
                            <track kind="captions" label="English captions" src="#" srclang="en" default />
                        </video>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__title">
                         <h3>{{ $animeFilm->anime_titre . ' Film : ' }}{{ $animeFilm->titre .' ' }}</h3>
                    </div>
                    <div class="anime__details__widget">    
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Anime:</span>{{ $animeFilm->anime_titre }}</li>
                                    <li><span>Views:</span>{{ $animeFilm->views}} views</li>

                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul>
                                    <li><span>Release Year:</span>{{ $animeFilm->releaseYear }}</li>
                                    <li><span>Duration :</span>{{ $animeFilm->duration }} H</li>
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
    <meta name="csrf" content="{{ csrf_token() }}">
    <!-- Anime Section End -->
@endsection('content')

@section('scripts')

     <script>
         var csrf = document.querySelector('meta[name="csrf"]').getAttribute('content');
         let isVideoPlaying = true;
         let video = document.getElementById('player');
         video.addEventListener('pause', function() {
              isVideoPlaying = false;
         });
         
         console.log(isVideoPlaying);
     
         function viewsIncr(id) {
          if (isVideoPlaying) { 
           var xhr = new XMLHttpRequest();
           xhr.open("POST", `/animeFilmWatching/${id}/viewsIncr`, true);
           xhr.setRequestHeader("Content-Type", "application/json");
           xhr.setRequestHeader("X-CSRF-TOKEN", csrf); 
           xhr.onreadystatechange = function () {
             // console.log(xhr.readyState);
             if (xhr.readyState === 4 && xhr.status === 200) {
                 console.log(xhr.responseText)
             }else{
                 console.error(error.message);
             }
         };
           xhr.send();
         }
         
         }
    
</script>

@endsection('scripts')