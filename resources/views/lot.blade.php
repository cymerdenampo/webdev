@extends('layouts.app')

@section('content')


    <main id="main">
        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single">{{ $data->title }}</h1>
                            <span class="color-text-a">{{ $data->barangay }}, City of Naga, Cebu</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $data->title }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- End Intro Single-->

        <!-- ======= Property Single ======= -->
        <section class="property-single nav-arrow-b pb-5">
            <div class="container">


                @if (count($images) > 0)
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div id="animated-thumbnails-gallery">
                                @foreach ($images as $image)
                                    <a style="display:{{ $loop->index <= 5 ? '' : 'none' }}"
                                        class="gallery-item {{ $loop->index <= 5 ? '' : 'hidden-on-load' }}"
                                        data-src="{{ asset('storage') }}/{{ $image->image_path }}">
                                        <img class="img-responsive" src="{{ asset('storage') }}/{{ $image->image_path }}" />
                                    </a>
                                @endforeach


                            </div>
                            @if (count($images) >= 6)
                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button id="show-all" class="btn btn-info"> Show all</button>
                                        <button id="hide-all" class="btn btn-info" style="display: none">See less</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                    <script>
                        $(document).ready(function() {
                            lightGallery(document.getElementById('animated-thumbnails-gallery'), {
                                thumbnail: true,
                            });
                        })
                    </script>
                @endif



                <div class="row">
                    <div class="col-sm-12">

                        <div class="row justify-content-between mt-4">
                            <div class="col-md-3 ">

                                <div class="property-summary">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="title-box-d section-t4-x mt-3">
                                                <h3 class="title-d">Quick Summary</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-list">
                                        <ul class="list">

                                            <li class="d-flex justify-content-between">
                                                <strong>Price:</strong>
                                                <span> <i class="fa-solid fa-peso-sign"></i>
                                                    {{ number_format($data->price, 2) }}</span>
                                            </li>

                                            <li class="d-flex justify-content-between">
                                                <strong>Property Type:</strong>
                                                <label
                                                    class="text-{{ $data->sold_or_leased == 1 ? 'danger' : 'success' }}">
                                                    {{ $data->type == 'sale' ? 'Sale' : 'Lease' }}
                                                </label>
                                                @if ($data->sold_or_leased == 1)
                                                    / <label class="text-danger">Sold</label>
                                                @endif
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <strong>Area:</strong>
                                                <span>{{ $data->area }}
                                                    <sup>2</sup>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9  section-md-t3 mt-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <h3 class="title-d">Property Description</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-description">
                                    <p class="description color-text-a">
                                        {{ $data->description }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if ($data->video_link)
                        <div class="col-sm-12 map-box">
                            <div class="row section-t3">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">Video</h3>
                                    </div>
                                </div>
                            </div>

                            @php
                                $youtubeUrl = $data->video_link;
                                $parsedUrl = parse_url($youtubeUrl);
                                if (isset($parsedUrl['query'])) {
                                    parse_str($parsedUrl['query'], $query);
                                    $vParameter = $query['v'] ?? null; // Use the null coalescing operator to handle the case when 'v' is not present
                                } else {
                                    $vParameter = null; // Set to null if there is no query string
                                }
                            @endphp

                            <iframe src="https://www.youtube.com/embed/{{ $vParameter }}" width="100%" height="460"
                                frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen
                                style="border-radius: 30px"></iframe>
                        </div>
                    @endif

                    <div class="col-sm-12 map-box">
                        <div class="row section-t3">
                            <div class="col-sm-12">
                                <div class="title-box-d">
                                    <h3 class="title-d">Map Location</h3>
                                </div>
                            </div>
                        </div>
                        @auth
                            {{-- @if (auth()->user()->plan == 'premium') --}}
                            <div class="contact-map box">
                                <div id="map" class="contact-map" style="border-radius: 30px">
                                </div>
                            </div>
                            {{-- @else
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="alert alert-dark" role="alert">
                                            <a href="/pricing"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; Upgrade to
                                                Premium</a>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                        @else
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-dark" role="alert">
                                        <a href="/login/user"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; Login to
                                            view
                                            content</a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <div class="col-md-12 owner-info-box">
                        <div class="row section-t3">
                            <div class="col-sm-12">
                                <div class="title-box-d">
                                    <h3 class="title-d">Contact Owner</h3>
                                </div>
                            </div>

                            @auth
                                <div class="col-md-4">

                                    {{-- @if (auth()->user()->plan !== 'free') --}}
                                    @if (auth()->user()->plan !== null)
                                        <div class="summary-list">
                                            <ul class="list">
                                                <li class="d-flex justify-content-between">
                                                    <strong>Name:</strong>
                                                    <span>{{ $data->created_by->name }}</span>
                                                </li>
                                                <li class="d-flex justify-content-between">
                                                    <strong>Email:</strong>
                                                    <span>{{ $data->created_by->email }}</span>
                                                </li>
                                                <li class="d-flex justify-content-between">
                                                    <strong>Mobile:</strong>
                                                    <span>{{ $data->created_by->phone ? $data->created_by->phone : 'N/A' }}</span>
                                                </li>
                                                @if ($data->created_by->address)
                                                    <li class="d-flex justify-content-between">
                                                        <strong>Address:</strong>
                                                        <span>{{ $data->created_by->address }}</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-dark" role="alert">
                                                    <a href="/pricing"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;
                                                        Upgrade to
                                                        Standard/Premium</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                                <div class="col-md-8 section-md-t3 mt-3">

                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="alert alert-dark" role="alert">
                                        <a href="/login/user"><i class="fa fa-lock" aria-hidden="true"></i>
                                            &nbsp; Login to view
                                            content</a>
                                    </div>
                                </div>
                            @endauth

                        </div>
                    </div>

                    @auth
                        @role('user')
                            {{-- @if (auth()->user()->plan !== 'free') --}}
                            @if (auth()->user()->plan !== null)
                                <div class="col-md-12 section-md-t3 mt-3">
                                    <div class="row d-flex ">
                                        @if ($role == 'seller')
                                            <div class="col-md-3">
                                                <div id="chat-container"></div>
                                            </div>
                                        @endif

                                        <div class="col-md-5">

                                            <div class="card" id="chat1" style="border-radius: 15px;">
                                                <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                                                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                                    @if ($role == 'seller')
                                                        <i class="fa fa-angle-left hidechat" style="cursor: pointer"></i>
                                                    @endif

                                                    <p class="mb-0 fw-bold">Live chat</p>
                                                    @if ($role == 'seller')
                                                        <i class="fa fa-close hidechat" style="cursor: pointer"></i>
                                                    @endif

                                                </div>
                                                <div class="card-body">
                                                    <div id="chat-wrapper">

                                                    </div>
                                                    <div class="form-outline">
                                                        <textarea id="messageInput" class="form-control" rows="4"></textarea>
                                                        <label class="form-label">Type your
                                                            message</label>
                                                    </div>

                                                    <button class="btn btn-sm mb-1" id="remindButton">Send Email Reminder</button>

                                                    <button class="btn btn-sm float-right" id="sendButton">Send</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            @endif
                        @endrole
                    @endauth


                    <!--start comment -->

                    <div class="col-md-12 owner-info-box">
                        <div class="row section-t3">
                            <div class="col-sm-12">
                                <div class="title-box-d">
                                    <h3 class="title-d">Comments</h3>
                                </div>
                            </div>

                            @auth



                                <div class="col-md-12">

                                    <form action="{{ route('lot.store') }}" class="signin-form" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $data->id }}" name="property_id">
                                        <textarea id="" cols="20" rows="5" class="form-control" required name="comment"
                                            style="border-radius: 30px"></textarea>
                                        <div class="text-right mt-3">

                                            {{-- @if (auth()->user()->plan !== 'free') --}}
                                            @if (auth()->user()->plan !== null)
                                                <button class="btn btn-a" type="submit">Comment</button>
                                            @else
                                                <button data-toggle="tooltip" data-placement="bottom"
                                                    title="Only Available for standard and premium users"
                                                    class="btn btn-a disabled" type="button">Comment</button>
                                                <script>
                                                    $('button[data-toggle="tooltip"]').tooltip()
                                                </script>
                                            @endif



                                        </div>
                                    </form>
                                </div>


                                <div class="col-md-12">
                                    <div class="box-comments">
                                        <ul class="list-comments">


                                            @if (count($comments) > 0)
                                                @foreach ($comments as $item)
                                                    <li>
                                                        <div class="comment-avatar">
                                                            <img style="object-fit: cover; border-radius:50px"
                                                                src="{{ $item->user->profile_pic ? asset('storage/' . $item->user->profile_pic) : 'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg' }}">
                                                        </div>
                                                        <div class="comment-details">
                                                            <h4 class="comment-author">{{ $item->user->name }}</h4>
                                                            <span>
                                                                {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y g:i A') }}</span>
                                                            <p class="comment-description">
                                                                {{ $item->comment }}
                                                            </p>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>

                                    </div>
                                </div>


                            </div>
                        @else
                            <div class="col-md-4">
                                <div class="alert alert-dark" role="alert">
                                    <a href="/login/user"><i class="fa fa-lock" aria-hidden="true"></i>
                                        &nbsp; Login to view
                                        content</a>
                                </div>
                            </div>
                        @endauth


                    </div>
                    <!-- end comment -->


                    <!--start viewers -->
                    @if ($role == 'seller')
                        <div class="col-md-12 owner-info-box">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">Visits</h3>
                                    </div>
                                </div>

                                @auth


                                    @if (auth()->user()->plan == 'premium')
                                        {{-- content --}}

                                        <div class="col-md-12">
                                            <div class="card" style="border-radius:30px">
                                                <div class="card-body">
                                                    <div class="data-table">
                                                        <table id="datatable" class="table table hover dt-responsive"
                                                            width="100%">
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-dark" role="alert">
                                                    <a href="/pricing"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;
                                                        Upgrade to Premium</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="alert alert-dark" role="alert">
                                        <a href="/login/user"><i class="fa fa-lock" aria-hidden="true"></i>
                                            &nbsp; Login to view
                                            content</a>
                                    </div>
                                </div>
                            @endauth


                        </div>
                        <!-- end viewers -->
                    @endif

                </div>
            </div>
        </section><!-- End Property Single-->

    </main>
@endsection

@auth


    @push('js')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJO4ZHiRYx1KVh-G7PMlGXEeopLOrT_qU&libraries=places">
        </script>

        <script>
            let data = @json($data);
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $('.tooltip').tooltip('show')

                if ($(`#map`).length > 0) {
                    drawMap(data.lat, data.lng, 'ts')
                }

            })

            async function drawMap(t_lat = null, t_lng = null) {
                let db_lat = t_lat ? t_lat : 10.2433;
                let db_long = t_lng ? t_lng : 123.7890;
                let map;
                let marker;
                let infoWindow;

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

                    // Create an info window content
                    const infoWindowContent = `<div><h3>${data.title}</h3><p>${data.location}</p></div>`;

                    // Initialize the info window
                    infoWindow = new google.maps.InfoWindow({
                        content: infoWindowContent,
                    });

                    infoWindow.open(map, marker);

                    // Open the info window when the marker is clicked
                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });

                } else {
                    // If location data is not available, remove the map box
                    $(`.map-box`).remove();
                }
            }

            $(document).on('submit', '#form-book', function(e) {
                e.preventDefault()
                $('#form-book').find('span.error').remove()
                $('#form-book').find('button[type="submit"]').attr("disabled", true).prepend(
                    `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon

                $.ajax({
                    data: $('#form-book').serialize(),
                    url: "/lot",
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
                        }).then((result) => {
                            location.reload();
                        });
                        $('.fa-spinner').remove() //removes loading icon
                        $('button[type="submit"]').attr("disabled", false) //enables back submit button
                        $("#form-book")[0].reset()
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
@endauth

@push('css')
    <style>
        .swiper-slide {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            text-align: center;
            /* Center any additional content within the slide */
        }

        .swiper-slide img {
            max-height: 400px;
            width: auto;
        }

        @media only screen and (max-width: 600px) {
            .swiper-slide img {
                max-width: 300px;
                max-height: 300px;
            }
        }

        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after,
        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            color: #61c461;
        }

        .intro-single {
            padding: 6rem 0 0rem !important;
            margin-top: 30px;
        }
    </style>
@endpush


@auth
    @role('user')
        @push('js')
            <script>
                var buyer_receiver_id = null;
                $(document).ready(function() {
                    let role = "{{ $role }}";
                    let aid = "{{ auth()->user()->id }}";
                    let ain = "{{ auth()->user()->name }}";

                    // Get elements
                    const chatContainer = document.getElementById('chat-container');

                    // Function to display chat for buyer
                    function displayBuyerChat(sellerId, buyerId, buyerName) {
                        $(`#chat1`).show()
                        const chatId = `${buyerId}_${sellerId}_lot${data.id}`;

                        $(`#sendButton`).remove()
                        $(`#chat1 .card-body`).append(
                            `<button class="btn btn-sm float-right" id="sendButton">Send</button>`)
                        const chatElement = document.getElementById('chat');
                        const messageInput = document.getElementById('messageInput');
                        const sendButton = document.getElementById('sendButton');
                        // Listen for changes in the chat document
                        chatsCollection.doc(chatId).onSnapshot((snapshot) => {
                            const data = snapshot.data();

                            if (data && data.messages) {
                                $(`#chat-wrapper`).empty()

                                const messagesHTML = data.messages.map((messageObj) => {
                                    const timestamp = messageObj.timestamp ? moment(messageObj.timestamp
                                        .toDate()).fromNow() : 'N/A';

                                    let who = messageObj.senderId
                                    const getInitials = inputString => inputString.split(' ').map(word =>
                                        word[0]).join('');
                                    const initials = getInitials(messageObj.senderName);
                                    let s_icon =
                                        "https://cdn.pixabay.com/photo/2022/03/17/06/08/letter-s-7073833_1280.png"
                                    if (who.includes('seller')) {
                                        //seller

                                        $(`#chat-wrapper`).append(`
                                    <div class="d-flex flex-row justify-content-${messageObj.senderName==ain?'end':'start'} mb-4">
                                        <div class="avatar-text" style="background-color:${messageObj.senderName==ain?'#5ddb4c':'#3555a9'}">${initials}</div>
                                        <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);max-width: 300px;">
                                            <label class="times">${messageObj.senderName}</label>
                                            <p class="small mb-0">${messageObj.message}</p>
                                                <label class="times">${timestamp}</label>
                                        </div>
                                    </div>
                                    `)
                                    } else {
                                        $(`#chat-wrapper`).append(`
                                    <div class="d-flex flex-row justify-content-${messageObj.senderName==ain?'end':'start'} mb-4">
                                        <div class="p-3 me-3 border"
                                            style="border-radius: 15px; background-color: #fbfbfb;max-width: 300px;">
                                            <label class="times">${messageObj.senderName}</label>
                                            <p class="small mb-0">${messageObj.message}</p>
                                                <label class="times">${timestamp}</label>
                                        </div>
                                        <div class="avatar-text" style="background-color:${messageObj.senderName==ain?'#5ddb4c':'#3555a9'}">${initials}</div>
                                    </div>
                                    `)
                                    }
                                    scrolll()
                                });

                            }
                        });
                        let senderId = `${role}${aid}`
                        let senderName = "{{ auth()->user()->name }}"
                        // Add event listener for the Send button
                        if (sendButton) {
                            sendButton.addEventListener('click', (e) => {
                                e.preventDefault()
                                sendMessage(chatId, buyerId, buyerName, sellerId, senderId, senderName)
                            });
                        }

                        return
                    }


                    async function sendEmail(sellerId) {
                        $(`#remindButton`).text('Sending reminder...')
                        $(`#remindButton`).prepend(`<span class="fa fa-spin fa-spinner mr-1"></span> `)
                        $(`#remindButton`).attr("disabled", true)

                        let payload = {
                            sellerId
                        }

                        Swal.fire({
                            title: 'Processing',
                            text: 'Please wait, we are sending an email...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showCancelButton: false,
                            showConfirmButton: false
                        })

                        await $.ajax({
                            data: payload,
                            url: "/email",
                            type: "POST",
                            success: function(data) {
                                console.log(data)
                            },
                            error: function(response) {
                                console.warn('Error:', response)
                            }
                        })

                        Swal.close()

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Email notification sent!',
                            showConfirmButton: false,
                            timer: 3000
                        })

                        $(`#remindButton`).attr("disabled", false)
                        $('.fa-spinner').remove()
                        $(`#remindButton`).text('Send Email Reminder')
                        return
                    }

                    // Function to send a message
                    function sendMessage(chatId, buyerId, buyerName, sellerId, senderId, senderName) {
                        const message = messageInput.value;

                        if (message.trim() !== '') {
                            const timestamp = new Date();

                            // Retrieve existing messages
                            chatsCollection.doc(chatId).get()
                                .then((doc) => {
                                    const existingMessages = doc.data()?.messages || [];
                                    const isChatUnread = existingMessages.some((messageObj) => messageObj.senderId !==
                                        senderId);

                                    const newMessage = {
                                        senderName,
                                        senderId,
                                        message,
                                        timestamp
                                    };
                                    const updatedMessages = [...existingMessages, newMessage];


                                    // Update the messages array in Firestore
                                    const chatUpdateData = {
                                        messages: updatedMessages,
                                        participants: {
                                            [sellerId]: true,
                                            [buyerId]: true,
                                        },
                                        buyer: {
                                            buyerName: buyerName
                                        },
                                        unread: {
                                            seller: existingMessages.length <= 0 && role == 'buyer' ? 1 : 0,
                                            buyer: existingMessages.length <= 0 && role == 'seller' ? 1 : 0
                                        },
                                        lot_id: data.id
                                    };
                                    console.log(existingMessages.length, role, isChatUnread, chatUpdateData)
                                    if (isChatUnread || existingMessages.length >= 1) {
                                        // Increment the appropriate unread count by 1 if the chat is unread.
                                        if (senderId === sellerId) {
                                            chatUpdateData.unread.buyer = (doc.data()?.unread.buyer || 0) + 1;
                                        } else {
                                            chatUpdateData.unread.seller = (doc.data()?.unread.seller || 0) + 1;
                                            //sendEmail(sellerId)
                                        }
                                    } else {
                                        // Set the appropriate unread count to 0 if the chat is not unread.
                                        // chatUpdateData.unread.seller = 0;
                                        // chatUpdateData.unread.buyer = 0;
                                    }

                                    chatsCollection.doc(chatId).set(chatUpdateData, {
                                        merge: true
                                    });
                                })
                                .catch((error) => {
                                    console.error("Error retrieving existing messages: ", error);
                                });

                            // Clear the input field
                            messageInput.value = '';
                        }
                    }



                    $(document).on('click', '#remindButton', function(e) {
                        let sellerId = `${data.created_by.id}`;

                        if (role === 'buyer') {
                            sendEmail(sellerId)
                        }

                        if (role === 'seller') {
                            sendEmail(buyer_receiver_id)
                        }
                    })


                    function displaySellerChatList() {

                        $(`#chat1`).hide()
                        // Get list of buyers
                        let sellerId = `seller${data.created_by.id}`;
                        chatsCollection.where(`participants.${sellerId}`, '==', true)
                            .get()
                            .then((querySnapshot) => {
                                const buyerList = document.createElement('div');
                                buyerList.innerHTML = '<h2>Chats</h2>';
                                if (querySnapshot.docs.length <= 0) {
                                    buyerList.innerHTML = '<h2>Chats</h2><p>No results</p>';
                                }
                                querySnapshot.forEach((doc) => {
                                    if (doc.data().lot_id && doc.data().lot_id == data.id) {
                                        const participants = Object.keys(doc.data().participants);

                                        const buyerId = participants.find((participant) => participant !==
                                            sellerId);

                                        let chatId = `${buyerId}_${sellerId}_lot${data.id}`;

                                        const name_b = doc.data().buyer.buyerName

                                        const unreadBuyerCount = doc.data().unread.buyer;
                                        const unreadSellerCount = doc.data().unread.seller;

                                        // Create a div to display the chat link and unread counts for both seller and buyer.
                                        const chatLinkDiv = document.createElement('div');
                                        chatLinkDiv.classList.add("chatLinkDiv");
                                        const buyerLink = document.createElement('a');
                                        buyerLink.href = '#';
                                        buyerLink.textContent = name_b;

                                        const unreadBuyerCountSpan = document.createElement('span');
                                        unreadBuyerCountSpan.classList.add("badge", "badge-danger");
                                        unreadBuyerCountSpan.textContent = ` ${unreadBuyerCount} unread `;

                                        const unreadSellerCountSpan = document.createElement('span');
                                        unreadSellerCountSpan.classList.add("badge", "badge-danger");
                                        unreadSellerCountSpan.textContent = ` ${unreadSellerCount} unread `;

                                        buyerLink.addEventListener('click', (e) => {
                                            e.preventDefault();
                                            // When the chat is opened, mark it as read for the specific user (seller or buyer).
                                            if (role === 'seller') {
                                                buyer_receiver_id = buyerId.replace('buyer', '');

                                                chatsCollection.doc(chatId).set({
                                                    unread: {
                                                        seller: 0,
                                                        buyer: unreadBuyerCount
                                                    }
                                                }, {
                                                    merge: true
                                                });
                                            } else {
                                                chatsCollection.doc(chatId).set({
                                                    unread: {
                                                        seller: unreadSellerCount,
                                                        buyer: 0
                                                    }
                                                }, {
                                                    merge: true
                                                });
                                            }
                                            displayBuyerChat(sellerId, buyerId, name_b);
                                            window.scrollTo(0, document.body.scrollHeight);
                                        });

                                        chatLinkDiv.appendChild(buyerLink);

                                        if (role == 'seller') {
                                            if (unreadSellerCount >= 1) {
                                                chatLinkDiv.appendChild(unreadSellerCountSpan);
                                            }

                                        } else {
                                            if (unreadBuyerCount >= 1) {
                                                chatLinkDiv.appendChild(unreadBuyerCountSpan);
                                            }
                                        }

                                        buyerList.appendChild(chatLinkDiv);
                                    }
                                });

                                chatContainer.innerHTML = '';
                                chatContainer.appendChild(buyerList);
                            }, (error) => {
                                console.error("Error fetching buyer list: ", error);
                            });
                    }


                    if (role == 'buyer') {
                        let chatId = `buyer${aid}_seller${data.created_by.id}_lot${data.id}`;
                        chatsCollection.doc(chatId).set({
                            unread: {
                                buyer: 0
                            }
                        }, {
                            merge: true
                        });

                        displayBuyerChat(`seller${data.created_by.id}`, `buyer${aid}`, `${ain}`);
                    } else {
                        displaySellerChatList()
                    }

                    $(".hidechat").on("click", function() {
                        displaySellerChatList()
                    });

                    function scrolll() {
                        var objDiv = document.getElementById("chat-wrapper");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }

                });
            </script>
        @endpush
    @endrole
