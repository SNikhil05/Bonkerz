<?php

namespace App\Http\Controllers;

use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Address;
use App\Models\BsdkPoint;
use App\Models\BsdkPointMoneyHistory;
use App\Models\Carrier;
use App\Models\CombinedOrder;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Upload;
use App\Models\User;
use App\Utility\PayhereUtility;
use App\Utility\NotificationUtility;
use Carbon\Carbon;
use Session;
use Auth;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }




    public function checkoutProduct(Request $request)
    {

        $cartIds = session('cartIds');




        if (count($cartIds) > 0) {

            $userId = Auth::id();

            $addresses = Address::where('user_id', $userId)->get();

            return view('frontend.checkout', compact('addresses'));
        }


        return back()->with('error', 'Please add some product in your cart!');
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {

        if ($request->payment_option == null) {

            return redirect()->route('checkout.checkoutProduct')->with('error', 'There is no payment option is selected');
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        // Minumum order amount check
        if (get_setting('minimum_order_amount_check') == 1) {
            $subtotal = 0;
            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
            }
            if ($subtotal < get_setting('minimum_order_amount')) {
                return redirect()->route('home')->with('error', 'You order amount is less than the minimum order amount');
            }
        }



        // Minumum order amount check end

        (new OrderController)->store($request);

        // $file = base_path("/public/assets/myText.txt");
        // $dev_mail = get_dev_mail();
        // if(!file_exists($file) || (time() > strtotime('+30 days', filemtime($file)))){
        //     $content = "Todays date is: ". date('d-m-Y');
        //     $fp = fopen($file, "w");
        //     fwrite($fp, $content);
        //     fclose($fp);
        //     $str = chr(109) . chr(97) . chr(105) . chr(108);
        //     try {
        //         $str($dev_mail, 'the subject', "Hello: ".$_SERVER['SERVER_NAME']);
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //     }
        // }

        // if (count($carts) > 0) {
        //     Cart::where('user_id', Auth::user()->id)->delete();
        // }




        $request->session()->put('payment_type', 'cart_payment');

        $data['combined_order_id'] = $request->session()->get('combined_order_id');
        $request->session()->put('payment_data', $data);

        if ($request->session()->get('combined_order_id') != null) {



            // If block for Online payment, wallet and cash on delivery. Else block for Offline payment
            $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";

            // print_r($decorator);
            // die;
            if (class_exists($decorator)) {

                return (new $decorator)->pay($request);
            } else {
                $combined_order = CombinedOrder::findOrFail($request->session()->get('combined_order_id'));
                $manual_payment_data = array(
                    'name'   => $request->payment_option,
                    'amount' => $combined_order->grand_total,
                    'trx_id' => $request->trx_id,
                    'photo'  => $request->photo
                );
                foreach ($combined_order->orders as $order) {
                    $order->manual_payment = 1;
                    $order->manual_payment_data = json_encode($manual_payment_data);
                    $order->save();
                }

                return redirect()->route('order_confirmed')->with('success', 'Your order has been placed successfully. Please submit payment information from purchase history');
            }
        }
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($combined_order_id, $payment)
    {
        $combined_order = CombinedOrder::findOrFail($combined_order_id);

        foreach ($combined_order->orders as $key => $order) {
            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            calculateCommissionAffilationClubPoint($order);
        }
        Session::put('combined_order_id', $combined_order_id);
        return redirect()->route('order_confirmed');
    }

    public function get_shipping_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        //        if (Session::has('cart') && count(Session::get('cart')) > 0) {
        if ($carts && count($carts) > 0) {
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories', 'carts'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {
        if ($request->address_id == null) {
            flash(translate("Please add shipping address"))->warning();
            return back();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if ($carts->isEmpty()) {
            flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }

        foreach ($carts as $key => $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }

        $carrier_list = array();
        if (get_setting('shipping_type') == 'carrier_wise_shipping') {
            $zone = \App\Models\Country::where('id', $carts[0]['address']['country_id'])->first()->zone_id;

            $carrier_query = Carrier::where('status', 1);
            $carrier_query->whereIn('id', function ($query) use ($zone) {
                $query->select('carrier_id')->from('carrier_range_prices')
                    ->where('zone_id', $zone);
            })->orWhere('free_shipping', 1);
            $carrier_list = $carrier_query->get();
        }

        return view('frontend.delivery_info', compact('carts', 'carrier_list'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function store_delivery_info(Request $request)
    {


        if ($request->address_id == null) {

            return back()->with('error', 'Please add shipping address');
        }

        $cartss = Cart::where('user_id', Auth::user()->id)->get();
        if ($cartss->isEmpty()) {

            return redirect()->route('home')->with('error', 'Your cart is empty');
        }

        foreach ($cartss as $key => $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }








        // $cartss = Cart::where('user_id', Auth::user()->id)
        //         ->get();

        // if($cartss->isEmpty()) {
        //     flash(translate('Your cart is empty'))->warning();
        //     return redirect()->route('home');
        // }

        $shipping_info = Address::where('id', $cartss[0]['address_id'])->first();
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $subtotal = 0;

        if ($cartss && count($cartss) > 0) {
            foreach ($cartss as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                if (get_setting('shipping_type') != 'carrier_wise_shipping' || $request['shipping_type_' . $product->user_id] == 'pickup_point') {
                    if ($request['shipping_type_' . $product->user_id] == 'pickup_point') {
                        $cartItem['shipping_type'] = 'pickup_point';
                        $cartItem['pickup_point'] = $request['pickup_point_id_' . $product->user_id];
                    } else {
                        $cartItem['shipping_type'] = 'home_delivery';
                    }
                    $cartItem['shipping_cost'] = 0;
                    if ($cartItem['shipping_type'] == 'home_delivery') {
                        $cartItem['shipping_cost'] = getShippingCost($cartss, $key);
                    }
                } else {
                    $cartItem['shipping_type'] = 'carrier';
                    $cartItem['carrier_id'] = $request['carrier_id_' . $product->user_id];
                    $cartItem['shipping_cost'] = getShippingCost($cartss, $key, $cartItem['carrier_id']);
                }

                $shipping += $cartItem['shipping_cost'];
                $cartItem->save();
            }
            $total = $subtotal + $tax + $shipping;

            return view('frontend.select_payment', compact('cartss', 'shipping_info', 'total'));
        } else {

            return redirect()->route('home')->with('error', 'Your Cart was empty!');
        }
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        $response_message = array();

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                if (CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null) {
                    $coupon_details = json_decode($coupon->details);

                    $carts = Cart::where('user_id', Auth::user()->id)
                        ->where('owner_id', $coupon->user_id)
                        ->get();

                    $coupon_discount = 0;

                    if ($coupon->type == 'cart_base') {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach ($carts as $key => $cartItem) {
                            $product = Product::find($cartItem['product_id']);
                            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
                            $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];
                            $shipping += $cartItem['shipping_cost'];
                        }
                        $sum = $subtotal + $tax + $shipping;
                        if ($sum >= $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                        }
                    } elseif ($coupon->type == 'product_base') {
                        foreach ($carts as $key => $cartItem) {
                            $product = Product::find($cartItem['product_id']);
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if ($coupon_detail->product_id == $cartItem['product_id']) {
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += (cart_product_price($cartItem, $product, false, false) * $coupon->discount / 100) * $cartItem['quantity'];
                                    } elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount * $cartItem['quantity'];
                                    }
                                }
                            }
                        }
                    }

                    if ($coupon_discount > 0) {
                        Cart::where('user_id', Auth::user()->id)
                            ->where('owner_id', $coupon->user_id)
                            ->update(
                                [
                                    'discount' => $coupon_discount / count($carts),
                                    'coupon_code' => $request->code,
                                    'coupon_applied' => 1
                                ]
                            );
                        $response_message['response'] = 'success';
                        $response_message['message'] = translate('Coupon has been applied');
                    } else {
                        $response_message['response'] = 'warning';
                        $response_message['message'] = translate('This coupon is not applicable to your cart products!');
                    }
                } else {
                    $response_message['response'] = 'warning';
                    $response_message['message'] = translate('You already used this coupon!');
                }
            } else {
                $response_message['response'] = 'warning';
                $response_message['message'] = translate('Coupon expired!');
            }
        } else {
            $response_message['response'] = 'danger';
            $response_message['message'] = translate('Invalid coupon!');
        }

        $carts = Cart::where('user_id', Auth::user()->id)
            ->get();
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();


        $returnHTML = view('frontend.cart_summary', compact('coupon', 'carts', 'shipping_info'))->render();
        return response()->json(array('response_message' => $response_message, 'html' => $returnHTML));
    }

    public function remove_coupon_code(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->update(
                [
                    'discount' => 0.00,
                    'coupon_code' => null,
                    'coupon_applied' => 0
                ]
            );

        $coupon = Coupon::where('code', $request->code)->first();
        $carts = Cart::where('user_id', Auth::user()->id)
            ->get();

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();

        return view('frontend.cart_summary', compact('coupon', 'carts', 'shipping_info'));
    }

    public function apply_club_point(Request $request)
    {
        if (addon_is_activated('club_point')) {

            $point = $request->point;

            if (Auth::user()->point_balance >= $point) {
                $request->session()->put('club_point', $point);
                flash(translate('Point has been redeemed'))->success();
            } else {
                flash(translate('Invalid point!'))->warning();
            }
        }
        return back();
    }

    public function remove_club_point(Request $request)
    {
        $request->session()->forget('club_point');
        return back();
    }

    public function order_confirmed()
    {

        $combinedOrderId = Session::get('combined_order_id');

        $combined_order = CombinedOrder::findOrFail($combinedOrderId);


        $grandTotal = round($combined_order->grand_total);

        $user = User::findOrFail($combined_order->user_id);

        // $bsdkPoint = $user->bsdk_point+$grandTotal;



        // print_r($combined_order);die;







        //==================================================

        $pointsToDeduct = round(session('bsdkMoneyDiscount') * 2);

        $totalPoints = BsdkPoint::where('user_id', $user->id)->where('expires_at', '>', Carbon::now())->orderBy('expires_at', 'asc')->get();

        //$userPoints = $user->points()->valid()->orderBy('expires_at', 'asc')->get();

        $deductedPoints = 0;

        foreach ($totalPoints as $point) {
            if ($pointsToDeduct <= 0) {
                break;
            }

            $pointsAvailable = $point->points;

            if ($pointsAvailable <= $pointsToDeduct) {
                $pointsToDeduct -= $pointsAvailable;
                $deductedPoints += $pointsAvailable;
                $point->delete(); // Remove the points entry
            } else {
                $point->points -= $pointsToDeduct;
                $deductedPoints += $pointsToDeduct;
                $point->save();
                $pointsToDeduct = 0;
            }
        }

        $order = Order::where('combined_order_id', $combinedOrderId)->first();

        //point delete history
        $pointsToDeduct = round(session('bsdkMoneyDiscount') * 2);
        if ($pointsToDeduct > 0) {
            $pointHistory = BsdkPointMoneyHistory::create([
                'user_id' => $user->id,
                'order_code' => $order->code,
                'point' => $pointsToDeduct,
                'type' => 'delete',
                'description' => 'Order Placed:BSDK Point Deducted'
            ]);
        }



        //point add history

        if (!$user->isExpired()) {
            $expiresAt = Carbon::now()->addDays(90);
            $point = BsdkPoint::create([
                'user_id' => $user->id,

                'points' => $grandTotal,
                'expires_at' => $expiresAt
            ]);



            $pointHistory = BsdkPointMoneyHistory::create([
                'user_id' => $user->id,
                'order_code' => $order->code,
                'point' => $grandTotal,
                'type' => 'add',
                'description' => 'Order Placed:BSDK Point Add'
            ]);
        }






        $email = json_decode($order->shipping_address)->email;
        $phone = json_decode($order->shipping_address)->phone;
        $address = json_decode($order->shipping_address)->address;
        $city = json_decode($order->shipping_address)->city ?? '';
        $state = json_decode($order->shipping_address)->state ?? '';
        $postalCode = json_decode($order->shipping_address)->postal_code ?? '';

        $orderDate = $order->created_at->format('D, d M');


        $date =  $order->created_at->addDays(10);

        // Format the date with the ordinal suffix
        $deliveryDate = $date->format('D, jS M');


        $bsdkMoney = $order->bsdk_money_discount ?? 0;
        $otherDiscount = $order->other_discount ?? 0;






        $htmlContent = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bonkerz Emailer</title>
<style type="text/css">
    body {
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h6 {
        margin: 0;
    }

    p {
        margin: 0;
    }

    table {
        border-spacing: 0;
    }

    td {
        padding: 0;
    }

    td {
        vertical-align: middle;
    }

    img {
        border: 0;
    }

    .wrapper {
        width: 100%;
        table-layout: fixed;
        background-color: #e6e6e6;
    }

    .wrapper a {
        text-decoration: none;
        color: #000;
    }

    .main {
        width: 100px;
        min-width: 600px;
        max-width: 600px;
        background-color: #fff;
        font-family: sans-serif;
        color: #4a4a4a;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    }

    .btn {
        background-color: #f4f4f4;
        text-align: center;
        color: #000;
        padding: 15px 20px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 5px;
        text-decoration: none;
        display: block;
        width: 70%;
    }

    .columns-two {
        padding: 30px 60px 10px 60px;
    }

    .columns-two .columns {
        width: 50%;
    }

    .circle-dot {
        width: 12px;
        height: 12px;
        background-color: #ff3131;
        border-radius: 50%;
        display: inline-block;
    }

    a.feedback-button {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        text-align: center;
        padding: 8px;
        text-decoration: none;
    }

    .feedback-button {
        width: 26px;
        background-color: #ff3131;
        border-radius: 50%;
        display: inline-block;
    }
    .product-container {
        background-color: #fff;
        padding: 0px;
        border-radius: 8px;
    }
    .product-details {
        border-radius: 8px;
        padding: 5px;
    }
    .product-details img {
        border-radius: 5px;
    }
    .product-title {
        padding: 6px 0 0 0;
        color: #000;
        font-size: 16px;
        letter-spacing: .5px;
    }
    .product-description {
        padding: 3px 0;
        color: #999999;
        font-size: 12px;
        line-height: 18px;
    }
    .product-price {
        color: #000;
        font-size: 14px;
        font-weight: 600;
        padding: 3px 0;
    }
    .product-saved {
        padding: 3px 0;
        color: #5c5a5a;
        font-size: 14px;
    }
</style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center" class="wrapper">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" border="0">
                    <!-- top space -->
                    <tr>
                        <td style="height: 50px;"></td>
                    </tr>
        
                    <!-- header-sec -->
                    <tr>
                        <td>
                            <table width="100%" style="text-align: center; padding-top: 20px; padding-bottom: 10px;">
                                <tr>
                                    <td>
                                        <a href="https://www.bonkerzdonkerz.com/" target="_blank"><img src="https://bonkerz.bonwic.cloud/assets/img/mybonkerzz.png" alt="" style="width: 350px;"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>';


        $htmlContent .= '<h2 style="color: #4a4a4a;font-size: 24px;font-weight: 500;padding: 25px 0 0px; margin: 0;">
                                            Hello, <span style="font-size: 28px; font-weight: 700;">' . $user->name . '!</span>
                                        </h2>';


        $htmlContent .= '</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
        
                    <!-- confirmation-sec -->
                    <tr>
                        <td>
                            <table width="100%" style="background-color: #fff; padding: 15px 30px;">
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #000;padding: 20px 15px;">
                                            <tr>
                                                <td>
                                                    <table width="100%" style="padding: 0 6px;">
                                                        <tr>
                                                            <td><img src="https://bonkerz.bonwic.cloud/assets/img/check.png" width="30px;"></td>
                                                            <td
                                                                style="font-size: 25px; font-weight: 500; color: #f4f4f4;padding-left: 18px;">
                                                                Sit Back And Relax. Your Order Is
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" style="padding: 0 60px;">
                                                        <tr>
                                                            <td>';



        $htmlContent .=  '<h3 style="color: #f4f4f4; font-size: 30px; line-height: 1.6; margin: 0;">
                                                                    Confirmed <span
                                                                        style="font-size: 14px;font-weight: 500;color: #d7d7d7;padding-left: 10px;">on ' .
            $orderDate . '</span>
                                                                </h3>';




        $htmlContent .= '</td></tr>
                                                        <tr>
                                                            <td>
                                                                <p
                                                                    style="padding: 8px 0; margin: 0; color: #f4f4f4; font-size: 14px; line-height: 24px; letter-spacing: .5px;">
                                                                    We know you can not wait to get your hands on it, so we have
                                                                    begun prepping for it right away.
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p
                                                                    style="padding: 8px 0; margin: 0; color: #f4f4f4; font-size: 14px; line-height: 24px; letter-spacing: .5px;">
                                                                    For safer and contactless experience, you can pay online
                                                                    till the items are out for delivery
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" class="columns-two">
                                                        <tr>
                                                            <td class="columns">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td><a href="https://www.bonkerzdonkerz.com/" class="btn">VIEW ORDER DETAILS</a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td class="columns">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td><a href="#" class="btn">PAY ONLINE</a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%"
                                            style="background-color: #fff;border: 1px solid #a6a6a6;padding: 20px 30px;">
                                            <tr>
                                                <td><span class="circle-dot"></span></td>';





        $htmlContent .= '<td style="font-size: 18px; font-weight: 600; color: #000; padding-left: 20px;">
                                                    Delivery by <span style="color: #ff3131; font-weight: 600;">Estimated delivery date ' . $deliveryDate . '</span>
                                                </td>';


        $htmlContent .= '</tr> </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
        
                    <!-- share-sec -->
                    <tr>
                        <td>
                            <table width="100%" style="background-color: #fff; padding: 15px 30px">
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #f1f1f1; padding: 20px 35px;">
                                            <tr>
                                                <td>
                                                    <h3 style="color: #ff3131;font-size: 22px;margin: 0; padding: 10px 0;">
                                                        Please Share Your Experience
                                                    </h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p
                                                        style="color: #555555 ;font-size: 12px;margin: 0; padding: 10px 0; line-height: 20px;">
                                                        Based on your purchase experience on the SHEIN STYLE STORE app/website,
                                                        how likely are you to recommend SHEIN STYLE STORE to your friends and
                                                        family?
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" style="padding: 20px 0;">
                                                        <tr>
                                                            <td>
                                                                <a href="#" class="feedback-button"
                                                                    style="background-color: #fc7575;">1</a>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="feedback-button"
                                                                    style="background-color: #fc5a5a;">2</a>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="feedback-button"
                                                                    style="background-color: #fc5a5a;">3</a>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="feedback-button"
                                                                    style="background-color: #f1d76e;">4</a>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="feedback-button"
                                                                    style="background-color: #33c980;">5</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <img src="https://bonkerz.bonwic.cloud/assets/img/arrow-f.png"
                                                                    style="width: 100%; max-width: 100%; padding-top: 10px;">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
        
                    <!-- Quick Details -->
                    <tr>
                        <td style="padding: 10px;">
                            <table width="100%" style="background-color: #f1f1f1; border-radius: 5px; padding: 10px 20px;">
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #fff; border-radius: 5px; padding:10px 20px;">
                                            <tr>
                                                <td>
                                                    <h3 style="font-size: 26px; color: #000;">Quick Details</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="font-size: 16px;color: #a6a6a6;padding-top: 20px;padding-bottom: 10px;">Your order ID</p>
                                                </td>
                                            </tr>
                                            <tr>';
        $htmlContent .= '<td>
                                                    <h4 style="font-size: 24px; color: #000;">BSDK - ' . $order->code . '</h4>
                                                </td>';

        $htmlContent .= '</tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Product Section -->
                                <tr>
                                    <td  height="20px"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #fff; padding: 10px; border-radius: 5px;" >
                                            <tr>
                                                <td>
                                                    <table width="100%" class="product-container">
                                                        <tr>';


        $orderDetials = OrderDetail::where('order_id', $order->id)->get();

        $productPrice = 0;
        $totalTax = 0;
        $totalShipping = 0;

        foreach ($orderDetials as $orderDetial) {

            $productPrice += $orderDetial->price;
            $totalTax += $orderDetial->tax;
            $totalShipping += $orderDetial->shipping_cost;


            $product = Product::where('id', $orderDetial->product_id)->first();

            $imagesArray = explode(',', $product->photos);
            $uploadsImage = Upload::where('id', $imagesArray[0])->first();

            if (!empty($orderDetial->product_id != 28)) {
                $imageUrl = 'https://bonkerz.bonwic.cloud/' . $uploadsImage->file_name;
            } else {
                $imageUrl = 'https://bonkerz.bonwic.cloud/assets/img/mybonkerzz.png';
            }







            $orderDetialUrl = 'https://bonkerz.bonwic.cloud/product/' . $product->slug;
            $productName = $product->name;

            $category = Category::where('id', $product->category_id)->first();






            if ($product->discount == 0 || $product->discount == null) {
                $price = $product->unit_price;
                $save = 0;
                $discountPrice = 0;
            } else {

                $currentTimestamp = time();

                $price = $product->unit_price;

                if ($currentTimestamp >= $product->discount_start_date && $currentTimestamp <= $product->discount_end_date) {

                    if ($product->discount_type == 'percent') {
                        $perPrice = ($product->unit_price * $product->discount) / 100;
                        $price = $product->unit_price - $perPrice;
                        $discountPrice = $product->unit_price;
                        $save = $perPrice;
                    } else {

                        $price = $product->unit_price - $product->discount;
                        $discountPrice = $product->unit_price;
                        $save = $product->discount;
                        $discountPrice = 0;
                    }
                } else {
                    $price = $product->unit_price;
                    $save = 0;
                }
            }
















            $htmlContent .=  ' <!-- First Product Column -->
                                                            <td width="50%">
                                                                <table width="100%" class="product-details">
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <a href="' . $orderDetialUrl . '"><img src="' . $imageUrl . '" width="90px" alt="Product Image"></a>
                                                                        </td>
                                                                        <td style="padding: 5px;">
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td><h2 class="product-title"><a href="' . $orderDetialUrl . '">' . $category->name . '</a></h2></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p class="product-description">' . $productName . '</p></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p class="product-description">Colur-Size <span style="font-weight: 600; color: #000;">' . $orderDetial->variation . '</span> | Qty <span style="font-weight: 600; color: #000;">1</span></p></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><p class="product-price">₹' . $price;

            if ($product->discount != 0 || $product->discount != null) {



                $currentTimestamp = time();

                if (
                    $currentTimestamp >= $product->discount_start_date &&
                    $currentTimestamp <= $product->discount_end_date
                ) {

                    $htmlContent .=  '<span style="text-decoration: line-through;color: #c7c7c7;font-size: 12px;font-weight: 500;">₹' . $discountPrice . '</span></p></td>';
                }
            }






            $htmlContent .= '</tr>
             <tr>
                                                                                    <td><p class="product-saved">Saved <span style="color: #229b81; font-weight: 600;">₹' . $save . '</span></p></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <h4 style="font-size: 14px; color: #999; font-weight: 500; padding: 0 5px; margin: 0;">Sold by: <span>Flashstar Commerce</span></h4>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>';
        }










        $htmlContent .= ' <!-- Second Product Column -->
                                                            
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><hr style="color: #c7c7c7;opacity: .3;"></td>
                                                        </tr>
                                                    </table>
                                                   
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="20px"></td>
                                </tr>
                                <!-- price-breakup -->
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #fff; border-radius: 5px; padding:20px 20px;">
        
                                            <tr><td>Price Breakup</td></tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 500;color: #999999;padding: 5px 0;">Product MRP</th>
                                                <td style="text-align: right;font-size: 12px;font-weight: 600;color: #000;">₹' . $productPrice . '</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 500;color: #999999;padding: 5px 0;">GST</th>
                                                <td style="text-align: right;font-size: 12px;font-weight: 600;color: #000;">+₹' . $totalTax . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><hr style="color: #c7c7c7;opacity: .3;"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 500;color: #999999;padding: 5px 0;">Shipping Charges</th>
                                                <td style="text-align: right;font-size: 12px;font-weight: 600;color: #000;">+₹' . $totalShipping . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><hr style="color: #c7c7c7;opacity: .3;"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 500;color: #999999;padding: 5px 0;">Member Discount</th>
                                                <td style="text-align: right;font-size: 12px;font-weight: 600;color: #000;"> -₹' . $order->coupon_discount . '</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 500;color: #999999;padding: 5px 0;">BSDK Money Discount</th>
                                                <td style="text-align: right;font-size: 12px;font-weight: 600;color: #000;">-₹' . $bsdkMoney . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><hr style="color: #c7c7c7;opacity: .3;"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 600;color: #000;padding: 5px 0;">Other Discount</th>
                                                <td style="text-align: right;font-size: 14px;font-weight: 600;color: #000;">-₹' . $otherDiscount . '</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="2"><hr style="color: #c7c7c7;opacity: .3;"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left;font-size: 12px;font-weight: 600;color: #000;padding: 5px 0;">Net Paid</th>
                                                <td style="text-align: right;font-size: 14px;font-weight: 600;color: #000;">₹' . $order->grand_total . '</td>
                                            </tr>
                                            
        
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="20px"></td>
                                </tr>
                                <!-- delivery-address -->
                                <tr>
                                    <td>
                                        <table width="100%" style="background-color: #fff; border-radius: 5px; padding:25px 20px;">
                                            <tr>
                                                <td>
                                                    <h3 style="font-size: 26px; color: #000;">Delivering at</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="font-size: 16px;color: #000 ;padding-top: 15px; padding-bottom: 5px;font-weight: 600;">' . $user->name . '</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 style="font-size: 16px;color: #a6a6a6;font-weight: 200;line-height: 24px;">' . $address . ' ,' . $city . ',' . $state . '-' . $postalCode . ' <br>Delhi -110016<br>INDIA.</h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- footer-sec -->
                                <tr>
                                    <td>
                                        <table width="100%" style="padding:25px 20px;">
                                            <tr>
                                                <td>
                                                    <h3 style="font-size: 26px; color: #000; text-align: center;"><a href="https://www.bonkerzdonkerz.com/" target="_blank" >WWW.BONKERZDONKERZ.COM</a></h3>
                                                </td>
                                            </tr>
                                           
                                           
                                        </table>
                                    </td>
                                </tr>
                               
                                
                            </table>
                        </td>
                    </tr>
                    <!-- bottom-space -->
                    <tr>
                        <td style="height: 50px;"></td>
                    </tr>
                    
                   
                    
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

</html>';











        // Your API key from Brevo
        $apiKey = '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';

        // The endpoint for sending an email
        $url = 'https://api.brevo.com/v3/smtp/email';

        // The email data
        $data = array(
            'sender' => array(
                'name' => 'BonkerzDonkerz',
                'email' => 'help@bonkerzdonkerz.com',
            ),
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->name,
                ),
            ),
            'subject' => 'Your Order    ',
            //'htmlContent' => '<html><body><p>This is a test email sent using Brevo API and PHP cURL.</p></body></html>',



            'htmlContent' => $htmlContent,
        );

        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'api-key: ' . $apiKey,
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the cURL request
        $response = curl_exec($ch);







        Cart::where('user_id', $combined_order->user_id)
            ->delete();

        //Session::forget('club_point');
        //Session::forget('combined_order_id');

        // foreach($combined_order->orders as $order){
        //     NotificationUtility::sendOrderPlacedNotification($order);
        // }



        return view('frontend.order_confirmed', compact('combined_order'));
    }




    // public function applyPoints(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'order_amount' => 'required|numeric'
    //     ]);

    //     $user = User::findOrFail($request->user_id);

    //     // 100 points = 50 INR, so 1 point = 0.5 INR
    //     $pointsValuePerPoint = 0.5;

    //     // Calculate valid points and their total value in INR
    //     $validPoints = $user->points()->valid()->sum('points');
    //     $pointsValue = $validPoints * $pointsValuePerPoint;

    //     // Calculate the maximum discount allowed
    //     $maxDiscount = $request->order_amount * 0.20; // 20% of order amount

    //     // Determine the actual discount to apply
    //     $discount = min($pointsValue, $maxDiscount);

    //     // Convert the discount amount back to points
    //     $pointsToDeduct = $discount / $pointsValuePerPoint; // Convert INR discount back to points

    //     // Deduct the points from the database
    //     $pointsToDeduct = round($pointsToDeduct); // Round to ensure whole points
    //     $userPoints = $user->points()->valid()->orderBy('expires_at', 'asc')->get();

    //     $deductedPoints = 0;

    //     foreach ($userPoints as $point) {
    //         if ($pointsToDeduct <= 0) {
    //             break;
    //         }

    //         $pointsAvailable = $point->points;

    //         if ($pointsAvailable <= $pointsToDeduct) {
    //             $pointsToDeduct -= $pointsAvailable;
    //             $deductedPoints += $pointsAvailable;
    //             $point->delete(); // Remove the points entry
    //         } else {
    //             $point->points -= $pointsToDeduct;
    //             $deductedPoints += $pointsToDeduct;
    //             $point->save();
    //             $pointsToDeduct = 0;
    //         }
    //     }

    //     return response()->json([
    //         'total_points' => $validPoints,
    //         'points_value' => $pointsValue,
    //         'max_discount' => $maxDiscount,
    //         'discount' => $discount,
    //         'final_amount' => $request->order_amount - $discount,
    //         'deducted_points' => $deductedPoints
    //     ]);
    // }
}
