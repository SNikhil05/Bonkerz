@extends('frontend.layouts.app')
@section('content')



<main class="main__content_wrapper overflow-hidden">

    <!-- Start product details section -->
    <section class="product__details--section section--padding pt-md-5 ">
        <div class="container-fluid">
            <div class="row row-cols-lg-2 row-cols-md-2">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="product__details--media">
                        <div class="grid pe-lg-5">
                            @php

                            $imagesArray = explode(',', $detailedProduct->photos);
                            $uploadsImages = App\Models\Upload::whereIn('id',$imagesArray)->get();

                            @endphp


                            @foreach($uploadsImages as $uploadsImage)
                            <a class="glightbox gridCol" href="{{ isset($uploadsImage->file_name) ? my_asset($uploadsImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" data-gallery="product-media-preview">
                                <img src="{{ isset($uploadsImage->file_name) ? my_asset($uploadsImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" class="img-fluid">
                            </a>
                            @endforeach

                            @if($detailedProduct->video_link != null)
                            @php $thumbnale = App\Models\Upload::where('id', $detailedProduct->thumbnail_img)->first(); @endphp
                            <div class="position-relative">
                                <img src="{{ isset($thumbnale->file_name) ? my_asset($thumbnale->file_name) : static_asset('assets/img/placeholder.jpg') }}" class="img-fluid" style="filter: brightness(0.6);">
                                <a class="glightbox gridCol w-100 " href="{{ $detailedProduct->video_link}}" data-gallery="product-media-preview">
                                    <span class="position-absolute top-50 start-50 translate-middle"> <i class="fa-solid fa-circle-play fa-4x text-danger"></i></span>
                                </a>
                            </div>
                            @endif



                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 border">
                    <div class="product__details--info">



                        <h2 class="product__details--info__title mb-0 mt-lg-0 mt-md-5 fs-2 ls-1">{{ $detailedProduct->name }}</h2>
                        <!-- <div class="py-0 fw-bold text-muted">Oversized Polos</div> -->


                        @if($detailedProduct->rating !=0)
                        <div class="product__details--info__rating d-flex align-items-center mb-2">
                            <ul class="rating d-flex justify-content-center">
                                <li class="rating__list">

                                    <span class="fas fa-star text-warning starrating" data-rating="1"></span>
                                    <span class="fas fa-star starrating text-warning " data-rating="2"></span>
                                    <span class="fas fa-star starrating text-warning" data-rating="3"></span>
                                    <span class="fas fa-star starrating text-warning" data-rating="4"></span>
                                    <span class="fas fa-star starrating text-warning" data-rating="5"></span>
                                    <input type="hidden" name="rating" class="rating-value" value="{{ $detailedProduct->rating }}">

                                </li>


                            </ul>
                            <span class="product__items--rating__count--number">({{ $detailedProduct->rating }})</span>
                        </div>

                        @endif



                        <div class="product__details--info__price py-4">


                            @php

                            if($detailedProduct->discount == 0 || $detailedProduct->discount == null)
                            {
                            $price = $detailedProduct->unit_price;

                            }else
                            {

                            $currentTimestamp = time();

                            $price = $detailedProduct->unit_price;

                            if ($currentTimestamp >= $detailedProduct->discount_start_date && $currentTimestamp <= $detailedProduct->discount_end_date) {

                                if($detailedProduct->discount_type=='percent')
                                {
                                $perPrice = ($detailedProduct->unit_price*$detailedProduct->discount)/100;
                                $price = $detailedProduct->unit_price-$perPrice;
                                $discountPrice = $detailedProduct->unit_price;
                                }
                                else{

                                $price = $detailedProduct->unit_price-$detailedProduct->discount;
                                $discountPrice = $detailedProduct->unit_price;

                                }

                                }
                                else{
                                $price = $detailedProduct->unit_price;
                                }
                                } @endphp















                                @php
                                $fixedPrice = $detailedProduct->unit_price;

                                if($detailedProduct->productTax->tax_type == 'percent')
                                {
                                $persentPrice = ($detailedProduct->unit_price*$detailedProduct->productTax->tax)/100;

                                $totalAmount = $price+$persentPrice;

                                }
                                else{
                                $totalAmount = $price+$detailedProduct->productTax->tax;
                                }





                                @endphp




                                <span class="text-dark fs-2 fw-bol">Rs. {{ $totalAmount }}</span>
                                <div class="pt-0 fw-bold text-muted">Tax Included</div>
                        </div>


                        <!------------ Form start----------->

                        @if ($detailedProduct->auction_product != 1)
                        <form id="option-choice-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">













                            <!-- Color Options -->
                            @if ($detailedProduct->colors != null && count(json_decode($detailedProduct->colors)) > 0)
                            <div class="d-flex gap-5">
                                <div class="">
                                    <div class="product__variant--title mb-8">{{ translate('Color') }}:</div>
                                </div>
                                <div class="">
                                    <div class="aiz-radio-inline d-flex gap-3">
                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip" data-title="{{ get_single_color_name($color) }}">
                                            <input type="radio" name="color" value="{{ get_single_color_name($color) }}" @if ($key==0) checked @endif>
                                            <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1">
                                                <span class="size-25px d-inline-block rounded" style="padding: 12px;background:{{ $color }};"></span>
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif











                            <div class="product__variant pt-0">

                                <div class="product__variant--list pb-5">
                                    <fieldset class="variant__input--fieldset weight">
                                        <legend class="product__variant--title mb-8">Choose Size : <span id="sizeId"></span></legend>

                                        @if ($detailedProduct->choice_options != null)
                                        @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                        @foreach ($choice->values as $key => $value)

                                        <input id="{{ $value }}" class="colorr" type="radio" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if ($key==0) checked @endif>
                                        <label class="variant__size--value blue rounded-0 my-1" for="{{ $value }}">{{ $value }}</label>

                                        @endforeach

                                        @endforeach

                                        @endif


                                    </fieldset>
                                </div>


                                <div data-v-9294f528="" class="d-flex align-items-center">
                                    <div data-v-9294f528="" class="CartsetQty mr20">
                                        <div data-v-9294f528="" class="fltdiv lh28">Quantity  &nbsp; </div> 
                                        <select data-v-9294f528="" class="qtyOption" name="quantity">
                                            <option data-v-9294f528="" value="1">01</option>
                                            <option data-v-9294f528="" value="2">02</option>
                                            <option data-v-9294f528="" value="3">03</option>
                                            <option data-v-9294f528="" value="4">04</option>
                                            <option data-v-9294f528="" value="5">05</option>
                                            <option data-v-9294f528="" value="6">06</option>
                                            <option data-v-9294f528="" value="7">07</option>
                                            <option data-v-9294f528="" value="8">08</option>
                                            <option data-v-9294f528="" value="9">09</option>
                                            <option data-v-9294f528="" value="10">10</option>
                                        </select>
                                    </div>
                                    </div>
                                    </div>



                                <!-- <input type="hidden" name="quantity" value="1"> -->


                                <div class="align-items-center flex-md-row flex-column d-flex gap-3 justify-content-between pb-5 product__variant--list quantity">
                                    @if(Auth::check())
                                    <button class="p-4 btn-dark w-100 rounded-0 border-0" type="button" onclick="addToCart()">Add To Cart</button>
                                    @else
                                    <a href="{{ route('user.login') }}" class="p-3 btn-dark w-100 rounded-0 border-0 text-center">Add To Cart</a>


                                    @endif


                                    @if(Auth::check())


                                    @php
                                    $userId = auth()->id();

                                    $wishlist = App\Models\Wishlist::where(['user_id' => $userId, 'product_id' => $detailedProduct->id])->first();


                                    @endphp

                                    @if(isset($wishlist->id))


                                    <div class="product__variant--list w-100">


                                        <span class="wishlist-toggle w-100 sale wishlistadd" data-product-id="{{ $detailedProduct->id }}">
                                            <a class="variant__wishlist--icon p-3 mt-0 justify-content-center bg-secondary text-light">
                                                <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="#fff" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                </svg>
                                                Added to Wishlist
                                            </a>
                                        </span>

                                    </div>







                                    @else

                                    <div class="product__variant--list w-100">


                                        <span class="wishlist-toggle w-100 sale wishlistadd" data-product-id="{{ $detailedProduct->id }}">
                                            <a class="variant__wishlist--icon p-3 mt-0 justify-content-center bg-secondary text-light">
                                                <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                </svg>
                                                Add to Wishlist
                                            </a>
                                        </span>

                                    </div>
                                    @endif



                                    @else



                                    <div class="product__variant--list w-100">
                                        <a class="variant__wishlist--icon p-3 mt-0 justify-content-center bg-secondary text-light" href="{{ route('user.login') }}" title="Add to wishlist">
                                            <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            Add to Wishlist
                                        </a>
                                    </div>


                                    @endif


                                </div>
                            </div>

                        </form>
                        @endif
                        <div class="my-3">

                            <ul class="d-flex align-items-center gap-3">
                                <li>Share:</li>
                                <li><a href="#"><i class="fa-brands fa-xl fa-square-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-xl fa-square-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-xl fa-square-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-xl fa-square-x-twitter"></i></a></li>

                            </ul>
                        </div>
                        <div class="dlv_dtls col-md-5 col pt-2">
                            <label class="fs-4 fw-bold">Delivery Details</label>
                            <div class="position-relative">
                                <input class="my-3 w-100 border border-light-subtle p-4" id="pin" type="number" placeholder="Enter Pin Code">
                                <button class="check border-0 bg-transparent position-absolute top-25">Check</button>
                            </div>
                        </div>

                        <div class="dlv_dtls col-md-5 col pt-2" id="derror">
                            
                            </div>

                        <div class="dlv_dtls col-md-5 col pt-2" id="delevryDiv">
                            
                        <div data-v-9294f528="" class="cod-message-text-wrapper">
