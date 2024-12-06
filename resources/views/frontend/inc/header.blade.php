<!-- Start preloader -->
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <img src="{{ asset('assets/frontend/img/logo/bonkerlogo.svg') }}" alt="">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
</div>
<!-- End preloader -->

<!-- Start header area -->
<header class="header__section">
    <div class="header__topbar--style3 bg-dark text-white py-1">
        <div class="container-fluid-2">
            <div class="header__topbar--inner style3 d-flex align-items-center justify-content-between">

                <div class="text-center mx-auto">
                    <p class="text-white">New Users Only ! All India <span class="text-danger">Free Delivery + 15% Extra Discount</span> Code: SHE15.</p>
                </div>

            </div>
        </div>
    </div>
    <div class="main__header main__header--style3 header__sticky border-bottom">
        <div class="container-fluid-2">
            <div class="row align-items-center position__relative">
                <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-4 col-3">
                    <div class="offcanvas__header--menu__open ">
                        <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512">
                                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352" />
                            </svg>
                            <span class="visually-hidden">Menu Open</span>
                        </a>
                    </div>
                    <div class="header__menu d-none d-lg-block">
                        <nav class="header__menu--navigation">
                            <div class="header__social">
                                <ul class="header__social--inner d-flex align-items-center">
                                    <li class="header__social--list ">
                                        <a class="header__social--list__icon" target="_blank" href="https://www.facebook.com/">
                                            <i class="fa-brands fa-square-facebook fa-2xl"></i>
                                        </a>
                                    </li>
                                    <li class="header__social--list ">
                                        <a class="header__social--list__icon" target="_blank" href="https://twitter.com/">
                                            <i class="fa-brands fa-square-snapchat fa-2xl"></i>
                                        </a>
                                    </li>
                                    <li class="header__social--list ">
                                        <a class="header__social--list__icon" target="_blank" href="https://www.instagram.com/">
                                            <i class="fa-brands fa-square-instagram fa-2xl"></i>
                                        </a>
                                    </li>
                                    <li class="header__social--list ">
                                        <a class="header__social--list__icon" target="_blank" href="https://www.youtube.com/">
                                            <i class="fa-brands fa-square-youtube fa-2xl"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-6">
                    <div class="main__logo text-center">
                        <h1 class="main__logo--title"><a class="main__logo--link" href="/"><img class="main__logo--img" src="{{ asset('assets/frontend/img/logo/bonkerlogo.svg') }}" alt="logo-img"></a></h1>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-4 col-lg-3 col-md-4 col-3">
                    <div class="header__account header__account2">
                        <ul class="d-lg-flex d-none justify-content-end align-items-center">
                            <li class="header__account--items header__account2--items  header__account--search__items d-sm-none">
                                <a class="header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                                    <svg class="header__search--button__svg" xmlns="http://www.w3.org/2000/svg" width="26.51" height="23.443" viewBox="0 0 512 512">
                                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448" />
                                    </svg>
                                    <span class="visually-hidden">search btn</span>
                                </a>
                            </li>








                            @if (Auth::check())
                            <!-- User is logged in, hide the login button -->

                            <!-- <a href="{{ route('user.logout') }}">Logout</a>
                            <p>Welcome, {{ Auth::user()->name }}!</p> -->






                            <li class="header__menu--items header__account--items header__account2--items">
                                <a class="header__account--btn bg-dark text-white rounded p-2" href="javascript:void(0)">
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </a>
                                <ul class="header__sub--menu">
                                    <li class="header__sub--menu__items"><a href="{{ route('profile') }}" class="header__sub--menu__link">Profile</a></li>
                                    <li class="header__sub--menu__items"><a href="{{ route('purchase_history.index') }}" class="header__sub--menu__link">Order</a></li>
                                    <!-- <li class="header__sub--menu__items"><a href="#" class="header__sub--menu__link">Gift Vouchers</a></li> -->
                                    <li class="header__sub--menu__items"><a href="{{ route('user.bsdkPoint') }}" class="header__sub--menu__link">BSDK Points</a></li>
                                    <li class="header__sub--menu__items"><a href="{{ route('user.bsdkMoney') }}" class="header__sub--menu__link">BSDK Money</a></li>
                                    <li class="header__sub--menu__items"><a href="#" class="header__sub--menu__link">My Coupon</a></li>

                                    <li class="header__sub--menu__items"><a href="{{ route('faq') }}" class="header__sub--menu__link">FAQ’s</a></li>


                                    <!-- <li class="header__sub--menu__items"><a href="#" class="header__sub--menu__link">Saved Address</a></li> -->

                                    <li class="header__sub--menu__items"><a href="{{ route('user.logout') }}" class="header__sub--menu__link">Log out</a></li>

                                </ul>
                            </li>




                            @else
                            <!-- User is not logged in, show the login button -->
                            <!-- <li class="header__account--items header__account2--items">
                                <a class="header__account--btn bg-dark text-white rounded p-2" href="{{ route('user.login') }}">
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </a>
                            </li> -->

                            <li class="header__account--items header__account2--items"><a class="header__account--btn text-dark" href="{{ route('user.login') }}">
                                    <span class="offcanvas__account--items__label">Login / Register</span>
                                </a></li>

                            @endif





                            @if(Auth::check())
                            <li class="header__account--items header__account2--items d-none d-lg-block">
                                <a class="header__account--btn bg-dark text-white rounded p-2" href="{{ route('user.wishlist') }}">
                                    <i class="fa-solid fa-heart fa-lg"></i>
                                </a>
                            </li>
                            @endif


                            @if(Auth::check())
                            @php
                            $userId = auth()->id();
                            $countCart = App\Models\Cart::where('user_id', $userId)->count();


                            @endphp
                            <li class="header__account--items header__account2--items ">
                                <a class="header__account--btn minicart__open--btn bg-dark text-white rounded p-2" href="{{ route('cart') }}">
                                    <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                    <span id="cartt" class="items__count style2">{{ $countCart }}</span>
                                </a>
                            </li>
                            @else
                            <li class="header__account--items header__account2--items ">
                                <a class="header__account--btn minicart__open--btn bg-dark text-white rounded p-2" href="{{ route('user.login') }}">
                                    <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                    <span class="items__count style2">0</span>
                                </a>
                            </li>

                            @endif




                            <li class="header__account--items header__account2--items ">
                                <a class="header__account--btn minicart__open--btn bg-dark text-white rounded p-2" href="#">
                                    <i class="fa-solid fa-money-bill-transfer fa-lg"></i>
                                    <!-- <span class="items__count style2">02</span>  -->
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main__header main__header--style3 header__sticky bg-red d-none d-lg-block py-0">
        <div class="container-fluid-2">
            <div class="row align-items-center position__relative">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-4 col-3">
                    <div class="offcanvas__header--menu__open ">
                        <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512">
                                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352" />
                            </svg>
                            <span class="visually-hidden">Menu Open</span>
                        </a>
                    </div>
                    <div class="header__menu d-none d-lg-block">
                        <nav class="header__menu--navigation">
                            <ul class="align-items-center d-flex justify-content-between">
                                <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="{{ route('subCategory', 'mens') }}">Mens</a>
                                </li>
                                <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="{{ route('subCategory', 'womens') }}">Womens</a>
                                </li>
                                <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="{{ route('subCategory', 'BSDK&Unisex') }}"><span class="text-black">BSDK</span> Unisex</a>
                                </li>
                                <!-- <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="#Track.php">Track order</a>
                                </li> -->
                                <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="#Influncer.php">Influncer Program</a>
                                </li>
                                <li class="header__menu--items style3">
                                    <a class="header__menu--link text-uppercase text-white" href="#store.php">Store Locator</a>
                                </li>
                                <li class="header__menu--items style3">






                                    <!-- <div class="header__search--box">
                                        <label>
                                            <input class="bg-transparent border border-2  border-white header__search--input rounded-pill" placeholder="Search here..." type="text">
                                        </label>
                                        <button class="align-items-center bg-white bg__secondary d-flex header__search--button justify-content-center px-3 py-2 rounded-circle text-white" type="submit" aria-label="search button">
                                            <svg class="header__search--button__svg text-black" xmlns="http://www.w3.org/2000/svg" width="27.51" height="26.443" viewBox="0 0 512 512">
                                                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                                            </svg>
                                        </button>
                                    </div> -->


                                    <div class="flex-grow-1 front-header-search d-flex gap-3 align-items-center">
                                        <div class="position-relative flex-grow-1 px-3 px-lg-0">
                                            <form action="{{ route('search') }}" method="GET" class="stop-propagation mb-0">
                                                <div class="d-flex position-relative align-items-center">
                                                    <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                                        <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                                    </div>
                                                    <div class=" header__search--box">
                                                        <input type="text" class="bg-transparent border border-2  border-white header__search--input rounded-pill" id="search" name="keyword" @isset($query) value="{{ $query }}" @endisset placeholder="{{ translate('I am shopping for...') }}" autocomplete="off">

                                                        <button class="align-items-center bg-white bg__secondary d-flex header__search--button justify-content-center px-3 py-2 rounded-circle text-white" type="submit" aria-label="search button">
                                                            <svg class="header__search--button__svg text-black" xmlns="http://www.w3.org/2000/svg" width="27.51" height="26.443" viewBox="0 0 512 512">
                                                                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="z-index: 9;">
                                                <div class="search-preloader absolute-top-center">
                                                    <div class="dot-loader">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                                <div class="search-nothing d-none p-3 text-center fs-16">

                                                </div>
                                                <div id="search-content" class="text-left">

                                                </div>
                                            </div>
                                        </div>
                                    </div>








                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Start Offcanvas header menu -->
    <div class="offcanvas__header">
        <div class="offcanvas__inner">
            <div class="offcanvas__logo">
                <a class="offcanvas__logo_link" href="/">
                    <img src="{{ asset('assets/frontend/img/logo/bonkerlogo.svg') }}" alt="Grocee Logo" width="158" height="36">
                </a>
                <button class="offcanvas__close--btn" data-offcanvas>close</button>
            </div>
            <nav class="offcanvas__menu">
                <ul class="offcanvas__menu_ul">
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('subCategory', 'mens') }}">Mens</a>

                    </li>
                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{ route('subCategory', 'womens') }}">Womens</a></li>
                    <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{ route('subCategory', 'BSDK&Unisex') }}">BSDK Unisex</a></li>
                    <!-- <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="#Track.php">Track order</a>

                    </li> -->
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="#Influncer.php">Influncer Program</a>

                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="#Store.php">Store Locator</a>
                        <!-- 
                    </li><li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="#Track.php">Track order</a>

                    </li> -->



                        @if (Auth::check())
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('profile') }}">Profile</a>

                    </li>

                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('purchase_history.index') }}">Orders</a>

                    </li>


                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('user.bsdkPoint') }}">BSDK Points</a>

                    </li>

                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('user.bsdkMoney') }}">BSDK Money</a>

                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="#">My Coupon</a>

                    </li>
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('faq') }}">FAQ’s</a>

                    </li>

                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="{{ route('user.logout') }}">Log out</a>

                    </li>
                    @endif










                </ul>

                @if (!Auth::check())
                <div class="offcanvas__account--items">
                    <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('user.login') }}">
                        <span class="offcanvas__account--items__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.51" height="19.443" viewBox="0 0 512 512">
                                <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                            </svg>
                        </span>
                        <span class="offcanvas__account--items__label">Login / Register</span>
                    </a>
                </div>
                @endif

            </nav>
        </div>
    </div>
    <!-- End Offcanvas header menu -->