@endauth

@push('css')
    <style>
        #chat1 .form-outline .form-control~.form-notch div {
            pointer-events: none;
            border: 1px solid;
            border-color: #eee;
            box-sizing: border-box;
            background: transparent;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-leading {
            left: 0;
            top: 0;
            height: 100%;
            border-right: none;
            border-radius: .65rem 0 0 .65rem;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-middle {
            flex: 0 0 auto;
            max-width: calc(100% - 1rem);
            height: 100%;
            border-right: none;
            border-left: none;
        }

        #chat1 .form-outline .form-control~.form-notch .form-notch-trailing {
            flex-grow: 1;
            height: 100%;
            border-left: none;
            border-radius: 0 .65rem .65rem 0;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-left: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-leading {
            border-right: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle {
            border-bottom: 0.125rem solid;
            border-color: #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-middle {
            border-top: none;
            border-right: none;
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing {
            border-top: 0.125rem solid #39c0ed;
            border-bottom: 0.125rem solid #39c0ed;
            border-right: 0.125rem solid #39c0ed;
        }

        #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing,
        #chat1 .form-outline .form-control.active~.form-notch .form-notch-trailing {
            border-left: none;
            transition: all 0.2s linear;
        }

        #chat1 .form-outline .form-control:focus~.form-label {
            color: #39c0ed;
        }

        #chat1 .form-outline .form-control~.form-label {
            color: #bfbfbf;
        }

        .times {
            padding: 0;
            margin: 0;
            font-size: 10px;
        }

        #chat-wrapper .p-3 {
            padding: 0.2rem 1rem !important;
        }

        #chat-wrapper {
            max-height: 300px;
            overflow-y: scroll;
        }



        .avatar-text {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #007BFF;
            /* Background color for the circle */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 13px;
            color: #ffffff;
            /* Text color for the initials */
        }

        #animated-thumbnails-gallery img {
            height: 200px;
            cursor: zoom-in;
        }
    </style>
