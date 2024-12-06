@php
$cartTotal = 0;
$gstTotal = 0;
$shipingTotal = 0;
$discountTotal = 0;
$coupenNumber = '';


$cartids= [];
$productIds = [];





@endphp
@foreach($carts as $cart)
@php
$cartids[] = $cart->id;
$productIds[] = $cart->product_id;

$cartTotal += $cart->price*$cart->quantity;

$gstTotal += $cart->tax*$cart->quantity;
$shipingTotal += $cart->shipping_cost*$cart->quantity;
$discountTotal += $cart->discount*$cart->quantity;
$coupenNumber =$cart->coupon_code;
@endphp
@endforeach

@php
use Carbon\Carbon;
$userId = auth()->id();
$totalPoints = App\Models\BsdkPoint::where('user_id', $userId)->where('expires_at', '>', Carbon::now())->sum('points');

$grandTotall = ($cartTotal+$gstTotal+$shipingTotal)-$discountTotal;

$pointDiscountInPercent = ($grandTotall*20)/100;




$bsdkMoney = $totalPoints/2;


if($pointDiscountInPercent>$bsdkMoney)
{
$pointDiductAmount = $bsdkMoney;

}else{
$pointDiductAmount = $pointDiscountInPercent;
}

$grandTotal = $grandTotall-$pointDiductAmount;

@endphp














