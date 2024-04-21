
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
        {{ $errorsString = ''}}
        
        @if($errors->any())
           
           {{ $errorsString = implode('&', $errors->all()) }}

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
                            <th>Role d'User</th>											
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>	
                          @foreach($users as $user)
                          <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->nom}}</td>
                            @if($user->nom != 'Super_Admin')
                            <td>
                                <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$user->id}}">
                                    <i class="material-icons">&#xE8B8;</i>
                                </a>
                                <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$user->id}}">
                                  <i class="material-icons">&#xE5C9;</i>
                                </a>
                              </td>
                              @endif
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


{{-- update Model --}}
<div class="modal" id="updateCategoryModal{{$user->id}}">
    <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Role User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Update medicine form -->
                        <form method="POST" action="/user/update">
                            @csrf

                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{$user->id}}">

                            <!-- Input fields for updated medicine details -->
                            <div class="form-group">
                                <label for="updateMedicineName">User Role:</label>
                                <select  class="form-control" id="updateCategoryName" name="role" required>
                                    @foreach ($roles as $role)
                                         <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Users Role</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</div>


{{--  --}}
  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$user->id}}">										
<div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Users '{{ $user->name }}'</h4>
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
