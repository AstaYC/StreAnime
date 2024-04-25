
@extends('layout.dashboard')
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
                                                <form method="POST" action="/episode/add" enctype="multipart/form-data">
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
                                                        <input type="file" class="form-control" id="CategorieName" name="mediaLink" >
                                                        
                                                        <label for="CategorieName">Episode Duration:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="duration" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]">
                                                        
                                                        <label for="CategorieName">Episode Number:</label>
                                                        <input type="number" class="form-control" id="CategorieName" name="episodeNumber" min="0">
                                                      
                                                        <label for="CategorieName">Season Associate:</label>
                                                        <select class="form-control search" id="CategorieName" name="season_id" data-live-search="true">
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
                                <th>Episode Number</th>											
                                <th>Duration</th>											
                                <th>Season Associate</th>											
                                <th>Anime Associate</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($episodes as $episode)
                            <tr>
                                <td><img src="{{$episode->posterLink}}" width="100px"></img></td>
                                <td>{{$episode->titre}}</td>
                                <td><video width="140" height="100" src="{{ $episode->mediaLink }}" autoplay loop controls poster="{{$episode->posterLink}}"></video></td>
                                <td>{{$episode->releaseYear}}</td>
                                <td>{{$episode->episodeNumber}}</td>
                                <td>{{$episode->duration}}</td>
                                <td>{{$episode->season_titre}}</td>
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
        <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update episode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/episode/update" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$episode->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="CategorieName">Episode Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="posterLink">
                                
                                <label for="CategorieName">Episode Titre:</label>
                                <input type="text" class="form-control" id="CategorieName" name="titre" value="{{ $episode->titre }}" required>
                                
                                <label for="CategorieName">Release Year:</label>
                                <input type="date" class="form-control" id="CategorieName" name="releaseYear" value="{{ $episode->releaseYear }}" >
                                
                                <label for="CategorieName">Episode Media:</label>
                                <input type="file" class="form-control" id="CategorieName" name="mediaLink" >
                                
                                <label for="CategorieName">Episode Duration:</label>
                                <input type="text" class="form-control" id="CategorieName" name="duration" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]" value="{{ $episode->duration }}" >
                                
                                <label for="CategorieName">Episode Ranking:</label>
                                <input type="number" class="form-control" id="CategorieName" name="episodeNumber" value="{{ $episode->episodeNumber }}" >
                            
                                <label for="CategorieName">Season Associate:</label>
                                <select class="form-control search" id="CategorieName" name="season_id" data-live-search="true">
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
                <div class="modal-header" style="max-width: 700px;">
                    <h4 class="modal-title">Hidden episodes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/episode/hidden">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$episode->id}}">
                        <p>Are you sure you want to Hidde this episodes "{{$episode->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Hidde episode</button>
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
