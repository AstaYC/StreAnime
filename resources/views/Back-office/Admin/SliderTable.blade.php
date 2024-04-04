
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
                <h1>My Sliders</h1>
            </div>
        </div>

        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>SLiders <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New Slider</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/slider/add">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">Choose The Anime Or Anime-Film</label>
                                                        <select  class="form-control select" id="CategorieName" name="media_id" data-live-search="true" required>

                                                             <optgroup label="Animes">
                                                                @foreach($animes as $anime)
                                                                <option value="{{$anime->anime_id}}">{{$anime->anime_titre}}</option>
                                                                @endforeach
                                                              </optgroup>
                                                              <optgroup label="Anime-Films">
                                                                @foreach($films as $film)
                                                                <option value="{{$film->film_id}}">{{$film->film_titre}}</option>
                                                                @endforeach
                                                              </optgroup>   
    
                                                        </select>
                                                        <label for="CategorieName">Type de Media:</label>
                                                        <select  class="form-control" id="CategorieName" name="type" required>
                                                            <option value="anime">Anime !</option>
                                                            <option value="animeFilm">Anime Film !</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add slider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New slider</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom de slider</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->nom}}</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$slider->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$slider->id}}">
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

    @foreach($sliders as $slider)

       <!-- modal de update -->
       <div class="modal" id="updateCategoryModal{{$slider->id}}">
    <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update slider</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/slider/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$slider->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="CategorieName">Choose The Anime Or Anime-Film</label>
                                <select  class="form-control select" id="CategorieName" name="media_id" data-live-search="true" required>

                                   <optgroup label="Animes">
                                      @foreach($animes as $anime)
                                      <option value="{{$anime->anime_id}}">{{$anime->anime_titre}}</option>
                                      @endforeach
                                    </optgroup>
                                    <optgroup label="Anime-Films">
                                      @foreach($films as $film)
                                      <option value="{{$film->film_id}}">{{$film->film_titre}}</option>
                                      @endforeach
                                    </optgroup>   
    
                                </select>
                                    <label for="CategorieName">Type de Media:</label>
                                    <select  class="form-control" id="CategorieName" name="type" required>
                                        <option value="anime">Anime !</option>
                                   <option value="animeFilm">Anime Film !</option>
                                </select>
                             </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update sliders</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$slider->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete sliders</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/slider/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$slider->id}}">
                        <p>Are you sure you want to delete this sliders "{{$slider->nom}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete sliders</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endforeach

@endsection 

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.select').selectpicker();
    })
</script>  
@endsection