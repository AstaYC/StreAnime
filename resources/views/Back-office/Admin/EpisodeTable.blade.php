
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
        @if($errors->any())
        <ul>
          <li>
           {{$errors}}
          </li>
        </ul>
     @endif
     @if(session('status'))
       <div class="alert alert-success">
         {{session('status')}}
       </div>
     @endif
        <div class="head-title">
            <div class="left">
                <h1>My Episodes</h1>
            </div>
            
        </div>

        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Episodes <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog" style="max-width: 700px;">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New Episode</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/episode/add">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                   <div class="form-group">
                                                        <label for="CategorieName">Episode Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                                                        
                                                        <label for="CategorieName">Episode Titre:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                        
                                                        <label for="CategorieName">Release Year:</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                                        
                                                        <label for="CategorieName">Episode Media:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="mediaLink" >

                                                        <label for="CategorieName">Imdb Episode Rating:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                                        
                                                        <label for="CategorieName">Episode Duration:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                                        
                                                        <label for="CategorieName">Episode Number:</label>
                                                        <input type="number" class="form-control" id="CategorieName" name="episodeNumber" min="0">
                                                      
                                                        <label for="CategorieName">Season Associate:</label>
                                                        <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                                            <option value="">Choose an Season</option>  
                                                            @foreach ($seasons as $season)
                                                            <option value="{{$season->id}}">{{$season->titre}} Anime:('{{$season->anime_titre}}')</option>  
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add Episode</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New episode</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>TiTre</th>											
                                <th>Release Year</th>											
                                <th>Media</th>											
                                <th>Imbd Rating</th>											
                                <th>Episode Number</th>											
                                <th>Duration</th>											
                                <th>Episode Associate</th>											
                                <th>Anime Associate</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($episodes as $episode)
                            <tr>
                                <td>{{$episode->poster}}</td>
                                <td>{{$episode->Titre}}</td>
                                <td>{{$episode->releaseYear}}</td>
                                <td>{{$episode->mediaLink}}</td>
                                <td>{{$episode->imbdLink}}</td>
                                <td>{{$episode->episodeNumber}}</td>
                                <td>{{$episode->duration}}</td>
                                <td>{{$episode->titre}}</td>
                                <td>{{$episode->anime_titre}}</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$episode->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$episode->id}}">
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

    @foreach($episodes as $episode)

       <!-- modal de update -->
    <div class="modal" id="updateCategoryModal{{$episode->id}}">
        <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update episode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/episode/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$episode->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="CategorieName">Episode Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                                
                                <label for="CategorieName">Episode Titre:</label>
                                <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                
                                <label for="CategorieName">Release Year:</label>
                                <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                
                                <label for="CategorieName">Episode Media:</label>
                                <input type="text" class="form-control" id="CategorieName" name="mediaLink" >

                                <label for="CategorieName">Imdb Episode Rating:</label>
                                <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                
                                <label for="CategorieName">Episode Duration:</label>
                                <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                
                                <label for="CategorieName">Episode Ranking:</label>
                                <input type="number" class="form-control" id="CategorieName" name="episodeNumber" >
                                
                                <label for="CategorieName">Status</label>
                                <select class="form-control" id="CategorieName" name="status">
                                   <option value="s">Showing</option>
                                   <option value="h">Hidding</option>
                                </select>
                            
                                <label for="CategorieName">Season Associate:</label>
                                <select class="form-control search" id="CategorieName" name="anime_id" data-live-search="true">
                                    <option value="">Choose an Season</option>  
                                    @foreach ($seasons as $season)
                                    <option value="{{$season->id}}">{{$season->titre}} Anime:('{{$season->anime_titre}}')</option>  
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update episodes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$episode->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete episodes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/episode/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$episode->id}}">
                        <p>Are you sure you want to delete this episodes "{{$episode->nom}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete episode</button>
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
    $(document).ready(function(){
        $('.search').selectpicker();
    })
</script>  

@endsection('scripts')

@endsection('content')