<img data-v-9294f528="" data-src="https://prod-img.thesouledstore.com/public/theSoul/images/icons/money-icon.png" alt="COD Details" class="gm-added gm-loaded gm-observing gm-observing-cb" src="https://prod-img.thesouledstore.com/public/theSoul/images/icons/money-icon.png?format=webp&amp;w=576&amp;dpr=1.0">
 <p data-v-9294f528="">Cash on delivery is available</p>
 </div>
  <div data-v-9294f528="" class="cod-message-text-wrapper">
  <img data-v-9294f528="" data-src="https://prod-img.thesouledstore.com/public/theSoul/images/icons/truck-icon.png" alt="Delivery Estimate" class="gm-added gm-loaded gm-observing gm-observing-cb" src="https://prod-img.thesouledstore.com/public/theSoul/images/icons/truck-icon.png?format=webp&amp;w=576&amp;dpr=1.0">
   <p data-v-9294f528="">Estimated Delivery by
                  <span data-v-9294f528="" id="eta"></span></p>
                  </div>

                        </div>







                        <div class="productDtls pt-5">
                            <div class="accordion" id="prdInfo">
                                <div class="accordion-item border-start-0 border-end-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-transparent fs-4 fw-bold py-4" type="button" data-bs-toggle="collapse" data-bs-target="#prdDtls" aria-expanded="true" aria-controls="prdDtls">
                                            Product Details
                                        </button>
                                    </h2>
                                    <div id="prdDtls" class="accordion-collapse collapse show" data-bs-parent="#prdInfo">
                                        <div class="accordion-body px-0">
                                            <div class="col-5">

                                                {!! $detailedProduct->description !!}

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="accordion-item border-start-0 border-end-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fs-4 fw-bold bg-transparent py-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#prdDesc" aria-expanded="false" aria-controls="prdDesc">
                                            Product Description
                                        </button>
                                    </h2>
                                    <div id="prdDesc" class="accordion-collapse collapse" data-bs-parent="#prdInfo">
                                        <div class="accordion-body px-0">
                                            comming soon..
                                        </div>
                                    </div>
                                </div> -->


                                <!-- <div class="accordion-item border-start-0 border-end-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fs-4 py-4 fw-bold bg-transparent  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#artInfo" aria-expanded="false" aria-controls="artInfo">
                                            Artist's Details
                                        </button>
                                    </h2>
                                    <div id="artInfo" class="accordion-collapse collapse" data-bs-parent="#prdInfo">
                                        <div class="accordion-body px-0">
                                            comming soon..
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details section -->

    <!-- Start product details tab section -->

    <!-- End product details tab section -->

    <!-- Start product section -->
    <section class="product__section product__section--style3 section--padding pt-0">
        <div class="container-fluid product3__section--container">
            <div class="section__heading text-center mb-50">
                <h2 class="">Customers also loved</h2>
            </div>

            <div class="product__section--inner product__swiper--column4__activation swiper">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        @php
                        $productsLoves = App\Models\Product::where('category_id', $detailedProduct->category_id)->get();
                        @endphp



                        @foreach($productsLoves as $productsLove)
                        @php


                        $coverImage = App\Models\Upload::where('id', $productsLove->thumbnail_img)->first();

                        @endphp
                        <div class="swiper-slide">
                            <div class="product__items ">
                                <div class="product__items--thumbnail">
                                    <a class="product__items--link" href="{{ route('product', $productsLove->slug) }}">
                                        <img class="product__items--img product__primary--img" src="{{ isset($coverImage->file_name) ? my_asset($coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                        <img class="product__items--img product__secondary--img" src="{{ isset($coverImage->file_name) ? my_asset($coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                                    </a>
                                </div>
                                <div class="product__items--content">
                                    <h3 class="product__items--content__title h4"><a href="{{ route('product', $productsLove->slug) }}">{{ $productsLove->name }}</a></h3>
                                    <div class="product__items--price">
                                        <span class="current__price">Rs. {{ $productsLove->unit_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
                <div class="swiper__nav--btn swiper-button-next"></div>
                <div class="swiper__nav--btn swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- End product section -->

    <!-- Start shipping section -->
    <section class="shipping__section2 shipping__style3 section--padding pt-0">
        <div class="container-fluid">
            <div class="product__reviews">
                <div class="product__reviews--header border-bottom-0">
                    <div class="section__heading text-center mb-50">
                        <h2>Customer Reviews</h2>
                    </div>


                    <!-- review Progress baar-->
                    <div class="product-reviews reviewBg p-5">



                        <div class="product-reviews__bar reviews-bar">
                            <ul class="list-reset reviews-bar__list">

                                <!-- 5 star review-->
                                <li class="reviews-bar__item">
                                    <ul class="rating d-flex justify-content-center me-2">
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="review_progress_bar">
                                        <span class="review_progress_bar__star">5</span>
                                        <div class="review_progress_bar__outter-line" data-rating="{{$totalFiveRatingPer}}">
                                            <span class="review_progress_bar__inner-line review_progress_bar__inner-line--excellent"></span>
                                        </div>
                                        <span id="value" class="review_progress_bar__quantity">{{ $fiveStarCount }}</span>
                                    </div>
                                </li>
                                <!-- End 5 star review-->

                                <!-- 4 star review-->
                                <li class="reviews-bar__item">
                                    <ul class="rating d-flex justify-content-center me-2">
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="review_progress_bar">
                                        <span class="review_progress_bar__star">4</span>
                                        <div class="review_progress_bar__outter-line" data-rating="{{ $totalFourRatingPer}}">
                                            <span class="review_progress_bar__inner-line review_progress_bar__inner-line--good"></span>
                                        </div>
                                        <span id="value" class="review_progress_bar__quantity">{{ $fourStarCount }}</span>
                                    </div>
                                </li>
                                <!-- End 4 star review-->




                                <!-- 3 star review-->
                                <li class="reviews-bar__item">
                                    <ul class="rating d-flex justify-content-center me-2">
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="review_progress_bar">
                                        <span class="review_progress_bar__star">3</span>
                                        <div class="review_progress_bar__outter-line" data-rating="{{ $totalThreeRatingPer }}">
                                            <span class="review_progress_bar__inner-line review_progress_bar__inner-line--normal"></span>
                                        </div>
                                        <span id="value" class="review_progress_bar__quantity">{{ $threeStarCount }}</span>
                                    </div>
                                </li>
                                <!-- End 3 star review-->




                                <!-- 2 star review-->
                                <li class="reviews-bar__item">
                                    <div class="review_progress_bar">
                                        <ul class="rating d-flex justify-content-center me-2">
                                            <li class="rating__list">
                                                <span class="rating__list--icon">
                                                    <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="rating__list">
                                                <span class="rating__list--icon">
                                                    <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="rating__list">
                                                <span class="rating__list--icon">
                                                    <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="rating__list">
                                                <span class="rating__list--icon">
                                                    <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li class="rating__list">
                                                <span class="rating__list--icon">
                                                    <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                    </svg>
                                                </span>
                                            </li>
                                        </ul>
                                        <span class="review_progress_bar__star">2</span>
                                        <div class="review_progress_bar__outter-line" data-rating="{{ $totalTwoRatingPer }}">
                                            <span class="review_progress_bar__inner-line review_progress_bar__inner-line--not-bad"></span>
                                        </div>
                                        <span id="value" class="review_progress_bar__quantity">{{ $twoStarCount }}</span>
                                    </div>
                                </li>
                                <!-- End 2 star review-->


                                <!-- 1 star review-->
                                <li class="reviews-bar__item">
                                    <ul class="rating d-flex justify-content-center me-2">
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="#ddd"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="review_progress_bar">
                                        <span class="review_progress_bar__star">1</span>
                                        <div class="review_progress_bar__outter-line" data-rating="{{ $totalOneRatingPer }}">
                                            <span class="review_progress_bar__inner-line review_progress_bar__inner-line--bad"></span>
                                        </div>
                                        <span id="value" class="review_progress_bar__quantity">{{ $oneStarCount }}</span>
                                    </div>
                                </li>
                                <!-- End 1 star review-->

                            </ul>
                        </div>

                        <a class="actions__newreviews--btn bg-dark bottom-0 me-0 ms-lg-auto mt-5 mt-6 my-lg-0 position-relative primary__btn rounded-0 text-white" href="#writereview">Write A Review</a>

                    </div>
                    <!--end prgoress baar-->




                </div>
                <div class="reviews__comment--area">



                    @foreach($reviews as $review)


                    @php

                    $user = App\Models\User::where('id', $review->user_id)->first();

                    @endphp

                    <div class="reviews__comment--list d-flex">
                        <div class="reviews__comment--thumb">
                            <img src="{{ asset('assets/frontend/img/user-circle.png') }}" alt="comment-thumb">
                        </div>
                        <div class="reviews__comment--content">
                            <div class="reviews__comment--top d-flex justify-content-between">
                                <div class="reviews__comment--top__left">
                                    <h3 class="reviews__comment--content__title h4">{{ $user->name }}</h3>

                                    <ul class="rating d-flex justify-content-center me-2">

                                        @if($review->rating == 5)
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        @elseif($review->rating == 4)
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        @elseif($review->rating == 3)
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        @elseif($review->rating == 2)
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                        @else


                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>

                                        @endif





                                    </ul>


                                </div>
                                <span class="reviews__comment--content__date">{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</span>
                            </div>
                            <p class="reviews__comment--content__desc">
                                {{ $review->comment }}
                            </p>

                        </div>

                    </div>

                    @endforeach




                    <!--write a review-->
                    <div id="writereview" class="reviews__comment--reply__area">

                        <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>
                        <div class="reviews__ratting d-flex align-items-center mb-20">
                            <form action="{{ route('reviews.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                <fieldset class="border-0 px-0">
                                    <div class="rating__group ">
                                        <input type="radio" class="rating__star" name="rating" value="1" aria-label="one star">
                                        <input type="radio" class="rating__star" name="rating" value="2" aria-label="two star">
                                        <input type="radio" class="rating__star" name="rating" value="3" aria-label="three star">
                                        <input type="radio" class="rating__star" name="rating" value="4" aria-label="four star">
                                        <input type="radio" class="rating__star" name="rating" value="5" aria-label="five star">
                                    </div>
                                </fieldset>

                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="col-12 mb-10">
                                    <textarea class="reviews__comment--reply__textarea" name="comment" required placeholder="Your Comments...."></textarea>
                                </div>

                            </div>
                        </div>
                        <button class="reviews__comment--btn text-white primary__btn" data-hover="Submit" type="submit">SUBMIT</button>
                        </form>
                    </div>
                    <!--end write a review-->
                </div>

            </div>
        </div>
    </section>
    <!-- End shipping section -->
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

@section('script')

<script src="{{ asset('assets/frontend/js/plugins/customSelectbox.js') }}"></script> <!-- new script-->

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: false,

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
    $(document).ready(function() {

        $('#delevryDiv').hide();

        $('.check').click(function() {

        let pincode = $('#pin').val();

            $.ajax({
                url: "/check-pincode", // Create a route for toggling the wishlist
                method: 'POST',
                data: {
                    pincode: pincode,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Toggle the heart icon and change color based on the response
                    if (response.status == true) {
                        let date = response.etd
                        $('#eta').text(date)
                        $('#delevryDiv').show();
                        
                        let htmlContent = '<p style="color:green">Delivery avlable!</p>';
                            $('#derror').html(htmlContent);

                    } else {

                            $('#delevryDiv').hide();

                            let htmlContent = '<p style="color:red">Delivery not avlable!</p>';
                            $('#derror').html(htmlContent);
                    }
                }
            });
        });


        let selectedValuee = $(".colorr:checked").val();

        $("#sizeId").text(selectedValuee);
        $(".colorr").on("change", function() {
            let selectedValue = $(".colorr:checked").val();
            $("#sizeId").text(selectedValue);
        });


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
                        let htmlContent = '<a class="variant__wishlist--icon p-3 mt-0 justify-content-center bg-secondary text-light"><svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="#fff" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" /></svg>Added to Wishlist</a>';
                        icon.html(htmlContent);
                    } else {
                        let htmlContent = '<a class="variant__wishlist--icon p-3 mt-0 justify-content-center bg-secondary text-light"><svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" /></svg>Add to Wishlist</a>';


                        icon.html(htmlContent);
                    }
                }
            });
        });

    });
</script>
<script>
    /* progress review baar*/
    const bars = document.querySelectorAll('.review_progress_bar__outter-line');
    const COUNT_STARS = 12;

    bars.forEach(el => {
        let rating = el.dataset.rating;

        let percent = (100 * rating) / COUNT_STARS;
        el.querySelector('.review_progress_bar__inner-line').style.width = `${percent}%`;
    });

    // ScrollReveal().reveal('.headline');
    /* end progress review baar*/
</script>


@endsection

@endsection