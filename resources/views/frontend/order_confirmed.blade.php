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
@section('content')<!-- Start checkout page area -->






<div class="checkout__page--area">
        <div class="container">
            <div class="checkout__page--inner d-flex justify-content-center">
                <div class="main checkout__mian mx-0 px-0">
                   
                    <main class="main__content_wrapper">
                        <form action="#">
                            <div class="checkout__content--step section__shipping--address pt-0">
                                <div class="section__header  text-center position__relative mb-25">
                                    <div class="my-3"><img src="{{ asset('assets/img/order_done.png') }}" alt="" class="" width="90"></div>
                                    @foreach ($combined_order->orders as $order)
                                    <span class="checkout__order--number">Order #{{ $order->code }}</span>
                                    @endforeach
                                 
                                    <h2 class="section__header--title h3">Thank you submission</h2>
                                   
                                </div>
                                <div class="order__confirmed--area border-radius-5 text-center mb-15">
                                    <h3 class="order__confirmed--title h4">Your order is  placed</h3>
                                    <p class="order__confirmed--desc">You,ll receive a confirmation email with your order number shortly</p>
                                    <a class="continue__shipping--btn primary__btn border-radius-5 text-white" href="{{ route('home') }}">continue shopping</a>
                                </div>
                            
                            </div>
                        </form>
                    </main>
                
                </div>
           
            </div>
        </div>
    </div>


@section('script')

@endsection
@endsection











