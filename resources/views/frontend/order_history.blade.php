@extends('frontend.layouts.app')
<style>
    tbody, td, tfoot, th, thead, tr {
  text-wrap: nowrap;
  text-align: center;
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



<main class="main__content_wrapper">

    <section class="my__account--section section--padding">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">
                    @include('frontend.partial.profilenav')
                </div>
                <div class="col-md-8">
                <div class="my__account--section__inner border-radius-10">
                    <div class="account__wrapper account__wrapper--style4 border-radius-10">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Orders History</h2>
                            <div class="table-responsive">
                                <table class="table border">
                                <thead class="">
                                        <tr class="border">
                                            <th class="border">Order</th>
                                            <th class="border">Date</th>
                                            <th class="border">Payment Status</th>
                                            <th class="border">Delivery Status</th>
                                            <th class="border">Total</th>
                                            <th class="border">Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody class="">
                                      
                                      
                                      
                                    @foreach ($orders as $key => $order)
                        @if (count($order->orderDetails) > 0)
                                      
                                       
                                        <tr class="">
                                            <td class="border"><a class="" href="{{route('purchase_history.details', encrypt($order->id))}}">#{{ $order->code }}</a></td>
                                            <td class="border">{{ date('d-m-Y', $order->date) }}</td>
                                            <td class="border">
                                            @if ($order->payment_status == 'paid')
                                        <span class="badge py-2 bg-success px-3 fs-6 w-auto" >Paid</span>
                                    @else
                                        <span class="badge py-2 bg-danger w-auto px-3 fs-6" >Unpaid</span>
                                    @endif
                                    @if($order->payment_status_viewed == 0)
                                        <!-- <span class="ml-2" style="color:green"><strong>*</strong></span> -->
                                    @endif

                                            </td>
                                            <td class="border">  {{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}
                                    @if($order->delivery_viewed == 0)
                                        <!-- <span class="ml-2" style="color:green"><strong>*</strong></span> -->
                                    @endif
                                </td>
                                            <td class="border">{{ single_price($order->grand_total) }}</td>
                                            <td class="border">
                                               <ul class="d-flex justify-content-center gap-3">
                                                    <li><a class="" href="{{route('purchase_history.details', encrypt($order->id))}}"><i
                                                                class="fa-solid text-warning fa-eye"></i></a></li>

                                                                @if($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                                    <li><a href="{{route('purchase_history.destroy', $order->id)}}"><i class="fa-solid text-red fa-trash-can"></i></a>
                                                    </li>
@endif


                                                    <li><a href="{{route('invoiceDownload', $order->id)}}"><i class="fa-solid text-success fa-download"></i></a>
                                                    </li>




                                                </ul>
                                            </td>
                                        </tr>

                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                           
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </section>
</main>





@endsection