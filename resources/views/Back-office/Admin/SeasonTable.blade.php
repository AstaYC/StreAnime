
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
                <h1>My Seasons</h1>
            </div>
            
        </div>

        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Seasons <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog" style="max-width: 700px;">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New Season</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/season/add" enctype="multipart/form-data">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                   <div class="form-group">
                                                        <label for="CategorieName">Season Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                                                        
                                                        <label for="CategorieName">Season Titre:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                        
                                                        <label for="CategorieName">Season Description:</label>
                                                        <textarea type="text" class="form-control" id="CategorieName" name="description" ></textarea>
                                                        
                                                        <label for="CategorieName">Release Year:</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                                       
                                                        <label for="CategorieName">End Year:</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="endYear" >
                                                        
                                                        <label for="CategorieName">Season trailler:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="trailerLink" >

                                                        <label for="CategorieName">Imdb Season Rating:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                                        
                                                        <label for="CategorieName">Season Ranking:</label>
                                                        <input type="number" class="form-control" id="CategorieName" name="seasonNumber" >
                                                      
                                                        <label for="CategorieName">Anime Associate:</label>
                                                        <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                                            <option value="">Choose an anime</option>  
                                                            @foreach ($animes as $anime)
                                                            <option value="{{$anime->id}}">{{$anime->titre}}</option>  
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add Season</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New Season</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>TiTre de season</th>											
                                <th>Description</th>											
                                <th>Release Year</th>											
                                <th>End Year</th>											
                                <th>Trailler</th>											
                                <th>Imbd Link</th>											
                                <th>Season Ranking</th>											
                                <th>Anime Associate</th>											
                                <th>Categories</th>											
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($seasons as $season)
                            <tr>
                                <td><img src="{{$season->posterLink}}" width="100px"></img></td>
                                <td>{{$season->titre}}</td>
                                <td>{{$season->description}}</td>
                                <td>{{$season->releaseYear}}</td>
                                <td>{{$season->endYear}}</td>
                                <td><iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $season->trailerLink }}" frameborder="0" allowfullscreen></iframe></td>
                                <td><a href="{{ $season->imbdLink }}" target="_blank"><img src="{{ asset('img/MAL.png') }}" width="50px"></img></a></td>
                                <td>{{$season->seasonNumber}}</td>
                                <td>{{$season->anime_titre}}</td>
                                <td>@foreach($animes->find($season->anime_id)->categories as $categorie){{$categorie->nom}} & @endforeach</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$season->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$season->id}}">
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

    @foreach($seasons as $season)

       <!-- modal de update -->
    <div class="modal" id="updateCategoryModal{{$season->id}}">
        <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update season</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/season/update" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$season->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                
                                <label for="CategorieName">Season Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="posterLink">
                                
                                <label for="CategorieName">Season Titre:</label>
                                <input type="text" class="form-control" id="CategorieName" name="titre" value="{{ $season->titre }}" required>
                                
                                <label for="CategorieName">Season Description:</label>
                                <textarea type="text" class="form-control" id="CategorieName" name="description">{{ $season->description }}</textarea>
                                
                                <label for="CategorieName">Release Year:</label>
                                <input type="date" class="form-control" id="CategorieName" name="releaseYear" value="{{ $season->releaseYear }}">
                                
                                <label for="CategorieName">End Year:</label>
                                <input type="date" class="form-control" id="CategorieName" name="endYear" value="{{ $season->endYear }}">
                                
                                <label for="CategorieName">Season trailler:</label>
                                <input type="text" class="form-control" id="CategorieName" name="trailerLink" value="{{ $season->trailerLink }}">

                                <label for="CategorieName">Imdb Season Rating:</label>
                                <input type="text" class="form-control" id="CategorieName" name="imbdLink" value="{{ $season->imbdLink }}">
                                
                                <label for="CategorieName">Season Ranking:</label>
                                <input type="number" class="form-control" id="CategorieName" name="seasonNumber" value="{{ $season->seasonNumber }}">
                              
                                <label for="CategorieName">Anime Associate:</label>
                                <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                    <option value="">Choose an anime</option>  
                                    @foreach ($animes as $anime)
                                    <option value="{{$anime->id}}">{{$anime->titre}}</option>  
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update seasons</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$season->id}}">										
<div class="modal-dialog" style="max-width: 700px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Hidden seasons</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->   
                    <form method="POST" action="/season/hidden">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$season->id}}">
                        <p>Are you sure you want to Hidden this seasons "{{$season->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Hidden season</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection('styles')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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

<script>
    $(document).ready(function(){
        $('.search').selectpicker();
    })
</script>  

@endsection('scripts')

@endsection('content')