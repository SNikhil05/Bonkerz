@extends('frontend.layouts.app')
@if (session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 30000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
</script>
@endif
<!-- show success and error message -->
@if (session('error'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 30000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "error",
        title: "{{ session('error') }}"
    });
</script>
@endif
@section('content')
<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">

    </section>
    <section class="product__details--tab__section section--padding">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">

                    <div class="product__details--tab__inner border-radius-10">





                        <div class="tab_content">


                            <div>
                                <div class="login__section section--padding pt-0">

                                    <div class="container">
                                        <form action="{{ route('verifyOtp') }}" method="post" id="otp_frm">
                                            @csrf
                                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                                            <div class="login__section--inner">
                                                <div class="row justify-content-center">

                                                    <div class="col-md-7">
                                                        <div class="account__login register">
                                                            <div class="account__login--header mb-25 text-center">


                                                                <h2 class="account__login--header__title h3 mb-10">
                                                                    Login With OTP</h2>
                                                                <p class="account__login--header__desc">We have sent you an OTP via SMS.
                                                                </p>
                                                            </div>
                                                            <div class="account__login--inner">
                                                                <div class="verification-code">

                                                                    <div class="verification-code--inputs my-4 d-flex gap-4 justify-content-center">
                                                                        <input name="otp[]" type="text" maxlength="1" />
                                                                        <input name="otp[]" type="text" maxlength="1" />
                                                                        <input name="otp[]" type="text" maxlength="1" />
                                                                        <input name="otp[]" type="text" maxlength="1" />

                                                                    </div>

                                                                </div>
                                                                <button class="account__login--btn primary__btn my-3" type="submit">Verify OTP</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
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
@section('script')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $("#login_frm").validate({

    });

    $("#regs").validate({
        rules: {
            name: {
                required: true,
            },
            password_confirmation: {
                equalTo: "#active_psd"
            }
        },
        messages: {
            name: "Please specify your name",
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            },
            phone: {
                required: "We need your phone number to contact you",
                minLength: 10,
            },

        },
    });
    $('#active_psd').on('input change', function() {
        if ($(this).val() != '') {
            $('#disable_psd').prop('disabled', false);
        } else {
            $('#disable_psd').prop('disabled', false);
        }
    });

    //Code Verification
    var verificationCode = [];
    $(".verification-code input[type=text]").keyup(function(e) {

        // Get Input for Hidden Field
        $(".verification-code input[type=text]").each(function(i) {
            verificationCode[i] = $(".verification-code input[type=text]")[i].value;
            $('#verificationCode').val(Number(verificationCode.join('')));
            //console.log( $('#verificationCode').val() );
        });

        //console.log(event.key, event.which);

        if ($(this).val() > 0) {
            if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event
                .key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
                $(this).next().focus();
            }
        } else {
            if (event.key == 'Backspace') {
                $(this).prev().focus();
            }
        }

    }); // keyup
</script>
@endsection