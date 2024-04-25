
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
                <h1>My Hidden Season</h1>
            </div>
            
        </div>

        <div class="container-xxxl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2>Hidden Season <b>Management</b></h2>
                            </div>

                        </div>
                    </div>
                    <table class="table table-striped table-hover"> 
                        <thead>
                            <tr>
                                <th>Poster</th>											
                                <th>Title</th>											
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>	
                        @foreach($seasons as $season)
                            <tr>
                                <td><img src="{{$season->posterLink}}" width="100px"></img></td>
                                <td>{{$season->titre}}</td>
                                <td>
                                        <a href="#" class="settings" title="Settings" data-toggle="modal" data-target="#updateCategoryModal{{$season->id}}">
                                            <i class="material-icons">&#xE5CA;</i>
                                        </a>
                                        <a href="#" class="delete" title="Delete" data-toggle="modal" data-target="#deleteCategoryModal{{$season->id}}">
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

    @foreach($seasons as $season)

       <!-- modal de recuperation -->
      
       <div class="modal" id="updateCategoryModal{{$season->id}}">										
          <div class="modal-dialog" style="max-width: 700px;">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Recuperation Season</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Delete medicine form -->
                            <form method="POST" action="/hiddenSeason/recuperate">
                            @csrf
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="{{$season->id}}">
                                <p>Are you sure you want to Recuperer this Season "{{$season->titre}}"?</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Recuperer Season</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>


  <!-- Delete Medicine Modal -->
<div class="modal" id="deleteCategoryModal{{$season->id}}">										
   <div class="modal-dialog" style="max-width: 700px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">delete Season</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Delete medicine form -->
                    <form method="POST" action="/hiddenSeason/delete">
                    @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{$season->id}}">
                        <p>Are you sure you want to delete this Season "{{$season->titre}}"?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Season</button>
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