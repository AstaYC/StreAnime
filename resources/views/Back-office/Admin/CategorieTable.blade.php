
@extends('layout.dashboard')
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
     {{-- @if(session('status'))
       <div class="alert alert-success">
         {{session('status')}}
       </div>
     @endif --}}
        <div class="head-title">
            <div class="left">
                <h1>My Categories</h1>
            </div>
            
        </div>


        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Categories <b>Management</b></h2>
                            </div>
                                <div class="modal" id="addCategorieModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title text-primary">Add New Categorie</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <!-- Add medicine form -->
                                                <form method="POST" action="/categorie/add">
                                                    @csrf
                                                    <!-- Input fields for medicine details -->
                                                    <div class="form-group">
                                                        <label for="CategorieName">Categorie Name:</label>
                                                        <input type="text" class="form-control" id="CategorieName" placeholder="CategorieName" name="nom" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add Categorie</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New Categorie</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom de Categorie</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($categories as $categorie)
                            <tr>
                                <td>{{$categorie->id}}</td>
                                <td>{{$categorie->nom}}</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$categorie->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$categorie->id}}">
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

    @foreach($categories as $categorie)

       <!-- modal de update -->
       <div class="modal" id="updateCategoryModal{{$categorie->id}}">
    <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Categorie</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/categorie/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$categorie->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="updateMedicineName">Categorie Name:</label>
                                <input type="text" class="form-control" id="updateCategoryName" name="nom" value="{{$categorie->nom}}" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Categorie</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$categorie->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Categorie</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/categorie/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$categorie->id}}">
                        <p>Are you sure you want to delete this Categorie "{{$categorie->nom}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Categorie</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')

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

@endsection('scripts')
