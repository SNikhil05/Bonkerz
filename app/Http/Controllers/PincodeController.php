<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ShiprocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PincodeController extends Controller
{
    protected $shiprocketService;

    public function __construct(ShiprocketService $shiprocketService)
    {
        $this->shiprocketService = $shiprocketService;
    }

    public function checkAvailability(Request $request)
    {
        $pincode = $request->pincode;
        $availability = $this->shiprocketService->checkPincodeAvailability($pincode);


        if (isset($availability['data']['available_courier_companies'][0]['etd'])) {
            return response()->json([
                'status' => true,
                'etd' => $availability['data']['available_courier_companies'][0]['etd']

            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Delivery not avlable!'

            ]);
        }




        //return response()->json($availability);
    }


    public function shippingPolicy()
    {
        return view('frontend.shippingpolocy');
    }

    public function termsConditions()
    {
        return view('frontend.termandconduction');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy');
    }


    public function setConsent(Request $request)
    {
        $consent = $request->input('consent');
        $minutes = 60 * 24 * 30; // 30 days
        Cookie::queue('user_consent', $consent, $minutes);

        return response()->json(['message' => 'Consent recorded']);
    }

    public function contactUs()
    {
        return view('frontend.contact');
    }

    public function contactUsStore(Request $request)
    {
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'message' => $request->message,

        ]);

        return back()->with('success', 'Your record has been saved!');
    }
}
