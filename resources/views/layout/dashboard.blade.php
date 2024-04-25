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
            <i class='bx bxs-smile'></i>
            <span class="text">Evento Espace d'Admin</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="/categorie">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Categories</span>
                </a>
            </li>
            <li>
                <a href="/eventValidation">
                    <i class='bx bxs-shopping-bag-alt' ></i>
                    <span class="text">Event Validation</span>
                </a>
            </li>
            <li>
                <a href="/role">
                    <i class='bx bxs-doughnut-chart' ></i>
                    <span class="text">Permission</span>
                </a>
            </li>
            <li>
                <a href="/user">
                    <i class='bx bxs-message-dots' ></i>
                    <span class="text">User</span>
                </a>
            </li>
            <li>
                <a href="/statistique">
                    <i class='bx bxs-message-dots' ></i>
                    <span class="text">Statistique</span>
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
        <a href="#" class="profile">
            <img src="img/people.png">
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