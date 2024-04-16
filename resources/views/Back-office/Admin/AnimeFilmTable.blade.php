
@extends('layout.dashboard')
@section('sidebar')
<!-- SIDEBAR -->
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
<!-- SIDEBAR -->
@endsection('sidebar')

@section('content')
<!-- CONTENT -->



    <!-- MAIN -->
    <main>
        {{$errorsString = ''}}
        @if($errors->any())
        {{ $errorsString = implode(' & ', $errors->all()); }}
        @endif

        <div class="head-title">
            <div class="left">
                <h1>My AnimeFilm</h1>
            </div>
            
        </div>

        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>AnimeFilm <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog" style="max-width: 700px;">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New AnimeFilm</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/animeFilm/add" enctype="multipart/form-data">
                                                    @csrf   
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">AnimeFilm Title:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                        
                                                        <label for="CategorieName">AnimeFilm Description:</label>
                                                        <textarea class="form-control" id="CategorieName" name="description" required></textarea>
                                                        
                                                        <label for="CategorieName">AnimeFilm Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                                                       
                                                        <label for="CategorieName">AnimeFilm Media:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="mediaLink" >
                                                        
                                                        <label for="CategorieName">AnimeFilm Trailler:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="trailerLink" >

                                                        <label for="CategorieName">Imdb AnimeFilm Rating:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                                       
                                                        <label for="CategorieName">Release Year</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                                        
                                                        <label for="CategorieName">Duration</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="duration"  pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]" value="HH:MM">
                                                
                                                        
                                                        <label for="CategorieName">Anime Associate</label>
                                                        <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                                            <option value="">Choose an anime</option>  
                                                            @foreach($animes as $anime)
                                                               <option value="{{$anime->id}}">{{$anime->titre}}</option>
                                                            @endforeach
                                                        </select>
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add AnimeFilm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New AnimeFilm</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover"> 
                        <thead>
                            <tr>
                                <th>Poster</th>											
                                <th>Title</th>											
                                <th>Media</th>											
                                <th>Description</th>											
                                <th>Trailler</th>											
                                <th>Rating</th>											
                                <th>Release Year</th>											
                                <th>Duration</th>											
                                <th>Anime Associate</th>											
                                <th>Categories</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($animeFilms as $animeFilm)
                            <tr>
                                <td><img src="{{$animeFilm->posterLink}}" width="100px"></img></td>
                                <td>{{$animeFilm->titre}}</td>
                                <td><video width="140" height="100" src="{{ $animeFilm->mediaLink }}" autoplay loop controls poster="{{$animeFilm->posterLink}}"></video></td>
                                <td>{{$animeFilm->description}}</td>
                                <td><iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $animeFilm->trailerLink }}" frameborder="0" allowfullscreen></iframe></td>
                                <td><a href="{{ $anime->imbdLink }}" target="_blank"><img src="{{ asset('img/MAL.png') }}" width="50px"></img></a></td>
                                <td>{{$animeFilm->releaseYear}}</td>
                                <td>{{$animeFilm->duration}}</td>  
                                <td>{{$animeFilm->anime_titre}}</td>  
                                <td>@foreach($animes->find($animeFilm->anime_id)->categories as $categorie){{$categorie->nom}} & @endforeach</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$animeFilm->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$animeFilm->id}}">
                                            <i class="material-icons">&#xE5C9;</i>
                                        </a>
                                </td>
                            </tr>
                        @endforeach
                     </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </main>

    @foreach($animeFilms as $animeFilm)

       <!-- modal de update -->
    <div class="modal" id="updateCategoryModal{{$animeFilm->id}}">
        <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update animeFilm</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/animeFilm/update" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$animeFilm->id}}">

                            <!-- Input fields for updated medicine details -->
                            
                            <div class="form-group">
                                <label for="CategorieName">AnimeFilm Title:</label>
                                <input type="text" class="form-control" id="CategorieName" name="titre" value="{{ $animeFilm->titre }}" required>
                                
                                <label for="CategorieName">AnimeFilm Description:</label>
                                <textarea class="form-control" id="CategorieName" name="description" required>{{ $animeFilm->description }}</textarea>
                                
                                <label for="CategorieName">AnimeFilm Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                               
                                <label for="CategorieName">AnimeFilm Media:</label>
                                <input type="file" class="form-control" id="CategorieName" name="mediaLink" >
                                
                                <label for="CategorieName">AnimeFilm Trailler:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeFilm->trailerLink }}" name="trailerLink" >

                                <label for="CategorieName">Imdb AnimeFilm Rating:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeFilm->imbdLink }}" name="imbdLink" >
                               
                                <label for="CategorieName">Release Year</label>
                                <input type="date" class="form-control" id="CategorieName" value="{{ $animeFilm->releaseYear }}" name="releaseYear" >
                                
                                <label for="CategorieName">Duration</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeFilm->duration }}" name="duration" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]"" > 
                        
                                
                                <label for="CategorieName">Anime Associate</label>
                                <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                    <option value="">Choose an anime</option>  
                                    @foreach($animes as $anime)
                                       <option value="{{$anime->id}}">{{$anime->titre}}</option>
                                    @endforeach
                                </select>
                            
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update animeFilms</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$animeFilm->id}}">										
<div class="modal-dialog" style="max-width: 700px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Hidden AnimeFilms</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/animeFilm/hidden">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$animeFilm->id}}">
                        <p>Are you sure you want to Hidden this AnimeFilms "{{$animeFilm->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Hidde AnimeFilm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach

@endsection('content')

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    
@endsection('styles')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.search').selectpicker();
    })
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

@endsection('scripts')