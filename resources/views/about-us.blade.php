@extends('layouts.app')

@section('content')
    <main id="main">

        <div class="container-fluid">
            <div class="row section-t8 justify-content-md-center">

                @include('layouts.submenu')


                {{-- <div class="col-md-5 ">
                    <br>
                    <br>
                    <br>
                    <br>

                    <h1 class="mb-4">About Us</h1>

                    <p>...</p>

                </div> --}}

                <!-- ======= Intro Single ======= -->
                <section class="intro-single">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <div class="title-single-box">
                                    <h1 class="title-single">Great Properties for Buyers and Sellers</h1>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            About Us
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </section><!-- End Intro Single-->

                <!-- ======= About Section ======= -->
                <section class="section-about">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 position-relative">
                                <div class="about-img-box">
                                    <img style="border-radius: 35px" src="{{ asset('estate/assets/img/slide-about-1.jpg') }}" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="sinse-box" style="border-radius: 30px">
                                    <h3 class="sinse-title">LotLink
                                        <br> Since 2023
                                    </h3>
                                    <p>an E-Lot Buy, Lease and Sell</p>
                                </div>
                            </div>
                            <div class="col-md-12 section-t8 position-relative">
                                <div class="row">
                                    <div class="col-md-6 col-lg-5">
                                        <img src="/estate/lotlink.png" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="col-lg-2  d-none d-lg-block position-relative">
                                        <div class="title-vertical d-flex justify-content-start">
                                            {{-- <span>Affordable Property</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-5 section-md-t3">
                                        <div class="title-box-d">
                                            <h3 class="title-d">About
                                                <span class="color-b">LotLink</span>
                                            </h3>
                                        </div>
                                        <p class="color-text-a">
                                            Welcome to LotLink Official, where we specialize in turning dreams into reality
                                            through our premium lots.
                                            With an unwavering commitment to excellence and a passion for crafting
                                            exceptional living spaces,
                                            we take pride in offering a diverse range of thoughtfully curated lots for sale
                                            and lease.
                                            Whether you're envisioning a peaceful suburban retreat, an urban oasis,
                                            or a scenic countryside escape, we have the perfect lot to match your vision.
                                            Explore the possibilities with LotLink Official, where your dream lot awaits.


                                        </p>
                                        <p class="color-text-a">
                                            Driven by a passion for connecting people with their ideal lots, we specialize
                                            in both selling and renting prime land.
                                            Our dedication to excellence, integrity, and personalized service ensures that
                                            your journey, whether buying or leasing,
                                            is seamless and rewarding. Discover the perfect space for your dreams with
                                            LotLink Official.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- =======Team Section ======= -->
                {{-- <section class="section-agents section-t8">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title-wrap d-flex justify-content-between">
                                    <div class="title-box">
                                        <h2 class="title-a">Meet Our Team</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-box-d">
                                    <div class="card-img-d">
                                        <img src="{{ asset('estate/assets/img/agent-7.jpg') }}" alt=""
                                            class="img-d img-fluid">
                                    </div>
                                    <div class="card-overlay card-overlay-hover">
                                        <div class="card-header-d">
                                            <div class="card-title-d align-self-center">
                                                <h3 class="title-d">
                                                    <a href="agent-single.html" class="link-two">Margaret Sotillo
                                                        <br> Escala</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body-d">
                                            <p class="content-d color-text-a">
                                                Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                                            </p>
                                            <div class="info-agents color-a">
                                                <p>
                                                    <strong>Phone: </strong> +54 356 945234
                                                </p>
                                                <p>
                                                    <strong>Email: </strong> agents@example.com
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer-d">
                                            <div class="socials-footer d-flex justify-content-center">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-facebook" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-twitter" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-instagram" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box-d">
                                    <div class="card-img-d">
                                        <img src="{{ asset('estate/assets/img/agent-6.jpg') }}" alt=""
                                            class="img-d img-fluid">
                                    </div>
                                    <div class="card-overlay card-overlay-hover">
                                        <div class="card-header-d">
                                            <div class="card-title-d align-self-center">
                                                <h3 class="title-d">
                                                    <a href="agent-single.html" class="link-two">Stiven Spilver
                                                        <br> Darw</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body-d">
                                            <p class="content-d color-text-a">
                                                Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                                            </p>
                                            <div class="info-agents color-a">
                                                <p>
                                                    <strong>Phone: </strong> +54 356 945234
                                                </p>
                                                <p>
                                                    <strong>Email: </strong> agents@example.com
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer-d">
                                            <div class="socials-footer d-flex justify-content-center">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-facebook" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-twitter" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-instagram" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box-d">
                                    <div class="card-img-d">
                                        <img src="{{ asset('estate/assets/img/agent-5.jpg') }}" alt=""
                                            class="img-d img-fluid">
                                    </div>
                                    <div class="card-overlay card-overlay-hover">
                                        <div class="card-header-d">
                                            <div class="card-title-d align-self-center">
                                                <h3 class="title-d">
                                                    <a href="agent-single.html" class="link-two">Emma Toledo
                                                        <br> Cascada</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body-d">
                                            <p class="content-d color-text-a">
                                                Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                                            </p>
                                            <div class="info-agents color-a">
                                                <p>
                                                    <strong>Phone: </strong> +54 356 945234
                                                </p>
                                                <p>
                                                    <strong>Email: </strong> agents@example.com
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer-d">
                                            <div class="socials-footer d-flex justify-content-center">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-facebook" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-twitter" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-instagram" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-linkedin" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#" class="link-one">
                                                            <i class="bi bi-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!-- End About Section-->
            </div>
        </div>



    </main><!-- End #main -->
@endsection