@endpush


@push('js')
    <script>
        $(document).on('click', '#show-all', function(e) {
            e.preventDefault()
            $(`#animated-thumbnails-gallery .gallery-item`).fadeIn(500);
            $(`#show-all`).hide()
            $(`#hide-all`).show()
        })

        $(document).on('click', '#hide-all', function(e) {
            e.preventDefault()
            $(`.hidden-on-load`).fadeOut(500)
            $(`#hide-all`).hide()
            $(`#show-all`).show()
        })
    </script>
@endpush


@push('css')
    <style>
        .box-comments .list-comments li {
            padding-bottom: 10px;
        }
    </style>
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
                    url: "/lot/{{ $data->id }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'visitor.name',
                        name: 'visitor.name',
                        title: 'Visitor Name'
                    },
                    {
                        data: 'visitor.email',
                        name: 'visitor.email',
                        title: 'Email'
                    },
                    {
                        data: 'visitor.phone',
                        name: 'visitor.phone',
                        title: 'Mobile'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Visit Timestamp'
                    },
                ],
                // order: [
                //     [1, 'asc']
                // ],
            })
        })
    </script>
@endpush

@push('css')
    <style>
        .btn.btn-a.disabled:hover {
            background-color: #2c2c2c;
            color: #d8d8d8;
        }
    </style>
@endpush
