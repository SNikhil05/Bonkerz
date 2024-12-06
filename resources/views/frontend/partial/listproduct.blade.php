<div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">


    @foreach($products as $product)
    <div class="col mb-30">
        <div class="product__items ">
            <div class="product__items--thumbnail">
                <a class="product__items--link" href="{{ route('product', $product->slug) }}">
                    <img class="product__items--img product__primary--img" src="{{ isset($product->thumbnail->file_name) ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                    <img class="product__items--img product__secondary--img" src="{{ isset($product->thumbnail->file_name) ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="product-img">
                </a>
                <div class="">

                    @if(Auth::check())

                    @php

                    $userId = auth()->id();

                    $wishlist = App\Models\Wishlist::where(['user_id' => $userId, 'product_id' => $product->id])->first();


                    @endphp

                    @if(isset($wishlist->id))
                    <div class="product__badge">
                        <span class="wishlist-toggle product__badge--items sale wishlistadd" data-product-id="{{ $product->id }}"><a><i class="fa-solid fa-heart fa-xl"></i></a></span>
                    </div>
                    @else

                    <div class="product__badge">
                        <span class="wishlist-toggle product__badge--items sale wishlistadd" data-product-id="{{ $product->id }}"><a><i class="far fa-heart fa-xl"></i></a></span>
                    </div>

                    @endif


                    @else
                    <div class="product__badge">
                        <a href="{{ route('user.login') }}"><span class="product__badge--items sale"><i class="far fa-heart fa-xl"></i></span></a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="product__items--content">

                <h3 class="product__items--content__title h4 pb-0 mb-0"><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h3>
                @php

                if($product->discount == 0 || $product->discount == null)
                {
                $price = $product->unit_price;

                }else
                {

                $currentTimestamp = time();

                $price = $product->unit_price;

                if ($currentTimestamp >= $product->discount_start_date && $currentTimestamp <= $product->discount_end_date) {

                    if($product->discount_type=='percent')
                    {
                    $perPrice = ($product->unit_price*$product->discount)/100;
                    $price = $product->unit_price-$perPrice;

                    $totalDiscount = $perPrice;

                    $discountPrice = $product->unit_price;
                    }
                    else{

                    $totalDiscount = $product->discount;
                    $price = $product->unit_price-$product->discount;
                    $discountPrice = $product->unit_price;

                    }

                    }
                    else{
                    $price = $product->unit_price;
                    }
                    } @endphp



                    <span class="product__items--content__subtitle text-gray">Rs.{{ $price }}</span>





                    @if($product->discount != 0 || $product->discount != null)

                    @php

                    $currentTimestamp = time();
                    @endphp
                    @if($currentTimestamp >= $product->discount_start_date && $currentTimestamp <= $product->discount_end_date)
                        <span class="price__divided"></span>
                        <span class="old__price">Rs{{ $discountPrice }}</span>
                        <p class="text-danger  fs-5">RS.{{ $totalDiscount }} OFF</p>
                        @endif
                        @endif










            </div>
        </div>
    </div>


    @endforeach
</div>