<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Utility\CartUtility;
use Session;
use Cookie;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CartController extends Controller
{
    public function index(Request $request)
    {

        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->get();


        return view('frontend.cart', compact('carts'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.' . get_setting('homepage_select') . '.partials.addToCart', compact('product'));
    }

    public function showCartModalAuction(Request $request)
    {
        $product = Product::find($request->id);
        return view('auction.frontend.addToCartAuction', compact('product'));
    }


    public function addMenbership($id)
    {


        $user = Auth::user();
        if(empty($user))
        {
            return back()->with('error','Please login your account!');
        }
        $cart=Cart::where(['user_id'=>$user->id,'product_id' => $id])->first();
        if(!empty($cart))
        {
            return back()->with('error','Membership already added in the cart!');
        }
 
        $product = Product::findOrFail($id);


       
        $cart = Cart::create([
            'product_id' => $product->id,
            'user_id' => $user->id,           
            'price' => $product->unit_price,
            'type' => 'membership',
            'quantity' => 1,
            'owner_id' => 9

        ]);

       



        return back()->with('success','Add to cart successfully!');
    }

    public function addToCart(Request $request)
    {
        // print_r($request->all());die;
        $carts = Cart::where('user_id', auth()->user()->id)->get();

        $cartCount = count($carts);
        $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);
        $product = Product::find($request->id);


        $carts = array();

        if ($check_auction_in_cart && $product->auction_product == 0) {
            return array(
                'status' => 0,
                'cart_count' => $cartCount,
                'message' => 'Remove Auction Product FromCart'
                // 'modal_view' => view('frontend.'.get_setting('homepage_select').'.partials.removeAuctionProductFromCart')->render(),
                // 'nav_cart_view' => view('frontend.'.get_setting('homepage_select').'.partials.cart')->render(),
            );
        }





        $quantity = $request['quantity'];

        if ($quantity < $product->min_qty) {
            return array(
                'status' => 0,
                'cart_count' => $cartCount,
                'message' => 'Min Qty Not Satisfied!'
                //'modal_view' => view('frontend.'.get_setting('homepage_select').'.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
                //'nav_cart_view' => view('frontend.'.get_setting('homepage_select').'.partials.cart')->render(),
            );
        }





        //check the color enabled or disabled for the product
        $str = CartUtility::create_cart_variant($product, $request->all());


        $product_stock = $product->stocks->where('variant', $str)->first();
         

        $cart = Cart::firstOrNew([
            'variation' => $str,
            'user_id' => auth()->user()->id,
            'product_id' => $request['id']
        ]);

        //print_r($cart);die;

        if ($cart && $product->digital == 0) {

            
            if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
                return array(
                    'status' => 0,
                    'cart_count' => $cartCount,
                    'message' => 'Auction Product Alreday Added Cart!'
                    // 'modal_view' => view('frontend.'.get_setting('homepage_select').'.partials.auctionProductAlredayAddedCart')->render(),
                    //'nav_cart_view' => view('frontend.'.get_setting('homepage_select').'.partials.cart')->render(),
                );
            }

            
            if ($product_stock->qty < $cart->quantity + $request['quantity']) {

               
                return array(
                    'status' => 0,
                    'cart_count' => $cartCount,
                    'message' => 'Product out of stack',
                    //'modal_view' => view('frontend.'.get_setting('homepage_select').'.partials.outOfStockCart')->render(),
                    // 'nav_cart_view' => view('frontend.'.get_setting('homepage_select').'.partials.cart')->render(),
                );
            }
            $quantity = $cart->quantity + $request['quantity'];
        }



        $price = CartUtility::get_price($product, $product_stock, $request->quantity);


        $tax = CartUtility::tax_calculation($product, $price);

        CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

        $carts = Cart::where('user_id', auth()->user()->id)->get();



         
        return array(
            'status' => 1,
            'cart_count' => count($carts),
            'message' => 'Add to cart successfully!'
            // 'modal_view' => view('frontend.'.get_setting('homepage_select').'.partials.addedToCart', compact('product', 'cart'))->render(),
            // 'nav_cart_view' => view('frontend.'.get_setting('homepage_select').'.partials.cart')->render(),
        );

        //print_r($carts);
    }

    //removes from Cart




    public function removeFromCart($id)
    {
        Cart::destroy($id);

        return back()->with('success', 'Remove item from cart!');
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cartItem = Cart::findOrFail($request->id);

        if ($cartItem['id'] == $request->id) {
            $product = Product::find($cartItem['product_id']);
            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
            $quantity = $product_stock->qty;
            $price = $product_stock->price;

            //discount calculation
            $discount_applicable = false;

            if ($product->discount_start_date == null) {
                $discount_applicable = true;
            } elseif (
                strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date
            ) {
                $discount_applicable = true;
            }

            if ($discount_applicable) {
                if ($product->discount_type == 'percent') {
                    $price -= ($price * $product->discount) / 100;
                } elseif ($product->discount_type == 'amount') {
                    $price -= $product->discount;
                }
            }

            if ($quantity >= $request->quantity) {
                if ($request->quantity >= $product->min_qty) {
                    $cartItem['quantity'] = $request->quantity;
                }
            }

            if ($product->wholesale_product) {
                $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
                if ($wholesalePrice) {
                    $price = $wholesalePrice->price;
                }
            }

            $cartItem['price'] = $price;
            $cartItem->save();
        }

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend.' . get_setting('homepage_select') . '.partials.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend.' . get_setting('homepage_select') . '.partials.cart')->render(),
        );
    }
}
