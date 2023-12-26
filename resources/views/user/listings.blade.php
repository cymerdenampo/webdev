@extends('layouts.app')

@section('content')
    <main>

        <section class="section-t8">
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
                                                New Listing
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
    </main>

    <!-- Start Edit/Add Modal -->
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <!--      Wizard container        -->
                    <div class="wizard-container">

                        <div class="card wizard-card" data-color="orange" id="wizardProfile">
                            <form id="form-modal">
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#one" data-toggle="tab">Step 1</a></li>
                                        <li><a href="#two" data-toggle="tab">Step 2</a></li>
                                        <li><a href="#three" data-toggle="tab">Step 3</a></li>
                                    </ul>

                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="one">
                                        {{-- <h4 class="info-text">Provide lot information </h4> --}}
                                        <div class="row">
                                            <input type="hidden" name="id" value="">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><small style="color: red">*</small>Title / Lot Name</label>
                                                    <input name="title" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label><small style="color: red">*</small>Area (m<sup>2</sup>)</label>
                                                    <input name="area" type="number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label><small style="color: red">*</small>Type</label>
                                                    <select name="type" class="form-control">
                                                        <option value=""></option>
                                                        <option value="lease">Lease</option>
                                                        <option value="sale">Sale</option>
                                                    </select>
                                                </div>
                                                <div class="form-group lease_freq">
                                                    <label><small style="color: red">*</small>Lease Frequency</label>
                                                    <select name="lease_freq" class="form-control">
                                                        <option value="monthly">Monthly</option>
                                                        <option value="annually">Annually</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label><small style="color: red">*</small><label
                                                            class="price-label">Price</label></label>
                                                    <input name="price" type="number" class="form-control">
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><small style="color: red">*</small>Description</label>
                                                    <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="two">
                                        {{-- <h4 class="info-text">Provide lot information </h4> --}}
                                        <div class="row">
                                            ...
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="three">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn">
                                                            <p>Upload images</p>
                                                            <input type="file" multiple accept="image/*"
                                                                data-max_length="20" name="images[]"
                                                                class="upload__inputfile">
                                                        </label>
                                                    </div>
                                                    <div class="upload__img-wrap"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Youtube video Link</label>
                                                    <input name="video_link" type="text" class="form-control"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="wizard-footer height-wizard">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm'
                                            name='next' value='Next' />
                                        <button type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm'
                                            name='finish'> FInish </button>

                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm'
                                            name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </form>
                        </div>
                    </div> <!-- wizard container -->

                </div>
            </div>
        </div>
    </div>
    <!-- End Edit/Add Modal -->

    <!-- Start feature Modal -->
    <div class="modal fade" id="modal-feature" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Feature Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">


                            <form id="form-modal-feature">
                                <input type="hidden" name="id">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="alert alert-primary" role="alert">
                                            For one month feature, send 100 to the GCASH number 0912-1232-123 and provide
                                            the
                                            reference code.
                                        </div>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>GCASH Reference Code</label>
                                        <input type="number" name="gcash_reference_code" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>GCASH Sender Number</label>
                                        <input type="tel" placeholder="0XXXXXXXXXX"
                                            pattern="[0-9]{4}[0-9]{3}[0-9]{4}" name="sender_gcash_number"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2 pt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Submit Payment
                                            Details</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="feature-table" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Payment #</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">GCASH Reference Code</th>
                                            <th scope="col">Sender Number</th>
                                            <th scope="col">Comments</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature Modal -->
@endsection


