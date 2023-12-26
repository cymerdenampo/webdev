<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>Contact System</title>
    {{-- <link href="{{ asset('estate/assets/img/logo.png') }}" rel="icon"> --}}
    <link href="{{ asset('estate/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="{{ asset('estate/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('estate/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('estate/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('estate/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('estate/assets/css/style1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <link
        href="https://cdn.datatables.net/v/bs4/dt-1.13.5/b-2.4.1/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css"
        rel="stylesheet">

    <script
        src="https://cdn.datatables.net/v/bs4/dt-1.13.5/b-2.4.1/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.0/rr-1.4.1/sc-2.2.0/sb-1.5.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <!-- Include LightGallery styles and scripts from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">




    <style>
        .flex-icons {
            display: flex;
            flex-direction: column;
            align-content: flex-start;
            justify-content: space-between;
            align-items: center;
            color: rgb(119, 119, 119);
            text-decoration: none;
        }

        .flex-icons:hover,
        .flex-icons.active,
        .flex-icons.visited {
            text-decoration: none;
            color: rgb(0, 0, 0) !important;
        }


        .flex-icons label {
            font-size: 13px;
            margin-top: 5px;
        }

        .custom-container {
            padding: 0 40px 0 40px;
        }

        .splide__slide {
            width: 300px;
            /* Set your desired width */
            height: 300px;
            /* Set your desired height */
            overflow: hidden;
            /* Ensure the overflow is hidden to contain the rounded corners */
            border-radius: 30px;
            /* Set the border radius */
        }

        .splide__slide img {
            width: 100%;
            /* Make the image fill the container */
            height: 100%;
            /* Make the image fill the container */
            object-fit: cover;
        }

        .showcase p {
            margin: 1px;
            font-size: 14px;
        }

        .showcase p.title {
            font-weight: 600;
            color: black;
        }

        .sticky {
            position: fixed;
            top: 90px;
            width: 100%
        }

        .header {
            padding: 30px 16px 0 16px;
            background: #ffffff00;
            z-index: 2;
            border-top: 0.1px solid #7777771a;
        }

        .sticky-border {
            box-shadow: 0 2px 5px rgb(221 221 221 / 75%);
            background: #ffffff;
        }

        .dropdown-menu {
            max-width: 175px;
        }

        div[aria-labelledby="unreadMessagesDropdown"].dropdown-menu {
            max-width: 600px;
        }

        div[aria-labelledby="unreadMessagesDropdown"] a {
            white-space: break-spaces !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('css')

    <style>
        body {
            font-family: "Poppins", sans-serif;
            color: #555555;
            background-color: #fff;
            background-image: url("https://www.transparenttextures.com/patterns/asfalt-dark.png");
        }

        .justify-content-centerx {
            justify-content: flex-end;
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T86B0KKW39"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-T86B0KKW39');
    </script>
</head>

<body>

    <!-- ======= Property Search Section ======= -->
    <div class="click-closed"></div>
    <!--/ Form Search Star /-->
    <div class="box-collapse">
        {{-- <div class="title-box-d">
            <h3 class="title-d">Search </h3>
        </div> --}}
        <span class="close-box-collapse right-boxed bi bi-x"></span>
        <div class="box-collapse-wrap form">
            <form class="form-a search">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label class="pb-2">Keyword</label>
                            <input type="text" class="form-control form-control-lg form-control-a"
                                placeholder="Keyword" name="keyword" id="s_keyword">
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Status</label>
                            <select class="form-control form-select form-control-a" name="type" id="s_status">
                                <option value="">Available</option>
                                <option value="sold">Sold</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Type</label>
                            <select class="form-control form-select form-control-a" name="type" id="s_type">
                                <option value="">All Type</option>
                                <option value="lease">For Lease</option>
                                <option value="sale">For Sale</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-group mt-3">
                            <label class="pb-2">Barangay</label>
                            <select class="form-control form-select form-control-a" name="barangay" id="s_barangay">
                                <option value="">All Barangays</option>
                                <option value="Alpaco">Alpaco</option>
                                <option value="Bairan">Bairan</option>
                                <option value="Balirong">Balirong</option>
                                <option value="Cabungahan">Cabungahan</option>
                                <option value="Cantao-an">Cantao-an</option>
                                <option value="Central Poblacion">Central Poblacion</option>
                                <option value="Cogon">Cogon</option>
                                <option value="Colon">Colon</option>
                                <option value="East Poblacion">East Poblacion</option>
                                <option value="Inayagan">Inayagan</option>
                                <option value="Inoburan">Inoburan</option>
                                <option value="Jaguimit">Jaguimit</option>
                                <option value="Lanas">Lanas</option>
                                <option value="Langtad">Langtad</option>
                                <option value="Lutac">Lutac</option>
                                <option value="Mainit">Mainit</option>
                                <option value="Mayana">Mayana</option>
                                <option value="Naalad">Naalad</option>
                                <option value="North Poblacion">North Poblacion</option>
                                <option value="Pangdan">Pangdan</option>
                                <option value="Patag">Patag</option>
                                <option value="South Poblacion">South Poblacion</option>
                                <option value="Tagjaguimit">Tagjaguimit</option>
                                <option value="Tangke">Tangke</option>
                                <option value="Tinaan">Tinaan</option>
                                <option value="Tuyan">Tuyan</option>
                                <option value="Uling">Uling</option>
                                <option value="West Poblacion">West Poblacion</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 mt-3 text-right">
                        <button type="submit" class="btn btn-b">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- End Property Search Section -->

    <!-- ======= Header/Navbar ======= -->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top " data-sticky-container>
        <div class="container-fluid custom-container">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand text-brand" href="/">
                <img class="mb-3" src="" alt="" style="width: auto; max-height: 60px;">Contact
                System<span class="color-b">
            </a>

            <div class="navbar-collapse collapse justify-content-centerx" id="navbarNavDropdown">
                <ul class="navbar-nav">

                    @guest

                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="/about-us">About
                                Us</a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login/user') ? 'active' : '' }}"
                                href="{{ route('user.login') }}">Login</a>
                        </li>
                    @endauth

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                                <i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('index') ? 'active' : '' }}" href="index">
                                <i class="fa-solid fa-address-book"></i> Contact</a>
                        </li>

                        @role('user')
                            {{-- @if (auth()->user()->plan == 'free')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('my-listings') ? 'active' : '' }}" href="/my-listings"><i class="fa-solid fa-briefcase"></i> Want to be a seller?</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('my-listings') ? 'active' : '' }}" href="/my-listings"><i class="fa-solid fa-briefcase"></i> My Listings</a>
                            </li>
                            @endif --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="unreadMessagesDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-envelope"></i> Notifications
                                    <span class="badge badge-danger" style="vertical-align: middle; display:none; ">0</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="unreadMessagesDropdown">
                                </div>
                            </li> --}}
                        @endrole

                        @role('admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user-list') ? 'active' : '' }}" href="/user-list"><i
                                        class="fa-solid fa-users"></i> Users</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link {{ request()->is('feature-payments') ? 'active' : '' }}"
                                    href="/feature-payments">Feature Payments</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('payments') ? 'active' : '' }}" href="/payments"><i
                                        class="fa-solid fa-credit-card"></i> Payments</a>
                            </li>
                        @endrole



                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('my-account') ? 'active' : '' }}" href="/my-account">
                                <i class="fa-regular fa-user"></i> My Account</a>
                        </li> --}}


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="x" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-user"></i> My Account
                                <span class="badge badge-danger" style="vertical-align: middle; display:none; ">0</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="x">
                                <a href="/settings-and-privacy" class="dropdown-item">Settings & Privacy</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    class="dropdown-item">Logout</a>
                            </div>
                        </li>



                        {{-- <li class="nav-item">
                            <a class="nav-link " href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </li> --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth

                </ul>
            </div>

            {{-- <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse"
                data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
                <i class="bi bi-search"></i>
            </button> --}}

    </nav><!-- End Header/Navbar -->


    @yield('content')
    {{-- @include('layouts.footer') --}}

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- <script src="{{ asset('estate/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('estate/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('estate/assets/js/main.js') }}"></script>

    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-firestore-compat.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

    @auth
        <script>
            let myuid = "{{ auth()->user()->id }}";
            let myfname = "{{ auth()->user()->name }}";
            let environment = "{{ env('APP_URL') }}";
            environment = environment.replace(/[^a-zA-Z ]/g, "")
            var chatsCollection = undefined
            $(document).ready(function() {
                // Initialize Firebase
                var firebaseConfig = {
                    apiKey: "AIzaSyAw-1xiVzeXAPnDnVmTbiSdOotNihAuI3Q",
                    authDomain: "lotlink-c4184.firebaseapp.com",
                    projectId: "lotlink-c4184",
                    storageBucket: "lotlink-c4184.appspot.com",
                    messagingSenderId: "1004530901404",
                    appId: "1:1004530901404:web:9db4353eaaf4fb163aa859"
                };

                firebase.initializeApp(firebaseConfig);
                // Firestore references
                const firestore = firebase.firestore();
                chatsCollection = firestore.collection(`chats-${environment}`);

                let total_notifications = 0;

                async function displayMessageCountWhereSellerIsMe() {
                    let sellerId = `seller${myuid}`;
                    await chatsCollection.where(`participants.${sellerId}`, '==', true)
                        .get()
                        .then((querySnapshot) => {


                            querySnapshot.forEach((doc) => {
                                console.log(doc.data())
                                const participants = Object.keys(doc.data().participants);

                                const buyerId = participants.find((participant) => participant !==
                                    sellerId);

                                const name_b = doc.data().buyer.buyerName

                                const unreadBuyerCount = doc.data().unread.buyer;
                                const unreadSellerCount = doc.data().unread.seller;
                                console.log(unreadSellerCount)

                                if (unreadSellerCount > 0) {
                                    total_notifications++;

                                    $(`div[aria-labelledby="unreadMessagesDropdown"]`).append(
                                        `<a class="dropdown-item" href="/lot/${doc.data().lot_id}">You received message for lot id ${doc.data().lot_id} from ${doc.data().buyer.buyerName}</a>`
                                    )
                                }

                            });


                        }, (error) => {
                            console.error("Error fetching buyer list: ", error);
                        });


                    displayMessageCountWhereBuyerIsMe()


                }

                displayMessageCountWhereSellerIsMe()

                async function displayMessageCountWhereBuyerIsMe() {
                    let buyerid = `buyer${myuid}`;
                    await chatsCollection.where(`participants.${buyerid}`, '==', true)
                        .get()
                        .then((querySnapshot) => {

                            querySnapshot.forEach((doc) => {
                                console.log(doc.data())
                                const unreadBuyerCount = doc.data().unread.buyer;
                                console.log(unreadBuyerCount)

                                if (unreadBuyerCount > 0) {
                                    total_notifications++;

                                    $(`div[aria-labelledby="unreadMessagesDropdown"]`).append(
                                        `<a class="dropdown-item" href="/lot/${doc.data().lot_id}">You received message for lot id ${doc.data().lot_id} from the lot owner</a>`
                                    )
                                }

                            });


                        }, (error) => {
                            console.error("Error fetching buyer list: ", error);
                        });


                    if (total_notifications > 0) {
                        $(`#unreadMessagesDropdown span`).text(total_notifications)
                        $(`#unreadMessagesDropdown span`).show()
                    } else {
                        $(`#unreadMessagesDropdown span`).hide()
                        $(`div[aria-labelledby="unreadMessagesDropdown"]`).append(
                            `<p class="pl-2">All clear here!</p>`
                        )
                    }


                }




            })
        </script>
    @endauth

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"
        integrity="sha512-xgIrH5DRuEOcZK5cPtVXx/WSp5DTir2JNcKE5ahV2u51NCTD9UDxbQgZHYHVBlPc4H8tug6BZTYIl2RdA/X0Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js"></script>

    <script>
        window.onscroll = function() {
            try {
                myFunction()
            } catch (error) {

            }

        };

        var header = document.getElementById("myHeader");

        function myFunction() {
            if (window.pageYOffset > 0) {
                header.classList.add("sticky-border");
            } else {
                header.classList.remove("sticky-border");
            }
        }

        $(document).on('submit', 'form.search', function(e) {
            e.preventDefault()
            let barangay = $(`#s_barangay`).val();
            let keyword = $(`#s_keyword`).val();
            let type = $(`#s_type`).val();
            let status = $(`#s_status`).val();
            window.location.href = `/search?keyword=${keyword}&barangay=${barangay}&type=${type}&status=${status}`
        })
    </script>

    @stack('js')


</body>

</html>
