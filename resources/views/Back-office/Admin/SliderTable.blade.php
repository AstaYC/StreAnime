
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
                <h1>My Sliders</h1>
            </div>
        </div>

        <div class="container-xxxl">
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
                                                        <label for="CategorieName">Choose The Anime</label>
                                                        <select  class="form-control select" id="CategorieName" name="anime_id" data-live-search="true" >
                                                                 <option value="">Choose an anime</option>
                                                                @foreach($animes as $anime)
                                                                  <option value="{{$anime->anime_id}}">{{$anime->anime_titre}}</option>
                                                                @endforeach
                                                        </select>
                                                        <br><br>
                                                        <div>OR</div>
                                                        <br>
                                                        <label for="CategorieName">Choose The AnimeFilm</label>
                                                        <select  class="form-control select" id="CategorieName" name="anime_film_id" data-live-search="true" >
                                                                  <option value="">Choose an animeFilm</option>
                                                               @foreach($films as $film)
                                                                  <option value="{{$film->film_id}}">{{$film->film_titre}} : Anime({{ $film->anime_titre}})</option>
                                                               @endforeach
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
                   <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Anime Poster</th>
                                    <th>The Associate Anime</th>											
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>	
                            @foreach($animeSliders as $animeSlider)
                                <tr>
                                    <td>{{$animeSlider->id}}</td>
                                    <td><img src="{{$animeSlider->posterLink}}" width="100px"></td>
                                    <td>{{$animeSlider->titre}}</td>
                                    <td>
                                            <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$animeSlider->id}}">
                                                <i class="material-icons">&#xE8B8;</i>
                                            </a>
                                            <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$animeSlider->id}}">
                                                <i class="material-icons">&#xE5C9;</i>
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                         </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Anime Films Poster</th>
                                    <th>The Associate Film</th>											
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>	
                            @foreach($filmSliders as $filmSlider)
                                <tr>
                                    <td>{{$filmSlider->id}}</td>
                                    <td><img src="{{$filmSlider->posterLink}}" width="100px"></td>
                                    <td>{{$filmSlider->titre}}</td>
                                    <td>
                                            <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$filmSlider->id}}">
                                                <i class="material-icons">&#xE8B8;</i>
                                            </a>
                                            <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$filmSlider->id}}">
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
            </div>
        </div>  
    </main>

    @foreach($animeSliders as $animeSlider)

       <!-- modal de update ANime slider-->
<div class="modal" id="updateCategoryModal{{$animeSlider->id}}">
    <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Animeslider</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/slider/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$animeSlider->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <select  class="form-control select" id="CategorieName" name="anime_id" data-live-search="true" >
                                    <optgroup label="Animes">
                                      @foreach($animes as $anime)
                                      <option value="{{$anime->anime_id}}">{{$anime->anime_titre}}</option>
                                      @endforeach
                                    </optgroup>
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
<div class="modal" id="deleteCategoryModal{{$animeSlider->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Aninmesliders</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/slider/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="anime_id" value="{{$animeSlider->id}}">
                        <p>Are you sure you want to delete this sliders "{{$animeSlider->titre}}"?</p>
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

 <!-- modal de update ANimeFIlm slider-->
 @foreach($filmSliders as $filmSlider)

 <!-- modal de update ANime slider-->
<div class="modal" id="updateCategoryModal{{$filmSlider->id}}">
<div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Update Filmslider</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
                  <!-- Update medicine form -->
                  <form method="POST" action="/slider/update">
                      @csrf

                      <input type="hidden" name="action" value="update">
                      <input type="hidden" name="id" value="{{$filmSlider->id}}">

                      <!-- Input fields for updated medicine details -->
                      <div class="form-group">
                          <label for="CategorieName">Choose The AnimeFilm</label>
                          <select  class="form-control select" id="CategorieName" name="anime_film_id" data-live-search="true" >
                                 @foreach($films as $film)
                                    <option value="{{$film->film_id}}">{{$film->film_titre}} : Anime({{ $film->anime_titre}})</option>
                                 @endforeach
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
<div class="modal" id="deleteCategoryModal{{$filmSlider->id}}">										
<div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Delete Filmsliders</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
              <!-- Delete medicine form -->
              <form method="POST" action="/slider/delete">
              @csrf
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="anime_film_id" value="{{$filmSlider->id}}">
                  <p>Are you sure you want to delete this sliders "{{$filmSlider->titre}}"?</p>
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

@endsection