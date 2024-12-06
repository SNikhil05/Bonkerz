<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    public function shipToTransfer(Request $request)
    {



        $order_details = Order::with('orderDetails')->where('id', $request->order_id)->first()->toArray();


        $billingDetails  = json_decode($order_details['shipping_address'], true);

        $order_details['order_id'] = $order_details['id'];
        $order_details['order_date'] = $order_details['created_at'];
        $order_details['pickup_location'] = "Primary";
        $order_details['channel_id'] = "5044231";
        $order_details['comment'] = "New Order";
        $order_details['billing_customer_name'] = $billingDetails['name'];
        $order_details['billing_last_name'] = "";
        $order_details['billing_address'] = $billingDetails['address'];
        $order_details['billing_address_2'] = "";
        $order_details['billing_city'] = $billingDetails['city'];
        $order_details['billing_pincode'] = $billingDetails['postal_code'];
        $order_details['billing_state'] = $billingDetails['state'];;
        $order_details['billing_country'] = $billingDetails['country'];
        $order_details['billing_email'] = $billingDetails['email'];
        $order_details['billing_phone'] = $billingDetails['phone'];
        $order_details['shipping_is_billing'] = true;
        $order_details['shipping_customer_name'] = $billingDetails['name'];
        $order_details['shipping_last_name'] = "";
        $order_details['shipping_address'] = $billingDetails['address'];
        $order_details['shipping_address_2'] = "";
        $order_details['shipping_city'] = $billingDetails['city'];
        $order_details['shipping_pincode'] = $billingDetails['postal_code'];
        $order_details['shipping_state'] = $billingDetails['state'];
        $order_details['shipping_country'] = $billingDetails['country'];
        $order_details['shipping_email'] = $billingDetails['email'];
        $order_details['shipping_phone'] = $billingDetails['phone'];

        $shippingAmount = 0;
        foreach ($order_details['order_details'] as $key => $item) {

            $product = Product::where('id',  $item['product_id'])->first();

            $otherDiscount = $order_details['other_discount'] ?? 0;

            $order_details['order_items'][$key]['name'] =  $product->name;
            $order_details['order_items'][$key]['sku'] = $item['variation'];
            $order_details['order_items'][$key]['units'] = $item['quantity'];
            $order_details['order_items'][$key]['selling_price'] = $item['price'];
            $order_details['order_items'][$key]['discount'] = number_format($otherDiscount, 2);
            $order_details['order_items'][$key]['tax'] = $item['tax'];
            $order_details['order_items'][$key]['hsn'] = "";
            $shippingAmount += $item['shipping_cost'];
        }
        $order_details['payment_method'] = 'Prepaid';
        $order_details['shipping_charges'] = $shippingAmount;
        $order_details['giftwrap_charges'] = 0;
        $order_details['transaction_charges'] = 0;
        $order_details['total_discount'] = $order_details['coupon_discount'];
        $order_details['sub_total'] = $order_details['grand_total'];
        $order_details['length'] = $request->length;
        $order_details['breadth'] = $request->breadth;
        $order_details['height'] = $request->height;
        $order_details['weight'] = $request->weight;
        //print_r(json_encode($order_details));
        $order_details = json_encode($order_details);

        // generate access token
        $c = curl_init();
        $url = "https://apiv2.shiprocket.in/v1/external/auth/login";
        $credentials = json_encode(['email' => 'hari.om@bonwic.com', 'password' => 'Hariom@12345']);
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $credentials);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $server_output = curl_exec($c);
        curl_close($c);
        $server_output = json_decode($server_output, true);


        // Create order in Ship rocket
        $url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $order_details);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $server_output['token'] . ''));
        $result = curl_exec($c);
        curl_close($c);
        $result = json_decode($result, true);




        if (isset($result['status_code']) && $result['status_code'] == 1) {
            // update order table column is pushed to 1
            $orderSave = Order::where('id', $request->order_id)->first();
            $orderSave->is_pushed = 1;
            $orderSave->save();



            $status = 'true';
        } else {
            $status = 'False';
        }


        if ($status == 'false') {
            flash(translate('Order not pushed to ShipRocket !'))->error();
            return redirect()->back()->with('error', 'Somthing went wrong!');
        } else {
            flash(translate('Order pushed to ShipRocket successfully!'))->success();
            return redirect()->back();
        }
    }


    public function track()
    {

        $email = 'hari.om@bonwic.com';
        $password = 'Hariom@12345';

        // Details from your provided array
        $shipmentId = 563774225; // Replace with the actual shipment_id

        // Get authentication token
        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $token = $response->json('token');

            // Track order
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://apiv2.shiprocket.in/v1/external/courier/track/shipment/' . $shipmentId);

            if ($response->successful()) {
                $trackingInfo = $response->json();

                // Output tracking information
                dd($trackingInfo);
            } else {
                echo 'Failed to get tracking information.';
            }
        } else {
            echo 'Failed to get authentication token.';
        }
    }


    public function contact()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view('backend.contact', compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        flash(translate('Contact delete successfully!'))->success();

        return back();
    }
}
