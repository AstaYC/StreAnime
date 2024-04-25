<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('asset/css/dashboard.css')}}">

    @yield('styles')

	<title>StreAnime</title>
</head>
<style>

</style>
<body>
{{-- sidebar --}}
    <section id="sidebar">
        <a href="#" class="brand">
            <img style="width: 18%" src="{{ asset('img/logo.png') }}" alt="">
            {{-- <i class='bx bxs-smile'></i> --}}
            <span class="text">StreAnime Dashboard</span>
        </a>
        <ul class="side-menu top">
            <li <?php if(url()->current() == url('/user')) echo 'class="active"'?>>
                <a href="/user">
                    <i class='bx bxs-group' ></i>
                    <span class="text">User</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/role')) echo 'class="active"'?>>
                <a href="/role">
                    <i class='bx bxs-cog'></i>
                    <span class="text">G. Roles</span>
                </a>
            </li>
            <li  <?php if(url()->current() == url('/anime')) echo 'class="active"'?>>
                <a href="/anime">
                    <i class='bx bxs-analyse'></i>
                    <span class="text">Anime</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/animeFilm')) echo 'class="active"'?>>
                <a href="/animeFilm">
                    <i class='bx bxs-analyse' ></i>
                    <span class="text">Anime Film</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/season')) echo 'class="active"'?>>
                <a href="/season">
                    <i class='bx bxs-show' ></i>
                    <span class="text">Season</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/episode')) echo 'class="active"'?>>
                <a href="/episode">
                    <i class='bx bxs-movie' ></i>
                    <span class="text">Episode</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/categorie')) echo 'class="active"'?>>
                <a href="/categorie">
                    <i class='bx bxs-folder' ></i>
                    <span class="text">Categorie</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/source')) echo 'class="active"'?>>
                <a href="/source">
                    <i class='bx bxs-collection' ></i>
                    <span class="text">Source</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/slider')) echo 'class="active"'?>>
                <a href="/slider">
                    <i class='bx bxs-adjust' ></i>
                    <span class="text">Slider</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/character')) echo 'class="active"'?>>
                <a href="/character">
                    <i class='bx bxs-user' ></i>
                    <span class="text">Character</span>
                </a>
            </li>

            <li <?php if(url()->current() == url('/animeNewsTable')) echo 'class="active"'?>>
                <a href="/animeNewsTable">
                    <i class='bx bxs-news' ></i>
                    <span class="text">News</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/hiddenAnime')) echo 'class="active"'?>>
                <a href="/hiddenAnime">
                    <i class='bx bxs-hide' ></i>
                    <span class="text">Hidden Anime</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/hiddenAnimeFilm')) echo 'class="active"'?>>
                <a href="/hiddenAnimeFilm">
                    <i class='bx bxs-hide' ></i>
                    <span class="text">Hidden AnimeFilm</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/hiddenSeason')) echo 'class="active"'?>>
                <a href="/hiddenSeason">
                    <i class='bx bxs-hide' ></i>
                    <span class="text">Hidden Season</span>
                </a>
            </li>
            <li <?php if(url()->current() == url('/hiddenEpisode')) echo 'class="active"'?>>
                <a href="/hiddenEpisode">
                    <i class='bx bxs-hide' ></i>
                    <span class="text">Hidden Episode</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/home" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text-info">HOME</span>
                </a>
                <a href="/logout" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

{{-- end section --}}

<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu' ></i>
        <a href="#" class="nav-link">StreAnime Dashboard</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>

    </nav>
    <!-- NAVBAR -->

    @yield('content')

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('asset/js/script.js')}}"></script>

@yield('scripts')

</body>
</html>