@extends('layouts.app')

@section('content')
    <main id="main">

        <div class="container-fluid">

            <section id="pricing" class="pricing-content section-padding section-t8">
                <div class="container">
                    <div class="section-title text-center">
                        <h1>Pricing </h1>
                        {{-- <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout.</p> --}}
                    </div>
                    <div class="row text-center mt-5">
                        @foreach ($plans as $plan)
                            <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                                data-wow-offset="0">
                                <div class="{{ $plan->class }}">
                                    <div class="price-head">
                                        @if ($plan->name == 'free')
                                            <h2>{{ ucfirst('Buyer') }}</h2>
                                        @endif

                                        @if ($plan->name == 'standard')
                                            <h2>{{ ucfirst('standard seller') }}</h2>
                                        @endif

                                        @if ($plan->name == 'premium')
                                            <h2>{{ ucfirst('premium seller') }}</h2>
                                        @endif

                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <h1 class="price">
                                        <p><i class="fa-solid fa-peso-sign"></i> {{ $plan->price }}
                                    </h1>

                                    @if ($plan->name == 'free')
                                        <h5>&nbsp;</h5>
                                    @else
                                        <h5>1 month</h5>
                                    @endif

                                    <ul class="text-left ml-5">
                                        @foreach ($plan->features as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach



                                    </ul>
                                    <ul>
                                        @if (auth()->user()->plan == $plan->name)
                                            <li class="text-success mt-4">Your current plan</li>
                                            @if (auth()->user()->plan !== 'free')
                                                <li class="text-success">Expires
                                                    {{ \Carbon\Carbon::parse(auth()->user()->plan_until)->format('F j, Y g:i A') }}
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                    @if ($plan->name !== 'free')
                                        @guest
                                            <a href="/login/user">Purchase</a>
                                        @else
                                            {{-- modal --}}
                                            @if (auth()->user()->plan !== $plan->name)
                                                <a href="#" data-toggle="modal" data-plan="{{ $plan->name }}"
                                                    data-target="#modal-subscribe">Purchase</a>
                                            @endif
                                        @endguest
                                    @endif




                                </div>
                            </div><!--- END COL -->
                        @endforeach

                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>

        </div>



    </main><!-- End #main -->

    <!-- Start feature Modal -->
    <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form-modal-subscribe">
                                <input type="hidden" name="id">
                                <div class="form-row">
                                    <p>Please send exact amount to 0945-164-2872. Incorrect amount is forfeited and will not
                                        be refunded.
                                    </p>
                                    <div class="form-group col-md-12">
                                        <label>GCASH Reference Code</label>
                                        <input type="number" name="gcash_reference_code" class="form-control" required>
                                    </div>

                                    {{-- <div class="form-group col-md-12">
                                        <label>GCASH Sender Number</label>
                                        <input type="tel" placeholder="0XXXXXXXXXX" pattern="[0-9]{4}[0-9]{3}[0-9]{4}"
                                            name="sender_gcash_number" class="form-control" required>
                                    </div> --}}

                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="error">
                                    </div>
                                    <div class="form-group col-md-12" hidden>
                                        <input type="hidden" name="plan">
                                    </div>
                                </div>
                                @if (
                                    $sellerfile &&
                                        $sellerfile->purok !== null &&
                                        $sellerfile->brgy !== null &&
                                        $sellerfile->police !== null &&
                                        $sellerfile->nbi !== null)
                                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
                                @else
                                    <p class="text-danger">Please Submit first Seller Data Requirementsa at the <a href="/settings-and-privacy"
                                            class="text-success">Settings and Privacy
                                            Page</a> </p>
                                    <div class="row">
                                        <div class="text-right col-md-12">
                                            <button disabled class="btn btn-lg btn-success">Submit</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End feature Modal -->
@endsection

@push('css')
    <style>
        body {
            margin-top: 20px;
        }

        .pricing-content {}

        .single-pricing {
            background: #fff;
            padding: 40px 20px;
            border-radius: 30px;
            position: relative;
            z-index: 2;
            border: 1px solid #eee;
            box-shadow: 0 10px 40px -10px rgba(0, 64, 128, .09);
            transition: 0.3s;
        }

        @media only screen and (max-width:480px) {
            .single-pricing {
                margin-bottom: 30px;
            }
        }

        .single-pricing:hover {
            box-shadow: 0px 60px 60px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transform: translate(0, -10px);
        }

        .price-label {
            color: #fff;
            background: #2eca6a;
            font-size: 16px;
            width: 100px;
            margin-bottom: 15px;
            display: block;
            -webkit-clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            margin-left: -20px;
            position: absolute;
        }

        .price-head h2 {
            font-weight: 600;
            margin-bottom: 0px;
            text-transform: capitalize;
            font-size: 26px;
        }

        .price-head span {
            display: inline-block;
            background: #2eca6a;
            width: 6px;
            height: 6px;
            border-radius: 30px;
            margin-bottom: 20px;
            margin-top: 15px;
        }

        .price {
            font-weight: 500;
            font-size: 50px;
            margin-bottom: 0px;
        }

        .single-pricing {}

        .single-pricing h5 {
            font-size: 14px;
            margin-bottom: 0px;
            text-transform: uppercase;
        }

        .single-pricing ul {
            list-style: none;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .single-pricing ul li {
            line-height: 35px;
        }

        .single-pricing a {
            background: none;
            border: 2px solid #2eca6a;
            border-radius: 5000px;
            color: #2eca6a;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            padding: 10px 45px;
            text-transform: capitalize;
            transition: all 0.3s ease 0s;
        }

        .single-pricing a:hover,
        .single-pricing a:focus {
            background: #2eca6a;
            color: #fff;
            border: 2px solid #2eca6a;
        }

        .single-pricing-white {
            background: #232434
        }

        .single-pricing-white ul li {
            color: #fff;
        }

        .single-pricing-white h2 {
            color: #fff;
        }

        .single-pricing-white h1 {
            color: #fff;
        }

        .single-pricing-white h5 {
            color: #fff;
        }

        .single-pricing ul {
            padding: 0;
        }

        .modal-sm {
            max-width: 600px !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        let plan = null;


        $('#modal-subscribe').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var plan = $(e.relatedTarget).data('plan');
            $(e.currentTarget).find('input[name="plan"]').val(plan);
        });

        $(document).on('submit', '#form-modal-subscribe', function(e) {
            e.preventDefault()
            $('#form-modal-subscribe').find('span.error').remove()
            $('#form-modal-subscribe').find('button[type="submit"]').attr("disabled", true).prepend(
                `<span class="fa fa-spin fa-spinner mr-1"></span> `) //shows loading icon

            $.ajax({
                data: $('#form-modal-subscribe').serialize() + '&action=feature',
                url: "/pricing",
                type: "POST",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '...',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('.fa-spinner').remove() //removes loading icon
                    $('button[type="submit"]').attr("disabled", false) //enables back submit button
                    $("#form-modal-subscribe")[0].reset()
                    $(`#modal-subscribe`).modal('hide');
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