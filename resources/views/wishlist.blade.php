@extends('layouts.app')

@section('content')
    {{-- <main>
        <br><br>
        <section>
            <div class="container-fluid">
                <div class="row p-5">
                    <div class="col-12">
                        <!--datatable below-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-warning">
                                        <h4 class="card-title">My Listings</h4>
                                        <p class="card-category"></p>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12 text-right p-3">
                                            <button type="button" class="btn btn-primary" id="create-new-entry">
                                                New Wish
                                            </button>
                                        </div>
                                        <div class="data-table">
                                            <table id="datatable" class="table table hover dt-responsive" width="100%">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main> --}}
    <br><br><br>
    <br>
    <br>
    <div class="row" id="cy-container">


        @foreach ($wishlists as $wishlist)
            <div class="col-md-4" id="card-{{ $wishlist->id }}">
                <div class="card mt-2 ml-2">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $wishlist->name }}</h5>
                        <p class="card-text">{{ $wishlist->amount }}</p>
                        <a href="/wishlist/{{ $wishlist->id }}" class="btn btn-primary">Update</a>
                        <button data-id="{{ $wishlist->id }}" class="btn btn-danger delete">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card mt-2 ml-2" style="width: 18rem;">
        <form id="form">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Amount</label>
                <input type="text" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
        </form>

    </div>

    <script></script>
@endsection


@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function sendPostRequest() {
            // URL where you want to send the POST request
            var apiUrl = 'wishlist';

            var formData = $('#form').serialize();

            // Send the POST request using jQuery
            $.ajax({
                type: 'POST',
                url: apiUrl,
                data: formData,
                success: function(data) {
                    // Handle the success response
                    console.log('POST request successful:', data);
                    Swal.fire({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success"
                    }).then((result) => {
                        // Check if the user clicked "OK"
                        // if (result.isConfirmed) {
                        //     // Reload the page
                        //     location.reload();
                        // }
                        console.log(data)
                        $(`#cy-container`).append(`
                        <div class="col-md-4" id="card-${data.data.id}">
                            <div class="card mt-2 ml-2">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">${data.data.name}</h5>
                                    <p class="card-text">${data.data.amount}</p>
                          
                                    <a href="/wishlist/${data.data.id}" class="btn btn-primary">Update</a>
                        <button data-id="${data.data.id}" class="btn btn-danger delete">Delete</button>

                                </div>
                            </div>
                        </div>
                        `)
                    });
                },
                error: function(error) {
                    // Handle the error response
                    console.error('Error sending POST request:', error);
                }
            });
        }

        // Call the function when the document is ready
        $(document).ready(function() {

            $('#form').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                sendPostRequest();
            });


            $(document).on('click', '.delete', function(e) {
                let id = $(this).data('id')

                $.ajax({
                    type: 'DELETE',
                    url: `/wishlist/${id}`,
                    success: function(data) {
                        // Handle the success response
                        console.log('POST request successful:', data);
                        Swal.fire({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success"
                        }).then((result) => {
                            $(`#card-${id}`).remove()
                        });
                    },
                    error: function(error) {
                        // Handle the error response
                        console.error('Error sending POST request:', error);
                    }
                });
            });
        });
    </script>
@endpush
