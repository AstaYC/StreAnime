
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
        <li>
            <a href="/role">
                <i class='bx bxs-doughnut-chart' ></i>
                <span class="text">Permission</span>
            </a>
        </li>
        <li class="active">
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
                <h1>My User</h1>
            </div>
            
        </div>


        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>User <b>Management</b></h2>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nom de User</th>											
                            <th>Email de User</th>											
                            <th>Password User</th>											
                            <th>Role d'User</th>											
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>	
                          @foreach($users as $user)
                          <tr>
                            <td>{{$user->user_id}}</td>
                            <td>{{$user->user_nom}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->password}}</td>
                            <td>{{$user->role_nom}}</td>
                            <td>
                                <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$user->user_id}}">
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
@foreach($users as $user)

  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$user->id}}">										
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
                    <form method="POST" action="/user/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <p>Are you sure you want to delete that User?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
