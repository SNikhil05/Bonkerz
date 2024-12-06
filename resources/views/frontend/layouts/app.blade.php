<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>bonker - Fashion eCommerce HTML Template</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" sizes="16x16 32x32" type="image/svg" href="{{ asset('assets/frontend/img/logo/bonkerlogo.svg') }}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/jquery-ui.css') }}">



    <link rel="stylesheet" href="https://demo.activeitzone.com/ecommerce/public/assets/css/aiz-core.css?v=4648">
    

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/all.min.css') }}" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bonkerz.css') }}">
    <!---sweet alert---->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/sweetalert.min.css') }}">

    <!--end sweet alert -->

    <!--- select2 css---->
    <link href="{{ asset('assets/frontend/css/plugins/select2.min.css') }}" rel="stylesheet" />


    <!--- end select2-->



    <!--- jqiery cdn ---->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->

    <!---- end jquery cdn --->

    <!-- <link rel="stylesheet" href="{{ asset('assets/css/aiz-core.css?v=') }}{{ rand(1000, 9999) }}">


    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!! translate('
            Nothing selected ', null, true) !!}',
            nothing_found: '{!! translate('
            Nothing found ', null, true) !!}',
            choose_file: '{{ translate('
            Choose file ') }}',
            file_selected: '{{ translate('
            File selected ') }}',
            files_selected: '{{ translate('
            Files selected ') }}',
            add_more_files: '{{ translate('
            Add more files ') }}',
            adding_more_files: '{{ translate('
            Adding more files ') }}',
            drop_files_here_paste_or: '{{ translate('
            Drop files here,
            paste or ') }}',
            browse: '{{ translate('
            Browse ') }}',
            upload_complete: '{{ translate('
            Upload complete ') }}',
            upload_paused: '{{ translate('
            Upload paused ') }}',
            resume_upload: '{{ translate('
            Resume upload ') }}',
            pause_upload: '{{ translate('
            Pause upload ') }}',
            retry_upload: '{{ translate('
            Retry upload ') }}',
            cancel_upload: '{{ translate('
            Cancel upload ') }}',
            uploading: '{{ translate('
            Uploading ') }}',
            processing: '{{ translate('
            Processing ') }}',
            complete: '{{ translate('
            Complete ') }}',
            file: '{{ translate('
            File ') }}',
            files: '{{ translate('
            Files ') }}',
        }
    </script> -->


<style>
 .swal2-container{
        position: fixed;
        z-index: 9999999999;
    }
    div:where(.swal2-icon).swal2-success .swal2-success-ring {
    border: 0.25em solid rgb(248 202 159)!important;
}
div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
    background: rgb(1 28 104)!important;
}
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
    background-color: #ff810c!important;
}
.search-input-box > input {
    border-radius: 21px;
    overflow: hidden;
    height: 40px;
    width: 250px;
}

input:disabled {
  cursor: default;
  background-color: rgba(217, 217, 217, 0.3);
  color: rgb(72, 68, 68);
  border-color: rgba(217, 217, 217, 0.3);
}
.error{
    color:red;
}



.control-label{
  display:block;
  margin:40px auto;
  font-weight:900;
}
.verification-code--inputs input[type=text] {
    border: 2px solid #e1e1e1;
    width: 46px;
    height: 46px;
    padding: 10px;
    text-align: center;
    display: inline-block;
  box-sizing:border-box;
}
    </style>



</head>

<body>
    <!-- aiz-main-wrapper -->
    <div class="">

        @include('frontend.inc.header')

        @yield('content')

        <!-- footer -->
        @include('frontend.inc.footer')

    </div>









    @yield('modal')

    <script src="{{ asset('assets/frontend/js/plugins/jquery.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/jquery-ui.js') }}"></script>
    <!--- select2 js---->
<script src="{{ asset('assets/frontend/js/plugins/select2.min.js') }}"></script>
<!--end select2 js--->


    <!-- All Script JS Plugins here  -->
    <script src="{{ asset('assets/frontend/js/vendor/popper.js') }}" defer="defer"></script>
    <script src="{{ asset('assets/frontend/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('assets/frontend/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/glightbox.min.js') }}"></script>



 




    <!-- Customscript js -->
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/all.min.js') }}"></script>

    <!---sweet alert--->

    <script src="{{ asset('assets/frontend/js/sweetalert.min.js') }}"></script>
    <!---sweet alert end--->
