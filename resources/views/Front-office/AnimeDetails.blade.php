@extends('layout.layout')
@section('content')


    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="/animeList">Anime List</a>
                        <span>Anime Details</span>
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
                        <div class="anime__details__pic set-bg" data-setbg="{{ $anime->posterLink }}">
                            <div class="comment"><i class="fa fa-calendar"></i> {{ $anime->releaseYear }}</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $anime->titre }}</h3>
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
                            <p>{{ $anime->description }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Source:</span> {{ $anime->source_nom }}</li>
                                            <li><span>Studio:</span> {{ $anime->studio }}</li>
                                            <li><span>Release Year:</span>{{ $anime->releaseYear }}</li>
                                            <li><span>Genre:</span> Animation</li>
                                            <li><span>Categories:</span>@foreach($anime->find($anime->id)->categories as $categorie){{$categorie->nom}} , @endforeach</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Mangaka:</span>{{ $anime->mangaka }}</li>
                                            <li><span>Rating:</span> 8.5 / 161 times</li>
                                            <li><span>End Year:</span><?php if($anime->endYear){ echo $anime->endYear; } else { echo 'Not yet Ended'; } ?></li>
                                            <li><span>Quality:</span> HD</li>
                                            <li><span>Views:</span> 131,541</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="#" class="follow-btn" data-toggle="modal" data-target="#charcterModel"  ><i class="fa fa-user"></i> Characters</a>
                                <a href="" data-toggle="modal" data-target="#youtubeModal" class="watch-btn"><span>Trailer</span> <i
                                    class="fa fa-angle-right"></i>
                                </a>
                                <a href="{{ $anime->imbdLink }}" target="_blank" style="margin-left : 20px;"><img src="{{ asset('img/MAL.png') }}" style="width:50px;  border-radius: 10px;"></a>
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
                                  <h5 class="modal-title text-white" id="youtubeModalLabel">Trailer For {{ $anime->titre }}</h5>
                                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $anime->trailerLink }}" frameborder="0" allowfullscreen></iframe>  
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
                                  <h5 class="modal-title text-white" id="youtubeModalLabel">The Characters in  {{ $anime->titre }}</h5>
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
                                <h5>Seasons for {{ $anime->titre }}</h5>
                            </div>
                        
                            <div class="row">

                                @foreach ($seasons as $season)
      
                                  <div class="col-lg-4 col-md-6 col-sm-6">
                                      <div class="product__item">
                                        <a href="<?php echo url('/seasonDetails/' . $season->id)?>">
                                          <div class="product__item__pic set-bg" data-setbg="{{ $season->posterLink }}">
                                              <div class="comment"><i class="fa fa-calendar"></i> {{ $season->releaseYear }}</div>
                                              <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                          </div>
                                        </a>
                                          <div class="product__item__text">
                                              <ul>
                                                  @foreach ( $anime->find($anime->id)->categories as $categorie )
                                                  <li>{{ $categorie->nom }}</li>
                                                  @endforeach
                                              </ul>
                                              <h5><a href="#">Se <?php echo $season->seasonNumber . ' : '?>{{ $season->titre }}</a></h5>
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