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
                        <a href="<?php echo url('/animeDetails/' . $season->anime_id)?>">Anime Detail</a>
                        <span>Season Details</span>
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
                        <div class="anime__details__pic set-bg" data-setbg="{{ $season->posterLink }}">
                            <div class="comment"><i class="fa fa-calendar"></i> {{ $season->releaseYear }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $views }} </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>Se <?php echo $season->seasonNumber . ' : '?>{{ $season->titre }} ({{ $season->anime_titre }})</h3>
                            </div>
                            <p>{{ $season->description }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Anime:</span>{{ $season->anime_titre }}</li>
                                            <li><span>Source:</span> {{ $season->source_nom }}</li>
                                            <li><span>Studio:</span> {{ $season->studio }}</li>
                                            <li><span>Release Year:</span>{{ $season->releaseYear }}</li>
                                            
                                            <li><span>Categories:</span>@foreach($anime->find($season->anime_id)->categories as $categorie){{$categorie->nom}} , @endforeach</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Mangaka:</span>{{ $season->mangaka }}</li>
                                            <li><span>SE Number:</span>{{ $season->seasonNumber }}</li>
                                            <li><span>End Year:</span><?php if($season->endYear){ echo $season->endYear; } else { echo 'Not yet Ended'; } ?></li>
                                            <li><span>Views:</span> {{ $views }} views</li>
                                            <li><span>Genre:</span> Animation</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="" data-toggle="modal" data-target="#youtubeModal" class="watch-btn"><span>Trailer</span> <i
                                    class="fa fa-angle-right"></i>
                                </a>
                                <a href="{{ $season->imbdLink }}" target="_blank" style="margin-left : 20px;"><img src="{{ asset('img/MAL.png') }}" style="width:50px;  border-radius: 10px;"></a>
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
                                  <h5 class="modal-title text-white" id="youtubeModalLabel">Trailer FOR {{ $season->titre }}</h5>
                                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $season->trailerLink }}" frameborder="0" allowfullscreen></iframe>  
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{--  --}}
                          
                <div class="row">
                    <div class="col-lg-12 col-md-8">
                      {{--  --}}
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Episodes for Se {{ $season->seasonNumber . ' : ' }} {{ $season->titre }}</h5>
                            </div>
                            @if (count($episodes) == 0)
                               <div style="color: white"><i class="fa fa-exclamation-circle"></i>  There Is No Episodes For this Season ! </div>
                            @endif
                            <div class="row">
                              
                                @foreach ( $episodes as $episode)
      
                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                      <div class="product__item">
                                        <a href="<?php echo url('/episodeWatching/' . $season->id)?>">
                                          <div class="product__item__pic set-bg" data-setbg="{{ $episode->posterLink }}">
                                              <div class="ep">18 / 18</div>
                                              <div class="comment"><i class="fa fa-calendar"></i> {{ $episode->releaseYear }}</div>
                                              <div class="view"><i class="fa fa-eye"></i> {{ $episode->views }} </div>
                                          </div>
                                        </a>
                                          <div class="product__item__text">
                                              <ul>
                                                  @foreach ( $anime->find($season->anime_id)->categories as $categorie )
                                                  <li>{{ $categorie->nom }}</li>
                                                  @endforeach
                                              </ul>
                                              <h5 style="color: white">Ep {{ $episode->episodeNumber . ' : ' }}<a href="#">{{ $episode->titre }}</a></h5>
                                          </div>
                                      </div>
                                  </div>
      
                                @endforeach()
                            </div>
                        </div>

                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <form method="POST" action="/addComment">
                                @csrf
                                <input type="hidden" name="id" value="{{ $season->anime_id }}">
                                <textarea style="color:black" placeholder="Your Comment" name="content" ></textarea>
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection