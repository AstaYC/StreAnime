
@extends('layout.dashboard')
@section('sidebar')
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">Evento Espace d'Admin</span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="/categorie">
                <i class='bx bxs-group' ></i>
                <span class="text">Categories</span>
            </a>
        </li>
        <li  >
            <a href="/eventValidation">
                <i class='bx bxs-shopping-bag-alt' ></i>
                <span class="text">Event Validation</span>
            </a>
        </li>
        <li class="active">
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
                <h1>My Categories</h1>
            </div>
            
        </div>


        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Roles <b>Management</b></h2>
                            </div>
                            <div class="modal" id="addCategorieModal">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title text-primary">Add New Role</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="/role/add">
                                        @csrf
                                        <div class="form-group">
                                          <label for="CategorieName">Role Name:</label>
                                          <input type="text" class="form-control" id="CategorieName" placeholder="CategorieName" name="nom" required>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label>Le(s) Route(s):</label>
                                          @foreach($routes as $route)
                                          <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="route{{$route['id']}}" name="id[]" value="{{$route['id']}}">
                                            <label class="form-check-label" for="route{{$route['id']}}">{{$route['nom']}}</label>
                                          </div>
                                          @endforeach
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" name="add" class="btn btn-primary">Add Role</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>    
                            <div class="col-sm-7">
                                <!-- <a href="" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Categories</span></a> -->
                                <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addCategorieModal"><i class="material-icons">&#xE147;</i> <span>Add New Role</span></a>				
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Role</th>										
                                <th>Les Permissions</th>										
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($rolesWithRoutes as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->nom}}</td>
                                <td>@foreach($role->routes as $route){{$route->nom}} & @endforeach</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$role->id}}">
                                            <i class="material-icons">&#xE8B8;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$role->id}}">
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
</section>
@foreach($rolesWithRoutes as $role)

       <!-- modal de update -->
       <div class="modal" id="updateCategoryModal{{$role->id}}">
        <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Update role "{{$role->nom}}"</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="/role/update">
                    @csrf
                    <input type="hidden" name="role_id" value="{{$role->id}}">

                    <div class="form-group">
                      <label for="updateMedicineName">Role Name:</label>
                      <input type="text" class="form-control" id="updateCategoryName" name="nom" value="{{$role->nom}}" required>
                    </div>
                    
                    <label>Le(s) Route(s):</label>
                    @foreach($routes as $route)
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="route{{$route['id']}}" name="id[]" value="{{$route['id']}}">
                      <label class="form-check-label" for="route{{$route['id']}}">{{$route['nom']}}</label>
                    </div>
                    @endforeach
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                  </form>
                </div>
              </div>
        </div>
      </div>
      
      {{--  delete model --}}
    <div class="modal" id="deleteCategoryModal{{$role->id}}">										
       <div class="modal-dialog">
             <div class="modal-content">
                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h4 class="modal-title">Delete Role "{{$role->nom}}"</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                 <!-- Modal Body -->
                 <div class="modal-body">
                     <!-- Delete medicine form -->
                     <form method="POST" action="/role/delete">
                         @csrf
                             <input type="hidden" name="id" value="{{$role->id}}">
                         <p>Are you sure you want to delete this Categorie?</p>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                             <button type="submit" class="btn btn-danger">Delete Role</button>
                         </div>
                     </form>
                 </div>
               </div>
        </div>
    </div>
@endforeach
@endsection
