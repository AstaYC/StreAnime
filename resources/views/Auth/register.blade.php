@extends('layout.layout')
@section('content')
    {{$errorsString = ''}}
    @if($errors->any())
        {{ $errorsString = implode(' & ', $errors->all()); }}
    @endif

    <section class="normal-breadcrumb set-bg" style="background-position: center" data-setbg="{{ asset('img/dragonSlayer.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Register</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Register</h3>
                        <form action="/register" method="POST">
                           @csrf
                            <div class="input__item">
                                <input style="color: black" type="email" name="email" placeholder="Email address">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input style="color: black" type="text" name="name" placeholder="Your Name">
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input style="color: black" type="password" name="password" placeholder="Password">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input style="color: black" type="password" name="password_confirmation" placeholder=" Confirmation du Password">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Register Now</button>
                        </form>
                        <h5>Already have an account ? <a href="/login">Log In!</a></h5>
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
        </div>
    </section>
    <!-- Signup Section End -->

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

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/css/logo.css') }}">
@endsection('styles')