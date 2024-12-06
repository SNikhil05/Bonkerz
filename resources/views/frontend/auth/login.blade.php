@extends('frontend.layouts.app')
<style>
    .radio-check {
        column-gap: 20px;
        display: flex;
    }

    .datepicker {
    padding: 1.5rem !important;
}

.datepicker td, .datepicker th {
    text-align: center;
    width: 40px !important;
    height: 30px !important;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: none;
}

.datepicker table tr td span {
    display: block;
    width: 31% !important;
    height: 40px !important;
    line-height: 54px;
    float: left;
    margin: 1%;
    cursor: pointer;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
    width: 300px;
    text-align: center;
}
table.table-condensed {
    width: 270px;
}
    
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">




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
    const Toastt = Swal.mixin({
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
    Toastt.fire({
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
                    <ul class="product__details--tab d-flex mb-30 justify-content-center">
                        <li class="product__details--tab__list active border border-end-0 py-3 text-center w-auto px-5 m-0" data-toggle="tab" data-target="#login">Login
                        </li>
                        <li class="product__details--tab__list py-3 border  text-center m-0 w-auto px-5" data-toggle="tab" data-target="#register">Register
                        </li>
                        <li class="product__details--tab__list py-3 border border-start-0  text-center m-0 w-auto px-5" data-toggle="tab" data-target="#otp">Log in With OTP
                        </li>



                    </ul>
                    <div class="product__details--tab__inner border-radius-10">





                        <div class="tab_content">
                            <div id="login" class="tab_pane active show">
                                <div class="login__section section--padding py-0">
                                    <div class="container">
                                        <form action="{{ route('cart.login.submit')}}" method="post" id="login_frm">
                                            @csrf
                                            <div class="login__section--inner">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-7">


                                                        @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @endif
                                                        <div class="account__login">
                                                            <div class="account__login--header mb-25">
                                                                <h2 class="account__login--header__title h3 mb-10">
                                                                    Login</h2>
                                                                <p class="account__login--header__desc">Login if you
                                                                    area a returning customer.</p>
                                                            </div>
                                                            <div class="account__login--inner">
                                                                <input required class="account__login--input text-dark my-3" placeholder="Email Addres" name="email" type="text" required>
                                                                <input required class="account__login--input text-dark my-3" placeholder="Password" name="password" type="password" required>
                                                                <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">


                                                                    <button class="account__login--forgot my-3">Forgot
                                                                        Your Password?</button>

                                                                </div>
                                                                <button class="account__login--btn primary__btn" type="submit">Login</button>
                                                                <div class="account__login--divide">
                                                                    <span class="account__login--divide__text">OR</span>
                                                                </div>



                                                                <div class="account__social d-flex gap-4 justify-content-center mb-15">
                                                                    <a class="" target="_blank" href="{{ route('social.login', 'facebook') }}"><i class="fa-brands fa-2xl fa-square-facebook"></i></a>
                                                                    <a class="" target="_blank" href="{{ route('social.login', 'google') }}"><i class="fa-brands fa-2xl fa-square-google-plus"></i></a>
                                                                    <a class="" target="_blank" href="{{ route('social.login', 'twitter') }}"><i class="fa-brands fa-2xl fa-square-x-twitter"></i></a>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                    </div>




                                </div>
                            </div>

                            <div id="otp" class="tab_pane">
                                <div class="login__section section--padding pt-0">

                                    <div class="container">
                                        <form action="{{ route('sendOtp') }}" method="post" id="otp_frm">
                                            @csrf
                                            <div class="login__section--inner">
                                                <div class="row justify-content-center">

                                                    <div class="col-md-7">
                                                        <div class="account__login register">
                                                            <div class="account__login--header mb-25">
                                                                <h2 class="account__login--header__title h3 mb-10">
                                                                    Login</h2>
                                                                <p class="account__login--header__desc">Login if you area a returning customer.
                                                                </p>
                                                            </div>
                                                            <div class="account__login--inner">
                                                                <div class="verification-code">

                                                                    <div class="form-group">

                                                                        <input type="text" class="form-control account__login--input" name="phone" placeholder="Enter Your Registerd Mobile Number">
                                                                    </div>
                                                                    <input type="hidden" id="verificationCode" />
                                                                </div>
                                                                <button class="account__login--btn primary__btn my-3" type="submit">Send Otp</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="register" class="tab_pane">
                                <div class="login__section section--padding pt-0">

                                    <div class="container">
                                        <form action="{{ route('user.register') }}" method="post" id="regs">
                                            @csrf
                                            <div class="login__section--inner">
                                                <div class="row justify-content-center">

                                                    <div class="col-md-7">
                                                        <div class="account__login register">
                                                            <div class="account__login--header mb-25">
                                                                <h2 class="account__login--header__title h3 mb-10">
                                                                    Create an Account</h2>
                                                                <p class="account__login--header__desc">Register
                                                                    here if you are a new customer</p>
                                                            </div>
                                                            <div class="account__login--inner">
                                                                <input required class="account__login--input text-dark my-3" name="name" placeholder="Name" type="text">
                                                                <input required class="account__login--input text-dark my-3" name="email" placeholder="Email Addres" type="email">
                                                                <input required class="account__login--input text-dark my-3" name="phone" placeholder="Phone Number" onkeypress="return /[0-9]/i.test(event.key)" minLength="10" maxLength="10" type="text">



                                                                <input required class="account__login--input text-dark psd my-3" placeholder="Password" id="active_psd" name="password" type="password">
                                                                <input required disabled id="disable_psd" class="account__login--input text-dark my-3" placeholder="Confirm Password" name="password_confirmation" type="password">


                                                                <!-- <input required id="birth" class="account__login--input text-dark my-3" placeholder="DOB" name="date_of_birth" type="text"> -->

                                                                <div class='input-group date' >
                                                                    <input type='text' class="form-control account__login--input" placeholder="DOB" name="startDate" id='startDate'/>
                                                                </div>

                                                                <div class="radio-check">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1">
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Male
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2" checked>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Female

                                                                        </label>
                                                                    </div>


                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" value="other" id="flexRadioDefault2" checked>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Other

                                                                        </label>
                                                                    </div>
                                                                </div>




                                                                <button class="account__login--btn primary__btn my-3" type="submit">Submit &amp; Register</button>

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
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
  
  $(function () {
	$('#startDate').datepicker({
   format: 'dd/mm/yyyy' 
  });
  });
	
  
});
</script>
<script>
    // $(document).ready(function() {

    //     $(function() {
    //         $("#birth").
    //         datepicker();
    //     });
    // })
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

    });
    // keyup
</script>
@endsection