<div class="ps-lg-5 p-0">

    <div class="widget__area">

        <div class="single__widget widget__bg mb-5 rounded-0">
            <ul class="widget__categories--menu">
                <li class="widget__categories--menu__list rounded-0  border-top-0 border-start-0 border-end-0 pb-2 ps-0 mb-2">
                    <label class="widget__categories--menu__label d-flex align-items-center px-0">
                        <img src="{{ asset('assets/frontend/img/icon/gift-card.svg') }}" width="25">
                        <span class="widget__categories--menu__text">Apply Coupon</span>
                        <svg class="widget__categories--menu__arrowdown--icon end-0" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="cursrentColor"></path>
                        </svg>
                    </label>
                    <div class="widget__categories--sub__menu">
                        <div class="coupon__code p-3">
                            <p class="coupon__code--desc">Enter your coupon code if you have one.</p>
                            <div class="coupon__code--field d-flex">




                                @if (isset($cart->discount) > 0 && isset($cart->coupon_code) !=null)

                                <form class="d-flex" id="remove-coupon-form" enctype="multipart/form-data">
                                    @csrf

                                    <label><input class="coupon__code--field__input rounded-0" readonly disabled name="code" placeholder="Coupon code" value="{{ $cart->coupon_code ?? ''}}" type="text" required></label>
                                    <button class="coupon__code--field__btn primary__btn rounded-0 bg-dark" type="button" id="coupon-remove">Change Coupon</button>

                                </form>



                                @else









                                <form class="d-flex" id="apply-coupon-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] ?? ''}}">

                                    <label><input class="coupon__code--field__input rounded-0" name="code" placeholder="Coupon code" value="{{ $coupenNumber ?? ''}}" type="text" required></label>
                                    <button class="coupon__code--field__btn primary__btn rounded-0 bg-dark" type="button" id="coupon-apply">Apply Now</button>

                                </form>

                                @endif

                            </div>
                        </div>
                    </div>
                </li>
                <!-- <li class="widget__categories--menu__list  rounded-0 border-top-0 border-start-0 border-end-0 pb-2 mb-2 px-0">
                    <label class="widget__categories--menu__label d-flex align-items-center px-0">
                        <img src="{{ asset('assets/frontend/img/icon/gift-card.svg') }}" width="25">
                        <span class="widget__categories--menu__text">Gift Voucher</span>
                        <svg class="widget__categories--menu__arrowdown--icon end-0" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <div class="widget__categories--sub__menu">
                        <div class="coupon__code p-3">
                            <p class="coupon__code--desc">Enter your Gift Voucher code if you have one.</p>
                            <div class="coupon__code--field d-flex">
                                <label><input class="coupon__code--field__input rounded-0" placeholder="Voucher code" type="text"></label>
                                <button class="coupon__code--field__btn primary__btn rounded-0 bg-dark" type="submit">Apply Now</button>
                            </div>
                        </div>
                    </div>
                </li> -->

                <!-- <li class="widget__categories--menu__list  rounded-0 border-top-0 border-start-0 border-end-0 pb-2 mb-2 px-0">
                    <label class="widget__categories--menu__label d-flex align-items-center px-0">
                        <img src="{{ asset('assets/frontend/img/icon/gift-wrap.svg') }}" width="25">
                        <span class="widget__categories--menu__text">Gift Wrap (25)</span>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" class="me-0 ms-auto">

                    </label>
                </li> -->
                <li class="widget__categories--menu__list rounded-0 border-0 pb-2 mb-2 px-0">
                    <label class="widget__categories--menu__label d-flex align-items-center px-0">
                        <img src="{{ asset('assets/frontend/img/icon/gift-money.svg') }}" width="25">
                        <span class="widget__categories--menu__text">BSDK Money/BSDK Points</span>
                        <svg class="widget__categories--menu__arrowdown--icon end-0" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <div class="widget__categories--sub__menu">
                        <div class="coupon__code p-3">




                            <p>BSDK Points <span class="text-success fs-6">(Active BSDK Points: {{$totalPoints ?? 0}})</span></p>

                            <p>BSDK Money <span class="text-success fs-6">(BSDK Money Balance: ₹ {{$bsdkMoney ?? 0}})</span></p>








                            <!-- <div class="coupon__code--field d-flex">
                                <label><input class="coupon__code--field__input rounded-0" placeholder="TSS Points" type="text"></label>
                                <button class="coupon__code--field__btn primary__btn rounded-0 bg-dark" type="submit">Apply Now</button>
                            </div> -->
                        </div>
                    </div>
                </li>
        </div>
    </div>

    <div class="pt-0 pb-4 fs-3 fw-bold">Billing Details</div>
    <div class="single__widget widget__bg mb-5 rounded-0">
        <div class="cart__summary--total mb-20">
            <table class="cart__summary--total__table">
                <tbody>
                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">Cart Total</td>
                        <td class="cart__summary--amount text-right">₹ {{ $cartTotal ?? '0'}}</td>
                        @php
                        session([
                        'cartIds' => $cartids,
                        'productIds' => $productIds,
                        'gstTotal' => $gstTotal,
                        'cartTotal' => $cartTotal ?? '0',
                        'shipingTotal' => $shipingTotal ?? '0',
                        'discountTotal' => $discountTotal ?? '0',
                        'grandTotal' => $grandTotal ?? '0',
                        'bsdkMoneyDiscount' => number_format($pointDiductAmount, 2) ?? '0'
                        ]);


                        @endphp
                    </tr>

                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">GST</td>
                        <td class="cart__summary--amount text-right"><span class="text-muted">₹ {{ $gstTotal ?? '0'}}</span></td>
                    </tr>
                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">Shipping Charges</td>

                        <td class="cart__summary--amount text-right">₹ {{ $shipingTotal ?? '0'}}</td>
                    </tr>
                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">Member Discount </td>
                        <td class="cart__summary--amount text-right"><span class="text-danger">₹ {{ $discountTotal ?? '0'}}</span></td>
                    </tr>

                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">BSDK Money Discount </td>
                        <td class="cart__summary--amount text-right"><span class="text-danger">₹ {{ number_format($pointDiductAmount, 2) ?? '0'}}</span></td>
                    </tr>

                    <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left fw-bold">Total Amount</td>
                        <td class="cart__summary--amount text-right fw-bold">₹ {{ $grandTotal ?? '0'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="cart__summary--footer">

            <ul class="d-flex justify-content-between">
                <li><button class="cart__summary--footer__btn primary__btn cart rounded-0" type="button"><a href="{{ route('checkout.checkoutProduct') }}" class="text-white">Checkout</a></button></li>
            </ul>
        </div>
    </div>


</div>