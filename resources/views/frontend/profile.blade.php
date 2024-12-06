@extends('frontend.layouts.app')

@section('content')
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
    const Toastt = Swal.mixin({
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
    Toastt.fire({
        icon: "error",
        title: "{{ session('error') }}"
    });
</script>
@endif
@section('content')


@php
    use Carbon\Carbon;
@endphp
<main class="main__content_wrapper">

    <section class="my__account--section section--padding">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">
                    @include('frontend.partial.profilenav')
                </div>
                <div class="col-md-8">
                    <div class="my__account--section__inner border-radius-10">

                    @if($user->is_membership_valid=='1')

                    <div class="alert alert-success text-center" role="alert">
                    You are now an Exclusive member.The memnership is valid till <span class="text-decoration-underline">{{ Carbon::parse($user->member_expire_at)->format('d M Y') }}.</span>
                    </div>
                    @endif

                        <h2 class="account__content--title h3 mb-20">General Information</h2>
                        <form class="contact__form--inner" method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="fullname">Full Name <span class="contact__form--label__star">*</span></label>
                                        <input class="contact__form--input" required name="name" value="{{ $user->name ?? ''}}" id="fullname" placeholder="Your Full Name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label">Date of Birth<span class="contact__form--label__star">*</span></label>
                                        <input class="contact__form--input" required name="date_of_birth" value="{{ $user->date_of_birth ?? ''}}" id="datepicker" placeholder="Your Date of Birth" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="input3">Phone Number <span class="contact__form--label__star">*</span></label>
                                        <input class="contact__form--input" required maxLength="10" minLenth="10" name="phone" value="{{ $user->phone }}" id="input3" placeholder="Phone number" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="input4">Email</label>
                                        <input class="contact__form--input" name="email" value="{{ $user->email }}" disabled required name="email" id="input4" placeholder="Email" type="email" style="background: #1a00001c;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="contact__form--list mb-15">
                                        <label class="contact__form--label" for="input5">Default Address</label>
                                        <textarea class="contact__form--textarea" name="address" id="input5" placeholder="Write Your  Address">{{ $user->address ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="contact__form--btn primary__btn" type="submit">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>




@section('script')
<script>
    $(function() {
        $("#datepicker").datepicker();
    });
</script>
@endsection
@endsection