@extends('frontend.layouts.app')
@section('content')
<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">

    </section>
    <section class="cart__section section--padding">
        <div class="container">
            <div class="cart__section--inner">
                <form action="#">
                    <h2 class="cart__title mb-40">Wishlist</h2>
                    <div class="cart__table">
                        <div class="table-responsive">
                            <table class="table align-middle border">
                                <thead>
                                    <tr>
                                        <th class="text-center text-lg-start border">Product</th>
                                        <th class="text-center  border">Price</th>
                                        <th class="text-center  border">STOCK STATUS</th>
                                        <th class="text-center  border">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlists as $wishlist)

                                    @php

                                    $product = App\Models\Product::where('id',
                                    $wishlist->product->id)->with('thumbnail')->first();
                                    // $cate

                                    @endphp
                                    <tr class="">
                                        <td class="border">
                                            <div class="align-items-center cart__product d-flex flex-wrap justify-content-center justify-content-lg-start">

                                                <div class="cart__thumbnail">
                                                    <a href="{{ route('product', $wishlist->product->slug) }}"><img
                                                            class="border-radius-5"
                                                            src="{{ isset($product->thumbnail->file_name) ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                            alt="cart-product"></a>
                                                </div>
                                                <div class="cart__content">
                                                    <h4 class="cart__content--title"><a
                                                            href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                                    </h4>

                                                </div>
                                            </div>
                                        </td>
                                        <td class=" text-center border">
                                            <span class="cart__price">Rs{{ $wishlist->product->unit_price }}</span>
                                        </td>
                                        <td class=" text-center">
                                            @if( $wishlist->product->stock_visibility_state == 'hide')
                                            <span class="in__stock text__secondary">Out of stock</span>

                                            @else

                                            <span
                                                class="in__stock text__secondary">{{ $wishlist->product->current_stock }}</span>

                                            @endif



                                        </td>
                                        <td class=" text-center  border">
                                            <a class="cart__remove--btn"
                                                href="{{ route('user.wishlist.remove', $wishlist->id) }}">
                                                <i class="fa-solid text-red fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                  

                        @if(count($wishlists) == 0)
                        <p class="text-center">Your wishlist is empty. Add some items!</p>
                        @endif



                        <div class="continue__shopping d-flex justify-content-between">
                            <a class="continue__shopping--link" href="{{ route('home') }}">Continue shopping</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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

@endsection