<script>






















    function addToCart() {
        // @if(Auth::check() && Auth::user()->user_type != 'customer')
        // AIZ.plugins.notify('warning', "{{ translate('Please Login as a customer to add products to the Cart.') }}");
        // return false;
        // @endif

      //  if (checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
                type: "POST",
                url: '{{ route('cart.addToCart') }}',
                data: $('#option-choice-form').serializeArray(),
                success: function(data) {
                    // $('#addToCart-modal-body').html(null);
                    // $('.c-preloader').hide();
                    // $('#modal-size').removeClass('modal-lg');
                    // $('#addToCart-modal-body').html(data.modal_view);
                    // AIZ.extra.plusMinus();
                    // AIZ.plugins.slickCarousel();
                    // updateNavCart(data.nav_cart_view, data.cart_count);

                    $('#cartt').text(data.cart_count);

if(data.status==1){
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "Cart Added Successfully !"
    });

}else{


    const Toastttt = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
         timer: 3000,
        timerProgressBar: true,
        didOpen: (toastt) => {
            toastt.onmouseenter = Swal.stopTimer;
            toastt.onmouseleave = Swal.resumeTimer;
        }
    });
    Toastttt.fire({
        icon: "error",
        title: data.message
    });


}





                }
            });
       // }
        // } else {
        //     //AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
        // }
    }
</script>

@if (session('success'))
<script>
    const Toasttt = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toasttt) => {
            toasttt.onmouseenter = Swal.stopTimer;
            toasttt.onmouseleave = Swal.resumeTimer;
        }
    });
    Toasttt.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
</script>
@endif
<!-- show success and error message -->
@if (session('error'))
<script>
    const Toastt = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
         timer: 3000,
        timerProgressBar: true,
        didOpen: (toastt) => {
            toastt.onmouseenter = Swal.stopTimer;
            toastt.onmouseleave = Swal.resumeTimer;
        }
    });
    Toastt.fire({
        icon: "error",
        title: "{{ session('error') }}"
    });
</script>
@endif


<script>


$(document).ready(function () {

    let consentGiven = localStorage.getItem('consentGiven');


    if (consentGiven !== null) {
        $('#consentModal').hide();

    }

    if (consentGiven === null) {

       
                setTimeout(function() {
                   
                    $('#consentModal').modal('show');
                   
                }, 6000); // Delay of 6 seconds
            }







            $('#allow').click(function() {
                        setConsent(true);
                        $('#consentModal').hide();
                    });

            $('#dontAllow').click(function() {
                setConsent(false);
                $('#consentModal').hide();
            });





            function setConsent(consent) {
                localStorage.setItem('consentGiven', consent);
                $('#consentModal').modal('hide');

                // Send the consent value to the server
                $.ajax({
                    url: '{{ route('set.consent') }}',
                    method: 'POST',
                    data: {
                        consent: consent,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Consent recorded');
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to record consent');
                    }
                });
            }

















var star_rating = $('.starrating');

var SetRatingStar = function () {
return star_rating.each(function () {
if (parseInt(star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
    
  return $(this).removeClass('far fa-star').addClass('fas fa-star');
} else {
   
  return $(this).removeClass('fas fa-star').addClass('far fa-star');
}
});
};



SetRatingStar();

});




//searc  start


$('#search').on('keyup', function() {
        search();
    });

    $('#search').on('focus', function() {
        search();
    });

    function search() {
        var searchKey = $('#search').val();
        if (searchKey.length > 0) {
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
           $.post("{{ route('search.ajax') }}", {
                      _token: '{{ csrf_token() }}',
                      search: searchKey
                },
               function(data) {
                    if (data == '0') {
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for  <strong>"' + searchKey + '"</strong>');
                        $('.search-preloader').addClass('d-none');

                    } else {
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                }
               );
        } else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }



//search end



    </script>

    @yield('script')



</body>

</html>