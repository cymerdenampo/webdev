@extends('layouts.app')

@section('content')
    <main>

        <section class="section-t8 mb-5">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 mb-5 mt-5">
                        <h4>Profile</h4>

                        <div class="card profile">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="row align-items-center ml-1">
                                        <div class="col-md-3">
                                            <img class="img-responsive avatar-view" width="100px"
                                                style="border-radius: 100px"
                                                src="{{ auth()->user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : 'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg' }}"
                                                alt="Avatar" title="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="name">
                                                <label for=""><strong>{{ auth()->user()->name }}</strong></label>
                                                <br>
                                                <label for=""><i class="fas fa-map-marker-alt"></i>
                                                    {{ auth()->user()->address }}</label>

                                                <label for="fileInput" class="info-profile btn btn-success">
                                                    <i class="fa-solid fa-camera"></i> Choose Profile
                                                </label>
                                                <input type="file" id="fileInput"
                                                    class="form-controlx upload__inputfile mt-2" accept="image/*"
                                                    name="image" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card personal">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                            role="tab" aria-controls="pills-home" aria-selected="true"><i
                                                class="fa-solid fa-address-card"></i> About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                            role="tab" aria-controls="pills-profile" aria-selected="false"><i
                                                class="fa-solid fa-lock"></i> Password</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-seller"
                                            role="tab" aria-controls="pills-profile" aria-selected="false"><i
                                                class="fa-solid fa-lock"></i> Seller Data</a>
                                    </li> --}}
                                </ul>

                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card personal">
                                <div class="card-body">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <div class="card-body">
                                                        <h5 class="card-title d-flex justify-content-between">
                                                            <span>Personal Details</span>
                                                            <a class="btn btn-success" id="editBtn" href="#"><i
                                                                    class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                        </h5>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                            <p class="col-sm-9" id="userName">{{ auth()->user()->name }}
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email
                                                            </p>
                                                            <p class="col-sm-9" id="userEmail">{{ auth()->user()->email }}
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile
                                                            </p>
                                                            <p class="col-sm-9" id="userPhone">{{ auth()->user()->phone }}
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                            <p class="col-sm-9 mb-0" id="userAddress">
                                                                {{ auth()->user()->address }},<br></p>
                                                        </div>
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div class="modal" id="edit_personal_details">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content"
                                                                {{ auth()->user()->roles->first()->name }}>
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Personal Details</h5>
                                                                </div>
                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <form id="form">
                                                                        <label for="inputFullname">Name</label>
                                                                        <input required type="text"
                                                                            class="form-control" name="name"
                                                                            value="{{ auth()->user()->name }}">
                                                                        <label for="phone">Mobile</label>
                                                                        <input required type="text"
                                                                            class="form-control" name="phone"
                                                                            value="{{ auth()->user()->phone }}">
                                                                        <label for="inputAdd">Address</label>
                                                                        <textarea required type="text" class="form-control" name="address">{{ auth()->user()->address }}</textarea>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success"
                                                                                id="saveChanges">Save Changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- Modal Footer -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-5">
                                                    <div class="card">
                                                        <div class="col card-body">
                                                            <h5 class="card-title d-flex justify-content-between">
                                                                <span>Plan Status</span>
                                                                <a class="edit-link" href="/pricing">

                                                                    @if (auth()->user()->plan == 'free')
                                                                        {{ ucfirst('') }}
                                                                        <button class="btn btn-success" type="button">
                                                                            <i class="fa-solid fa-circle-up"></i>
                                                                            Upgrade</button>
                                                                    @endif
                                                                    @if (auth()->user()->plan == 'standard')
                                                                        {{ ucfirst('') }}
                                                                        <button class="btn btn-success" type="button">
                                                                            <i class="fa-solid fa-circle-up"></i>
                                                                            Upgrade</button>
                                                                    @endif

                                                                </a>
                                                            </h5>

                                                            <div class="card-body text-success text-center">
                                                                <h5 class="card-title">

                                                                    @if (auth()->user()->plan == 'free')
                                                                        {{ ucfirst('Buyer') }}
                                                                    @endif

                                                                    @if (auth()->user()->plan == 'standard')
                                                                        {{ ucfirst('Standard Seller') }}
                                                                    @endif

                                                                    @if (auth()->user()->plan == 'premium')
                                                                        {{ ucfirst('Premium Seller') }}
                                                                    @endif
                                                                </h5>
                                                                <p class="card-text">Your current plan<br>
                                                                    @if (auth()->user()->plan !== 'free')
                                                                        Expires
                                                                        {{ \Carbon\Carbon::parse(auth()->user()->plan_until)->format('F j, Y g:i A') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title d-flex justify-content-between">
                                                                <span>Skills </span>
                                                                <a class="edit-link" href="#"><i
                                                                        class="far fa-edit me-1"></i>
                                                                    Edit</a>
                                                            </h5>
                                                            <div class="skill-tags">
                                                                <span>Html5</span>
                                                                <span>CSS3</span>
                                                                <span>WordPress</span>
                                                                <span>Javascript</span>
                                                                <span>Android</span>
                                                                <span>iOS</span>
                                                                <span>Angular</span>
                                                                <span>PHP</span>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab">
                                            <span class="nav-link"><strong>Change Password</strong></span>
                                            <form id="form-cp">
                                                <div class="form-group row">
                                                    <label for="current_password"
                                                        class="col-md-4 col-form-label text-md-left pl-5">Current
                                                        Password</label>

                                                    <div class="col-md-6">
                                                        <input id="current_password" type="password" class="form-control"
                                                            name="current_password" required
                                                            autocomplete="current-password">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="new_password"
                                                        class="col-md-4 col-form-label text-md-left pl-5">New
                                                        Password</label>

                                                    <div class="col-md-6">
                                                        <input id="new_password" type="password" class="form-control"
                                                            name="new_password" required autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="new_password_confirmation"
                                                        class="col-md-4 col-form-label text-md-left pl-5">Confirm New
                                                        Password</label>

                                                    <div class="col-md-6">
                                                        <input id="new_password_confirmation" type="password"
                                                            class="form-control" name="new_password_confirmation" required
                                                            autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success float-right">
                                                            Change Password
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="pills-seller" role="tabpanel">
                                            <span class="nav-link"><strong>Seller Data</strong></span>
                                            <div class="row">
                                                <div class="  col-md-3">
                                                    <div class="card">
                                                        @if ($sellerfile)
                                                            <img class="card-img-top img-responsive"
                                                                style="width: 100% !important;" id="img1"
                                                                src="/storage/{{ $sellerfile->purok }}">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">Upload Purok.</p>

                                                            <div class="form-group col-md-12">
                                                                <label for="fileInput1"
                                                                    class="info-profile btn btn-primary">
                                                                    <i class="fa-solid fa-file-shield"></i>Upload
                                                                </label>

                                                                <input type="file" id="fileInput1"
                                                                    class="form-controlx upload__inputfile mt-2"
                                                                    accept="image/*" name="image"
                                                                    style="display: none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="  col-md-3">
                                                    <div class="card">
                                                        @if ($sellerfile)
                                                            <img class="card-img-top img-responsive"
                                                                style="width: 100% !important;" id="img2"
                                                                src="/storage/{{ $sellerfile->brgy }}">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">Upload Brgy Clearance.</p>
                                                            <div class="form-group col-md-12">
                                                                <label for="fileInput2"
                                                                    class="info-profile btn btn-primary">
                                                                    <i class="fa-solid fa-file-shield"></i>Upload
                                                                </label>

                                                                <input type="file" id="fileInput2"
                                                                    class="form-controlx upload__inputfile mt-2"
                                                                    accept="image/*" name="image"
                                                                    style="display: none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="  col-md-3">
                                                    <div class="card">
                                                        @if ($sellerfile)
                                                            <img class="card-img-top img-responsive"
                                                                style="width: 100% !important;" id="img3"
                                                                src="/storage/{{ $sellerfile->police }}">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">Upload Police Clearance.</p>
                                                            <div class="form-group col-md-12">
                                                                <label for="fileInput3"
                                                                    class="info-profile btn btn-primary">
                                                                    <i class="fa-solid fa-file-shield"></i>Upload
                                                                </label>

                                                                <input type="file" id="fileInput3"
                                                                    class="form-controlx upload__inputfile mt-2"
                                                                    accept="image/*" name="image"
                                                                    style="display: none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="  col-md-3">
                                                    <div class="card">
                                                        @if ($sellerfile)
                                                            <img class="card-img-top img-responsive"
                                                                style="width: 100% !important;" id="img4"
                                                                src="/storage/{{ $sellerfile->nbi }}">
                                                        @endif
                                                        <div class="card-body">
                                                            <p class="card-text">Upload NBI Clearance.</p>
                                                            <div class="form-group col-md-12">
                                                                <label for="fileInput4"
                                                                    class="info-profile btn btn-primary">
                                                                    <i class="fa-solid fa-file-shield"></i>Upload
                                                                </label>

                                                                <input type="file" id="fileInput4"
                                                                    class="form-controlx upload__inputfile mt-2"
                                                                    accept="image/*" name="image"
                                                                    style="display: none;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- <div class="card personal mt-3">
                            <div class="card-body">
                                <table id="datatable" class="table table hover dt-responsive" width="100%">
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        

        </section>
    </main>
@endsection

@push('css')
    <style>
        .card {
            border-radius: 30px;
            /* border: none; */
        }

        .name {
            padding-left: 10%;
        }

        @media (max-width: 767px) {

            .col-md-4,
            .col-md-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .name label {
                display: block;
                margin-bottom: 5px;
            }
        }

        .profile,
        .personal {
            background: rgb(218, 218, 218);
            background: linear-gradient(90deg, rgba(218, 218, 218, 1) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #28a745;
            color: #fff;
        }

        .modal {
            padding-top: 10%;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black with transparency for blur effect */
            backdrop-filter: blur(5px);
            /* Blurry effect */
            z-index: 998;
        }

        .img-responsive {
            width: 100px !important;
            height: 100px !important;
        }

        #pills-seller .card {
            border-radius: 0%;
            margin-top: 5px;
        }

        #pills-seller .card label {
            width: 100%;
        }
    </style>
@endpush

@push('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editBtn').on('click', function() {
                $('#edit_personal_details').fadeIn(
                    'slow'); // Show the edit modal with a slow fade-in animation
                $('.modal-overlay').fadeIn('slow'); // Show the overlay with a slow fade-in animation
            });

            $('.btn-close, .modal-overlay, [data-bs-dismiss="modal"]').on('click', function() {
                $('#edit_personal_details').fadeOut(
                    'slow'); // Hide the modal with a slow fade-out animation
                $('.modal-overlay').fadeOut('slow'); // Hide the overlay with a slow fade-out animation
            });

            $('#editForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission (to handle it with your custom logic)

                var newName = $('#editName').val();
                var newPhone = $('#editPhone').val();
                var newAddress = $('#editAddress').val();

                // Handle form submission here with your custom logic
                // For example, you can send data via AJAX or perform any action you need
                // Update the displayed values with a slow fade-out and fade-in animation
                $('#userName').fadeOut('slow', function() {
                    $(this).text(newName).fadeIn('slow');
                });

                $('#userPhone').fadeOut('slow', function() {
                    $(this).text(newPhone).fadeIn('slow');
                });

                $('#userAddress').fadeOut('slow', function() {
                    $(this).text(newAddress).fadeIn('slow');
                });

                // Hide the modal with a slow fade-out animation
                $('#edit_personal_details').fadeOut('slow');
                $('.modal-overlay').fadeOut('slow'); // Also hide the overlay
            });
        });
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/settings-and-privacy",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        title: 'Id',
                        visible: false,
                    },
                    {
                        data: 'gcash_reference_code',
                        name: 'gcash_reference_code',
                        title: 'GCASH Ref Code'
                    },
                    {
                        data: 'plan',
                        name: 'plan',
                        title: 'Plan'
                    },
                    {
                        data: 'comments',
                        name: 'comments',
                        title: 'Comments'
                    }, {
                        data: 'status',
                        name: 'status',
                        title: 'Status',
                        render: function(data, type, row, meta) {
                            if (data == 'approved') {
                                return `<span class="badge badge-primary">${data}</span>`
                            } else {
                                return `<span class="badge badge-danger">${data}</span>`
                            }

                        }
                    },
                    {
                        data: 'from',
                        name: 'from',
                        title: 'From'
                    },
                    {
                        data: 'to',
                        name: 'to',
                        title: 'Until'
                    },
                ],
                order: [
                    [0, 'desc']
                ],

            })

            $('.tooltip').tooltip('show')

        })

        $(document).ready(function() {
            // Event listener for file input change
            $('#fileInput').on('change', function() {
                if (this.files && this.files[0]) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successs!',
                        text: 'Profile Changed Successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });

            // Your existing form submission code
            $(document).on('submit', '#form', function(e) {
                e.preventDefault();
                // ... Rest of your code for form submission and Swal.fire on success/error
            });
        });


        $(document).on('submit', '#form', function(e) {
            e.preventDefault()
            $('#form').find('span.error').remove()
            $('#form').find('button[type="submit"]').attr("disabled", true).prepend(
                `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon

            $.ajax({
                data: $('#form').serialize() + `&action=info`,
                url: "/settings-and-privacy",
                type: "POST",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Updated Successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button

                },
                error: function(response) {
                    console.warn('Error:', response)
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').after(
                            '<span class="error text-danger">' + error + '</span>')
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button
                }
            })
        })


        $(document).on('submit', '#form-cp', function(e) {
            e.preventDefault()
            $('#form-cp').find('span.error').remove()
            $('#form-cp').find('button[type="submit"]').attr("disabled", true).prepend(
                `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon

            $.ajax({
                data: $('#form-cp').serialize() + `&action=cp`,
                url: "/settings-and-privacy",
                type: "POST",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Password Changed Successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button

                },
                error: function(response) {
                    console.warn('Error:', response)
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $(document).find('[name=' + field_name + ']').after(
                            '<span class="error text-danger">' + error + '</span>')
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button
                }
            })
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            ImgUpload();

            function ImgUpload() {
                var imgArray = [];

                $('#fileInput').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    // Clear existing images


                    imgArray.push(file);

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Use event.target.result instead of reader.result
                        $(`.img-responsive.avatar-view`).attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('action', 'profile_pic_update');

                    $.ajax({
                        data: formData,
                        url: "/settings-and-privacy",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(response) {
                            console.warn('Error:', response)
                        }
                    })

                });

                $('#fileInput1').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    // Clear existing images



                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Use event.target.result instead of reader.result
                        $(`#img1`).attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('action', 'purok');

                    $.ajax({
                        data: formData,
                        url: "/settings-and-privacy",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(response) {
                            console.warn('Error:', response)
                        }
                    })

                });


                $('#fileInput2').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    // Clear existing images



                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Use event.target.result instead of reader.result
                        $(`#img2`).attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);

                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('action', 'brgy');

                    $.ajax({
                        data: formData,
                        url: "/settings-and-privacy",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(response) {
                            console.warn('Error:', response)
                        }
                    })

                });


                $('#fileInput3').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    // Clear existing images



                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Use event.target.result instead of reader.result
                        $(`#img3`).attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);


                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('action', 'police');

                    $.ajax({
                        data: formData,
                        url: "/settings-and-privacy",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(response) {
                            console.warn('Error:', response)
                        }
                    })

                });

                $('#fileInput4').on('change', function(e) {

                    var file = e.target.files[0];

                    if (!file || !file.type.match('image.*')) {
                        return;
                    }

                    // Clear existing images



                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Use event.target.result instead of reader.result
                        $(`#img4`).attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);


                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('action', 'nbi');

                    $.ajax({
                        data: formData,
                        url: "/settings-and-privacy",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                        },
                        error: function(response) {
                            console.warn('Error:', response)
                        }
                    })

                });
            }

        })
    </script>
@endpush

@push('css')
    <style>
        .img-responsive {
            height: 150px !important;
            width: 150px !important;
            object-fit: cover;
        }
    </style>
@endpush
