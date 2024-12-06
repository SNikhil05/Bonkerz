@extends('frontend.layouts.app')
@section('content')

<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">

    </section>
    <!-- End breadcrumb section -->

    <!-- Start shop section -->
    <section class="shop__section section--padding">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">PRODUCTS</h2>

                            <ul class="widget__form--check">



                               <!--main category-->


                               <!---end main category --->


                                </li>
                            </ul>

                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">THEMES</h2>
                            <ul class="widget__form--check">


                              

                            </ul>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">color</h2>
                            <ul class="widget__form--check">
                                @foreach($colors as $color)
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray d-flex align-items-center">
                                        <span class="p-3 rounded-circle me-3" style="background-color:{{$color->code}};"></span>{{ $color->name }}</label>
                                    <input class="widget__form--check__input submitfild" name="color" value="{{ $color->code }}" type="radio">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                @endforeach


                            </ul>
                        </div>


                      
                        <!-- <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">Price</h2>
                            <ul class="widget__form--check">

                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price1">Rs. 199 To Rs. 499</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="199-499" id="price1" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price2">Rs. 500 To Rs. 999</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="500-999" id="price2" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price3">Rs. 1000 To Rs. 1499</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="1000-1499" id="price3" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 1500 To Rs. 1999</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="1500-1999" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 2000 To Rs. 2499</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="2000-2499" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 2500 To Rs. 2999</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="2500-2999" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 3000 To Rs. 3499</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="3000-3499" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 3500 To Rs. 3999</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="3500-3999" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 4000 To Rs. 4499</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="4000-4499" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label text-gray" for="price4">Rs. 4500 To Rs. 4999</label>
                                    <input class="widget__form--check__input price submitfild" name="price" value="4500-4999" id="price4" type="checkbox">
                                    <span class="widget__form--checkmark"></span>
                                </li>

                            </ul>
                        </div> -->
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">Size</h2>
                            <div class="product__variant pt-0">

                                <div class="product__variant--list pb-5">
                                    <ul class="widget__form--check">
                                    </ul>
                                    <fieldset class="variant__input--fieldset weight py-2">
                                        @foreach($sizes as $size)
                                        <input id="{{ $size->id }}" class="submitfild" name="size" value="{{ $size->value }}" type="radio">
                                        <label class="variant__size--value blue rounded-0 my-1" for="{{ $size->id }}">{{ $size->value }}</label>

                                        @endforeach

                                    </fieldset>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="shop__header bg__gray--color px-0 mx-0 d-flex align-items-center mt-0 pt-0 justify-content-between mb-30">
                        <div class="d-block">
                            <!-- <p class="product__showing--count text-gray m-0 p-0">Home / Oversized T-shirts</p> -->
                            <p class="product__showing--count m-0 p-0">{{ count($products) }} items</span></p>
                        </div>
                        <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                            <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                            </svg>
                            <span class="widget__filter--btn__text">Filter</span>
                        </button>
                        <!-- <div class="product__view--mode d-flex align-items-center">
                            <div class="product__view--mode__list me-4 product__short--by align-items-center d-none d-lg-flex">
                                <label class="product__view--label me-4">Pages :</label>
                                <div class="select shop__header--select">
                                    <select class="product__view--select">
                                        <option selected value="1">65</option>
                                        <option value="2">40</option>
                                        <option value="3">42</option>
                                        <option value="4">57 </option>
                                        <option value="5">60 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
                                <div class="select shop__header--select">
                                    <select class="product__view--select">
                                        <option selected value="1">Sort by latest</option>
                                        <option value="2">Sort by popularity</option>
                                        <option value="3">Sort by newness</option>
                                        <option value="4">Sort by rating </option>
                                    </select>
                                </div>
                            </div>


                        </div> -->

                    </div>
                    <div class="shop__product--wrapper">
                        <div class="tab_content">
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner product__grid--inner" id="productData">
                                    <div>




                                    @include('frontend.partial.listproduct')
                                   


                                    </div>

                                </div>
                            </div>

                            
                            <div id="pagenationn">{{ $products->links('vendor.pagination.default') }}</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shop section -->

    <!-- Start shipping section -->
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
    <!-- End shipping section -->
    <!-- Start offcanvas filter sidebar -->
    <div class="offcanvas__filter--sidebar widget__area">
        <button type="button" class="offcanvas__filter--close" data-offcanvas>
            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg> <span class="offcanvas__filter--close__text">Close</span>
        </button>
        <div class="offcanvas__filter--sidebar__inner">
            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">PRODUCTS</h2>

                <ul class="widget__form--check">



                  <!--- main category and sub category--->



                  <!---end main category--->




                </ul>

            </div>
            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">THEMES</h2>
                <ul class="widget__form--check">

                  
                </ul>
            </div>
            <!-- <div class="single__widget price__filter widget__bg">
                <h2 class="widget__title h3">PRICES</h2>
                <div class="">
                    <fieldset class="filter-price w-100">
                        <div class="price-wrap">
                            <span class="price-title">Ranges:</span>
                            <div class="price-wrap-1">
                                <span class="price__filter--currency">Rs</span>
                                <input id="canvas_one">
                            </div>
                            <div class="price-wrap_line">-</div>
                            <div class="price-wrap-2">
                                <span class="price__filter--currency">Rs</span>
                                <input id="canvas_two">
                            </div>
                        </div>
                        <div class="price-field">
                            <input type="range" min="100" max="500" value="100" id="canvas_lower" class="w-100">
                            <input type="range" min="100" max="500" value="500" id="canvas_upper" class="w-100">
                        </div>

                    </fieldset>
                </div>

            </div> -->

            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">color</h2>
                <ul class="widget__form--check">

                    @foreach($colors as $color)
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray d-flex align-items-center">
                            <span class="p-3 rounded-circle me-3" style="background-color:{{$color->code}};"></span>{{ $color->name }}</label>
                        <input class="widget__form--check__input submitfild" value="{{ $color->code }}" type="radio">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    @endforeach


                </ul>
            </div>

            <!-- <div class="single__widget widget__bg">
                <h2 class="widget__title h3">Price</h2>
                <ul class="widget__form--check">

                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price1">Rs. 199 To Rs. 499</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="199-499" id="price1" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price2">Rs. 500 To Rs. 999</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="500-999" id="price2" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price3">Rs. 1000 To Rs. 1499</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="1000-1499" id="price3" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 1500 To Rs. 1999</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="1500-1999" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 2000 To Rs. 2499</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="2000-2499" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 2500 To Rs. 2999</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="2500-2999" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 3000 To Rs. 3499</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="3000-3499" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 3500 To Rs. 3999</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="3500-3999" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 4000 To Rs. 4499</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="4000-4499" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label text-gray" for="price4">Rs. 4500 To Rs. 4999</label>
                        <input class="widget__form--check__input price submitfild" name="price" value="4500-4999" id="price4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>

                </ul>
            </div> -->


            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">Size</h2>
                <div class="product__variant pt-0">

                    <div class="product__variant--list pb-5">
                        <ul class="widget__form--check">
                        </ul>
                        <fieldset class="variant__input--fieldset weight py-2">
                            @foreach($sizes as $size)
                            <input id="{{ $size->id }}" name="weight" value="{{ $size->value }}" type="radio" checked>
                            <label class="variant__size--value blue rounded-0 my-1" for="{{ $size->id }}">{{ $size->value }}</label>

                            @endforeach
                        </fieldset>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- End offcanvas filter sidebar -->
