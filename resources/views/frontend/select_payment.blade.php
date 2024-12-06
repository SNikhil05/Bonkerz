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
        <div class="checkout__page--inner d-flex">
            <div class="main checkout__mian">
                <header class="main__header checkout__mian--header mb-30">

                    <!-- <details class="order__summary--mobile__version">
                        <summary class="order__summary--toggle border-radius-5">
                            <span class="order__summary--toggle__inner">
                                <span class="order__summary--toggle__icon">
                                    <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="order__summary--toggle__text show">
                                    <span>Show order summary</span>
                                    <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg"
                                        class="order-summary-toggle__dropdown" fill="currentColor">
                                        <path
                                            d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="order__summary--final__price">Rs.227.70</span>
                            </span>
                        </summary>
                        <div class="order__summary--section">
                            <div class="cart__table checkout__product--table">
                                <table class="summary__table">
                                    <tbody class="summary__table--body">
                                        <tr class=" summary__table--items">
                                            <td class=" summary__table--list">
                                                <div class="product__image two  d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a href="product-details.php"><img class="border-radius-5"
                                                                src="assets/img/product/small-product7.png"
                                                                alt="cart-product"></a>
                                                        <span class="product__thumbnail--quantity">1</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h3 class="product__description--name h4"><a
                                                                href="product-details.php">Fresh-whole-fish</a></h3>
                                                        <span class="product__description--variant">COLOR: Blue</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" summary__table--list">
                                                <span class="cart__price">Rs.65.00</span>
                                            </td>
                                        </tr>
                                        <tr class="summary__table--items">
                                            <td class=" summary__table--list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a href="product-details.php"><img class="border-radius-5"
                                                                src="assets/img/product/small-product2.png"
                                                                alt="cart-product"></a>
                                                        <span class="product__thumbnail--quantity">1</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h3 class="product__description--name h4"><a
                                                                href="product-details.php">Vegetable-healthy</a></h3>
                                                        <span class="product__description--variant">COLOR: Green</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" summary__table--list">
                                                <span class="cart__price">Rs.82.00</span>
                                            </td>
                                        </tr>
                                        <tr class=" summary__table--items">
                                            <td class=" summary__table--list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a href="product-details.php"><img class="border-radius-5"
                                                                src="assets/img/product/small-product4.png"
                                                                alt="cart-product"></a>
                                                        <span class="product__thumbnail--quantity">1</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h3 class="product__description--name h4"><a
                                                                href="product-details.php">Raw-onions-surface</a></h3>
                                                        <span class="product__description--variant">COLOR: White</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" summary__table--list">
                                                <span class="cart__price">Rs.78.00</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Subtotal </td>
                                            <td class="checkout__total--amount text-right">Rs.860.00</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Shipping</td>
                                            <td class="checkout__total--calculated__text text-right">Calculated at next
                                                step</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__total--footer">
                                        <tr class="checkout__total--footer__items">
                                            <td
                                                class="checkout__total--footer__title checkout__total--footer__list text-left">
                                                Total </td>
                                            <td
                                                class="checkout__total--footer__amount checkout__total--footer__list text-right">
                                                Rs.860.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </details> -->
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














                    <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $cartss[0]['owner_id'] }}">

                        <div class="card rounded-0 border shadow-none">
                            <!-- Additional Info -->
                            <div class="card-header p-4 d-block border-bottom-0">



                                <div class="card-header p-0 border-bottom-0">
                                    <h3 class="fs-4 fw-700 text-dark mb-0">
                                        Select a payment option
                                    </h3>
                                </div>
                                <!-- Payment Options -->
                                <div class="card-body text-center px-4 pt-0">
                                    <div class="row">












                                        <!-- Cash Payment -->
                                        @if (get_setting('cash_payment') == 1)
                                        @php
                                        $digital = 0;
                                        $cod_on = 1;
                                        foreach ($cartss as $cartItem) {
                                        $product = get_single_product($cartItem['product_id']);
                                        if ($product['digital'] == 1) {
                                        $digital = 1;
                                        }
                                        if ($product['cash_on_delivery'] == 0) {
                                        $cod_on = 0;
                                        }
                                        }
                                        @endphp
                                        @if ($digital != 1 && $cod_on == 1)
                                        <div class="col-3 gx-0">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="cash_on_delivery" class="online_payment" type="radio" name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/cod.png') }}" class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span class="d-block fw-600 fs-5">Cash on Delivery</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        @endif
                                        @endif






                                        <!-- razorpay -->

                                        <div class="col-3 gx-0">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="razorpay" class="online_payment" type="radio" name="payment_option">
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/rozarpay.png') }}" class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span class="d-block fw-600 fs-5">Razorpay</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>











                                        @if (Auth::check())
                                        <!-- Offline Payment -->
                                        @if (addon_is_activated('offline_payment'))
                                        @foreach (get_all_manual_payment_methods() as $method)
                                        <div class="col-6 gx-0">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="{{ $method->heading }}" type="radio" name="payment_option" class="offline_payment_option" onchange="toggleManualPaymentData({{ $method->id }})" data-id="{{ $method->id }}" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ uploaded_asset($method->photo) }}" class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span class="d-block fw-600 fs-5">{{ $method->heading }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        @endforeach

                                        @foreach (get_all_manual_payment_methods() as $method)
                                        <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                            @php echo $method->description @endphp
                                            @if ($method->bank_info != null)
                                            <ul>
                                                @foreach (json_decode($method->bank_info) as $key => $info)
                                                <li>Bank Name -
                                                    {{ $info->bank_name }},
                                                    Account Name -
                                                    {{ $info->account_name }},
                                                    Account Number -
                                                    {{ $info->account_number }},
                                                    Routing Number -
                                                    {{ $info->routing_number }}
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                        @endforeach
                                        @endif
                                        @endif
                                    </div>

                                    <!-- Offline Payment Fields -->
                                    @if (addon_is_activated('offline_payment'))
                                    <div class="d-none mb-3 rounded border bg-white p-3 text-left">
                                        <div id="manual_payment_description">

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Transaction ID <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control mb-3" name="trx_id" id="trx_id" placeholder="'Transaction ID" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Photo</label>
                                            <div class="col-md-9">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            Browse</div>
                                                    </div>
                                                    <div class="form-control file-amount">Choose image
                                                    </div>
                                                    <input type="hidden" name="photo" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Wallet Payment -->
                                    <!-- @if (Auth::check() && get_setting('wallet_system') == 1)
                                    <div class="py-4 px-4 text-center bg-soft-secondary-base mt-4">
                                        <div class="fs-14 mb-3">
                                            <span class="opacity-80">Your wallet balance</span>
                                            <span class="fw-700">{{ single_price(Auth::user()->balance) }}</span>
                                        </div>
                                        @if (Auth::user()->balance < $total)
                                            <button type="button" class="btn btn-secondary" disabled>
                                               Insufficient balance
                                            </button>
                                        @else
                                            <button type="button" onclick="use_wallet()"
                                                class="btn btn-primary fs-14 fw-700 px-5 rounded-0">
                                               Pay with wallet
                                            </button>
                                        @endif
                                    </div>
                                @endif -->
                                </div>

                                <!-- Agree Box -->
                                <div class="minicart__conditions text-start justify-content-start">
                                    <input class="minicart__conditions--input" id="agree_checkbox" type="checkbox" required>
                                    <label class="minicart__conditions--label fs-5" for="agree_checkbox">I agree with the <a class="minicart__conditions--link" href="#">Terms & Conditions,</a>
                                        <a class="minicart__conditions--link" href="#">Privacy Policy</a></label>
                                </div>
                                <!-- <div class="pt-3 ">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" required id="agree_checkbox">
                                    <span class="aiz-square-check"></span>
                                    <span class="fs-6">I agree to the  <a href=""
                                    class="fw-700">terms and conditions</a>,
                                <a href=""
                                    class="fw-700">return policy</a> &
                                <a href=""
                                    class="fw-700">privacy policy</a></span>
                                </label>
                               
                            </div> -->

                                <div class="row align-items-center pt-3 px-4 mb-4">
                                    <!-- Return to shop -->
                                    <div class="col-6 gx-0">
                                        <a href="{{ route('home') }}" class="btn btn-link text-dark fs-5 m-0 p-0 fw-700 px-0">
                                            <i class="fas fa-arrow-left pe-2"></i>
                                            Return to shop
                                        </a>
                                    </div>
                                    <!-- Complete Ordert -->
                                    <div class="col-6 text-right">
                                        <button type="submit" class="bg-red btn fw-700 px-4 py-3 fs-4 rounded text-white">Complete Order</button>
                                    </div>
                                </div>
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





                <div class="pt-0 pb-4 fs-3 fw-bold">Billing Details</div>
                <div class="single__widget widget__bg mb-5 rounded-0">
                    <div class="cart__summary--total mb-20">
                        <table class="cart__summary--total__table">
                            <tbody>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left">Cart Total</td>
                                    <td class="cart__summary--amount text-right">₹ {{ session('cartTotal') }}</td>
                                    <input type="hidden" id="sub_total" value="{{ session('cartTotal') }}">


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
                                    <td class="cart__summary--total__title text-left">Other Discount </td>
                                    <td class="cart__summary--amount text-right"><span class="text-danger">₹ <span id="otherDiscount">0</span></span></td>
                                </tr>
                                <tr class="cart__summary--total__list">
                                    <td class="cart__summary--total__title text-left fw-bold">Total Amount</td>
                                    <td class="cart__summary--amount text-right fw-bold">₹ <span id="totalAmount">{{ session('grandTotal') }}</span></td>
                                </tr>

                                @php

                                $totaPay = session('grandTotal');
                                @endphp

                                <input type="hidden" value="{{ $totaPay }}" id="totalPay">
                            </tbody>
                        </table>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</div>




