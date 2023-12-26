@extends('layouts.app')

@section('content')
    <main id="main pt-5">
        <br><br>
        <br><br>
        <br><br>


        <div class="container justify-content-center">
            <div class="row">
                <div class="col-md-8 offset-md-2 mb-5">
                    <div class="container1" id="container1">
                        <div class="form-container1 sign-up">
                            <form id="form" action="#" class="signin-form" method="POST">
                                <h1><strong>Create Account</strong></h1>
                              

                                <!-- <label for="">Full Name</label> -->
                                <input type="text" id="inputFullname" name="name" for="inputFullname"
                                    placeholder="Full Name" required>

                                <!-- <label for="">Email</label> -->
                                <input type="email" name="email" placeholder="Email" required>

                                <div class="password-input">
                                    <!-- Password Input Field -->
                                    <div class="password-input">
                                        <input autocomplete="new-password" id="inputPassword" name="password"
                                            type="password" placeholder="Password" required>
                                        <span class="toggle-password" toggle="#inputPassword">
                                            <i class="fa fa-fw fa-eye field-icon"></i>
                                        </span>
                                    </div>

                                    <!-- Confirm Password Input Field -->
                                    <div class="password-input">
                                        <input id="inputPasswordConfirm" name="password_confirmation" type="password"
                                            placeholder="Confirm Password" required>
                                        <span class="toggle-password" toggle="#inputPasswordConfirm">
                                            <i class="fa fa-fw fa-eye field-icon"></i>
                                        </span>
                                    </div>
                                </div>
                        
                                <span>Thankyou for registering</span>
                                <button name="btn_register" type="submit">Sign Up</button>
                            </form>
                        </div>




                        <div class="form-container1 sign-in">
                            <form action="{{ route('user.login') }}" class="signin-form" method="POST">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error!</strong> {{ session('error') }}
                                    </div>
                                @endif
                                @csrf
                                <h1><strong>Sign In</strong></h1>
                                
                 
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="password-input">
                                    <input id="password-field" name="password" type="password" class="form-control"
                                        placeholder="Password" required>
                                    <span class="toggle-password" toggle="#password-field">
                                        <i class="fa fa-fw fa-eye field-icon"></i>
                                    </span>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="checkbox-wrap ms-5"
                                    style="width: 100%; transform: scale(0.8);margin-left: -2vh;">
                                    <div>
                                        <label for="inputRememberPassword" class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" name="remember_me">
                                            <span class="checkmark"></span>
                                        </label> Remember Me
                                    </div>
                                </div>

                                <a href="/password/reset">Forget Your Password?</a>
                                <button name="btn_login" type="submit">Sign In</button>
                            </form>
                        </div>

                        <div class="toggle-container1">
                            <div class="toggle">
                                <div class="toggle-panel toggle-left">
                                    {{-- <span><img src="/estate/lotlink.png" alt="lotlink.png" style="width: 250px;"></span> --}}
                                    <h1><strong style="color: #fff">Welcome Back!</strong></h1>
                                    <p>Enter your personal details to see all Contacts</p>
                                    <button class="hidden" id="login">Sign In</button>
                                </div>
                                <div class="toggle-panel toggle-right">
                                    {{-- <span><img src="/estate/lotlink.png" alt="lotlink.png" style="width: 250px;"></span> --}}
                                    <h1><strong style="color: #fff">Hello, Friend!</strong></h1>
                                    <p>Register with your personal details to see all Contacts</p>
                                    <button class="hidden" id="register">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>


    </main>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('estate/assets/css/login1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@push('js')
    <script src="{{ asset('estate/assets/js/login.js') }}"></script>
@endpush


{{-- Submit Function/Create Account --}}

@push('js')
    <script>
        let loading = false

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $("#form").on('submit', async function(e) {
            e.preventDefault()
            if (loading == true) {
                return false //do not proceed prevent multiple request
            }
            loading = true
            Swal.fire({
                title: 'Processing',
                text: 'Please wait...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: false,
                showConfirmButton: false
            })
            var serializedData = $(this).serialize();

            var serializedFormData = new FormData();
            $.each(serializedData.split('&'), function() {
                var pair = this.split('=');
                serializedFormData.append(pair[0], unescape(pair[1]));

            });
            serializedFormData.append('image', global_file);

            $.ajax({
                data: serializedFormData,
                url: "/register/user",
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    loading = false
                    Swal.close()
                    $("#form")[0].reset()
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Registration successful',
                    }).then((result) => {
                        window.location = `${window.location.origin}/login/user`
                    });
                },
                error: function(response) {
                    console.log(response)
                    loading = false
                    Swal.close()
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        if ($(document).find('#form [name=' + field_name + ']')
                            .next().is('span')) {
                            $(document).find('#form [name=' + field_name + ']')
                                .next('span').remove()
                        }
                        $(document).find('#form [name=' + field_name + ']').after(
                            '<span class="error text-danger">' + error + '</span>')

                    })
                }
            })
        })
    </script>
@endpush

@push('js')
    <script>
        var global_file = undefined;
        $(document).ready(function() {
            ImgUpload();

            function ImgUpload() {
                var imgArray = [];

                $('.upload__inputfile').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    imgArray.push(file);

                    // const formData = new FormData();
                    // formData.append('image', file);
                    global_file = file
                    console.log(global_file)

                });
            }

        })
    </script>

    <script>
        $(document).ready(function() {
            const passwordFields = document.querySelectorAll('.toggle-password');


            passwordFields.forEach(field => {
                field.addEventListener('click', () => {

                    const passwordInput = document.querySelector(field.getAttribute('toggle'));
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                    } else {
                        passwordInput.type = 'password';
                    }
                });
            });


        });
    </script>
@endpush
