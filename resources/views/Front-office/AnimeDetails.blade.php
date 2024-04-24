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
                            <div class="view"><i class="fa fa-eye"></i> {{ $animeViews }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $anime->titre }}</h3>
                            </div>
                            <div class="anime__details__rating">
                                <?php $getIntRating = intval($getAvgRating) ?>
                            @if($getIntRating % 2 == 0)
                                <div class="rating">
                                    @for ($i=0 ; $i<$getIntRating ;$i=$i+2)
                                      <a href="#"><i class="fa fa-star"></i></a>   
                                    @endfor
                                </div>
                            @endif

                            @if($getIntRating % 2 != 0)
                                <div class="rating">
                                    @for ($i=0 ; $i<$getIntRating - 1 ;$i=$i+2)
                                       <a href="#"><i class="fa fa-star"></i></a>   
                                    @endfor
                                    <i class="fa fa-star-half-o"></i>
                               </div>
                            @endif
                                <span>{{ $getAvgRating }} / 10 | ({{ $getCount }}) Votes</span>
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
                                            <li><span>Rating:</span> {{ $getAvgRating }} / 10 Stars</li>
                                            <li><span>End Year:</span><?php if($anime->endYear){ echo $anime->endYear; } else { echo 'Not yet Ended'; } ?></li>
                                            <li><span>Quality:</span> HD</li>
                                            <li><span>Views:</span> {{ $animeViews }} views</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <form id="formWatchList" method="POST" action="/addAnimeWatchList">
                                    @csrf
                                    <input type="hidden" value="{{ $anime->id }}" name="id">
                                </form>
                                @if ($isExist == false)
                                  <a href="#" id="formClick" class="follow-btn"><i class="fa fa-heart-o"></i><span id="spanContent"> Follow</span> </a>
                                @endif
                                @if ($isExist == true)
                                <a href="#" id="formClick" class="follow-btn removeButton"><i class="fa fa-heart-o"></i><span id="spanContent"> Remove</span> </a>
                                @endif
                                <a href="" class="follow-btn" data-toggle="modal" data-target="#charcterModel"  ><i class="fa fa-user"></i> Characters</a>
                                <a href="" data-toggle="modal" data-target="#youtubeModal" class="watch-btn"><span>Trailer</span> <i
                                    class="fa fa-angle-right"></i>
                                </a>
                                <a href="{{ $anime->imbdLink }}" target="_blank" style="margin-left : 20px; margin-right:50px"><img src="{{ asset('img/MAL.png') }}" style="width:50px;  border-radius: 10px;"></a>
                                <div style="align-items:center" class="d-flex flex-column">
                                    <p style="margin-bottom: -10px; font-size: 90%;" class="pRating">What do you think about this Anime?</p>
                                    <form id="ratingForm" method="POST" action="/ratingAnime">
                                        @csrf
                                        <div class="rating radioClick">
                                            <input type="hidden" name="id" value="{{ $anime->id }}">

                                                <input value="10" name="stars" id="star10" type="radio">
                                                <label for="star10"></label>
                                                <input value="9" name="stars" id="star9" type="radio">
                                                <label for="star9"></label>
                                                <input value="8" name="stars" id="star8" type="radio">
                                                <label for="star8"></label>
                                                <input value="7" name="stars" id="star7" type="radio">
                                                <label for="star7"></label>
                                                <input value="6" name="stars" id="star6" type="radio">
                                                <label for="star6"></label>                                              
                                                <input value="5" name="stars" id="star5" type="radio">
                                                <label for="star5"></label>
                                                <input value="4" name="stars" id="star4" type="radio">
                                                <label for="star4"></label>
                                                <input value="3" name="stars" id="star3" type="radio">
                                                <label for="star3"></label>
                                                <input value="2" name="stars" id="star2" type="radio">
                                                <label for="star2"></label>
                                                <input value="1" name="stars" id="star1" type="radio">
                                                <label for="star1"></label>                                              
                                        </div>
                                    </form>
                                </div>
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
                                            <a href="" data-toggle="modal" data-target="#charcterDetailModel{{ $character->id }}">
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

                                <div class="modal-footer">
                                </div>

                              </div>
                            </div>
                          </div>

                          {{--  --}}

                          {{-- Character Detail Model --}}
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
                                                                                        @foreach ($filmAssociés->find($character->id)->anime_films as $animeFilm)
                                                                                          {{ $animeFilm->titre }} &
                                                                                        @endforeach
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
                                              <div class="view"><i class="fa fa-eye"></i> {{ $season->seasonViews }}</div>
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
                            @if (count($animeComments) == 0)
                               <div style="color: white"><i class="fa fa-exclamation-circle"></i> There Is No Comment for this Film ! </div>
                            @endif
                            @foreach ( $animeComments as $animeComment)
                                <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="{{ $animeComment->picture }}" alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <h6>{{ $animeComment->name }} 
                                            <span><?php echo $animeComment->created_at . ' '?>
                                               @if(session('user_id') === $animeComment->user_id)
                                                <a style="color:red" href="" data-toggle="modal" data-target="#deleteComment{{$animeComment->id}}""><i class="fa fa-trash"></i></a>
                                               @endif
                                            </span>
                                        </h6>
                                        <p>{{ $animeComment->content }}</p>
                                    </div>
                                </div>   
                            @endforeach
                            {{-- Comment delete Modal --}}
                            @foreach ($animeComments as $animeComment)
                            <div class="modal fade" id="deleteComment{{$animeComment->id}}" tabindex="-1" role="dialog" aria-labelledby="charcterModel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 300px;">
                                  <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-white" id="youtubeModalLabel">Delete Comment</h5>
                                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <form method="POST" action="/deleteComment">
                                           @csrf
                                               <input type="hidden" name="action" value="delete">
                                               <input type="hidden" name="id" value="{{$animeComment->id}}">
                                               <p style="color:white">Are you sure you want to delete this Comment?</p>
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                   <button type="submit" class="btn btn-danger">Delete Comment</button>
                                               </div>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                            {{--  --}}  
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <form method="POST" action="/addComment">
                                @csrf
                                <input type="hidden" name="id" value="{{ $anime->id }}">
                                <textarea style="color:black" placeholder="Your Comment" name="content" ></textarea>
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
        {{$errorsString = ''}}
        @if($errors->any())
        {{ $errorsString = implode(' & ', $errors->all()); }}
        @endif
        <meta name="csrf" content="{{ csrf_token() }}">

