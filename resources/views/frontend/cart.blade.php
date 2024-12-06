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
<style>
.newsletter__popup--footer {
    position: absolute;
    top: 80% !important;
    left: 10%;
    width: 80%;
    text-align: center;
}

.newsletter__popup--inner {

overflow: inherit !important;
border-radius: 35px !important;
}
.newsletter__popup--close__btn {
    position: absolute;
    top: -10px !important;
    right: -8px !important;
    
}

.newsletter__popup--subscribe__btn {
    width: 100%;
    height: auto !important;
    background: var(--secondary-color);
    color: var(--white-color);
    border: 0;
    padding: 1.25rem 2rem !important;
    font-size: 2.15rem !important;
    text-transform: uppercase;
    font-weight: 500;
    border-radius: 5px;
    margin-top: 1.5rem;
}
.newsletter__popup--inner {
    width: 655px !important;
    /*height: 83vh !important;*/
}
 @media screen and (max-width: 460px) {
     
     .newsletter__popup--subscribe__btn {
    height: auto !important;
    padding: .5rem 2rem !important;
    font-size: 1.55rem !important;
    margin-top: 0px !important;
}
     
 }
</style>
@section('content')
<main class="main__content_wrapper">





    <!-- cart section start -->
    <section class="cart__section section--padding">
        <div class="container-fluid">
            <div class="cart__section--inner">


                <div class="row">
                    <div class="col-lg-8">
                        <!--billing address-->
                        <div class="delv_address d-flex align-items-center w-100 p-5 border mb-5">
                            <div class="row w-100">
                                <div class="col-lg-9">
                                    <div id="editor">
                                        <div class="fw-bold fs-3"> SHEIN STYLE STORES</div>
                                        Shop No 19 Hauz Khas Village, Cafe Pink, Delhi Estimated delivery by 09 Nov
                                    </div>
                                </div>
                                <div class="col-lg-3 d-flex align-items-center">
                                    <div class="d-grid gap-2 col-2 ms-auto me-3">
                                        <button class="bg-transparent border-0 text-danger" type="button">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        @if(count($carts) == 0)
                        <p>Your Cart is empty. Add some items!</p>

                        @endif


                        @php
                        $cartTotalPrice=0;
                        $totalGst = 0;
                        $TotalSippingCost = 0;
                        $totalAmount =0;

                        @endphp
                        @foreach($carts as $cart)

                        @php

                        $cartTotalPrice += $cart->price* $cart->quantity;
                        $totalGst += $cart->tax*$cart->quantity;

                        $product = App\Models\Product::with('thumbnail')->where('id', $cart->product_id)->first();


                        $TotalSippingCost += $product->shipping_cost*$cart->quantity;



                        $totalAmount = $TotalSippingCost+$cartTotalPrice+$totalGst;

                        @endphp

                        <div class="row border-bottom pb-5 mb-5 border-secondary-subtle">
                            <div class="col-xl-3 col-lg-3 col-12">
                                <div class="car_img_holder col-lg-3 col-12 rounded-4">
                                    <a href="{{ route('product', $product->slug) }}"><img class="border-radius-5" src="{{ isset($product->thumbnail->file_name) ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" width="100%" alt="cart-product"></a>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-12">
                                <h4 class="cart__content--title pb-2 pt-lg-0 pt-3"><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h4>
                                <div class="text-muted">{{ $product->name }}</div>
                                <div class="text-muted">Qty:{{ $cart->quantity }}</div>

                                
                                <div class="d-flex gap-3">
                               




                                @if($cart->type=='membership')
                                
                                <div class="">
                                    <span>12 Month Membership</span>
                                </div>

                            </div>
                            
                            @else

                            <div class="">
                                   <span class="text-muted">Color-Size:</span>
                                </div>
                                <div class="">
                                    <span>{{ $cart->variation }}</span>
                                </div>

                            </div>

                            <div class="">
                                    <span class="text-muted">Estimated Delivery</span> <span class="text-dark">{{ $product->est_shipping_days }} Days</span>
                                </div>
                            @endif










                               
                            </div>
                            <div class="col-lg-4 col-12 col-md-10">
                                <div class="product__details--info__price mb-lg-10 mb-0 text-lg-end text-start">
                                    <!-- <span class="old__price">₹ {{ $product->unit_price }}</span> -->


                                    
                                    <span class="current__price">₹ {{ $cart->price }}</span>
                                </div>
                                <div class="pt-lg-5 pt-3 text-right d-lg-block d-flex">
                                    <a href="{{ route('cart.removeFromCart', $cart->id) }}" class="coupon__code--field__btn primary__btn mb-lg-3 mb-0 me-0 ms-auto d-block w-100 rounded-0 text-white bg-dark text-center">Remove</a>

                                </div>
                            </div>
                        </div>


                        @endforeach
                        <!--/prd row-->





                    </div>
                    <div class="col-lg-4 " id="cart_summary">
                        @include('frontend.cart_summary')
                    </div>




                </div>
            </div>
            </form>
        </div>
        </div>
    </section>
    <!-- cart section end -->
    <section class="p-5 bg-dark">
        <div class="row">
            <div class="container">
                <h3 class=" text-white text-center">Affordable Indian Street Wear Brand</h3>
            </div>
        </div>
    </section>
    <section class="p-5">
        <div class="row">
            <div class="container">
                <h3 class="text-center">Become part of Happy Customers</h3>
            </div>
        </div>
    </section>





