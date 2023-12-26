@extends('layouts.app')

@section('content')

    <main id="main">

        <div class="container-fluid">
            <div class="row  section-t8  justify-content-md-center">

                @include('layouts.submenu', ['withFeature' => false])

                <div class="col-md-12 showcase mt-5">
                    <div class="row custom-container pt-2">
                        @if (count($data) > 0)
                            <div class="col-md-12"><label>Search Results</label></div>
                            @foreach ($data as $item)
                                <div class="col-md-2">
                                    <section id="image-carousel-{{ $item->id }}" class="splide"
                                        aria-label="Beautiful Images">
                                        <div class="splide__track">
                                            <ul class="splide__list">
                                                @if (count($item->images) > 0)
                                                    @foreach ($item->images as $image)
                                                        <li class="splide__slide">
                                                            <a href="/lot/{{ $item->id }}">
                                                                <img src="{{ asset('storage') }}/{{ $image->image_path }}">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="splide__slide">
                                                        <a href="/lot/{{ $item->id }}">
                                                            <img
                                                                src="https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg">
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </section>
                                    <div class="pt-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="title">{{ $item->title }}</p>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <p> <label
                                                        class="text-{{ $item->sold_or_leased == 1 ? 'danger' : 'success' }}">
                                                        {{ $item->type == 'sale' ? 'Sale' : 'Lease' }}</label>
                                                    @if ($item->sold_or_leased == 1)
                                                        / <label class="text-danger">Sold</label>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <p>{{ $item->barangay }}, City Of Naga, Cebu</p>

                                        <p><i class="fa-solid fa-peso-sign"></i>
                                            {{ number_format($item->price, 2) }}
                                            @if ($item->type == 'lease')
                                                {{ $item->lease_freq }}
                                            @endif
                                        </p>
                                        <p>{{ $item->area }} m<sup>2</sup></p>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        new Splide("#image-carousel-{{ $item->id }}").mount();
                                    });
                                </script>
                            @endforeach
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <nav class="pagination-a">
                                            {{ $data->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 mt-2"><label>Sorry, no results found</label></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>



    </main><!-- End #main -->
@endsection