@push('css')
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('bootstrap-wizard-master/assets/css/gsdk-bootstrap-wizard.css') }}" rel="stylesheet" />
    <link href="{{ asset('bootstrap-wizard-master/assets/css/demo.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('bootstrap-wizard-master/assets/js/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('bootstrap-wizard-master/assets/js/gsdk-bootstrap-wizard.js') }}"></script>
    <script src="{{ asset('bootstrap-wizard-master/assets/js/jquery.validate.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJO4ZHiRYx1KVh-G7PMlGXEeopLOrT_qU&libraries=places">
    </script>

    <script>
        let storage_path = '{{ asset('storage') }}/';
        let removedImageIds = []

        $(document).ready(function() {

            $("body").on('keydown', '.noinput', function(event) {
                return false;
            });

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
                    url: "my-listings",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        title: 'ID'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        title: 'Title'
                    },
                    {
                        data: 'sold_or_leased',
                        name: 'sold_or_leased',
                        title: 'Status',
                        render: function(value, data, array) {

                            if (array['type'] == 'lease') {

                                return array['sold_or_leased'] == 1 ?
                                    ' <span class="badge badge-danger">Leased</span>' :
                                    '<span class="badge badge-success">Available for lease</span> ';
                            } else {
                                return array['sold_or_leased'] == 1 ?
                                    ' <span class="badge badge-danger">Sold</span>' :
                                    ' <span class="badge badge-success">Available for sale</span>';
                            }

                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Action',
                        orderable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ],
            })

            // new entry click
            $('body').on('click', '#create-new-entry', function() {
                $(`.wizard-container a[href="#one"]`).tab('show');
                $('#form-modal')[0].reset()
                $(`.upload__img-wrap`).empty()
                removedImageIds = []
                $(`#modal`).modal({
                    backdrop: 'static',
                })
                $(`#modal .modal-title`).text('New Listing')
                drawMap()
            })

            //edit
            $('body').on('click', '.edit-row', function() {
                var id = $(this).data('id')
                $(`.wizard-container a[href="#one"]`).tab('show');
                $('#form-modal')[0].reset()
                $(`.upload__img-wrap`).empty()
                removedImageIds = []
                $.get('my-listings/' + id + '/edit', function(res) {
                    let data = res.data
                    $(`#modal`).modal({
                        backdrop: 'static',
                    })
                    $(`#modal .modal-title`).text('Edit Listing')
                    $.each(data, function(key, t_value) {
                        $(`[name*=${key}]`).val(t_value)
                        if (key == 'type') {
                            if (t_value == 'sale') {
                                $(`.form-group.lease_freq`).hide()
                                $(`.price-label`).text(`Price`)
                            } else {
                                $(`.form-group.lease_freq`).show()
                                $(`.price-label`).text(`Lease Amount`)
                            }
                        }
                    })
                    manualAddImages(res.images)
                    drawMap(data.lat, data.lng, data.location, data.country, data.province, data
                        .city, data.barangay)

                })
            })

            function manualAddImages(data) {
                var imgWrap = $('.upload__box').find('.upload__img-wrap');
                imgWrap.empty()
                for (let i = 0; i < data.length; i++) {
                    var html =
                        `<div class='upload__img-box'><div  data-id="${data[i].id}" style='background-image: url("${storage_path + data[i].image_path}")' class='img-bg'><div class='upload__img-close'></div></div></div>`;
                    imgWrap.append(html);
                }
            }

            //form submit
            $(document).on('submit', '#form-modal', function(e) {
                e.preventDefault()

                if ($(`.upload__img-box .img-bg`).length <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry!',
                        text: 'Image is required',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    return
                }

                $('#form-modal').find('span.error').remove()
                $('#form-modal').find('[type="submit"]').attr("disabled", true).prepend(
                    `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon


                const formData = new FormData();

                const inputs = this.querySelectorAll('#form-modal [name]');
                for (let i = 0; i < inputs.length; i++) {
                    const input = inputs[i];
                    const name = input.name;
                    const value = input.value;

                    if (name !== '') {
                        // For file inputs, add the files directly to the formData
                        if (input.type === 'file') {
                            const files = input.files;
                            for (let j = 0; j < files.length; j++) {
                                formData.append(name, files[j]);
                            }
                        } else {
                            // For other input types, add their name and value to the formData
                            formData.append(name, value);
                        }
                    }
                }

                if (removedImageIds.length > 0) {
                    for (let i = 0; i < removedImageIds.length; i++) {
                        formData.append('removedImageIds[]', removedImageIds[i]);
                    }
                }

                $.ajax({
                    data: formData,
                    url: "my-listings",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var oTable = $('#datatable').dataTable()
                        oTable.fnDraw(false)
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '...',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        $('.fa-spinner').remove() //removes loading icon
                        $('[type="submit"]').attr("disabled",
                            false) //enables back submit button
                        $(`#modal`).modal('hide');
                    },
                    error: function(response) {
                        console.warn('Error:', response)
                        $.each(response.responseJSON.errors, function(field_name, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry!',
                                text: error,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        })
                        $('.fa-spinner').remove() //removes loading icon
                        $('[type="submit"]').attr("disabled",
                            false) //enables back submit button
                    }
                })
            })



            async function drawMap(t_lat = null, t_lng = null, t_location = null, t_country = null, t_province =
                null, t_city = null, t_barangay = null) {
                await $('#two').empty().append(`
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="locationInput">Search Location</label>
                                <input type="text" class="form-control" id="locationInput">
                            </div>
                            <div id="map" style="height: 600px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-row mt-4">
                                <div class="form-group col-md-12" >
                                    <div class="alert alert-primary" role="alert">
                                        Click the map to populate required fields below
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>Google Map Location</label>
                                    <input type="text" class="form-control noinput" data-name="location_readonly" >
                                    <input type="hidden" class="form-control" data-name="location" name="location">
                                </div>
                                <div class="form-group col-md-3" hidden>
                                    <label>Country</label>
                                    <input type="text" class="form-control noinput" data-name="country_readonly" >
                                    <input type="hidden" class="form-control" name="country" data-name="country">
                                </div>
                                <div class="form-group col-md-3" hidden>
                                    <label>Province</label>
                                    <input type="text" class="form-control noinput"  data-name="province_readonly" >
                                    <input type="hidden" class="form-control"  name="province" data-name="province" >
                                </div>
                                <div class="form-group col-md-3" hidden>
                                    <label>City</label>
                                    <input type="text" class="form-control noinput" data-name="city_readonly" >
                                    <input type="hidden" class="form-control" name="city" data-name="city">
                                </div>
                                <div class="form-group col-md-6" >
                                    <label>Lat</label>
                                    <input type="text" class="form-control noinput" name="lat">
                                </div>
                                <div class="form-group col-md-6" >
                                    <label>Lng</label>
                                    <input type="text" class="form-control noinput" name="lng">
                                </div>

                                <div class="form-group  col-md-12">
                                    <label><small style="color: red">*</small>Barangay</label>
                                    <select name="barangay" class="form-control">
                                        <option value=""></option>
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
                        </div>
                    </div>
                    `);

                let db_lat = t_lat ? t_lat : 10.204131063160549
                let db_long = t_lng ? t_lng : 123.75490307807922
                let map;
                let marker;

                if (db_lat && db_long) {
                    // If location data is available, show the map with the pin
                    const latLng = new google.maps.LatLng(db_lat, db_long);
                    const mapOptions = {
                        center: latLng,
                        zoom: 15,
                        mapTypeId: 'satellite',
                    };
                    map = new google.maps.Map(document.getElementById('map'), mapOptions);

                    // Add a pin at the location
                    marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });

                    $(`input[data-name*="location"]`).val(t_location);
                    $(`input[data-name*="country"]`).val(t_country)
                    $(`input[data-name*="province"]`).val(t_province)
                    $(`input[data-name*="city"]`).val(t_city)
                    $(`select[name="barangay"]`).val(t_barangay)
                    if (db_lat != 10.204131063160549) {
                        $(`input[name="lat"]`).val(db_lat)
                        $(`input[name="lng"]`).val(db_long)
                    }

                } else {
                    // If location data is not available, show the map without a pin
                    const mapOptions = {
                        center: new google.maps.LatLng('10.2085', '123.7573'),
                        zoom: 15,
                    };
                    map = new google.maps.Map(document.getElementById('map'), mapOptions);
                }

                // Add a click event listener to the map to drop a pin
                map.addListener('click', function(event) {
                    if (marker) {
                        marker.setMap(null);
                    }
                    marker = new google.maps.Marker({
                        position: event.latLng,
                        map: map,
                    });
                    saveLocation(event.latLng.lat(), event.latLng.lng());
                });

                // Add Autocomplete to the location input field
                const input = document.getElementById('locationInput');
                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                autocomplete.addListener('place_changed', function() {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.error('No location data for input: ' + place.name);
                        return;
                    }

                    if (marker) {
                        marker.setMap(null);
                    }

                    // Update the map and input field with the selected place
                    map.setCenter(place.geometry.location);
                    marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                    });

                    saveLocation(place.geometry.location.lat(), place.geometry.location
                        .lng());
                });
            }

            function saveLocation(lat, lng) {
                // Reverse geocode the latitude and longitude to get the address
                const geocoder = new google.maps.Geocoder();
                const latLng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                    location: latLng
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            const address = results[0].formatted_address;
                            console.info(address)

                            // Segregate the address components
                            let country = '';
                            let province = '';
                            let city = '';


                            for (let i = 0; i < results[0].address_components.length; i++) {
                                const addressComponent = results[0].address_components[i];
                                const types = addressComponent.types;

                                if (types.includes('country')) {
                                    country = addressComponent.long_name;
                                } else if (types.includes('administrative_area_level_2')) {
                                    province = addressComponent.long_name;
                                } else if (types.includes('locality')) {
                                    city = addressComponent.long_name;
                                }
                            }
                            if (city == "City of Naga") {
                                $(`input[data-name*="location"]`).val(address);
                                $(`input[data-name*="country"]`).val(country)
                                $(`input[data-name*="province"]`).val(province)
                                $(`input[data-name*="city"]`).val(city)
                                $(`input[name="lat"]`).val(lat)
                                $(`input[name="lng"]`).val(lng)
                            } else {
                                $(`input[data-name*="location"]`).val("");
                                $(`input[data-name*="country"]`).val("");
                                $(`input[data-name*="province"]`).val("");
                                $(`input[data-name*="city"]`).val("");
                                $(`input[name="lat"]`).val("");
                                $(`input[name="lng"]`).val("");
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error!',
                                    text: 'Location selected is outside City of Naga',
                                    showConfirmButton: true,
                                })
                            }


                        } else {
                            console.error('No results found for the clicked location.');
                        }
                    } else {
                        console.error('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }

            $(window).on('shown.bs.modal', function() {
                window.dispatchEvent(new Event('resize'));
            });

            ImgUpload();

        })

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                if (file) {
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                } else {
                    let id = $(this).parent().data("id");
                    removedImageIds.push(id)
                    $(this).parent().parent().remove();
                }

            });
        }



        //feature management
        //edit click
        $('body').on('click', '.edit-feature-row', function() {
            var id = $(this).data('id')
            $.get('my-listings/' + id + '/edit', function(res) {
                let data = res.data
                let feature_payments = res.feature_payments
                $(`#modal-feature`).modal({
                    backdrop: 'static',
                })
                $.each(data, function(key, value) {
                    $(`input[name="${key}"]`).val(value)
                })
                $(`#modal-feature table tbody`).empty()
                $.each(feature_payments, function(key, item) {
                    $(`#modal-feature table tbody`).append(`
                    <tr>
                        <td> ${item.id}</td>
                        <td> ${formatDateTime(item.created_at)}</td>
                        <td> ${item.gcash_reference_code}</td>
                        <td> ${item.sender_gcash_number}</td>
                        <td> ${item.comments ? item.comments : ''}</td>
                        <td> ${item.from ? formatDateTime(item.from) : ''}</td>
                        <td> ${item.to ? formatDateTime(item.to) : ''}</td>
                        <td> ${item.status}</td>
                    <tr>
                    `)
                })


            })
        })

        function formatDateTime(inputDateString) {
            const inputDate = new Date(inputDateString);
            if (isNaN(inputDate)) {
                return 'Invalid Date';
            }

            return new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true,
            }).format(inputDate);
        }


        $(document).on('submit', '#form-modal-feature', function(e) {
            e.preventDefault()
            $('#form-modal-feature').find('span.error').remove()
            $('#form-modal-feature').find('button[type="submit"]').attr("disabled", true).prepend(
                `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon

            $.ajax({
                data: $('#form-modal-feature').serialize() + '&action=feature',
                url: "my-listings",
                type: "POST",
                success: function(data) {
                    var oTable = $('#datatable').dataTable()
                    oTable.fnDraw(false)
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '...',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button
                    $("#form-modal-feature")[0].reset()
                    $(`#modal-feature`).modal('hide');
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


@push('css')
    <style>
        .upload__box p {
            margin: 0;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .upload__img-main {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            bottom: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-main:after {
            content: '\2713';
            font-size: 14px;
            color: white;
        }

        .upload__box .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.update-sold-or-leased', function() {
                const id = $(this).data("id")
                const statustext = $(this).data("statustext")
                const statusnew = $(this).data("statusnew")
                Swal.fire({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#26B99A',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            data: `id=${id}&sold_or_leased=${statusnew}&action=sold_or_leased`,
                            type: "POST",
                            url: "my-listings",
                            success: function(data) {
                                var oTable = $('#datatable').dataTable()
                                oTable.fnDraw(false)
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            },
                            error: function(data) {
                                console.log('Error:', data)
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Attach change event handler to the select element with name "type"
            $(`.form-group.lease_freq`).hide()
            $('select[name="type"]').change(function() {
                // Get the selected value
                var selectedValue = $(this).val();
                // Display the selected value in the console (you can modify this part)
                console.log('Selected value:', selectedValue);
                if (selectedValue) {
                    if (selectedValue == 'sale') {
                        $(`.price-label`).text(`Price`)
                        $(`.form-group.lease_freq`).hide()
                    } else {
                        $(`.price-label`).text(`Lease Amount`)
                        $(`.form-group.lease_freq`).show()
                    }
                } else {

                }
            });
        });
    </script>
@endpush