</header>


<!-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        This is the body of the modal.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->



<div id="consentModal" data-rapid_height="50" style="width: 422px; top: 1px; left: calc(50% - 211px); margin: 0px; padding: 0px; box-shadow: rgb(136, 136, 136) 0px 0px 4px; font-size: 11px; font-weight: 400; position: fixed; z-index: 2147483647; background: #FFFFFF;">
    <div style="margin: 0;padding: 0 20px 10px;word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;">
        <div style="float: left;position: relative;display: inline-block;margin: 15px 15px 0 0!important;padding: 0!important;word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;">
            <img style="word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;height: 65px!important;width: 65px!important;" src="{{ asset('assets/frontend/img/logo/blogo.svg') }}" class="gm-added gm-observing gm-observing-cb">
        </div>
        <div style="word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;position: relative!important;padding: 10px 0 0!important;color: #000!important;text-align: left!important;margin: 0!important;line-height: 1.4em!important;display: inline-block!important;width: calc(100% - 80px)!important;">
            <span style="margin-bottom: 5px; text-align: left; font-size: 14px; font-weight: 700; overflow: hidden; height: 2.8em; line-height: 1.4em; display: block; font-family: Open Sans, sans-serif !important; word-spacing: normal !important; letter-spacing: normal !important; color: #232323 !important;">
                This website would like to send you awesome updates and offers!
            </span>
            <p style="overflow: hidden; height: 2.8em; word-spacing: normal !important; letter-spacing: normal !important; font-family: Open Sans, sans-serif !important; font-size: 12px !important; line-height: 1.4em !important; margin: 10px 0px !important; padding: 0px !important; text-align: left !important; color: #232323 !important;">
                Notifications can be turned off anytime from browser settings.
            </p>
        </div>
        <div style="display: flex;justify-content: space-between;word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;">
            <div style="word-spacing: normal!important;letter-spacing: normal!important;font-family: Open Sans,sans-serif!important;margin: 0!important;padding: 0!important;margin-left: auto !important;">
                <button id="dontAllow" data-bs-dismiss="modal" style="overflow: hidden; word-spacing: normal !important; letter-spacing: normal !important; width: 100px !important; height: 26px !important; font-size: 14px !important; cursor: pointer !important; line-height: 1.1em !important; border-radius: 4px !important; border: 1px solid rgba(0, 0, 0, 0.1) !important; display: inline-block !important; font-weight: 400 !important; margin: 0px 20px 0px 0px !important; padding: 5px !important; text-transform: none !important; box-sizing: border-box !important; text-shadow: none !important; box-shadow: none !important; white-space: nowrap !important; color: #000000; background: #ffffff;">
                    Don't Allow
                </button>
                <button data-bs-dismiss="modal" style="overflow: hidden; word-spacing: normal !important; letter-spacing: normal !important; width: 90px !important; height: 26px !important; font-size: 14px !important; cursor: pointer !important; line-height: 1.1em !important; border-radius: 4px !important; border: 1px solid rgba(0, 0, 0, 0.1) !important; display: inline-block !important; font-weight: 400 !important; margin: 0px !important; padding: 5px !important; text-transform: none !important; box-sizing: border-box !important; text-shadow: none !important; box-shadow: none !important; white-space: nowrap !important; color: #FFFFFF; background: #ed2d2f;" id="allow">
                    Allow
                </button>
            </div>
        </div>
    </div>
</div>



<!-- End header area -->