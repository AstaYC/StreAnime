
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
                <h1>My Character</h1>
            </div>
            
        </div>


        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Character <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New character</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/character/add">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">Character Name:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="nom" required>
                                                        
                                                        <label for="CategorieName">Character glance:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="glance" required>
                                                        
                                                        <label for="CategorieName">Character image:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="images" >
                                                      
                                                        <label for="CategorieName">In Anime ?</label>
                                                        <select class="form-control" id="CategorieName" name="anime_id" >
                                                            <option value="">Choose an anime</option>  
                                                            @foreach ($animes as $anime)
                                                            <option value="{{$anime->id}}">{{$anime->nom}}</option>  
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <label for="films_id">In Film(s) ?</label>
                                                        <select name="films_id[]" id="films_id" multiple>
                                                            @foreach ($animeFilms as $animeFilm)
                                                            <option value="{{$animeFilm->id}}">{{$animeFilm->nom}}</option>  
                                                            @endforeach
                                                        </select>
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add character</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New character</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom de character</th>											
                                <th>Glance</th>											
                                <th>Anime Associé</th>											
                                <th>Film(s) Associé</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($characters as $character)
                            <tr>
                                <td>{{$character->id}}</td>
                                <td>{{$character->nom}}</td>
                                <td>{{$character->glance}}</td>
                                <td>{{$character->anime_nom}}</td>
                                <td>@foreach($characterWithFilms->find($character->id)->anime_films as $film){{$film->titre}} & </td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$character->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$character->id}}">
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

    @foreach($characters as $character)

       <!-- modal de update -->
    <div class="modal" id="updateCategoryModal{{$character->id}}">
        <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update character</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/character/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$character->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="CategorieName">Character Name:</label>
                                <input type="text" class="form-control" id="CategorieName" name="nom" value="{{$character->nom}} required>
                                
                                <label for="CategorieName">Character glance:</label>
                                <input type="text" class="form-control" id="CategorieName" name="glance" value="{{$character->glance}} required>
                                
                                <label for="CategorieName">Character image:</label>
                                <input type="file" class="form-control" id="CategorieName" name="images" >
                              
                                <label for="CategorieName">In Anime ?</label>
                                <select class="form-control" id="CategorieName" name="anime_id" >
                                    <option value="">Choose an anime</option>  
                                    @foreach ($animes as $anime)
                                    <option value="{{$anime->id}}">{{$anime->nom}}</option>  
                                    @endforeach
                                </select>
                                <br>
                                <label for="films_id">In Film(s) ?</label>
                                <select name="films_id[]" id="films_id" multiple>
                                    @foreach ($animeFilms as $animeFilm)
                                    <option value="{{$animeFilm->id}}">{{$animeFilm->nom}}</option>  
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update characters</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$character->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete characters</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/character/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$character->id}}">
                        <p>Are you sure you want to delete this characters "{{$character->nom}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete character</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
new MultiSelectTag('films_id', {
    rounded: true,    // default true
    shadow: true,      // default false
    placeholder: 'Search',  // default Search...
    tagColor: {
        textColor: 'black',
        borderColor: 'black',
        bgColor: 'white',
    },
    onChange: function(values) {
        console.log(values)
    }
})
</script>
@endsection
