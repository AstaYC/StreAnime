
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
                <h1>My News</h1>
            </div>
            
        </div>


        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>AnimeNews <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New News</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/animeNewsTable/add" enctype="multipart/form-data">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">News Title:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="CategorieName">News Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="posterLink" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="CategorieName">News Date:</label>
                                                        <input type="text" class="form-control" id="CategorieName" placeholder="DD/april/YYYY" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="CategorieName">News SOurce:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="newsLink" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="CategorieName">Anime Associate:</label>
                                                        <select type="text" class="form-control" id="CategorieName" name="anime_id" required>
                                                            @foreach ($animes as $anime)
                                                               <option value="{{ $anime->id }}">{{ $anime->titre }}</option>  
                                                            @endforeach 
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add News</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New News</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>News Poster</th>
                                <th>News Title</th>											
                                <th>News Date</th>
                                <th>News Source</th>
                                <th>Anime Associate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($animeNews as $animeNew)
                            <tr>
                                <td><img src="{{$animeNew->posterLink}}" width="100px"></img></td>
                                <td>{{$animeNew->titre}}</td>
                                <td>{{$animeNew->date}}</td>
                                <td><a href="{{$animeNew->newsLink}}" target="_blanc">NewsSource</a></td>
                                <td>{{$animeNew->anime_titre}}</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$animeNew->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$animeNew->id}}">
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

    @foreach($animeNews as $animeNew)

       <!-- modal de update -->
       <div class="modal" id="updateCategoryModal{{$animeNew->id}}">
           <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update source</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Add medicine form -->
                        <form method="POST" action="/animeNewsTable/update" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$animeNew->id}}">

                            <!-- Input fields for medicine details -->
                            <div class="form-group">
                                <label for="CategorieName">News Title:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeNew->titre }}" name="titre" required>
                            </div>
                            <div class="form-group">
                                <label for="CategorieName">News Poster:</label>
                                <input type="file" class="form-control" id="CategorieName"  name="posterLink" >
                            </div>
                            <div class="form-group">
                                <label for="CategorieName">News Date:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeNew->date }}" placeholder="DD/april/YYYY" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="CategorieName">News SOurce:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $animeNew->newsLink }}" name="newsLink" required>
                            </div>
                            <div class="form-group">
                                <label for="CategorieName">Anime Associate:</label>
                                <select type="text" class="form-control" id="CategorieName" name="anime_id" required>
                                    @foreach ($animes as $anime)
                                        <option value="{{ $anime->id }}">{{ $anime->titre }}</option>  
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add" class="btn btn-primary">update News</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$animeNew->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete News</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/animeNewsTable/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$animeNew->id}}">
                        <p>Are you sure you want to delete this News "{{$animeNew->nom}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete News</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection('styles')

@section('scripts')
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#myTable').DataTable();
       } );
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