</main>

@section('script')
<script>
    $(document).ready(function() {






        $('input:checkbox').click(function() {
            $('.price:checkbox').not(this).prop('checked', false);
        });


        $('.submitfild').on('click', function() {
            let checkedValues = $('input[name="category_id"]:checked').map(function() {
                return this.value;
            }).get();

            let size = $('input[name="size"]:checked').map(function() {
                return this.value;
            }).get();

            let color = $('input[name="color"]:checked').map(function() {
                return this.value;
            }).get();

            let price = $('input[name="price"]:checked').val();

            console.log(color);



            $.ajax({
                url: "{{ route('productFilter') }}", // Create a route for toggling the wishlist
                method: 'POST',
                data: {
                    category_ids: checkedValues,
                    sizes: size,
                    price: price,
                    color: color,
                   // parendId:"",

                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {

                    $("#productData").html(data);
                    $('#pagenationn').hide();
                }
            });


            // console.log(checkedValues);

            // You can use checkedValues in your further logic or send it to the server via AJAX
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
                        let htmlContent = '<a><i class="fa-solid fa-heart faxl"></i></a>';


                        icon.html(htmlContent);
                    } else {
                        let htmlContent = '<a><i class="far fa-heart fa-xl"></i></span></a>';


                        icon.html(htmlContent);
                    }
                }
            });
        });

    });
</script>
 <script>
    let lowerSlider = document.querySelector('#lower');
    let upperSlider = document.querySelector('#upper');
    let canvas_lowerSlider = document.querySelector('#canvas_lower');
    let canvas_upperSlider = document.querySelector('#canvas_upper');

    document.querySelector('#two').value = upperSlider.value;
    document.querySelector('#one').value = lowerSlider.value;

    document.querySelector('#canvas_two').value = canvas_upperSlider.value;
    document.querySelector('#canvas_one').value = canvas_lowerSlider.value;

    let lowerVal = parseInt(lowerSlider.value);
    let upperVal = parseInt(upperSlider.value);

    let canvas_lowerVal = parseInt(canvas_lowerSlider.value);
    let canvas_upperVal = parseInt(canvas_upperSlider.value);

    upperSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value = this.value
    };

    canvas_upperSlider.oninput = function() {
        canvas_lowerVal = parseInt(canvas_lowerSlider.value);
        canvas_upperVal = parseInt(canvas_upperSlider.value);

        if (canvas_upperVal < canvas_lowerVal + 4) {
            canvas_lowerSlider.value = canvas_upperVal - 4;
            if (canvas_lowerVal == canvas_lowerSlider.min) {
                canvas_upperSlider.value = 4;
            }
        }
        document.querySelector('#canvas_two').value = this.value
    };

    lowerSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value = this.value
    };

    canvas_lowerSlider.oninput = function() {
        canvas_lowerVal = parseInt(canvas_lowerSlider.value);
        canvas_upperVal = parseInt(canvas_upperSlider.value);
        if (canvas_lowerVal > canvas_upperVal - 4) {
            canvas_upperSlider.value = canvas_lowerVal + 4;
            if (canvas_upperVal == canvas_upperSlider.max) {
                canvas_lowerSlider.value = parseInt(canvas_upperSlider.max) - 4;
            }
        }
        document.querySelector('#canvas_one').value = this.value
    };


    $('.show-more-content').hide();

    $('.show-more').click(function() {
        $('.show-more-content').show(150);
        $('.show-less').show();
        $('.show-more').hide();
    });

    $('.show-less').click(function() {
        $('.show-more-content').hide(150);
        $('.show-more').show();
        $(this).hide();
    });
</script> 

@endsection
@endsection