</main>


<div class="modal fade" id="payModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered payModelOpt">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="paySidebaar border p-4">

                            <div class="fs-3 fw-bold">Order Summary</div>

                            <div class="bg-white p-3 mt-3">
                                <div class="d-flex">
                                    <div class="col-3">
                                        <img src="{{ asset('assets/frontend/img/product/product5.png') }}" class="img-fluid">
                                    </div>
                                    <div class="col-8 me-0 ms-auto">
                                        <div class="fs-4 fw-bold">Black Panther: Long Live The King</div>

                                        <div class="d-flex">
                                            <div class="col-5 text-secondary fs-4">
                                                Quantity 1
                                            </div>
                                            <div class="col text-secondary fs-4 ms-auto me-0 text-end">
                                                Price: 1850.00
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-3 mt-4">
                                <div class="cart__summary--total mb-20">
                                    <table class="cart__summary--total__table">
                                        <tbody>
                                            <tr class="cart__summary--total__list">
                                                <td class="cart__summary--total__title text-left">Cart Total</td>
                                                <td class="cart__summary--amount text-right">₹ 1198.20</td>
                                            </tr>
                                            <tr class="cart__summary--total__list">
                                                <td class="cart__summary--total__title text-left">Member Discount</td>
                                                <td class="cart__summary--amount text-right"><span class="text-danger">₹ 250.48</span></td>
                                            </tr>
                                            <tr class="cart__summary--total__list">
                                                <td class="cart__summary--total__title text-left">GST</td>
                                                <td class="cart__summary--amount text-right"><span class="text-muted">₹ 73.28</span></td>
                                            </tr>
                                            <tr class="cart__summary--total__list">
                                                <td class="cart__summary--total__title text-left">Shipping Charges</td>
                                                <td class="cart__summary--amount text-right">₹ 0</td>
                                            </tr>
                                            <tr class="cart__summary--total__list">
                                                <td class="cart__summary--total__title text-left fw-bold">Total Amount</td>
                                                <td class="cart__summary--amount text-right fw-bold">₹ 73.28</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class=" p-4 border border-1">
                            <div class="payScroller">
                                <!--pay opt row-->
                                <div class="p-4 d-flex align-items-center border-bottom">
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/frontend/img/icon/upi.svg') }}" class="me-4">
                                            <span class="fs-3 fw-bold">UPI</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 me-0 ms-auto">
                                        <div class="product__details--info__price mb-10 text-right ">
                                            <span class="old__price me-4">₹ 1,850</span>
                                            <span class="text-black fs-2 fw-bold">₹ 110</span>
                                        </div>
                                        <div class="me-0 ms-auto d-table bg-danger fs-5 text-light px-3 py-0">5% Discounte</div>
                                        <span class="d-table fs-5 me-0 ms-auto text-secondary">Free Shipping</span>
                                    </div>
                                </div>
                                <!--/ pay opt row-->
                                <!--pay opt row-->
                                <div class="p-4 d-flex border-bottom align-items-center">
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/frontend/img/icon/card.svg') }}" class="me-4">
                                            <span class="fs-3 fw-bold">Card/Card EMI</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 me-0 ms-auto">
                                        <div class="product__details--info__price mb-10 text-right ">
                                            <span class="old__price me-4">₹ 1,850</span>
                                            <span class="text-black fs-2 fw-bold">₹ 110</span>
                                        </div>
                                        <div class="me-0 ms-auto d-table bg-danger fs-5 text-light px-3 py-0">5% Discounte</div>
                                        <span class="d-table fs-5 me-0 ms-auto text-secondary">Free Shipping</span>
                                    </div>
                                </div>
                                <!--/ pay opt row-->
                                <!--pay opt row-->
                                <div class="p-4 d-flex border-bottom align-items-center">
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/frontend/img/icon/wallets.svg') }}" class="me-4">
                                            <span class="fs-3 fw-bold">Wallets</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 me-0 ms-auto">
                                        <div class="product__details--info__price mb-10 text-right ">
                                            <span class="old__price me-4">₹ 1,850</span>
                                            <span class="text-black fs-2 fw-bold">₹ 110</span>
                                        </div>
                                        <div class="me-0 ms-auto d-table bg-danger fs-5 text-light px-3 py-0">5% Discounte</div>
                                        <span class="d-table fs-5 me-0 ms-auto text-secondary">Free Shipping</span>
                                    </div>
                                </div>
                                <!--/ pay opt row-->
                                <!--pay opt row-->
                                <div class="p-4 d-flex border-bottom align-items-center">
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/frontend/img/icon/net-banking.svg') }}" class="me-4">
                                            <span class="fs-3 fw-bold">Net Banking</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 me-0 ms-auto">
                                        <div class="product__details--info__price mb-10 text-right ">
                                            <span class="old__price me-4">₹ 1,850</span>
                                            <span class="text-black fs-2 fw-bold">₹ 110</span>
                                        </div>
                                        <div class="me-0 ms-auto d-table bg-danger fs-5 text-light px-3 py-0">5% Discounte</div>
                                        <span class="d-table fs-5 me-0 ms-auto text-secondary">Free Shipping</span>
                                    </div>
                                </div>
                                <!--/ pay opt row-->

                                <!--pay opt row-->
                                <div class="p-4 d-flex border-bottom align-items-center">
                                    <div class="col-lg-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/frontend/img/icon/net-banking.svg') }}" class="me-4">
                                            <span class="fs-3 fw-bold">Net Banking</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 me-0 ms-auto">
                                        <div class="product__details--info__price mb-10 text-right ">
                                            <span class="old__price me-4">₹ 1,850</span>
                                            <span class="text-black fs-2 fw-bold">₹ 110</span>
                                        </div>
                                        <div class="me-0 ms-auto d-table bg-danger fs-5 text-light px-3 py-0">5% Discounte</div>
                                        <span class="d-table fs-5 me-0 ms-auto text-secondary">Free Shipping</span>
                                    </div>
                                </div>
                                <!--/ pay opt row-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$user=Auth::user();
