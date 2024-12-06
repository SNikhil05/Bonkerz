@extends('frontend.layouts.app')
@if (session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
</script>
@endif
<!-- show success and error message -->
@if (session('error'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "error",
        title: "{{ session('error') }}"
    });
</script>
@endif
@section('content')<!-- Start checkout page area -->
<div class="checkout__page--area">
    <div class="container">
        <div class="checkout__page--inner d-flex py-lg-5 py-3">
            <div class="main checkout__mian">
                <header class="main__header checkout__mian--header mb-30">

                    <details class="order__summary--mobile__version">
                        <summary class="order__summary--toggle border-radius-5">
                            <span class="order__summary--toggle__inner">
                                <span class="order__summary--toggle__icon">
                                    <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="order__summary--toggle__text show">
                                    <span>Show order summary</span>
                                    <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor">
                                        <path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="order__summary--final__price">₹ {{ session('grandTotal') }}</span>
                            </span>
                        </summary>
                        <div class="order__summary--section">
                            <div class="cart__table checkout__product--table">
                                <table class="summary__table">
                                    <tbody>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">Cart Total</td>
                                            <td class="cart__summary--amount text-right">₹ {{ session('cartTotal') }}</td>


                                        </tr>

                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">GST</td>
                                            <td class="cart__summary--amount text-right"><span class="text-muted">₹ {{ session('gstTotal') }}</span></td>
                                        </tr>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">Shipping Charges</td>

                                            <td class="cart__summary--amount text-right">₹ {{ session('shipingTotal') }}</td>
                                        </tr>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left">Member Discount </td>
                                            <td class="cart__summary--amount text-right"><span class="text-danger">₹ {{ session('discountTotal') }}</span></td>
                                        </tr>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left fw-bold">Total Amount</td>
                                            <td class="cart__summary--amount text-right fw-bold">₹ {{ session('grandTotal') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </details>
                    <nav>
                        <ol class="breadcrumb checkout__breadcrumb d-flex">
                            <li class="breadcrumb__item breadcrumb__item--completed d-flex align-items-center">
                                <a class="breadcrumb__link" href="cart.php">Cart</a>
                                <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path>
                                </svg>
                            </li>

                            <li class="breadcrumb__item breadcrumb__item--current d-flex align-items-center">
                                <span class="breadcrumb__text current">Information</span>
                                <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path>
                                </svg>
                            </li>
                            <li class="breadcrumb__item breadcrumb__item--blank d-flex align-items-center">
                                <span class="breadcrumb__text">Shipping</span>
                                <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path>
                                </svg>
                            </li>
                            <li class="breadcrumb__item breadcrumb__item--blank">
                                <span class="breadcrumb__text">Payment</span>
                            </li>
                        </ol>
                    </nav>
                </header>
                <main class="main__content_wrapper">
                    <form action="{{ route('checkout.store_delivery_info') }}" method="POST">
                        @csrf
                        @if(count($addresses) > 0)
                        @foreach($addresses as $address)
                        @php
                        $country = App\Models\Country::where('id', $address->country_id)->first();
                        $state = App\Models\State::where('id', $address->state_id)->first();
                        $city = App\Models\City::where('id', $address->city_id)->first();

                        @endphp
                        <div class="checkout__content--step section__contact--information">
                            <div class="order__confirmed--area border-radius-5 mb-15">
                                <div class="d-flex flex-wrap justify-content-between py-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <h4>Saved Address:</h4>
                                            <input class="form-check-input" name="address_id" value="{{ $address->id }}" type="radio" name="flexRadioDefault" required>
                                            {{ $address->address ?? ''}}, {{ $country->name }}, {{ $state->name }}, {{ $city->name }}, {{ $address->postal_code ?? ''}}, {{ $address->phone ?? ''}}
                                        </label>
                                    </div>
                                    <div class="">
                                        <a class="btn bg-red text-white fs-4 btn-lg" onclick="edit_address('{{$address->id}}')">Change</a>
                                    </div>
                                </div>
                                <!-- <hr> -->
                                <!-- <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left cart__table--body__list py-2">
                                                Address </td>
                                            <td
                                                class="checkout__total--calculated__text text-right cart__table--body__list py-2 ">
                                                {{ $address->address ?? ''}}</td>
                                        </tr>





                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left cart__table--body__list py-2">
                                                Country</td>
                                            <td
                                                class="checkout__total--calculated__text cart__table--body__list py-2 text-right ">
                                                {{ $country->name }}</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left cart__table--body__list py-2">
                                                State</td>
                                            <td
                                                class="checkout__total--calculated__text cart__table--body__list py-2 text-right ">
                                                {{ $state->name }}</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left cart__table--body__list py-2">
                                                City</td>
                                            <td
                                                class="checkout__total--calculated__text cart__table--body__list py-2 text-right ">
                                                {{ $city->name }}</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left cart__table--body__list py-2">
                                                Postal code</td>
                                            <td
                                                class="checkout__total--calculated__text cart__table--body__list py-2 text-right ">
                                                {{ $address->postal_code ?? ''}}</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left ">Phone</td>
                                            <td class="checkout__total--calculated__text  text-right ">{{ $address->phone ?? ''}}</td>
                                        </tr>
                                    </tbody>

                                </table> -->
                            </div>

                        </div>

                        @endforeach


                        <input type="hidden" name="shipping_type_{{ get_admin()->id }}" value="home_delivery">









                        @endif
                        <div class="order__confirmed--area border-radius-5 mb-15 bg-light">
                            <div class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#add_address">
                                    <i class="fa-solid fa-plus fa-2x"></i>
                                    <h3 class="order__confirmed--title h4 text-center">Add New Address</h3>
                                </a>
                            </div>

                        </div>

                        <div class="">
                            <button type="submit" class="btn bg-red text-white fs-4 py-3 btn-lg">Continue to Payment</button>
                        </div>
                    </form>
                </main>

            </div>
            <aside class="checkout__sidebar sidebar">
                <div class="cart__table checkout__product--table">
                    <table class="cart__table--inner">
                        <tbody class="cart__table--body">
                            @php
                            $productIds = session('productIds');
                            $cartIds = session('cartIds');



                            $carts = App\Models\Cart::whereIn('id', $cartIds)->get();
                            https://image-ap1.moengage.com/thesouledstoremoengage/20221003093333669940IGG5H4TSSLogoblackpngthesouledstoremoengage.png" class="gm-added gm-observing gm-observing-cb


                            @endphp
                            @foreach($carts as $cart)
                            @php $product = App\Models\Product::with('thumbnail')->where('id', $cart->product_id)->first(); @endphp
                            <tr class="cart__table--body__items">
                                <td class="cart__table--body__list">
                                    <div class="product__image two  d-flex align-items-center">
                                        <div class="product__thumbnail border-radius-5">
                                            <a href="#"><img class="border-radius-5" src="{{ isset($product->thumbnail->file_name) ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="cart-product"></a>

                                        </div>
                                        <div class="product__description">
                                            <h3 class="product__description--name h4 text-start"><a href="product-details.php">{{ $product->name }}</a></h3>
                                            @if($cart->type=='membership')
                                            <span class="product__description--variant text-dark">12 Month Membership</span>
                                            @else
                                            <span class="product__description--variant text-dark">COLOR-SIZE: {{ $cart->variation }}</span>

                                            @endif


                                        </div>
                                    </div>
                                </td>
                                <td class="cart__table--body__list">
                                    <span class="cart__price">Rs.{{ $cart->price }}</span>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- <div class="checkout__total">
                    <table class="checkout__total--table">
                        <tbody class="checkout__total--body">
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Subtotal </td>
                                <td class="checkout__total--amount text-right">Rs.860.00</td>
                            </tr>
                            <tr class="checkout__total--items">
                                <td class="checkout__total--title text-left">Shipping</td>
                                <td class="checkout__total--calculated__text text-right">Calculated at next step</td>
                            </tr>
                        </tbody>
                        <tfoot class="checkout__total--footer">
                            <tr class="checkout__total--footer__items">
                                <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                                    Total </td>
                                <td class="checkout__total--footer__amount checkout__total--footer__list text-right">
                                    Rs.860.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div> -->



                <div class="pt-0 pb-4 fs-3 fw-bold">Billing Details</div>
                <div class="single__widget widget__bg mb-5 rounded-0">
                    <div class="cart__summary--total mb-20">
                        <table class="cart__summary--total__table">
                            <tbody>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">Cart Total</td>
                                    <td class="cart__summary--amount text-right">₹ {{ session('cartTotal') }}</td>


                                </tr>

                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">GST</td>
                                    <td class="cart__summary--amount text-right"><span class="text-muted">₹ {{ session('gstTotal') }}</span></td>
                                </tr>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">Shipping Charges</td>

                                    <td class="cart__summary--amount text-right">₹ {{ session('shipingTotal') }}</td>
                                </tr>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">Member Discount </td>
                                    <td class="cart__summary--amount text-right"><span class="text-danger">₹ {{ session('discountTotal') }}</span></td>
                                </tr>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">BSDK Money Discount </td>
                                    <td class="cart__summary--amount text-right"><span class="text-danger">₹ {{ session('bsdkMoneyDiscount') }}</span></td>
                                </tr>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left fw-bold">Total Amount</td>
                                    <td class="cart__summary--amount text-right fw-bold">₹ {{ session('grandTotal') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</div>

<!-- new address modal start-->
<div class="modal fade modal-show" id="add_address" tabindex="-1" aria-labelledby="add_addressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_addressLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="checkout__content--step section__shipping--address">

                    <div class="section__shipping--address__content">
                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="address" placeholder="Address" type="text" required>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="phone" placeholder="Phone" required type="text">
                                        </label>
                                    </div>
                                </div>
                                @php
                                $countries = App\Models\Country::where('status','1')->orderBy('name')->get();
                                @endphp

                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">Country</label>
                                        <select required data-placeholder="Select a Country" class="js-example-placeholder-single js-states form-control" name="country_id">
                                            <option value="">Select your country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">State</label>
                                        <select required data-placeholder="Select a state" class="js-example-placeholder-single js-states form-control" name="state_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list checkout__input--select ">
                                        <label class="checkout__select--label" for="country">City</label>
                                        <select required data-placeholder="Select a city" class="js-example-placeholder-single js-states form-control" name="city_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-12">
                                    <div class="checkout__input--list">
                                        <label>
                                            <input class="checkout__input--field border-radius-5" name="postal_code" required placeholder="Postal code" type="text">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__checkbox">
                                <button type="submit" class="btn bg-red text-white fs-4 btn-lg">Save</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- new address modal end-->

<!-- new change address modal start-->
<div id="edit_modal_body"></div>

@section('script')




<script type="text/javascript">
    $(".js-example-placeholder-single").select2({
        dropdownParent: $('.modal-show'),

        placeholder: "Select a one",
        allowClear: true
    });
    $(".select-2").select2({
        dropdownParent: $('#change_add'),

        placeholder: "Select a one",
        allowClear: true
    });


    //for address


























    // $(document).on("click", "#coupon-apply", function() {
    //     var data = new FormData($('#apply-coupon-form')[0]);

    //     $.ajax({

    //         method: "POST",
    //         url: "{{ route('checkout.apply_coupon_code') }}",
    //         data: data,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(data, textStatus, jqXHR) {
    //             // AIZ.plugins.notify(data.response_message.response, data.response_message.message);
    //             $("#cart_summary").html(data.html);
    //             const Toastadd = Swal.mixin({
    //                 toast: true,
    //                 position: "top-end",
    //                 showConfirmButton: false,
    //                 timer: 3000,
    //                 timerProgressBar: true,
    //                 didOpen: (toast) => {
    //                     toast.onmouseenter = Swal.stopTimer;
    //                     toast.onmouseleave = Swal.resumeTimer;
    //                 }
    //             });
    //             Toastadd.fire({
    //                 icon: "success",
    //                 title: data.response_message.message
    //             });
    //         }
    //     })
    // });




    // $(document).on("click", "#coupon-remove", function() {
    //     var data = new FormData($('#remove-coupon-form')[0]);

    //     $.ajax({

    //         method: "POST",
    //         url: "{{ route('checkout.remove_coupon_code') }}",
    //         data: data,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(data, textStatus, jqXHR) {
    //             $("#cart_summary").html(data);
    //             const Toastre = Swal.mixin({
    //                 toast: true,
    //                 position: "top-end",
    //                 showConfirmButton: false,
    //                 timer: 3000,
    //                 timerProgressBar: true,
    //                 didOpen: (toast) => {
    //                     toast.onmouseenter = Swal.stopTimer;
    //                     toast.onmouseleave = Swal.resumeTimer;
    //                 }
    //             });
    //             Toastre.fire({
    //                 icon: "success",
    //                 title: "Remove Coupon Code Successfully !"
    //             });
    //         }
    //     })
    // })



    // let editorBtn = document.getElementById('editorBtn');
    // let element = document.getElementById('editor');

    // editorBtn.addEventListener('click', function(e) {
    //     e.preventDefault();

    //     if (element.isContentEditable) {
    //         // Disable Editing
    //         element.contentEditable = 'false';
    //         editorBtn.innerHTML = 'Edit';
    //         // You could save any changes here.
    //     } else {
    //         element.contentEditable = 'true';
    //         editorBtn.innerHTML = 'Save';
    //     }
    // });
</script>




<script type="text/javascript">
    // function add_new_address(){
    //     $('#new-address-modal').modal('show');
    // }

    function edit_address(address) {
        var url = '{{ route("addresses.edit", ":id") }}';
        url = url.replace(':id', address);

        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: url,
            type: 'GET',
            success: function(response) {
                $('#edit_modal_body').html(response.html);
                $('#change_add').modal('show');

            }
        });
    }

    $(document).on('change', '[name=country_id]', function() {
        var country_id = $(this).val();
        get_states(country_id);
    });

    $(document).on('change', '[name=state_id]', function() {
        var state_id = $(this).val();
        get_city(state_id);
    });

    function get_states(country_id) {
        var csrfToken = '{{ csrf_token() }}';

        $('[name="state"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "{{route('get-state')}}",
            type: 'POST',
            data: {
                country_id: country_id
            },
            success: function(response) {
                var obj = JSON.parse(response);
                if (obj != '') {
                    $('[name="state_id"]').html(obj);
                    // AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }

    function get_city(state_id) {
        var csrfToken = '{{ csrf_token() }}';
        $('[name="city"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                state_id: state_id
            },
            success: function(response) {
                var obj = JSON.parse(response);
                if (obj != '') {
                    $('[name="city_id"]').html(obj);
                    // AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
</script>



@endsection
@endsection