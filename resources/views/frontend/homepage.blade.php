@extends('frontend.layouts.app')

@section('content')

<main class="main__content_wrapper">

    <!-- Start banner section -->
    <section class="banner__section banner__style2 section--padding pt-lg-5 pt-0">

        <div class="container-fluid">
            <div class="row mb--n28">

                @foreach($featured_categories as $featured_category)


                <div class="col-lg-4 col-md-order mb-28">
                    <div class="banner__items position__relative">
                        <a class="banner__items--thumbnail " href="{{ route('subCategory', $featured_category->slug) }}"><img class="banner__items--thumbnail__img" src="{{ isset($featured_category->coverImage->file_name) ? my_asset($featured_category->coverImage->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="banner-img">
                            <div class="bottom-0 position-absolute start-50 style2 translate-middle-x text-white text-center">
                                <span class="">Go To Fashion</span>
                                <h3 class="banner__items--content__title style2 text-uppercase text-center text-white">{{ $featured_category->name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>

                @endforeach



            </div>
        </div>
    </section>
    <!-- End banner section -->
</main>
@endsection