@extends('frontend.layouts.app')



<style>

.membership-det-top .container {
    max-width: 1400px;
}

.membership-det-header .container {
    max-width: 1400px;
}
.membership-det-mid .container {
    max-width: 1400px;
}
.membership-det-top {
    background: #fff;
    text-align: center;
    padding: 2rem 0;
}
.membership-det-top h2 {
    font-size: 2.5rem;
    letter-spacing: .75px;
}
.membership-det-top h3 {
    font-size: 3.65rem;
    letter-spacing: .75px;
    font-weight: 600;
    margin: .5rem 0;
}
.membership-det-header {
    padding: 5rem 0;
    text-align: center;
    background: url(assets/frontend/img/icon/membership-bg.jpg);
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
}

.membership-det-header h3 {
    font-size: 3.5rem;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: .75px;
    /* margin: 2rem 0 3rem 0; */
}

.membership-det-header p {
    font-size: 1.5rem;
    font-weight: 600;
    color: #fff;
    margin-top: 3rem;
    margin-bottom: 1rem;
}

.BSDK-Points {
    background: linear-gradient(to right, #fff 5%, #ff3a3a 50%, #fff 95%);
    width: 250px !important;
    margin: auto;
    padding: 1.75rem;
    border-radius: 10px;
    font-size: 4.5rem;
    font-weight: 700;
}
.membership-det-header .text-red {
    color: #ff4444;
    border: none;
    text-shadow: none;
    font-size: 1.75rem;
}
.bsdk-content p {
    letter-spacing: .75px;
    font-size: 1.45rem;
    font-weight: 500;
}

ul {
    color: #fff;
}

.bsdk-content ul li {
    letter-spacing: .75px;
    font-size: 1.45rem;
    font-weight: 500;
    line-height: 2.5rem;
}
.membership-det-mid {
    background: #000;
    padding: 5rem 0;
}
.membership-det-mid h3 {
    color: #fff;
    text-align: center;
    letter-spacing: .75px;
    font-size: 4rem;
    margin: 2rem 0 5rem 0;
}
.membership-det-mid .icon-box img {
    text-align: center;
    width: 70px;
}

.membership-det-mid .content h2 {
        font-size: 2rem;
        line-height: 3.5rem;
        color: #ff4444;
        letter-spacing: .75px;
        font-weight: 500;
    }

.membership-det-mid .content p {
    letter-spacing: .75px;
    font-size: 1.45rem;
    font-weight: 500;
    line-height: 2.5rem;
    color: #fff;
}
.membership-det-mid .content {
    margin-top: 10px;
    margin-left: 10px;
}
.membership-det-mid .icon-box {
    display: flex;
    margin-bottom: 5rem;
}

.membership-det-mid .icon-box ul li {
    letter-spacing: .75px;
    font-size: 1.45rem;
    font-weight: 500;
    line-height: 2.5rem;
}
.membership-det-mid .conditions {
    padding: 4rem;
    margin-left: 8rem;
}
.membership-det-mid .conditions ul li {
    letter-spacing: .75px;
    font-size: 1.45rem;
    font-weight: 500;
    line-height: 2.5rem;
}
.card-membership {
    background: #fff;
    width: 350px !important;
    margin: auto !important;
    padding: 4rem 5rem;
    border-radius: 20px;
    display: inline-block;
    margin-top: 4rem !important;
}

.card-membership p {
    font-size: 2rem;
    color: #a1a1a1 !important;
    margin: 0 !important;
    font-weight: 300;
    margin-top: 5px !important;
}

.card-membership .membership-button {
    background: #ff3131;
    color: #fff;
    padding: 1.5rem 4rem;
    border-radius: 20px;
    font-size: 2rem;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px;
    margin-top: 3rem;
}
@media only screen and (max-width: 991px) {
    .membership-det-mid .conditions {
    padding: 4rem;
    margin-left: 4rem;
}
.membership-det-mid .content {
    margin-top: 0px;
    margin-left: 10px;
}
.membership-det-mid .conditions {
    padding: 0 4rem;
    margin-left: 4rem;
}
.membership-det-mid h3 {
    color: #fff;
    text-align: center;
    letter-spacing: .75px;
    font-size: 2.5rem;
    margin: 2rem 0 2rem 0;
    line-height: 5rem;
}
.membership-det-mid {
    background: #000;
    padding: 0 0 5rem 0;
}
.card-membership .membership-button {
    background: #ff3131;
    color: #fff;
    padding: 1.25rem 3rem;
    border-radius: 20px;
    font-size: 2rem;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px;
    margin-top: 3rem;
}
}


</style>


@section('content')
{{-- top --}}
<section class="membership-det-top">
    <div class="container">
        <div class="row">
            <h2>BONKERZ DONKERZ</h2>
            <h3>MEMBERSHIP</h3>
        </div>
    </div>

</section>
{{-- header --}}
<section class="membership-det-header">
    <div class="container">
        <div class="row d-block">
            <h3>{{ $user->name }}</h3>
            <p>Your BSDK Points</p>
            <div class="BSDK-Points">{{ $totalPoints }}</div>
            <p>Your BSDK Money</p>
            <div class="BSDK-Points">Rs.{{ $bsdkMoney }}</div>

            @if($memberShipStatus == 0 && $membershipCartStatus==0)
            <div class="card-membership">
                <h2>Rs.199/-</h2>
                <p>Per Year</p>
                <div class="btn">
                    <a href="{{ route('addMenbership',28) }}" class="membership-button">Subscribe Now</a>
                </div>
            </div>
            @endif




            <div class="bsdk-content">
                <p class="text-red">1.What's the points?</p>
                <p>Points are a kind of virtual currency on the BONKERZ DONKERZ website/app. You can choose to use and deduct part of the payment amount when placing an order.</p>
            </div>


            <div class="bsdk-content">
                <p class="text-red">2.How to use the points?</p>
                <ul>
                    <li>1.Every 100 points = 50 INR</li>
                    <li>2.You can use the points to deduct up to 20% of the total amount of products when you place your order (only the total price of products is supported, excluding shipping, insurance).</li>
                    <li>3. Points are valid from 7 days to 3 months, if your points expired before being used, they will be deleted from your account.</li>
                </ul>
            </div>
        </div>
    </div>


</section>
{{-- middle-content --}}
<section class="membership-det-mid">
    <div class="container">
        <div class="row">
            <h3>How to earn the points ?</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 icon-box d-md-flex">
                    <div class="col-2 icon"><img src="{{ static_asset('assets/frontend/img/icon/user-icon.svg') }}"></div>
                    <div class="col-10 content">
                            <h2>Register with BONKERZ DONKERZ</h2>
                            <p>New User complete the registration will receive 100 points.</p>
                        </div>
                    </div>
                    <div class="col-md-6 icon-box d-md-flex">
                    <div class="col-2 icon"><img src="{{ static_asset('assets/frontend/img/icon/mail-icon.svg') }}"></div>
                    <div class="col-10 content">
                            <h2>Virify your mail</h2>
                            <p>New User complete the registration will receive 100 points.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 icon-box d-md-flex">
                    <div class="col-2 icon"><img src="{{ static_asset('assets/frontend/img/icon/buy-and-earn-icon.svg') }}"></div>
                    <div class="col-10 content">
                            <h2>Buy and earn</h2>
                            <p>You’ll earn 1 point for every Rs. spent on your purchase.</p>
                            <ul>
                                <li>1.Points will be credited to your account once you confirm delivery of your order</li>
                                <li>2.Log into your BONKERZ DONKERZ account</li>
                                <li>3.Click on "My Orders"</li>
                                <li>4.Select orders you have received and click on "Confirm order "</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 icon-box d-md-flex">
                    <div class="col-2 icon"><img src="{{ static_asset('assets/frontend/img/icon/follow-us.svg') }}"></div>
                    <div class="col-10 content">
                            <h2>Follow us on social media (Instagram , Facebook , YouTube , Snapchat ,
                                Printrest)</h2>
                            <p>You may follow us on Social media you will receive the 1000 points</p>
                        </div>
                    </div>
                </div>
                <div class="conditions">
                    <ul>
                        <li>1. If an unpaid order is cancelled, the points applied to the original order will be immediately returned to your points account.</li>
                        <li>2. If you request a return/a full refund for a product, the points for returned item will reverted to your account along with your refund. If it's a partial return, points will be
                            returned based on a percentage of the product's price.</li>
                        <li>3. The validity period of the points is calculated from the date when the points are first obtained, and will not be re-timed due to the points being returned.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</section>






@endsection