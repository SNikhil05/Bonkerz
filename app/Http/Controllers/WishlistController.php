<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$wishlists = Wishlist::where('user_id', Auth::user()->id)->paginate(15);
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();



        return view('frontend.wishlist', compact('wishlists'));
    }


    public function bsdkMoney()
    {
        $user = Auth::user();
        return view('frontend.bsdkMoney', compact('user'));
    }

    public function bsdkPoint()
    {
        $user = Auth::user();
        return view('frontend.bsdkPoint', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }




    public function remove($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return back()->with('success', 'Remove Wishlist Successfully!');
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     if(Auth::check()){
    //         $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
    //         if($wishlist == null){
    //             $wishlist = new Wishlist;
    //             $wishlist->user_id = Auth::user()->id;
    //             $wishlist->product_id = $request->id;
    //             $wishlist->save();
    //         }
    //         return view('frontend.'.get_setting('homepage_select').'.partials.wishlist');
    //     }
    //     return 0;
    // }

    // public function remove(Request $request)
    // {
    //     $wishlist = Wishlist::findOrFail($request->id);
    //     if($wishlist!=null){
    //         if(Wishlist::destroy($request->id)){
    //             return view('frontend.'.get_setting('homepage_select').'.partials.wishlist');
    //         }
    //     }
    // }



    /**
     * product Wishlist Add or remove
     */


    public function toggleWishlist(Request $request)
    {


        // print_r($request->all());die;


        $user = Auth::user();

        $productId = $request->input('product_id');
        $user = auth()->user();
        $wishlistItem = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($wishlistItem) {

            $wishlistItem->delete();
            $isInWishlist = false;
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $isInWishlist = true;
        }

        return response()->json(['is_in_wishlist' => $isInWishlist]);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
