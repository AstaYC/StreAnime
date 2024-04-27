
<!DOCTYPE html>
<html lang="zxx"> 

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StreAnime</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/asset/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/asset/css/style.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .input {
            border: none;
            outline: none;
            border-radius: 15px;
            padding: 1em;
            background-color: #ccc;
            box-shadow: inset 2px 5px 10px rgba(0,0,0,0.3);
            transition: 300ms ease-in-out;
            height: 40px;
          }

         .input:focus {
           background-color: white;
           transform: scale(1.05);
           box-shadow: 3px 3px 20px #969696,
                      -3px -3px 20px #ffffff;
         }
    </style>


</head>
<body >
    <main id="app">
        <div id="preloder">
            <div class="loader"></div>
        </div>
        
        <!-- Header Section Begin -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header__logo">
                            <a href="/">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="header__nav">
                            <nav class="header__menu mobile-menu">
                                <ul>
                                    <li <?php if(url()->current() === url('/home') || url()->current() === url('/') ) echo 'class="active"'; ?>><a href="/">Homepage</a></li>
                                    <li <?php if(url()->current() == url('/animeList')) echo 'class="active"'?>><a href="/animeList">Anime List<span class="arrow_carrot-down"></span></a></li>
                                    <li <?php if(url()->current() == url('/animeFilmList')) echo 'class="active"'?>><a href="/animeFilmList">Anime Film List<span class="arrow_carrot-down"></span></a></li>
                                    <li <?php if(url()->current() == url('/characterList')) echo 'class="active"'?> ><a href="/characterList">Characters List</a></li>                         
                                    <li <?php if(url()->current() == url('/animeNews')) echo 'class="active"'?> ><a href="/animeNews">A.News</a></li>                         
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-2" >
                        @if(session('picture') == false)
                          <div style="padding: 20px 0 15px;" class="header__right">
                            <a href="/login"><span class="icon_profile"></span></a>
                          </div>
                        @endif
                        @if (session('picture'))
                            <div class="header__right">
                                <a href="#" class="search-switch"><span class="icon_search"></span></a>
                                <a class="btn" id="dropdown_change"><img style="width: 40px; height:40px; border-radius: 40px;" src="{{session('picture')}}" alt=""></a>
                            </div>
                         @endif
                        <div id="dropdown_content" class="dropdown-menu dropdown-menu-model show" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 60px; left: 80px;">
                            <a class="dropdown-item" href="/userProfil"><i class="fa fa-user"></i>  - Profile</a>
                            @if(session('user_role') == '1')
                            <a class="dropdown-item" href="/user"><i class="fa fa-bookmark"></i>  - Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="/watchList"><i class="fa fa-heart"></i>  - WhatchList</a>
                            <a class="dropdown-item di-bottom" style="background-color: #e53637; color:white" href="/logout">  Logout  <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div id="mobile-menu-wrap"></div>
            </div>
        </header>
    
            <!-- Breadcrumb Begin -->
            <div class="breadcrumb-option">
                <div class="container">
                    <div class="row" style="align-items: center;">
                        <div class="col-lg-6">
                            <div class="breadcrumb__links">
                                <a href="/"><i class="fa fa-home"></i> Home</a>
                                <span>Anime List</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <i class="fa fa-search fa-2x btn" @click="HandleSubmit()"></i>
                                <input type="text" autocomplete="off" v-model="keyword" class="input" placeholder="Search Anime Title.....">                         
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
                        <div class="col-lg-8">
                            <div class="product__page__content">
                                <div class="product__page__title">
                                    <div class="row" style="align-items:center">
                                        <div class="col-lg-4 col-md-8 col-sm-6">
                                            <div class="section-title">
                                                <h4>Anime List</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="product__page__filter">
                                                <p>Category:</p>
                                                <select>
                                                    <option value="">All</option>
                                                    <option value="">1-10</option>
                                                    <option value="">10-50</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="product__page__filter">
                                                <p>Source:</p>
                                                <select>
                                                    <option value="">All</option>
                                                    <option value="">1-10</option>
                                                    <option value="">10-50</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6" v-for="anime in list" :key="anime.id">
                                        <div class="product__item">
                                            <a :href="'{{ url('/animeDetails/') }}/' + anime.id">
                                                <div class="product__item__pic set-bg" :style="{ 'background-image': 'url(' + anime.posterLink + ')' }"> 
                                                <div class="ep">@{{ anime.rate }} / 10</div>
                                                <div class="comment"><i class="fa fa-calendar"></i> @{{ anime.releaseYear }}</div>
                                                <div class="view"><i class="fa fa-eye"></i> @{{  anime.Views }}</div>
                                               </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li v-for="categories in anime.categories">@{{ categories.nom }}</li>                                                </ul>
                                                <h5><a href="">@{{ anime.titre }}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6" v-else>
                                        <i class="fa fa-exclamation-circle"></i> There Is No Film has the same Anime !
                                    </div>
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
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="product__sidebar">
                                <div class="product__sidebar__view">
                                    <div class="section-title">
                                        <h5>Top Anime Views</h5>
                                    </div>
        
                                    <div class="filter__gallery">
                                        @foreach ($topAnimeVieweds as $topAnimeViewed)
                                            <a href="<?php echo url('/animeDetails/' . $topAnimeViewed['anime']->id)?>">
                                                <div class="product__sidebar__view__item set-bg" data-setbg="{{ $topAnimeViewed['anime']->posterLink }}" style="position: relative ; background-position: center">
                                                    <div class="ep">{{ $topAnimeViewed['rate'] }} / 10</div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ $topAnimeViewed['totalViews']}}</div>
                                                    <h5 style="color: white ; font-weight:900 ; position:absolute ; bottom:0 ; width:100%; padding:10px ; background-color: rgba(0, 0, 0, 0.5);">{{ $topAnimeViewed['anime']->titre }}</h5>
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
                                                           <h5 style="color:white">Ep <?php echo $lastEpisode->episodeNumber . ' : '?> {{ $lastEpisode->titre }}</a></h5>
                                                           <h5 style="color:white">Anime : {{ $lastEpisode->anime_titre }}</a></h5>
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

    </main>
    <!-- Product Section End -->

    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row logoFooter">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="/">Homepage</a></li>
                            <li><a href="/animeList">Anime List</a></li>
                            <li><a href="/animeFilmList">Anime Film List</a></li>
                            <li><a href="/characterList">Characters List</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
    
                  </div>
              </div>
          </div>
    </footer>
      <!-- Footer Section End -->
    
      <!-- Search model Begin -->

    
        
 
    <script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/player.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('asset/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    var app = new Vue({
        el: '#app',
        data: {
            keyword: '',
            list:null,
        },
        methods: {
            HandleSubmit() {
                axios.get('api/search', {
                    params: {
                        keyword:this.keyword
                    }
                })
                    .then(response => {
                        console.log(response.data.list);
                        this.list = response.data.list;
                    })
                    .catch(error => {
                        console.error(error);
                        // Handle error response
                    });
                }
            },
        
        mounted() {
            this.HandleSubmit();
        },
     });
</script>

<script>
    let dropdown_change = document.querySelector('#dropdown_change');
    let dropdown_content = document.querySelector('#dropdown_content');
    dropdown_change.addEventListener('click' , () => {
        console.log('hana kanclicki')
        dropdown_content.classList.toggle ("letGo");
     })
</script>

 </body>
</html>