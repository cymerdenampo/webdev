@extends('layouts.app')

@section('content')
    <main id="main pt-5">
        <br><br>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- <div class="col-md-6 text-center mb-5"> -->
                    <div class="col-md-6 text-center">
                        <a href="/homepage">
                            <h2 class="heading-section">LOTLINK</h2>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Create an Account</h3>
                            <form id="form" action="#" class="signin-form" method="POST">

                                <!-- <label for="">Email</label> -->
                                <div class="form-group">
                                    <input id="inputEmail" for="inputEmail" type="email" name="email"
                                        class="form-control" placeholder="Email" required>
                                </div>

                                <!-- <label for="">Password</label> -->
                                <div class="form-group">
                                    <input autocomplete="new-password" for="inputPassword" id="inputPassword" name="password" type="password"
                                        class="form-control" placeholder="Password" required>
                                    <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <!-- <label for="">Confirm Password</label> -->
                                <div class="form-group">
                                    <input for="inputPasswordConfirm" id="inputPasswordConfirm" name="password_confirmation"
                                        type="password" class="form-control" placeholder="Confirm Password" required>
                                    <span toggle="#inputPasswordConfirm"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                                <script>
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
                                </script>


                                <!-- <label for="">Full Name</label> -->
                                <div class="form-group">
                                    <input type="text" id="inputFullname" name="name" for="inputFullname"
                                        class="form-control" placeholder="Full Name" required>
                                </div>

                                <!-- <label for="">Address</label> -->
                                <div class="form-group">
                                    <input type="text" for="inputAdd" id="inputAdd" name="address" for="inputAdd"
                                        class="form-control" placeholder="Address" required>
                                </div>

                                <!-- <label for="">Birthdate</label> -->
                                {{-- <div class="form-group">
                                    <input type="text" name="birthdate" class="form-control" placeholder="Birth Date"
                                        required>
                                </div> --}}

                                <!-- <label for="">Contact Number</label> -->
                                <div class="form-group">
                                    <input for="phone" type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" id="phone"
                                        name="phone" class="form-control" placeholder="Contact Number" required>
                                </div>

                                <!-- <label for="">Valid Id</label> -->
                                <div class="form-group">
                                    <label for="img">Upload Valid ID</label>
                                    <input type="file" class="form-control upload__inputfile" accept="image/*"
                                        name="image" required>
                                </div>

                                {{-- <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div> --}}

                                <div class="form-group">
                                    <button name="btn_register" type="submit"
                                        class="form-control btn btn-primary submit px-3">Create Account</button>
                                </div>

                                <div class="form-group">
                                    <button onclick="goToIndex()"
                                        class="form-control btn btn-primary submit px-3">Login</button>
                                    <script>
                                        function goToIndex() {
                                            window.location.href = "{{ route('user.login') }}";
                                        }
                                    </script>
                                </div>

                                <div class="form-group d-md-flex">
                                    <div class="w-100 text-md-center"><a href="/password/reset" style="color: #fff">Forgot
                                            Password</a></div>
                                    <!-- <div class="w-50 text-md-right"><a href="#" style="color: #fff">Forgot Password</a></div> -->
                                </div>

                            </form>
                            <p class="w-100 text-center">&mdash; Or Create With &mdash;</p>
                            <div class="social d-flex text-center">
                                <a href="/auth/facebook" class="btn btn-primary facebook"> <i class="fa fa-facebook"></i>
                                    <span>Facebook</span> </a>
                                <a href="/auth/google" class="btn btn-danger google-plus"> <i class="fa fa-google-plus"></i>
                                    Gmail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


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

@push('css')
    <link rel="stylesheet" href="{{ asset('estate/assets/css/login.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url(/estate/bg.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
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
@endpush
