@extends('layouts.app')

@section('content')
    <main>
        <br><br>
        <br><br>
        <br><br>
        <section>

            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Welcome</div>

                            <div class="card-body">
                                You are logged in as {{ auth()->user()->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