@endsection

@section('scripts')

<script>
    var radioClick = document.querySelector('.radioClick');
    var ratingForm = document.querySelector('#ratingForm');
    radioClick.addEventListener('change' , function(){
        // alert('ha radio tclicka')
        ratingForm.submit();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errors = '{{ $errorsString }}';

        if (errors) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errors,
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var status = '{{ session("status") }}';

        if (status) {
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: status,
            });
        }
    });
</script>
<script>

    document.addEventListener("DOMContentLoaded", function() {
    var radios = document.querySelectorAll('.rating input[type="radio"]');
    
    radios.forEach(function(radio) {
        radio.checked = false;
    });
});
</script>

{{-- add To watch List --}}

<script>
      var formClick = document.getElementById('formClick');
      var formWatchList = document.getElementById('formWatchList');
// span change
      var spanContent = document.getElementById('spanContent');

       
      formClick.addEventListener('click', function(){
        formWatchList.submit();
        spanContent.textContent = " Remove" ;
      });
       
</script>


{{-- delete comment --}}
{{-- <script>
    var deleteCom = document.getElementById('deleteCom');
    deleteCom.addEventListener('click' , function(){
        Swal.fire({
                icon: 'info',
                title: 'Emmm !',
                text: 'Are you sure you want to delete this comment',
            });
    })
</script> --}}

@endsection('scripts')