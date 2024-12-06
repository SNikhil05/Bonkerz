@extends('frontend.layouts.app')

@section('content')

<style>
    .product__items--thumbnail video {
        width: 100%;
        height: 100%;
    }

    .membership-section {
        background-color: #222;
        text-align: center;
        color: #fff;
        margin: 2rem 0
    }

    .membership-header {
        background: #fbfbfb;
        color: #000;
        padding: 2rem 0;
        font-size: 3rem;
        font-weight: 600;
        letter-spacing: .5px;
    }

    .membership-section-wrapper .title {
        font-size: 2rem;
        letter-spacing: .75px;
        margin: 2rem 0;
    }

    .membership-section-wrapper h2 {
        padding: 5rem 0;
        font-size: 4rem;
        letter-spacing: .75px;
    }

    .membership-section-wrapper img {
        width: 100px;
    }

    .membership-footer {
        background: linear-gradient(to right, #fff 5%, #ff3a3a 50%, #fff 95%);
        padding: 2rem 0;
        font-size: 4rem;
        margin-top: 5rem;
        font-weight: 600;
        letter-spacing: .5px;
    }

    .membership-footer a {

        text-decoration: none;
        font-size: 3.5rem;
    }

    .membership-footer a:hover {
        color: #ffffff;
    }

    @media screen and (max-width: 860px) {
        .membership-header {
            background: #fbfbfb;
            color: #000;
            padding: 1rem 0;
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .membership-section-wrapper h2 {
            padding: 2rem 0;
            font-size: 2.5rem;
            letter-spacing: .75px;
            line-height: 36px;
        }

        .membership-footer a {
            text-decoration: none;
            color: #ffffff;
            line-height: 38px;
            font-size: 2rem;
            padding: 0rem !important;
        }

        .membership-footer {
            background: linear-gradient(to right, #fff 5%, #ff3a3a 50%, #fff 95%);
            padding: 1rem 0;
            font-size: 4rem;
            margin-top: 5rem;
            font-weight: 600;
            letter-spacing: .5px;
        }
    }
</style>


@php

$banner = $category->bannerImage->file_name;

if(isset($banner))
{
$bannerImage = my_asset($category->bannerImage->file_name);
}
else{
$bannerImage = static_asset('assets/img/placeholder.jpg');
}

@endphp


<main class="main__content_wrapper">
    <!-- Start slider section -->
    <section class="hero__slider--section">
        <div class="hero__slider--inner hero__slider--activation  swiper">
            <div class="hero__slider--wrapper swiper-wrapper">
                <div class="swiper-slide  ">
                    <div class="hero__slider--items home1__slider--bg" style="background:url({{ $bannerImage }});background-repeat:no-repeat;background-size:cover;">
                        <div class="container-fluid">
                            <div class="hero__slider--items__inner position-relative">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="slider__content">



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-0 bg-dark-0 px-3 d-lg-block d-none">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="text-white">
                                    <p class="text-white"><span class="text-danger">HOME DELIVERY</span> Receive
                                        your purchase in 7 to 10 working days</p>
                                </div>
                                <div class="text-white">
                                    <p class="text-white"><span class="px-3 text-white">|</span></p>
                                </div>
                                <div class="text-white">
                                    <p class="text-white"><span class="text-danger">FREE DELIVERY</span> Order above
                                        3999</p>
                                </div>
                                <div class="text-white">
                                    <p class="text-white"><span class="px-3 text-white">|</span></p>
                                </div>
                                <div class="text-white">
                                    <p class="text-white"><span class="text-danger">10% DISCOUNT</span> On prepaid
                                        orders</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="swiper__nav--btn swiper-button-next"></div>
            <div class="swiper__nav--btn swiper-button-prev"></div>
        </div>
    </section>
    <!-- End slider section -->
    <!-- Start product section -->
    <section class="product__section section--padding">
        <div class="container-fluid">
            <div class="section__heading text-center my-3">
                <h2 class="section__heading--maintitle">NEW ARRIVALS</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">



                @foreach($newArribles as $newArrible)
                @php
                $category = App\Models\Category::where('id', $newArrible->parent_id)->first();
                @endphp
                <div class="col mb-30">
                    <div class="product__items ">
                        <div class="product__items--thumbnail">
                            <a class="product__items--link" href="{{ route('productList', ['category' => $category->slug, 'subCategory' => $newArrible->slug]) }}">
                                <img class="product__items--img product__primary--img" src="{{ isset($newArrible->coverImage->file_name) ? my_asset($newArrible->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                <img class="product__items--img product__secondary--img" src="{{ isset($newArrible->coverImage->file_name) ? my_asset($newArrible->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                            </a>

                        </div>
                        <div class="product__items--content">
                            <h3 class="product__items--content__title h4"><a href="{{ route('productList', ['category' => $category->slug, 'subCategory' => $newArrible->slug]) }}">{{ $newArrible->name }}</a>
                            </h3>
                            <!-- <span class="product__items--content__subtitle">Jacket, Women</span> -->
                        </div>
                    </div>
                </div>

                @endforeach

                </a>
            </div>
        </div>
    </section>
    <!-- End product section -->
    <!-- Start product section -->
    <section class="product__section section--padding pt-0 pt-lg-5">
        <div class="container-fluid">
            <div class="section__heading text-center my-3">
                <h2 class="section__heading--maintitle">SHOP BY THEME</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                @foreach($shopByTheams as $shopByTheam)
                @php
                $category = App\Models\Category::where('id', $shopByTheam->parent_id)->first();
                @endphp
                <div class="col mb-30">
                    <div class="product__items ">
                        <div class="product__items--thumbnail">
                            <a class="product__items--link" href="{{ route('productList', ['category' => $category->slug, 'subCategory' => $shopByTheam->slug]) }}">
                                <img class="product__items--img product__primary--img" src="{{ isset($shopByTheam->coverImage->file_name) ? my_asset($shopByTheam->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                <img class="product__items--img product__secondary--img" src="{{ isset($shopByTheam->coverImage->file_name) ? my_asset($shopByTheam->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                            </a>

                        </div>

                    </div>
                </div>
                @endforeach


            </div>
            <div class="text-center mt-5">
                <a class="border-4 border-bottom border-danger mx-auto text-center rounded w-auto py-2" href="#new.php">View More Product

                </a>
            </div>
        </div>
    </section>
    <!-- End product section -->
    <!-- Start product section -->
    <section class="product__section section--padding pt-0 pt-lg-5">
        <div class="container-fluid">
            <div class="section__heading text-center my-3">
                <h2 class="section__heading--maintitle">SHOP BY CATEGORY</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-3 row-cols-1 mb--n30">


                @foreach($subcategories as $subcategory)
                @php
                $category = App\Models\Category::where('id', $subcategory->parent_id)->first();
                @endphp

                <div class="col mb-30">
                    <div class="product__items ">
                        <div class="product__items--thumbnail postion-relative">
                            <a class="product__items--link" href="{{ route('productList', ['category' => $category->slug, 'subCategory' => $subcategory->slug]) }}">
                                <img class="product__items--img product__primary--img" src="{{ isset($subcategory->coverImage->file_name) ? my_asset($subcategory->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                <img class="product__items--img product__secondary--img" src="{{ isset($subcategory->coverImage->file_name) ? my_asset($subcategory->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                            </a>
                            <div class="d-flex gap-3 position-absolute translate">
                                <div class="px-2 py-4 border border-1 border-dark bg-white box-y"></div>
                                <div class="px-2 py-4 border border-1 border-dark bg-white box-y"></div>
                                <div class="px-2 py-4 border border-1 border-dark bg-white box-y"></div>
                                <div class="px-2 py-4 border border-1 border-dark bg-white box-y"></div>
                            </div>
                        </div>

                        <div class="skew">
                            <div class="bg-white border border-1 border-dark ms-lg-4 mx-auto py-2 text-center translate-middle-y w-75">

                                <h3 class="product__items--content__title h4 my-0 skew-text px-1"><a href="{{ route('productList', ['category' => $category->slug, 'subCategory' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <div class="text-center mt-5">
                <a class="border-4 border-bottom border-danger mx-auto text-center rounded w-auto py-2" href="#new.php">View More Product

                </a>
            </div>
        </div>
    </section>
    <!-- End product section -->
    <!-- Start product section -->

    <section class="product__section section--padding py-0 pt-lg-5">
        <div class="container-fluid">
            <div class="section__heading text-center my-3">
                <h2 class="section__heading--maintitle">TOP SELLING</h2>
            </div>
            <div class="product__section--inner product__swiper--activation swiper">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($topSellingProducts as $topSellingProduct)
                        <div class="swiper-slide">
                            <div class="product__items ">
                                <div class="product__items--thumbnail">
                                    <a class="product__items--link" href="{{ route('product', $topSellingProduct->slug) }}">
                                        <img class="product__items--img product__primary--img" src="{{ isset($topSellingProduct->thumbnail->file_name) ? my_asset($topSellingProduct->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                        <img class="product__items--img product__secondary--img" src="{{ isset($topSellingProduct->thumbnail->file_name) ? my_asset($topSellingProduct->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                    </a>





                                    @if(Auth::check())

                                    @php

                                    $userId = auth()->id();

                                    $wishlist = App\Models\Wishlist::where(['user_id' => $userId, 'product_id' =>
                                    $topSellingProduct->id])->first();


                                    @endphp

                                    @if(isset($wishlist->id))
                                    <div class="product__badge">
                                        <span class="wishlist-toggle product__badge--items sale wishlistadd" data-product-id="{{ $topSellingProduct->id }}"><a><i class="fa-solid fa-heart fa-xl"></i></a></span>
                                    </div>
                                    @else

                                    <div class="product__badge">
                                        <span class="wishlist-toggle product__badge--items sale wishlistadd" data-product-id="{{ $topSellingProduct->id }}"><a><i class="far fa-heart fa-xl"></i></a></span>
                                    </div>

                                    @endif


                                    @else
                                    <div class="product__badge">
                                        <a href="{{ route('user.login') }}"><span class="product__badge--items sale"><i class="far fa-heart fa-xl"></i></span></a>
                                    </div>
                                    @endif



                                </div>
                                @php

                                if($topSellingProduct->discount == 0 || $topSellingProduct->discount == null)
                                {
                                $price = $topSellingProduct->unit_price;

                                }else
                                {

                                $currentTimestamp = time();

                                $price = $topSellingProduct->unit_price;

                                if ($currentTimestamp >= $topSellingProduct->discount_start_date && $currentTimestamp <= $topSellingProduct->discount_end_date) {

                                    if($topSellingProduct->discount_type=='percent')
                                    {
                                    $perPrice = ($topSellingProduct->unit_price*$topSellingProduct->discount)/100;
                                    $price = $topSellingProduct->unit_price-$perPrice;
                                    $discountPrice = $topSellingProduct->unit_price;
                                    }
                                    else{

                                    $price = $topSellingProduct->unit_price-$topSellingProduct->discount;
                                    $discountPrice = $topSellingProduct->unit_price;

                                    }

                                    }
                                    else{
                                    $price = $topSellingProduct->unit_price;
                                    }
                                    } @endphp

                                    <div class="product__items--content">
                                        <span class="product__items--content__subtitle">Jacket, Women</span>
                                        <h3 class="product__items--content__title h4"><a href="{{ route('product', $topSellingProduct->slug) }}">{{ $topSellingProduct->name }}</a>
                                        </h3>
                                        <div class="product__items--price">
                                            <span class="current__price">Rs{{ $price }}</span>



                                            @if($topSellingProduct->discount != 0 || $topSellingProduct->discount !=
                                            null)

                                            @php

                                            $currentTimestamp = time();
                                            @endphp
                                            @if($currentTimestamp >= $topSellingProduct->discount_start_date &&
                                            $currentTimestamp <= $topSellingProduct->discount_end_date)
                                                <span class="price__divided"></span>
                                                <span class="old__price">Rs{{ $discountPrice }}</span>
                                                @endif
                                                @endif






                                        </div>
                                        <ul class="rating product__rating d-flex">




                                            @if($topSellingProduct->rating != 0)

                                            <li class="rating__list">({{ $topSellingProduct->rating }})<span class="rating__list--icon"><svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                    </svg> </span>
                                            </li>

                                            @endif
                                        </ul>
                                        <ul class="product__items--action d-flex">




                                        </ul>
                                    </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="swiper__nav--btn swiper-button-next"></div>
                    <div class="swiper__nav--btn swiper-button-prev"></div>
                </div>
            </div>


        </div>
    </section>





    <!-- End product section -->
    <!-- Start banner section -->
    <section class="banner__section section--padding py-4">
        <div class="container-fluid">
            <div class="row row-cols-1">
                <div class="col">
                    <div class=" position__relative">
                        <a class="banner__items--thumbnail display-block" href="#shop.php"><img class=" banner__img--height__md display-block" src="{{ asset('assets/frontend/img/banner/banner.png') }}" alt="b-1.jpg">

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner section -->
    <!-- Start banner section -->
    <section class="banner__section section--padding py-4">
        <div class="container-fluid">
            <div class="row row-cols-1">
                <div class="col">
                    <div class=" position__relative">
                        <a class="banner__items--thumbnail display-block" href="#shop.php"><img class=" banner__img--height__md display-block" src="{{ asset('assets/frontend/img/banner/b-1.jpg') }}" alt="banner-img">

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner section -->

    <!-- Start membership section -->
    <section class="membership-section">
        <div class="membership-section-wrapper">
            <div class="membership-header">MEMBERSHIP</div>
            <div class="container">
                <div class="row">
                    <h2>SURPRISE GIFT ON EACH PREPAID ORDER</h2>
                    <div class="col-md-3 text-center">
                        <img src="{{ static_asset('assets/frontend/img/icon/MEMBER-DISCOUNTS.svg') }}">
                        <div class="title">MEMBER DISCOUNTS</div>
                    </div>

                    <div class="col-md-3 text-center">
                        <img src="{{ static_asset('assets/frontend/img/icon/PRIORITY-SHIPPING.svg') }}">
                        <div class="title">PRIORITY SHIPPING</div>
                    </div>

                    <div class="col-md-3 text-center">
                        <img src="{{ static_asset('assets/frontend/img/icon/BIRTHDAY-DISCOUNT.svg') }}">
                        <div class="title">BIRTHDAY DISCOUNT</div>
                    </div>

                    <div class="col-md-3 text-center">
                        <img src="{{ static_asset('assets/frontend/img/icon/LOYALITY-POINTS.svg') }}">
                        <div class="title">LOYALITY POINTS</div>
                    </div>
                </div>
            </div>
            <div class="membership-footer"><a href="#">BECOME A BSDK MEMBER</a></div>
        </div>

    </section>
    <!-- end-membership-section -->

    <!-- Start banner section -->
    {{-- <section class="banner__section section--padding py-4">
        <div class="">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="position__relative position-relative">
                        <a class="banner__items--thumbnail display-block" href="#shop.php"><img class=" banner__img--height__md display-block" src="{{ asset('assets/frontend/img/banner/b-4.jpg') }}" alt="banner-img">

    </a>
    <div class="position-absolute top-50 translate-middle start-50 text-white text-center">
        <h2 class="deals__banner--content__maintitle">MEMBERSHIP</h2>
        <p class="deals__banner--content__desc text-white">Are you ready to elevate your fashion
            game and make a statement <br> with your style? Welcome to Bonkerz Donkerz, where
            fashion meets<br> affordability and quality.</p>
        <a class="primary__btn" href="#shop.php">Get Membership
            <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
            </svg>
        </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section> --}}
    <!-- End banner section -->
    <!-- Start product section -->
    <section class="product__section section--padding py-4">
        <div class="container-fluid">
            <div class="section__heading text-center my-3">
                <img src="{{ asset('assets/frontend/img/icon/instagram.svg') }}" width="60" class="img-fluid my-4" alt="">
                <h2 class="section__heading--maintitle">STYLE BY OUR COMMUNITY</h2>
            </div>
            <div class="product__section--inner product__swiper--activation swiper">
                <div class="swiper-wrapper">


                    @php

                    $reels = App\Models\Reel::orderBy('id', 'desc')->get();


                    @endphp

                    @foreach($reels as $reel)
                    <div class="swiper-slide">
                        <div class="product__items ">
                            <div class="product__items--thumbnail">
                                <video autoplay loop muted>
                                    <source src="{{ asset('storage/' . $reel->reel_path) }}" type="video/mp4">
                                </video>


                            </div>

                        </div>
                    </div>


                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next"></div>
                <div class="swiper__nav--btn swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- End product section -->
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
<!-- Start News letter popup -->
<div class="newsletter__popup" data-animation="slideInUp">
    <div id="boxes" class="newsletter__popup--inner">
        <button class="newsletter__popup--close__btn" aria-label="search close button">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg>
        </button>
        <div class="box newsletter__popup--box d-flex align-items-center">
            <div class="newsletter__popup--thumbnail">
                <img class="newsletter__popup--thumbnail__img display-block" src="{{ asset('assets/frontend/img/banner/newsletter-popup-thumb2.png') }}" alt="newsletter-popup-thumb">
            </div>
            <div class="newsletter__popup--box__right">
                <h2 class="newsletter__popup--title">Join Our Newsletter</h2>
                <div class="newsletter__popup--content">
                    <label class="newsletter__popup--content--desc">Enter your email address to subscribe our
                        notification of our new post &amp; features by email.</label>
                    <div class="newsletter__popup--subscribe" id="frm_subscribe">
                        <form class="newsletter__popup--subscribe__form">
                            <input class="newsletter__popup--subscribe__input" type="text" placeholder="Enter you email address here...">
                            <button class="newsletter__popup--subscribe__btn">Subscribe</button>
                        </form>
                        <div class="newsletter__popup--footer">
                            <input type="checkbox" id="newsletter__dont--show">
                            <label class="newsletter__popup--dontshow__again--text" for="newsletter__dont--show">Don't
                                show this popup again</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End News letter popup -->


@section('script')
<script>
    $(document).ready(function() {

        // Handle clicking on the heart icon
        $('.wishlist-toggle').click(function() {
            let productId = $(this).data('product-id');
            let icon = $(this);

            $.ajax({
                url: "/toggle-wishlist", // Create a route for toggling the wishlist
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Toggle the heart icon and change color based on the response
                    if (response.is_in_wishlist == true) {
                        let htmlContent = '<a><i class="fa-solid fa-heart fa-xl"></i></a>';


                        icon.html(htmlContent);
                    } else {
                        let htmlContent = '<a><i class="far fa-heart fa-xl"></i></span></a>';


                        icon.html(htmlContent);
                    }
                }
            });
        });

    });

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        },
    });
</script>
@endsection


@endsection