$memberShipStatus = $user->is_membership_valid;

$cart = App\Models\Cart::where(['user_id' => $user->id, 'product_id' => '28'])->first();

if(!empty($cart))
{
    $membershipCartStatus =1;
}else{
    $membershipCartStatus =0;
}


@endphp

@if($memberShipStatus == 0 && $membershipCartStatus==0)
<!-- Start News letter popup -->
<div class="newsletter__popup" data-animation="slideInUp">
    <div id="boxes" class="newsletter__popup--inner">
        <button class="newsletter__popup--close__btn" aria-label="search close button">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg>
        </button>
        <div class="box newsletter__popup--box d-flex align-items-center">
            <div class="newsletter_img_box">
                <img class="newsletter__popup--thumbnail__img display-block" src="{{ asset('assets/frontend/img/banner/membership2.png') }}" height="100px" alt="newsletter-popup-thumb">
                <div class="newsletter__popup--footer">
                <a href="{{ route('addMenbership',28) }}" class="newsletter__popup--subscribe__btn">YES! SHOP AT DISCOUNTED PRICES</a>
               </div>
            
            </div>
           
        </div>
    </div>
</div>
<!-- End News letter popup -->

@endif


@section('script')

<script type="text/javascript">
    $(document).on("click", "#coupon-apply", function() {
        var data = new FormData($('#apply-coupon-form')[0]);

        $.ajax({

            method: "POST",
            url: "{{ route('checkout.apply_coupon_code') }}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data, textStatus, jqXHR) {
               
                // AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                $("#cart_summary").html(data.html);
                const Toastadd = Swal.mixin({
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
                Toastadd.fire({
                    icon: "success",
                    title: data.response_message.message
                }).then(function() {
					location.reload();
                });
            }
           
        })
    });




    $(document).on("click", "#coupon-remove", function() {
        var data = new FormData($('#remove-coupon-form')[0]);

        $.ajax({

            method: "POST",
            url: "{{ route('checkout.remove_coupon_code') }}",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data, textStatus, jqXHR) {
                
                $("#cart_summary").html(data);
                const Toastre = Swal.mixin({
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
                Toastre.fire({
                    icon: "success",
                    title: "Remove Coupon Code Successfully !"
                }).then(function() {
					location.reload();
                });
                
            }
        })
        
    })



    let editorBtn = document.getElementById('editorBtn');
    let element = document.getElementById('editor');

    editorBtn.addEventListener('click', function(e) {
        e.preventDefault();

        if (element.isContentEditable) {
            // Disable Editing
            element.contentEditable = 'false';
            editorBtn.innerHTML = 'Edit';
            // You could save any changes here.
        } else {
            element.contentEditable = 'true';
            editorBtn.innerHTML = 'Save';
        }
    });
</script>
@endsection
@endsection