@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        $(".online_payment").click(function() {
            $('#manual_payment_description').parent().addClass('d-none');
        });
        toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));





        $('input[name="payment_option"]').change(function() {


            if ($(this).val() == 'razorpay') {

                let grandTotal = $('#totalPay').val();



                let otherDiscount = grandTotal * 5 / 100;
                let newGrandTotal = grandTotal - otherDiscount;


                $('#otherDiscount').text(otherDiscount);
                $('#totalAmount').text(newGrandTotal);

            } else {
                let grandTotal = $('#totalPay').val();

                let otherDiscount = 0;
                let newGrandTotal = grandTotal;

                $('#otherDiscount').text(otherDiscount);
                $('#totalAmount').text(newGrandTotal);
            }
        });
    });






    // var minimum_order_amount_check = {
    //     {
    //         get_setting('minimum_order_amount_check') == 1 ? 1 : 0
    //     }
    // };
    // var minimum_order_amount = {
    //     {
    //         get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0
    //     }
    // };

    // function use_wallet() {
    //     $('input[name=payment_option]').val('wallet');
    //     if ($('#agree_checkbox').is(":checked")) {
    //         ;
    //         if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
    //             // AIZ.plugins.notify('danger',
    //             //     '{{ translate('You order amount is less then the minimum order amount') }}');



    //             alert('You order amount is less then the minimum order amount');





    //         } else {
    //             $('#checkout-form').submit();
    //         }
    //     } else {
    //         alert('You need to agree with our policies');
    //         //AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
    //     }
    // }



    function toggleManualPaymentData(id) {
        if (typeof id != 'undefined') {
            $('#manual_payment_description').parent().removeClass('d-none');
            $('#manual_payment_description').html($('#manual_payment_info_' + id).html());
        }
    }
</script>



@endsection
@endsection