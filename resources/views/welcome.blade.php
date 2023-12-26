@extends('layouts.app')

@section('content')


    <main id="main">
        <div class="container-fluid section-t8">
            <div class="row justify-content-md-center">

                {{-- @include('layouts.submenu') --}}


            </div>
        </div>



    </main>
@endsection

@push('css')
    <style>
        @media only screen and (max-width: 600px) {
            .showcase.mt-5 {
                margin-top: 7rem !important;
            }
        }
    </style>
@endpush
