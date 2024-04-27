
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
    

    @yield('styles')
    
</head>
<body>
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
                <div class="col-lg-2">
                    @if(session('picture') == false)
                      <div style="padding: 20px 0 15px;" class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
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
    
    @yield('content')
    
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
      <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

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
        let dropdown_change = document.querySelector('#dropdown_change');
        let dropdown_content = document.querySelector('#dropdown_content');
        dropdown_change.addEventListener('click' , () => {
            console.log('hana kanclicki')
            dropdown_content.classList.toggle ("letGo");
         })
    </script>

    @yield('scripts')

 </body>
</html>