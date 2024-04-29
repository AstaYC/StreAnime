@extends('layout/layout')
@section('content')
    <!-- Page Preloder -->

    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
            @foreach($animeSliders as $animeSlider)
                <div class="hero__items set-bg" data-setbg="{{ $animeSlider->posterLink }}" style="height: 650px ; background-position: center ;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                @foreach($animes->find($animeSlider->anime_id)->categories as $categorie)
                                  <div class="label">{{$categorie->nom}}</div>
                                @endforeach
                                <h2>{{ $animeSlider->anime_titre }}</h2>
                                <p>{{ $animeSlider->anime_description }}</p>
                                <a href="<?php echo url('/animeDetails/' . $animeSlider->anime_id) ?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($animeFilmsSliders as $animeFilmsSlider)
              <div class="hero__items set-bg" data-setbg="{{ $animeFilmsSlider->posterLink }}" style="height: 650px ; background-position: center;">
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="hero__text">
                              @foreach($animes->find($animeFilmsSlider->anime_id)->categories as $categorie)
                                <div class="label">{{$categorie->nom}}</div>
                              @endforeach
                              <h2>{{ $animeFilmsSlider->animeFilm_titre }}</h2>
                              <p>{{ $animeFilmsSlider->animeFilm_description }}</p>
                              <a href="<?php echo url('/animeFilmDetails/' . $animeFilmsSlider->anime_film_id)?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
          </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Trending Anime Now </h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="/animeList" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           @foreach ($trendanimes as $trendanime)                               
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                  <a href="<?php echo url('/animeDetails/' . $trendanime->id)?>">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $trendanime->posterLink }}">
                                        <div class="ep">{{ $trendanime->rate }} / 10</div>
                                        <div class="comment"><i class="fa fa-calendar"></i> {{ $trendanime->releaseYear }}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{ $trendanime->Views }}</div>
                                    </div>
                                  </a>
                                    <div class="product__item__text">
                                        <ul>

                                            @foreach ( $animes->find($trendanime->id)->categories as $categorie )
                                            <li>{{ $categorie->nom }}</li>
                                            @endforeach
                                        </ul>
                                        <h5><a href="#">{{ $trendanime->titre }}</a></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                            
                        </div>
                        
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Trending Anime Films Now  </h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="/animeFilmList" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          @foreach ($trendanimeFilms as $trendanimeFilm)  
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                  <a href="<?php echo url('/animeFilmDetails/' . $trendanimeFilm->id)?>">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $trendanimeFilm->posterLink }}">
                                        <div class="ep">{{ $trendanimeFilm->rate }} / 10</div>
                                        <div class="comment"><i class="fa fa-calendar"></i> {{ $trendanimeFilm->releaseYear }}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{ $trendanimeFilm->views }} </div>
                                    </div>
                                  </a>
                                    <div class="product__item__text">
                                        <ul>

                                           @foreach ($animes->find($trendanimeFilm->anime_id)->categories as $categorie)
                                             <li>{{ $categorie->nom }}</li>
                                           @endforeach 
                                        </ul>
                                        <h5><a href="#">{{ $trendanimeFilm->titre }} ({{ $trendanimeFilm->anime_titre }})</a></h5>
                                    </div>
                                </div>
                            </div>
                          @endforeach    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Views Anime</h5>
                            </div>

                            <div class="filter__gallery">
                                @foreach ( $topAnimes as $topAnime)
                                    <a href="<?php echo url('/animeDetails/' . $topAnime['anime']->id)?>">
                                        <div class="product__sidebar__view__item set-bg" data-setbg="{{ $topAnime['anime']->posterLink }}" style="position: relative; background-position: center">
                                            <div class="ep">{{ $topAnime['rate'] }} / 10</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{ $topAnime['totalViews'] }}</div>
                                            <h5 style="color: white; font-weight: 900; position: absolute; bottom: 0;  width: 100%; padding: 10px; background-color: rgba(0, 0, 0, 0.5); background-position: center">{{ $topAnime['anime']->titre }}</h5>
                                        </div>
                                     </a> 
                                @endforeach
                            </div>
                        </div>


                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Views Anime Film</h5>
                            </div>

                            <div class="filter__gallery">
                               @foreach ($mostViewedFilms as $mostViewedFilm)
                               <a href="<?php echo url('/animeFilmDetails/' . $mostViewedFilm->id)?>">
                                   <div class="product__sidebar__view__item set-bg" data-setbg="{{ $mostViewedFilm->posterLink }}" style="position: relative ; background-position: center">
                                       <div class="ep">{{  $mostViewedFilm->rate }} / 10</div>
                                       <div class="view"><i class="fa fa-eye"></i> {{ $mostViewedFilm->views }}</div>
                                       <h5 style="color: white ; font-weight:900 ; position:absolute ; bottom:0 ; width:100%; padding:10px ; background-color: rgba(0, 0, 0, 0.5);">{{ $mostViewedFilm->titre }}</h5>
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
                                                 <h5 style="color:white">Ep <?php echo $lastEpisode->episodeNumber . ' : '?> {{ $lastEpisode->titre }}</h5>
                                                 <h5 style="color:white">Anime : {{ $lastEpisode->anime_titre }}</h5>
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

<!-- Footer Section Begin -->
   
 @endsection
 @section('scripts')
   <script>
       document.addEventListener('DOMContentLoaded', function () {
           var status = '{{ session("status") }}';
   
           if (status) {
              let timerInterval;
              Swal.fire({
                   icon: 'success',
                   title: status,
                   timer: 4000,
                   timerProgressBar: true,
                   didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {  
                 clearInterval(timerInterval);
                }
               }).then((result) => {
                /* Read more about handling dismissals below */
               if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                 }
                 });
               }
             });
   </script>

@endsection('scripts')
