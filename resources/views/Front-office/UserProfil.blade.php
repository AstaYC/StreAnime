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
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="...">
                                    </div>
                                    <div class="col-lg-6 px-xl-10">
                                        <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                            <h3 class="h2 text-white mb-0">Name : {{ $user->name }}</h3>
                                            <span class="text-primary">{{ $user->role_name }}</span>
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
@endsection('scripts')