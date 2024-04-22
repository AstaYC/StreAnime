@extends('layout/layout')
@section('content')


    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Your Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
        <section class="chmla">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-sm-5">
                        <div class="card card-style1 border-0">
                            <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 mb-4 mb-lg-0 d-flex flex-column" style="align-items: center">
                                        <img class="picProfile" src="{{ session('picture') }}" alt="...">
                                        <div class="input-div">
                                            <form id="picForm" method="POST" action="/editPicProfil" enctype="multipart/form-data">
                                                @csrf
                                                <input id="fileChange" class="input" name="picture" type="file">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em  " height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon"><polyline points="16 16 12 12 8 16"></polyline><line y2="21" x2="12" y1="12" x1="12"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                                            </form>
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-6 px-xl-10">
                                        <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                            <h3 class="h2 text-white mb-0">Name : {{ $user->name }}</h3>
                                            <span class="text-primary">Role : {{ $user->role_name }}</span>
                                        </div>
                                        <ul class="list-unstyled mb-1-9">
                                            <form method="POST" action="/editUserProfil">
                                                @csrf
                                                <label  class="display-26 text-secondary me-2 font-weight-600">User Email: </label>
                                                <input  style="background-color: #0b0c2a" class="form-control" type="email" name="email" value="<?php echo $user->email ?>">

                                                <label  class="display-26 text-secondary me-2 font-weight-600">User Name: </label>
                                                <input  style="background-color: #0b0c2a" class="form-control" type="text" name="user" value="{{ $user->name }}">
                                                <br>
                                                <p id="changePassword" class="display-26 text-secondary me-2 font-weight-600 btn"><i class="fa fa-key"></i> Change Password !</p>
                                               
                                                <div id="displayDetail">
                                                    <label class="display-26 text-secondary me-2 font-weight-600">Old Password: </label><input style="background-color: #0b0c2a" class="form-control" name="oldPassword" type="password"></li>
                                                    <label class="display-26 text-secondary me-2 font-weight-600">New Password: </label><input style="background-color: #0b0c2a" class="form-control" name="newPassword" type="password"></li>
                                                </div>
                                                <button style="background-color: #0d1064; color:white; margin-top:20px" type="submit" class="btn btn-block">Save</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{$errorsString = ''}}
        @if($errors->any())
        {{ $errorsString = implode(' & ', $errors->all()); }}
        @endif
        

    <!-- Anime Section End -->
@endsection('content')
@section('styles')
<link rel="stylesheet" href="{{ asset('asset/css/userProfil.css') }}">
@endsection('styles')

@section('scripts')
    <script>
       let change = document.querySelector('#changePassword')
       let display = document.querySelector('#displayDetail')
       change.addEventListener('click' , () => {
           console.log('hana kanclicki')
           display.classList.toggle ("letGo");
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

<script>
    var fileChange = document.querySelector('#fileChange');
    var picForm = document.querySelector('#picForm');
    fileChange.addEventListener('change' , function(){
        picForm.submit();
    });
</script>
@endsection('scripts')