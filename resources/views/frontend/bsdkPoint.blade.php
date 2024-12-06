@extends('frontend.layouts.app')
<style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        text-wrap: nowrap;
        text-align: center;
    }
    
.top-img-sec {
    border: 1px solid #e9e9e9;
    padding: 4rem 0;
    margin: 10px 0;
}
.top-img-sec img {
    width: 100px;
    margin-bottom: 10px;
}

.mid-img-sec {
     border: 1px solid #e9e9e9;
    padding: 4rem 0;
     margin: 10px 0;
}

.mid-img-sec h3 {
     font-size: 1.75rem;
    text-transform: uppercase;
    color: #222;
    
}

.mid-img-sec img {
    width: 100px;
    margin-bottom: 10px;
}

.total-count-sec {
     border: 1px solid #e9e9e9;
    padding: 3rem 0; 
     margin: 10px 0;
}
.please-note-sec {
     border: 1px solid #e9e9e9;
    padding: 3rem 2rem; 
     margin: 5px 0;
}


.please-note-sec ul li {
    list-style-type: disc;
    line-height: 30px;
    margin-left: 20px;
    font-size: 18px;
    color: #515151;
}
.total-count-sec h2 {
    font-size: 2rem;
    text-transform: uppercase;
    color: #222;
    margin-bottom: 0px;
}

.total-count-sec h1 {
    font-size: 2.65em;
    margin: .40em 0;
    font-weight: 600;
    color: #222;
}
.please-note-sec h2 {
    font-size: 2rem;
    text-transform: uppercase;
    color: #222;
    margin-bottom: 10px;
}
.account__menu--list {
    
    font-weight: 500 !important;
    margin-bottom: 0px !important;
    padding: 2rem;
    border: 1px solid #e9e9e9;
}
.my__account--section__inner {
        padding: 1rem;
}
.account__content--title {
    font-weight: 500 !important;
}
.my__account--section__inner {
    box-shadow: none !important;
}

.my__account--section__inner {
        padding: 2rem !important;
    }
.account__content--title {
    text-transform: uppercase !important;
    font-size: 2.10rem !important;
}
</style>



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
                        
                        <div class="BsdkPoint">
                            <div class="account__content--title h3 mb-20">My BSDk Points</div>
                            <div class="top-img-sec text-center">
                                <img src="{{ asset('assets/frontend/img/icon/ic6.svg') }}" class="img-fluid">
                                <p class="text-uppercase">A quick and convenient way to and refund</p>
                            </div>
                            <div class="mid-img-sec d-flex">
                                <div class="col text-center">
                                    <img src="{{ asset('assets/frontend/img/icon/ic2.svg') }}" class="img-fluid" style="width: 55px;">
                                    <h3>Instant checkout</h3>
                                    <p>One-click easy and fast checkout</p>
                                </div>
                                <div class="col text-center">
                                    <img src="{{ asset('assets/frontend/img/icon/ic3.svg') }}" class="img-fluid" style="width: 65px;">
                                    <h3>Prompt Rewards</h3>
                                    <p>Get instant prizes as BSDk Points</p>
                                </div>
                            </div>
                             <div class="total-count-sec text-center">
                                 <h2>Total BSDK Points</h2>
                                <h1>350.01</h1>
                            </div>
                             <div class="please-note-sec">
                                <h2>Please Note</h2>
                                <ul>
                                    <li>No minimum or maximum usage limit.</li>
                                    <li>Can be clubbed with gift vouchers and discount codes.</li>
                                    <li>Applicable on products on offer/sale.</li>
                                </ul>
                                
                            </div>
                        </div>

                        @php
                        use Carbon\Carbon;
                        $userId = auth()->id();
                        $totalPoints = App\Models\BsdkPoint::where('user_id', $userId)->where('expires_at', '>', Carbon::now())->sum('points');
                        $bsdkMoney = $totalPoints;
                        @endphp

                        <!--<h2 class="text-center"><strong>Total BSDK Point</strong></h2>-->
                        <!--<h1 class="text-center"><strong>{{ round($bsdkMoney) }}</strong></h1>-->


                        <div class="account__wrapper account__wrapper--style4 border-radius-10">
                            <div class="account__content">
                                <h2 class="account__content--title h3 mb-20">Bsdk Point History</h2>
                                <div class="table-responsive">
                                    <table class="table border">
                                        <thead class="">
                                            <tr class="border">

                                                <th class="border">Date</th>
                                                <th class="border">Description</th>
                                                <th class="border">Order Id</th>
                                                <th class="border">Amount</th>

                                            </tr>
                                        </thead>

                                        <tbody class="">

                                            @php

                                            $bsdkHistories = App\Models\BsdkPointMoneyHistory::where('user_id',$userId)->orderBy('id', 'desc')->get();
                                            @endphp

                                            @foreach ($bsdkHistories as $bsdkHistory)



                                            <tr class="">
                                                <td class="border">{{ $bsdkHistory->created_at->format('d-m-Y') }}</td>
                                                <td class="border">{{ $bsdkHistory->description }}</td>
                                                <td class="border">#{{ $bsdkHistory->order_code }}</td>

                                                <td class="border">
                                                    @if ($bsdkHistory->type == 'add')
                                                    <span class="badge py-2 bg-success px-3 fs-6">+{{ round($bsdkHistory->point) }}</span>
                                                    @else
                                                    <span class="badge py-2 bg-danger w-auto px-3 fs-6">-{{ round($bsdkHistory->point) }}</span>
                                                    @endif


                                                </td>


                                            </tr>


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