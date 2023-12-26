@extends('layouts.app')

@section('content')
    <br><br>
    <br><br>
    <br><br>

    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-8 offset-md-2 mb-5">
                <div class="container1" id="container1">

                    <div class="form-container1 sign-in">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                </div>
                            @endif
                            <h1><strong>Admin Login</strong></h1>

                            <input class="validate-input" data-validate="Valid email is required: ex@abc.xyz" type="text"
                                name="email" id="email" for="email" placeholder="Email">

                            <div class="password-input">
                                <input class="validate-input" data-validate="Password is required" type="password"
                                    name="password" id="password" placeholder="Password">
                                <span class="toggle-password" data-toggle="#password">
                                    <i class="fa fa-fw fa-eye field-icon"></i>
                                </span>
                            </div>

                            <a href="/password/reset">Forget Your Password?</a>
                            <button name="btn_login" type="submit">Sign In</button>
                        </form>
                    </div>

                    <div class="toggle-container2">
                        <div class="toggle">

                            <div class="toggle-panel toggle-right">
                                <span><img src="/estate/lotlink.png" alt="lotlink.png" style="width: 250px;"></span>
                                <h1><strong style="color: #fff">Hello, Admin!</strong></h1>
                                <p style="color: #fff" id="quote">Loading quote...</p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('css')
    <link rel="stylesheet" href="{{ asset('estate/assets/css/login1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .toggle-container2 {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            /* transition: all 0.6s ease-in-out; */
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container1 {
            min-height: 600px;
        }
    </style>
@endpush

@push('js')

    <script>
        // Array of quotes
        const quotes = [
            "The only way to do great work is to love what you do. - Steve Jobs",
            "Believe you can and you're halfway there. - Theodore Roosevelt",
            "Strive not to be a success, but rather to be of value. - Albert Einstein",
            "The secret of getting ahead is getting started. - Mark Twain",
            "Hardships often prepare ordinary people for an extraordinary destiny. - C.S. Lewis",
            "In the middle of difficulty lies opportunity. - Albert Einstein",
            "Your time is limited, don't waste it living someone else's life. - Steve Jobs",
            "Every accomplishment starts with the decision to try. - John F. Kennedy"
            // Add more quotes as needed
        ];

        // Get a random quote
        const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];

        // Display the random quote in the paragraph
        document.getElementById("quote").innerText = randomQuote;
    </script>

    <script>
        //para sa show password
        document.addEventListener('DOMContentLoaded', function() {
            const passwordFields = document.querySelectorAll('.toggle-password');

            passwordFields.forEach(field => {
                field.addEventListener('click', () => {
                    const passwordInput = document.querySelector(field.getAttribute('data-toggle'));
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
