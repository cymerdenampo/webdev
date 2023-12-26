@extends('layouts.app')

@section('content')
    <br><br><br>
    <br>
    <br>


    <div class="card mt-2 ml-2" style="width: 18rem;">
        <form id="form">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" required value="{{ $wishlist->name }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Amount</label>
                <input type="text" name="amount" required value="{{ $wishlist->amount }}">
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
        </form>

    </div>

    <script></script>
@endsection


@push('js')
    <script>
        let id = '{{ $wishlist->id }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function sendPostRequest() {
            // URL where you want to send the POST request
            var apiUrl = '/wishlist/' + id;

            var formData = $('#form').serialize();

            // Send the POST request using jQuery
            $.ajax({
                type: 'PUT',
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
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
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
        });
    </script>
@endpush
