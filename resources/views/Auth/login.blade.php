@extends('layout.layout')
@section('content')

     {{$errorsString = ''}}
     @if($errors->any())
         {{ $errorsString = implode(' & ', $errors->all()); }}
     @endif
     
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" style="background-position: center" data-setbg="{{ asset('img/dragonSlayer.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Login</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row centerEarth" >
                <div class="col-lg-6">
                    <div class="login__form">
                        <div class="luffySayYoo">
                            <h3>Login</h3>
                            <img src="{{ asset('img/yo.png') }}" alt="">
                        </div>
                        <form method="POST"  action="/login">
                            @csrf
                            <div class="input__item">
                                <input style="color: black" type="email" name="email" placeholder="Email address">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input style="color: black" type="password" name="password" placeholder="Password">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Login Now</button>
                        </form>
                        <a href="#" class="forget_pass">Forgot Your Password?</a>
                    </div>
                </div>
                {{-- earth logo --}}
                <div class="col-lg-6">
                    <div class="section-banner">
                        <div id="star-1">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-2">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-3">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-4">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-5">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-6">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      
                        <div id="star-7">
                          <div class="curved-corner-star">
                            <div id="curved-corner-bottomright"></div>
                            <div id="curved-corner-bottomleft"></div>
                          </div>
                          <div class="curved-corner-star">
                            <div id="curved-corner-topright"></div>
                            <div id="curved-corner-topleft"></div>
                          </div>
                        </div>
                      </div>
                      
                </div>
                {{-- end earth logo --}}
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>or</span>
                            <ul>

                                <li>
                                    <a href="/register" class="google">
                                        Dont’t Have An Account?
                                        <a href="/register" class="primary-btn">Register Now</a>
                                     </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->
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
            var error = '{{ session("error") }}';
    
            if (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',  
                    text: error,
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

    @section('styles')
       <link rel="stylesheet" href="{{ asset('asset/css/logo.css') }}">
    @endsection('styles')
