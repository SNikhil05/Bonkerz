@extends('frontend.layouts.app')
@section('content')
<main class="main__content_wrapper">

    <section class="my__account--section section--padding">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">

                    @include('frontend.partial.profilenav')
                </div>

                <div class="col-md-8">
                    <div class="my__account--section__inner border-radius-10">
                        <main class="main__content_wrapper">
                            <form action="#">
                                <div class="checkout__content--step section__shipping--address pt-0">
                                    <div class="section__header  position__relative mb-25">

                                        <h2 class="section__header--title h3">Order ID #{{ $order->code }}</h2>

                                    </div>

                                    <div class="customer__information--area border-radius-5">
                                        <h3 class="customer__information--title  mb-5">Order Summary</h3>
                                        <div class="customer__information--inner flex-wrap flex-md-nowrap d-flex gap-5">
                                            <div class="customer__information--list">
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Order Code:-</h4>
                                                    <ul>
                                                        <li>{{ $order->code }}</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Customer:-</h4>
                                                    <ul>
                                                        <li>{{ json_decode($order->shipping_address)->name }}</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Email:</h4>
                                                    <ul>
                                                        @if ($order->user_id != null)
                                                        <li>{{ $order->user->email }}</li>
                                                        @endif




                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap justify-content-between">
                                                    <h4 class="customer__information--subtitle h5 w-50">Shipping
                                                        address:</h4>
                                                    <ul class="w-50 text-end">
                                                        <li>{{ json_decode($order->shipping_address)->address }},
                                                            {{ json_decode($order->shipping_address)->city }},
                                                            @if(isset(json_decode($order->shipping_address)->state)) {{ json_decode($order->shipping_address)->state }} - @endif
                                                            {{ json_decode($order->shipping_address)->postal_code }},
                                                            {{ json_decode($order->shipping_address)->country }}
                                                        </li>
                                                    </ul>
                                                </div>


                                            </div>
                                            <div class="customer__information--list">
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Order Date:-</h4>
                                                    <ul>
                                                        <li>{{ date('d-m-Y H:i A', $order->date) }}</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Order Status:-
                                                    </h4>
                                                    <ul>
                                                        <li>{{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="customer__information--subtitle h5">Total Order
                                                        Amount:</h4>
                                                    <ul>
                                                        <li> {{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap justify-content-between">
                                                    <h4 class="customer__information--subtitle h5 w-50">Shipping
                                                        Method:</h4>
                                                    <ul class="w-50 text-end">
                                                        <li>Flat Shipping rate</li>
                                                    </ul>
                                                </div>
                                                <div class="customer__information--step d-flex flex-wrap justify-content-between">
                                                    <h4 class="customer__information--subtitle h5 w-50">Payment
                                                        Method:</h4>
                                                    <ul class="w-50 text-end">
                                                        <li>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</li>
                                                    </ul>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="customer__information--area border-radius-5 my-5">
                                        <h3 class="customer__information--title  mb-5">Order Details</h3>
                                        <div class="table-responsive">
                                            <table class="table border">
                                                <thead class="">
                                                    <tr class="border">
                                                        <th class="border">#</th>
                                                        <th class="border">Image</th>
                                                        <th class="border">Product</th>
                                                        <th class="border">Variation</th>
                                                        <th class="border">Quantity</th>
                                                        <th class="border">Delivery Type</th>
                                                        <th class="border">Price</th>
                                                        @if (addon_is_activated('refund_request'))
                                                        <th class="border">Refund</th>
                                                        @endif

                                                        <th class="border">Review</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="">
                                                    @foreach ($order->orderDetails as $key => $orderDetail)


                                                    @php

                                                    $product = App\Models\Product::where('id', $orderDetail->product_id)->first();

                                                    $imagesArray = explode(',', $product->photos);
                                                    $uploadsImage = App\Models\Upload::where('id',$imagesArray[0])->first();




                                                    @endphp




                                                    <tr class="">
                                                        <td class="border">{{ sprintf('%02d', $key+1) }}</td>
                                                        <td class="border"><img src="{{ isset($uploadsImage->file_name) ? my_asset($uploadsImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" width="60" class="img-fluid">
                                                        </td>
                                                        <td class="border">
                                                            @if ($orderDetail->product != null && $orderDetail->product->auction_product == 0)
                                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                                            @elseif($orderDetail->product != null && $orderDetail->product->auction_product == 1)
                                                            {{ $orderDetail->product->name }}
                                                            @else
                                                            <strong>Product Unavailable</strong>
                                                            @endif
                                                        </td>
                                                        <td class="border">{{ $orderDetail->variation }}</td>
                                                        <td class="border">{{ $orderDetail->quantity }}</td>
                                                        <td class="border">
                                                            @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                                            Home Delivery
                                                            @elseif ($order->shipping_type == 'pickup_point')
                                                            @if ($order->pickup_point != null)
                                                            {{ $order->pickup_point->name }} Pickip Point
                                                            @else
                                                            Pickup Point
                                                            @endif
                                                            @elseif($order->shipping_type == 'carrier')
                                                            @if ($order->carrier != null)
                                                            {{ $order->carrier->name }} Carrier
                                                            <br>
                                                            Transit Time - {{ $order->carrier->transit_time }}
                                                            @else
                                                            Carrier
                                                            @endif
                                                            @endif
                                                        </td>
                                                        <td class="border">{{ single_price($orderDetail->price) }}</td>



                                                        @if (addon_is_activated('refund_request'))
                                                        @php
                                                        $no_of_max_day = get_setting('refund_request_time');
                                                        $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                                        $today_date = Carbon\Carbon::now();
                                                        @endphp
                                                        <td class="border">
                                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->payment_status == 'paid' && $orderDetail->delivery_status == 'delivered')
                                                                <a href="{{ route('refund_request_send_page', $orderDetail->id) }}" class="btn btn-primary btn-sm rounded-0">Send</a>
                                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                                <b class="text-info">Pending</b>
                                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 2)
                                                                <b class="text-success">Rejected</b>
                                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                                <b class="text-success">Approved</b>
                                                                @elseif ($orderDetail->product->refundable != 0)
                                                                <b>N/A</b>
                                                                @else
                                                                <b>Non-refundable</b>
                                                                @endif
                                                        </td>
                                                        @endif
                                                        <td class="border">



                                                            @if ($orderDetail->delivery_status == 'delivered')
                                                            <a href="javascript:void(0);" onclick="product_review('{{ $orderDetail->product_id }}')" class="btn bg-red btn-lg text-white"> Review </a>
                                                            @else
                                                            <span class="btn rounded bg-red fs-5 text-white">Not Delivered Yet</span>
                                                            @endif





                                                        </td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="checkout__total customer__information--area ms-auto customer__information--list border-radius-5">
                                        <table class="checkout__total--table">
                                            <tbody class="checkout__total--body">
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Subtotal </td>
                                                    <td class="checkout__total--amount text-right">{{ single_price($order->orderDetails->sum('price')) }}</td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Shipping</td>
                                                    <td class="checkout__total--calculated__text text-right">{{ single_price($order->orderDetails->sum('shipping_cost')) }}
                                                    </td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Tax</td>
                                                    <td class="checkout__total--calculated__text text-right">{{ single_price($order->orderDetails->sum('tax')) }}
                                                    </td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Coupon</td>
                                                    <td class="checkout__total--calculated__text text-right">-{{ single_price($order->coupon_discount) }}
                                                    </td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">BSDK Money Point </td>
                                                    <td class="checkout__total--calculated__text text-right"> {{ round($order->bsdk_money_discount*2) }}
                                                    </td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">BSDK Money Discount </td>
                                                    <td class="checkout__total--calculated__text text-right">-{{ single_price($order->bsdk_money_discount ?? 0) }}
                                                    </td>
                                                </tr>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Other Discount </td>
                                                    <td class="checkout__total--calculated__text text-right">-{{ single_price($order->other_discount ?? 0) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="checkout__total--footer">
                                                <tr class="checkout__total--footer__items">
                                                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                                                        Total </td>
                                                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">
                                                        {{ single_price($order->grand_total) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </form>

                        </main>
                    </div>

                </div>

            </div>
        </div>

    </section>
</main>

@section('script')
@endsection
@endsection