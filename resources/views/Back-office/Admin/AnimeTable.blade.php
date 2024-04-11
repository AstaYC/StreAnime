
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
                <h1>My Anime</h1>
            </div>
            
        </div>

        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Anime <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog" style="max-width: 700px;">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New Anime</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/anime/add">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">Anime Title:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                        
                                                        <label for="CategorieName">Anime Description:</label>
                                                        <textarea class="form-control" id="CategorieName" name="description" required></textarea>
                                                        
                                                        <label for="CategorieName">Anime Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="poster" >
                                                        
                                                        <label for="CategorieName">Anime Trailler:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="traillerLink" >

                                                        <label for="CategorieName">Imdb Anime Rating:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                                                       
                                                        <label for="CategorieName">Release Year</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                                        
                                                        <label for="CategorieName">End Year</label>
                                                        <input type="date" class="form-control" id="CategorieName" name="endYear" >
                                                        
                                                        <label for="CategorieName">Mangaka</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="mangaka" >
                                                        
                                                        <label for="CategorieName">Studio</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="studio" >
                                                        
                                                        <label for="CategorieName">Source</label>
                                                        <select class="form-control" name="source_id" id="CategorieName">
                                                            @foreach($sources as $source)
                                                               <option value="{{$source->id}}">{{$source->nom}}</option>
                                                            @endforeach
                                                        </select>

                                                        <br>
                                                        <label for="CategorieName">Categories</label>
                                                        <select name="categories[]" id="categories" multiple>
                                                            @foreach ($categories as $categorie)
                                                            <option value="{{$categorie->id}}">{{$categorie->nom}}</option>  
                                                            @endforeach
                                                        </select>
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add Anime</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New Anime</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Poster</th>											
                                <th>Title</th>											
                                <th>Description</th>											
                                <th>Trailler</th>											
                                <th>Rating</th>											
                                <th>Release Year</th>											
                                <th>End Year</th>											
                                <th>Mangaka</th>											
                                <th>Studio</th>											
                                <th>Source</th>											
                                <th>Categories</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($animes as $anime)
                            <tr>
                                <td>{{$anime->poster}}</td>
                                <td>{{$anime->titre}}</td>
                                <td>{{$anime->description}}</td>
                                <td>{{$anime->traillerLink}}</td>
                                <td>{{$anime->imbdLink}}</td>
                                <td>{{$anime->releaseYear}}</td>
                                <td>{{$anime->endYear}}</td>
                                <td>{{$anime->mangaka}}</td>
                                <td>{{$anime->studio}}</td>
                                <td>{{$anime->nom}}</td>
                                <td>@foreach($anime->find($anime->id)->categorie as $categorie){{$categorie->nom}} & @endforeach</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$anime->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$anime->id}}">
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

    @foreach($animes as $anime)

       <!-- modal de update -->
    <div class="modal" id="updateCategoryModal{{$anime->id}}">
        <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update anime</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/anime/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$anime->id}}">

                            <!-- Input fields for updated medicine details -->
                            
                            <div class="form-group">
                                <label for="CategorieName">Anime Title:</label>
                                <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                
                                <label for="CategorieName">Anime Description:</label>
                                <textarea class="form-control" id="CategorieName" name="description" required></textarea>
                                
                                <label for="CategorieName">Anime Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="poster" >
                                
                                <label for="CategorieName">Anime Trailler:</label>
                                <input type="text" class="form-control" id="CategorieName" name="traillerLink" >

                                <label for="CategorieName">Imdb Anime Rating:</label>
                                <input type="text" class="form-control" id="CategorieName" name="imbdLink" >
                               
                                <label for="CategorieName">Release Year</label>
                                <input type="date" class="form-control" id="CategorieName" name="releaseYear" >
                                
                                <label for="CategorieName">End Year</label>
                                <input type="date" class="form-control" id="CategorieName" name="endYear" >
                                
                                <label for="CategorieName">Mangaka</label>
                                <input type="text" class="form-control" id="CategorieName" name="mangaka" >
                                
                                <label for="CategorieName">Studio</label>
                                <input type="text" class="form-control" id="CategorieName" name="studio" >
                             
                                <label for="CategorieName">Source</label>
                                <select class="form-control" name="source_id" id="CategorieName">
                                    @foreach($sources as $source)
                                       <option value="{{$source->id}}">{{$source->nom}}</option>
                                    @endforeach
                                </select>
                                
                                <label for="CategorieName">Status</label>
                                <select class="form-control" id="CategorieName" name="status">
                                   <option value="s">Showing</option>
                                   <option value="h">Hidding</option>
                                </select>
                                
                            
                                <br>
                                <label for="CategorieName">Categories</label>
                                <select name="categories[]" id="categories" multiple>
                                    @foreach ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->nom}}</option>  
                                    @endforeach
                                </select>
                            
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update animes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$anime->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Animes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/anime/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$anime->id}}">
                        <p>Are you sure you want to delete this Animes "{{$anime->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Anime</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach

@endsection('content')

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    
@endsection('styles')

@section('scripts')

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
new MultiSelectTag('categories', {
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
@endsection('scripts')