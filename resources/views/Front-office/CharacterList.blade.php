@extends('layout.layout')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Characters List</span>
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
                                        <h4>Characters List</h4>
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
                           @foreach ( $characters as $character)
                            <div class="col-lg-2 col-md-6 col-sm-6">
                                <div class="product__item">

                                    <a href="" data-toggle="modal" data-target="#charcterDetailModel{{ $character->id }}">
                                       <div style="height:200px" class="product__item__pic set-bg" data-setbg="{{ $character->picture }}">
                                           <div class="ep">{{ $character->anime_titre }}</div>
                                           <div class="comment"><i class="fa fa-birthday-cake"></i> {{ $character->birthday }}</div>
                                       </div>
                                    </a>
                                    <div class="product__item__text">
                                        <h5 style="color:white">Name : {{ $character->nom }}</a></h5>
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

        @foreach ( $characters as $character)
        <div class="modal fade" id="charcterDetailModel{{ $character->id }}" tabindex="-1" role="dialog" aria-labelledby="charcterModel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;">
              <div class="modal-content bg-dark">
                <div class="modal-header">
                  <h5 style="font:bolder" class="modal-title text-white" id="youtubeModalLabel">Who Is {{ $character->nom }} ?</h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding-left: 20px"> 
                        <div class="anime__details__content">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div style="width:220px;" class="anime__details__pic set-bg" data-setbg="{{ $character->picture }}">
                                        <div class="comment"><i class="fa fa-birthday-cake"></i> {{ $character->birthday }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="anime__details__text">
                                        <div class="anime__details__title">
                                            <h3>{{ $character->nom }}</h3>
                                        </div>
                                        <p>{{ $character->glance }}</p>
                                        <div class="anime__details__widget">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <ul>
                                                        <li><span>Anime:</span> {{ $character->anime_titre }}</li>
                                                        <li><span>AnimeFilms:</span>
                                                            @if($filmAssociés->find($character->id))
                                                            {{-- {{ dd($filmAssociés) }} --}}

                                                            @foreach ($filmAssociés->find($character->id)->anime_films as $animeFilm)
                                                              {{ $animeFilm->titre }} &
                                                            @endforeach
                                                    
                                                            @endif
                                                          </li>                                                   
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <ul>
                                                        <li><span>Birthday:</span>{{ $character->birthday }}</li>
                                                        <li><span>Age:</span>{{ $character->age }} years</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="anime__details__btn">
                                            <ul>
                                                <li><span style="color: white">More Details In : </span><a href="{{ $character->malLink }}" target="_blank" style="margin-left : 20px;"><img src="{{ asset('img/MAL.png') }}" style="width:50px;  border-radius: 10px;"></a>
                                                </li>
                                                                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
              </div>
            </div>
        </div>
        @endforeach
    </section>
<!-- Product Section End -->
@endsection