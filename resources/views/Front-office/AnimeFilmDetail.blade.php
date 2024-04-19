@extends('layout.layout')
@section('content')


    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/animeFilmList">Anime Film List</a>
                        <span>Anime film Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ $animeFilm->posterLink }}">
                            <div class="comment"><i class="fa fa-calendar"></i> {{ $animeFilm->releaseYear }}</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $animeFilm->titre }} ( {{ $animeFilm->anime_titre }} )</h3>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                                <span>1.029 Votes</span>
                            </div>
                            <p>{{ $animeFilm->description }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Anime:</span> {{ $animeFilm->anime_titre }}</li>
                                            <li><span>Source:</span> {{ $animeFilm->source_nom }}</li>
                                            <li><span>Studio:</span> {{ $animeFilm->studio }}</li>
                                            <li><span>Release Year:</span>{{ $animeFilm->releaseYear }}</li>
                                            <li><span>Categories:</span>@foreach($animes->find($animeFilm->anime_id)->categories as $categorie){{$categorie->nom}} , @endforeach</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Mangaka:</span>{{ $animeFilm->mangaka }}</li>
                                            <li><span>Rating:</span> 8.5 / 161 times</li>
                                            <li><span>Duration:</span> <?php echo $animeFilm->duration . ' H'?></li>
                                            <li><span>Genre:</span> Animation</li>
                                            <li><span>Views:</span> 131,541</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="<?php echo url('/animeFilmWatching/' . $animeFilm->id) ?>" class="follow-btn"><i class="fa fa-heart-o"></i> Watch Now</a>
                                <a href="" data-toggle="modal" data-target="#charcterModel" class="follow-btn"><i class="fa fa-user"></i> Characters</a>
                                <a href="" data-toggle="modal" data-target="#youtubeModal" class="watch-btn"><span>Trailer</span> <i
                                    class="fa fa-angle-right"></i>
                                </a>
                                <a href="{{ $animeFilm->imbdLink }}" target="_blank" style="margin-left : 20px;"><img src="{{ asset('img/MAL.png') }}" style="width:50px;  border-radius: 10px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                          {{-- trailer model --}}
                          <div class="modal fade" id="youtubeModal" tabindex="-1" role="dialog" aria-labelledby="youtubeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 700px;">
                              <div class="modal-content bg-dark">
                                <div class="modal-header">
                                  <h5 class="modal-title text-white" id="youtubeModalLabel">Trailer pour {{ $animeFilm->titre }}</h5>
                                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $animeFilm->trailerLink }}" frameborder="0" allowfullscreen></iframe>  
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>     
                          {{--  --}}

                          {{-- Chararcter Model --}}

                          <div class="modal fade" id="charcterModel" tabindex="-1" role="dialog" aria-labelledby="charcterModel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 1000px;">
                              <div class="modal-content bg-dark">
                                <div class="modal-header">
                                  <h5 class="modal-title text-white" id="youtubeModalLabel">The Characters in  {{ $animeFilm->titre }}</h5>
                                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row"> 
                                        @foreach ($characters as $character )
                                           <div class="col-lg-2 col-md-6 col-sm-6">
                                            <a href="<?php echo url('/')?>">
                                                <div class="product__item">
                                                       <div style="height: 150px" class="product__item__pic set-bg" data-setbg="{{ $character->picture }}">
                                                           <div class="comment"><i class="fa fa-user"></i> {{ $character->nom }}</div>
                                                       </div>
                                                </div>
                                            </a>
                                           </div>   
                                        @endforeach
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{--  --}}
                          
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                      {{--  --}}
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Films Has the Similar Anime ({{ $animeFilm->anime_titre }})</h5>
                            </div>
                         @if (count($animeFilmSimilars) == 0)
                            <div style="color: white"><i class="fa fa-exclamation-circle"></i> There Is No Film has the same Anime ! </div>
                         @endif
                          <div class="row">
                              @foreach ($animeFilmSimilars as $animeFilmSimilar)
    
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                      <a href="<?php echo url('/animeFilmDetails/' . $animeFilmSimilar->id)?>">
                                        <div class="product__item__pic set-bg" data-setbg="{{ $animeFilmSimilar->posterLink }}">
                                            <div class="ep">18 / 18</div>
                                            <div class="comment"><i class="fa fa-calendar"></i> {{ $animeFilmSimilar->releaseYear }}</div>
                                            <div class="view"><i class="fa fa-tag"></i> {{ $animeFilmSimilar->anime_titre }}</div>
                                        </div>
                                      </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @foreach ( $animes->find($animeFilmSimilar->anime_id)->categories as $categorie )
                                                <li>{{ $categorie->nom }}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="#">{{ $animeFilmSimilar->titre }}</a></h5>
                                        </div>
                                    </div>
                                </div>
    
                              @endforeach()
                          </div>
                        </div>
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Reviews</h5>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-1.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                    <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-2.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                    <p>Finally it came out ages ago</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-3.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                    <p>Where is the episode 15 ? Slow update! Tch</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-4.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Chris Curry - <span>1 Hour ago</span></h6>
                                    <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                    "demons" LOL</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-5.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                                    <p>Finally it came out ages ago</p>
                                </div>
                            </div>
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-6.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                                    <p>Where is the episode 15 ? Slow update! Tch</p>
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
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-1.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Boruto: Naruto next generations</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-2.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-3.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-4.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection