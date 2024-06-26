
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
                                                <form method="POST" action="/anime/add" enctype="multipart/form-data">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">Anime Title:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="titre" required>
                                                        
                                                        <label for="CategorieName">Anime Description:</label>
                                                        <textarea class="form-control" id="CategorieName" name="description" required></textarea>
                                                        
                                                        <label for="CategorieName">Anime Poster:</label>
                                                        <input type="file" class="form-control" id="CategorieName" name="posterLink" >
                                                        
                                                        <label for="CategorieName">Anime Trailler:</label>
                                                        <input type="text" class="form-control" id="CategorieName" name="trailerLink" >

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
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Poster</th>											
                                <th>Title</th>											
                                <th>Description</th>											
                                <th>Trailler</th>											
                                <th>Imbd</th>											
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
                                <td><img src="{{$anime->posterLink}}" width="100px"></img></td>
                                <td>{{$anime->titre}}</td>
                                <td>@if(strlen($anime->description) > 50)
                                    {{ substr($anime->description , 0 , 50) }}
                                    <a href="#" onclick="showMore('{{ $anime->description }}')" >read more</a>
                                    @else
                                     {{$anime->description}}
                                    @endif
                                </td>
                                <td><iframe width="140" height="100" src="https://www.youtube.com/embed/{{ $anime->trailerLink }}" frameborder="0" allowfullscreen></iframe></td>
                                <td><a href="{{ $anime->imbdLink }}" target="_blank"><img src="{{ asset('img/MAL.png') }}" width="50px"></img></a></td>
                                <td>{{$anime->releaseYear}}</td>
                                <td>{{$anime->endYear}}</td>
                                <td>{{$anime->mangaka}}</td>
                                <td>{{$anime->studio}}</td>
                                <td>{{$anime->nom}}</td>
                                <td>@foreach($anime->categories as $categorie){{$categorie->nom}} & @endforeach</td>
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
                        <h4 class="modal-title">Update Anime "{{$anime->titre}}"</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/anime/update" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$anime->id}}">

                            <!-- Input fields for updated medicine details -->
                            
                            <div class="form-group">
                                <label for="CategorieName">Anime Title:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $anime->titre }}" name="titre" required>
                                
                                <label for="CategorieName">Anime Description:</label>
                                <textarea class="form-control" id="CategorieName" name="description" required>{{ $anime->description }}</textarea>
                                
                                <label for="CategorieName">Anime Poster:</label>
                                <input type="file" class="form-control" id="CategorieName" name="posterLink" >  
                                
                                <label for="CategorieName">Anime Trailler:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $anime->trailerLink }}" name="traillerLink" >

                                <label for="CategorieName">Imdb Anime Rating:</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $anime->imbdLink }}" name="imbdLink" >
                               
                                <label for="CategorieName">Release Year</label>
                                <input type="date" class="form-control" id="CategorieName" value="{{ $anime->releaseYear }}" name="releaseYear" >
                                
                                <label for="CategorieName">End Year</label>
                                <input type="date" class="form-control" id="CategorieName" value="{{ $anime->endYear }}" name="endYear" >
                                
                                <label for="CategorieName">Mangaka</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $anime->mangaka }}"  name="mangaka" >
                                
                                <label for="CategorieName">Studio</label>
                                <input type="text" class="form-control" id="CategorieName" value="{{ $anime->studio }}" name="studio" >
                             
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
                                <select name="categories[]" id="categories2" multiple>
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
                    <h4 class="modal-title">Hidden Animes</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/anime/hidden">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        {{-- {{ dd($anime) }} --}}
                        <input type="hidden" name="id" value="{{$anime->id}}">
                        <p>Are you sure you want to Hidde this Animes "{{$anime->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Hidden Anime</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach

@endsection('content')

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    
@endsection('styles')

@section('scripts')

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#myTable').DataTable();
       } );
 </script>
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

<script>
new MultiSelectTag('categories2', {
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

{{-- show more script --}}
<script>
    function showMore(description){
        console.log(description);
        alert(description);
    }

</script>


@endsection('scripts')