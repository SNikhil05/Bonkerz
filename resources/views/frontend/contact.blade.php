@extends('frontend.layouts.app')
<style>
    .contact-bg {
        background: url('http://127.0.0.1:8000/assets/frontend/img/icon/membership-bg.jpg');
        background-repeat: repeat;
        background-size: auto;
        margin-top: 12rem;
        background-repeat: no-repeat;
        background-size: cover;
    }

    h1 {
        font-size: 3em !important;
        margin: .67em 0;
    }
</style>
@if (session('success'))
<script>
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
        timer: 3000,
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
@section('content')<!-- Start checkout page area -->


<!-- Start  section -->
<section class="banner__section banner__style2 section--padding py-5 position-relative">
    <div class="container">
        <div class="row mb--n28  position-relative justify-content-center text-center">
            <div class="col-lg-5 col-md-order">
                <h1>Contact Us</h1>

            </div>


        </div>

    </div>


</section>
<section class="section--padding contact-bg px-0 p-md-5">
    <div class="container">
        <div class="row justify-content-center position-relative">
            <div class="col-lg-6">

                <div class="p-5 box d-lg-block d-none"></div>
                <div class="contact__form bg-sky m-0 translate-y">
                    <form class="contact__form--inner" method="post" action="{{ route('contactUsStore') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input1">First Name <span class="contact__form--label__star">*</span></label>
                                    <input required class="contact__form--input" name="first_name" id="input1" placeholder="Your First Name" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input2">Last Name <span class="contact__form--label__star">*</span></label>
                                    <input required class="contact__form--input" name="last_name" id="input2" placeholder="Your Last Name" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input3">Phone Number <span class="contact__form--label__star">*</span></label>
                                    <input required class="contact__form--input" name="phone" id="input3" placeholder="Phone number" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input4">Email <span class="contact__form--label__star">*</span></label>
                                    <input required class="contact__form--input" name="email" id="input4" placeholder="Email" type="email">
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input5">Country <span
                                            class="contact__form--label__star">*</span></label>
                                    <select class="form-control js-example-tags" required>
                                        <option></option>
                                        <option>india</option>
                                        <option>india</option>
                                    </select>
                                </div>
                            </div> -->
                            <!-- <div class="col-lg-6 ">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input6">State <span
                                            class="contact__form--label__star">*</span></label>
                                    <select class="form-control js-example-tags" required>
                                        <option></option>
                                        <option>UP</option>
                                        <option>UP</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="contact__form--list mb-15">
                                    <label class="contact__form--label" for="input5">Your Comment or
                                        Question<span class="contact__form--label__star">*</span></label>
                                    <textarea class="contact__form--textarea" name="message" id="input5" placeholder="It is a long established fact that a reader." required></textarea>
                                </div>
                            </div>

                        </div>
                        <button class="contact__form--btn primary__btn rounded-pill py-2" type="submit">Submit Now</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>
<!-- End  section -->

<section class="mt-5">

</section>




@endsection