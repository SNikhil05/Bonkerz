@extends('frontend.layouts.app')
<style>
    /* faq */
    .faq-header-sec {
        background: #000000;
        padding: 5rem 0;
        text-align: center;
    }

    .faq-header-sec h2 {
        color: #c9c9c9;
        font-size: 3.5rem;
        text-align: center;
        margin-top: 1rem;
        margin-bottom: 1rem;
        letter-spacing: .75px;
        font-weight: 400;
    }

    .faq-header-sec p {
        color: #c9c9c9;
        font-size: 2rem;
        text-align: center;
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        letter-spacing: .75px;
    }

    .faq-header-sec .title-sec {
        background: #ff3131;
        padding: 1.5rem 0 3.5rem;
        color: #fff;
    }

    .faq-header-sec .title-sec h3 {
        color: #fff;
        font-size: 2.75rem;
        text-align: center;
        font-weight: 500;
    }

    .faq-header-sec .serach-sec {
        background: #222222;
        padding: 2rem 0;
    }

    .faq-header-sec .btn-myOrder {
        background: #04d820;
        padding: 1rem 2rem;
        font-size: 1.75rem;
        margin: 3rem 0;
        border: none;
        border-radius: 5px;
        letter-spacing: .75px;
    }

    .faq-header-sec .btn-myOrder:hover {
        background: #ff3131;
    }

    .faq-header-sec .serach-sec {
        background: #fff;
        padding: 2rem 0;
        border-radius: 20px;
        padding-left: 2rem;
        padding-right: 2rem;
        width: 70%;
        margin: auto;
        position: relative;
        top: -25px;
    }

    .serach-sec .form-select {
        padding: 1rem;
        font-size: 1.45rem;
        border-radius: 10px;
        border: 2px solid #ddd;
    }

    .faq-wrapper {
        padding: 5rem 0;
    }

    .faq-wrapper .title {
        font-size: 3rem;
        text-align: center;
        margin: 3.5rem 0;
        font-weight: 600;
    }

    .faq-wrapper .nav-pills .nav-link {
        border: 2px solid #222;
        color: #000;
        background-color: #fff;
        padding: 1.5rem 3rem;
        font-size: 1.45rem;
        font-weight: 600;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .faq-wrapper .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #ff3131;
    }

    .faq-sec {
        display: flex;
    }

    .faq-wrapper .nav-pills .nav-link {
        width: 100%;
        margin-right: 1.25rem;
    }

    .left-tab {
        /* border-right: 1px solid #212529; */
    }

    .right-tab {
        padding-left: 1.75rem;
        /* border-left: 1px solid #212529; */
    }

    .faq-wrapper .accordion-item {
        background-color: #fff;
        border: 1px solid rgb(0 0 0);
    }

    .faq-wrapper .accordion-button:not(.collapsed) {
        color: #ffffff;
        background-color: #ff3131;
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
        font-size: 1.55rem;
        letter-spacing: .55px;
        border: 1px solid #222;
        padding: 2rem;
        font-weight: 600;
    }

    .faq-wrapper .accordion-button {
        font-size: 1.55rem;
        letter-spacing: .55px;
        padding: 2rem;
        font-weight: 600;

    }

    .faq-wrapper li {
        list-style: disc;
        line-height: 26px;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .faq-wrapper .accordion-body {
        padding: 1.75rem 1.5rem;
    }

    .faq-wrapper .form-select:focus {
        border-color: #000 !important;
        outline: 0;
        box-shadow: none;
    }

    .form-select:focus {
        border-color: #d7d7d7 !important;
        outline: 0;
        box-shadow: none !important;
    }

    .faq-wrapper .accordion-button:focus {
        z-index: 3;
        border-color: #000;
        outline: 0;
        box-shadow: none;
    }

    @media only screen and (max-width: 991px) {
        .faq-header-sec .serach-sec {
            width: 90%;
        }

        .faq-sec {
            display: block;
        }

        .left-tab {
            border-right: none;
        }

        .faq-wrapper .nav-pills .nav-link {
            width: 100%;
            margin-right: 0;
            font-size: 16px;
        }

        .right-tab {
            padding-left: 0;
        }

        .col-md-4 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100% !important;
        }

        .col-md-8 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 100% !important;
        }

        .faq-wrapper {
            padding: 2rem 0 5rem 0;
        }

        .faq-header-sec h2 {
            color: #c9c9c9;
            font-size: 2.5rem;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
            letter-spacing: .75px;
            font-weight: 400;
            line-height: 34px;
        }

        .faq-header-sec .title-sec h3 {
            color: #fff;
            font-size: 1.95rem;
            text-align: center;
            font-weight: 500;
        }

        .faq-header-sec .serach-sec {
            background: #fff;
            padding: 1.25rem 0;
            border-radius: 20px;
            padding-left: 2rem;
            padding-right: 2rem;
            width: 90%;
            margin: auto;
            position: relative;
            top: -25px;
        }

        .faq-header-sec {
            background: #000000;
            padding: 2rem 0;
            text-align: center;
        }
    }

    /* end faq */
</style>
@section('content')

<section class="faq-header-sec">
    <div class="container">
        <h2>Manage Your Orders Easily</h2>
        <p>Track, Return/ Exchange or Cancel your orders hassle-free.</p>
        <a class="btn btn-primary text-center btn-myOrder" href="{{ route('purchase_history.index') }}" role="button">My Orders</a>
    </div>
    <div class="container-fluid p-0">
        <div class="title-sec container-fluid">
            <h3>What can we help you with today?</h3>
        </div>
    </div>
    <div class="container">
        <div class="serach-sec">
            {{-- <label for="faqDropdown">Select FAQ:</label> --}}
            <select class="form-select" id="faqDropdown">
                <option selected disabled>Please select your query.</option>
                <option value="faq1">ORDER AND TRACKING</option>
                <option value="faq2">EXCHANGE AND RETURN</option>
                <option value="faq3">BSDK POINTS AND VOUCHER</option>
                <option value="faq4">PAYMENTS RELATED</option>

            </select>
        </div>
    </div>
</section>
<section class="faq-wrapper">
    <div class="container">
        <div class="row">
            <div class="title">FAQ’s</div>
        </div>

        <div class="row">
            <div class="faq-sec">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="nav left-tab nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-faq1-tab" data-toggle="pill" href="#v-pills-faq1" role="tab" aria-controls="v-pills-faq1" aria-selected="true">ORDER AND TRACKING</a>
                        <a class="nav-link" id="v-pills-faq2-tab" data-toggle="pill" href="#v-pills-faq2" role="tab" aria-controls="v-pills-faq2" aria-selected="false">EXCHANGE AND RETURN</a>
                        <a class="nav-link" id="v-pills-faq3-tab" data-toggle="pill" href="#v-pills-faq3" role="tab" aria-controls="v-pills-faq3" aria-selected="false">BSDK POINTS AND VOUCHER</a>
                        <a class="nav-link" id="v-pills-faq4-tab" data-toggle="pill" href="#v-pills-faq4" role="tab" aria-controls="v-pills-faq4" aria-selected="false">PAYMENTS RELATED</a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="right-tab">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-faq1" role="tabpanel" aria-labelledby="v-pills-faq1-tab">
                                <div class="acc1">
                                    <div class="accordion" id="accordionExample">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    1 How do i know my orders is confirmed ?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Once you successfully place your order, you will receive a confirmation email &
                                                            SMS/WhatsApp with details of your order and your order ID.
                                                        </li>
                                                        <li>You’ll receive another email & SMS/ WhatsApp once your order is shipped out. All you
                                                            have to do then is, sit back, relax, and wait for your awesome product(s) to arrive!

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    2 How i can check the status of my order?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>‘My Orders' page would provide you with complete information of your order
                                                            including the order status, payment status and tracking details.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    3 Do you deliver in my location?
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>‘The delivery in your pincode and estimate time of delivery can be checked on our order
                                                            page by entering the pincode in ‘Check Delivery Details’ section. We are continually
                                                            expanding our capabilities to deliver across all the pincodes in the country.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    4 Can i add item after placing the order ?
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Unfortunately, once the order is placed, you won’t be able to add more items to it. You can
                                                            place a new order for the items you missed out on adding.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    5 How long will it take for my order to reach me?
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>
                                                            Orders in India, once shipped, are typically delivered in 2-3 business days in metros, and 7-10 business days for the rest of India. Delivery time may vary depending upon the shipping address and other factors (public holidays, extreme weather conditions, etc.).
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    6 How do I cancel my order?
                                                </button>
                                            </h2>
                                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Tap on “My Orders” section under the main menu of your App/Website and then select the
                                                            order you want to cancel. The 'Cancel' option will only be available before your order is
                                                            shipped. If you are facing an issue, please email us at ordersupport@bonkerzdonkerz.com
                                                            and we will sort it for you.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSeven">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                    7 Can i modify the address /Phone number for the delivery ?
                                                </button>
                                            </h2>
                                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Sorry, that is not possible at the moment as the system would have already passed the
                                                            mobile number and address to our warehouse to pack and ship your product. That said,
                                                            we never say never! You can always cancel the order before it has been packed and can
                                                            place a new order. Don't worry, there are no cancellation charges.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEight">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                    8 Where can I view my past orders?
                                                </button>
                                            </h2>
                                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>You can view all your orders under MY ACCOUNT section of your BONKERZ DONKERZ
                                                            account. Please note if you guest checkout while placing the order, login with the same
                                                            phone number/email you used while placing the order.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading9">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                                    9 What is the cancellation policy at SHEIN STYLE STORE ?
                                                </button>
                                            </h2>
                                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Please note you can only cancel your order till it hasn’t been dispatched by us. Refund for
                                                            Debit card/Credit Card, UPI and Net banking orders will be processed within 7-15 banking
                                                            days.</li>

                                                        <li>Refunds for orders paid through BONKERZ DONKERZ wallet will be refunded within 24-72
                                                            Business hours of cancellation.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading10">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                                    10 How i can track my order?
                                                </button>
                                            </h2>
                                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>You can track your order once it has been dispatched from our warehouse. An email, SMS,
                                                            and Whatsapp notification will be sent with a link. You can also track it from your account
                                                            on the website by Selecting ‘Orders’ from the top right corner and then clicking on 'Track
                                                            Order' for the respective Order ID.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading11">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                                    11 What is the estimated delivery time ?
                                                </button>
                                            </h2>
                                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>The delivery time varies from cities to cities. Typically it take 2 – 3 days for all metros &
                                                            Tier 1 cities. Tier 2 & 3 cities may take 7 to 15 days. Some cities in north east India & J&K etc
                                                            may take 15 to 20 days. You could enter your pin code at the product view page to know
                                                            the exact estimate time of delivery.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading12">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                                    12 What are the shipping charges i have to pay ?
                                                </button>
                                            </h2>
                                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We offer free shipping within India on all products purchased on its website for all prepaid
                                                            orders - (You have to pay shipping charges Rs 99 only on COD orders )
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading13">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                                    13 What are the shipping charges i have to pay ?
                                                </button>
                                            </h2>
                                            <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We understand that you can’t wait at your delivery address all the time, and that is exactly
                                                            why we will try to 3 attempt delivering your order . So, if you have missed the delivery
                                                            please do not worry, we will try to make an attempt again. We’ll also drop you a call, in
                                                            case you miss the delivery to understand your delivery requirements.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading14">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                                    14 Do you deliver internationally ?
                                                </button>
                                            </h2>
                                            <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Yes, we do deliver internationally. We offer shipping to many countries around the world.
                                                            Shipping rates and delivery times may vary depending on the destination. Please note that
                                                            international orders may be subject to customs duties and taxes imposed by the
                                                            recipient's country. If you have any specific questions about international shipping or
                                                            need assistance with placing an international order, please feel free to contact our
                                                            customer service team for further assistance.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading15">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                                    15 I got an email/ sms /what’s app saying product has been delivered ,but i haven’t received any delivery. What should i do ?
                                                </button>
                                            </h2>
                                            <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Sometimes, the delivery partner hands over the order to the neigh-bour or the entry
                                                            security guard of your society in case you’re not available. Please check if the delivery is
                                                            made to them. In case it is not, please drop us a mail and we’ll investigate the issue with
                                                            our logistics partner.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading16">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                                    16 I want to place an order but I don’t want any price tag or invoice attached as it is a gift for someone. Is it possible?
                                                </button>
                                            </h2>
                                            <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We have to leave the tags intact in case the person you’re gifting faces any issues and
                                                            would like to return the product. We will blacken the prices on the invoice. Please reach
                                                            out to us as soon as your order is placed. If you want to add a note to the gift, please email
                                                            the note to us at ordersupport@bonkerzdonkerz.com and immediately call us on our
                                                            number so that we can add it before the order is shipped. Please note that the character
                                                            limit for the note is 250 characters.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading17">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                                    17 How can I get my order delivered faster?
                                                </button>
                                            </h2>
                                            <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Sorry, currently we do not have any service available to expedite the order delivery. In
                                                            future, if we start offering such a service and your area pincode is serviceable, you will
                                                            receive a communication from our end.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading18">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                                    18 Why can’t I see the Cash On Delivery (COD) option?
                                                </button>
                                            </h2>
                                            <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>If the Cash On Delivery (COD) option is not showing, it’s because this facility is unavailable
                                                            for your postal code. You can either pay by Debit Card, Credit Card, or Net Banking, or you
                                                            can get the products delivered to an alternate address (where COD is available).
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading19">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                                                    19 Is there any additional charge for Cash On Delivery (COD) orders?
                                                </button>
                                            </h2>
                                            <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Yes, we charge a flat fee of ₹99 for Cash On Delivery (COD) orders.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading20">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                                                    20 Are there any additional shipping charges?
                                                </button>
                                            </h2>
                                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>BONKERZ DONKERZ provides FREE shipping for all orders above ₹2999 in India. A shipping
                                                            charge of ₹99 is payable only on orders below ₹999. Minimum order value should be ₹299
                                                            (excluding GST).

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading21">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                                    21 What if my order is undelivered?
                                                </button>
                                            </h2>
                                            <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>For prepaid orders, if our courier partners are unable to deliver the product and they send
                                                            it back to us, we will initiate a refund as BSDK Money to your The BONKERZ DONKERZ
                                                            which will reflect within 48-72 business hours of initiation.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-faq2" role="tabpanel" aria-labelledby="v-pills-faq2-tab">
                                <div class="acc1">
                                    <div class="accordion" id="accordionExample2">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    1 How do i know my orders is confirmed ?1 What is your Exchange policy?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>You can apply for an exchange for your order within 7 days after an order has been
                                                            delivered. We have a reverse pick up facility for most pin codes (chargeable )*
                                                        </li>
                                                        <li>Exchanges can only be done for the same products in a different size. It cannot be
                                                            exchanged for another design in the same product category or against any other product
                                                            across our website/app.
                                                        </li>

                                                        <li>If you wish to exchange products from a combo pack, the whole pack will have to be sent
                                                            back to us. Partial returns aren’t accepted. If there is a manufacturing issue, or if you have
                                                            any other query regarding this, you can contact us on the number (+91-9289280084) or
                                                            email us on ordersupport@bonkerzdonkerz.com.
                                                        </li>
                                                        <li>Gift wrapping charges are non-refundable and we will not be able to gift wrap any
                                                            exchanges requested.</li>

                                                        <li>
                                                            To maintain strict hygiene standards of our products, we do not accept exchanges on several product categories, including but not limited to masks, boxers, shorts, sweatactivated t-shirts and socks. The Souled Store may, at its discretion and without prior notice, change the products or categories to which this policy would apply.
                                                        </li>
                                                        <p class="fw-bold">Exchange is only allowed if there is a size issue. You can opt to take the next size you need .
                                                            If the particular size is not available on the website, we will provide you with the gift
                                                            voucher.</p>
                                                        <p class="fw-bold"> -If you have received any defective product, please inform it to us within 48 hours after the
                                                            delivery. Once our quality team checks the same, we will send you the new product.
                                                        </p>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    2 In case I return the products, will the COD/Shipping/Gifting charges be credited back?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>No. These are charges applicable each time an order is placed and are non-refundable.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    3 My product has been picked up but I have not got my refund yet.
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>If it has been 24-48 hours since the order has been picked by our courier partner and if the
                                                            refund isn't reflecting as BSDK money, please email us at
                                                            Ordersupport@bonkerzdonkerz.com and we will sort it out for you.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    4 How do I create a exchange request?
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>To initiate an exchange please go to My Account. Once your order is delivered you'll find a
                                                            exchange button next to your order. Click the button and follow the steps to initiate a
                                                            return.
                                                        </li>
                                                        <li>Please note: - You can initiate your exchange request only 24 hours after your order is
                                                            delivered.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    5 I have created a exchange request. When will the product be picked up?
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>
                                                            Once we receive this request, someone from the courier partner's team will arrive at the address for a pickup within 3 business days. Please ensure the product(s) and the tags are intact on the product(s) for it to be accepted by the courier company.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    6 When will I get my exchanged product delivered?
                                                </button>
                                            </h2>
                                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Your exchange product will be shipped from our warehouse after the returned product
                                                            has been picked from your end. Orders in India, once shipped, are typically delivered in 3-7
                                                            business days in metros, and 10-15 business days for the rest of India. Delivery time may
                                                            vary depending upon the shipping address and other factors (public holidays, extreme
                                                            weather conditions, etc.).
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSeven">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                    7 Where should I self-ship the returns?
                                                </button>
                                            </h2>
                                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>In case your pin code is non-serviceable for a reverse pick up, you’ll have courier the
                                                            product(s) to the following address:<br>

                                                            BONKERZ DONKERZ RETAIL
                                                            19,Hauz Khas Village Near to Pink cafe Restaurant
                                                            Hauz Khas Village, New Delhi - 110016.

                                                        </li>
                                                        <li>Please ensure the items are packed securely to prevent any loss or damage during transit.
                                                            All items must be in unused condition with all original tags attached and packaging intact.
                                                            Within 48 hours of receiving the product(s), the complete amount + 100 (in lieu of courier
                                                            charges) will be refunded to your BONKERZ DONKERZ account as BSDK Money.
                                                        </li>
                                                        <p>PLEASE NOTE: We request that you do not use The Professional Couriers for self return as
                                                            they are not reliable and the package will not be accepted at the warehouse. Please make sure
                                                            your courier costs do not exceed the amount stipulated above. We recommend using ‘Speed
                                                            Post’ as your courier service. Speed Post is a Government of India owned entity and has the
                                                            most widely distributed postal network in India.
                                                        </p>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEight">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                    8 How do I track the status of my replacement order?
                                                </button>
                                            </h2>
                                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>You can track your order once it has been dispatched from our warehouse. An email, SMS, and
                                                            Whatsapp notification will be sent with a link. You can also track it from your account on the
                                                            website by Selecting ‘Orders’ from the top right corner and then clicking on 'Track Order' for
                                                            the respective Order ID.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading9">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                                    9 How and when would I get a refund for a exchanged order?
                                                </button>
                                            </h2>
                                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We do not have a money refund policy. We allow only size exchange for the products
                                                            purchased. In case the next size you want is not in stock, we will provide you credit voucher
                                                            worth the price of the product (excluding COD charge & GST)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading10">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                                    10 How do I raise a second exchange for my exchanged order?
                                                </button>
                                            </h2>
                                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <p>We do not have a second exchange policy. However, if you still want to initiate the exchange,
                                                        an amount of 250 INR will be charged for the second exchange.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading11">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                                    11 How to exchange combo items?
                                                </button>
                                            </h2>
                                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <p>Important: If you have purchased a combo order from our website, please note that we do not
                                                        offer exchanges for single products in the combo order. In order to process an exchange, both
                                                        products in the combo order should be exchanged together. We ask that you carefully review
                                                        the items within your combo order before finalizing your purchase.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading12">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                                    12 What do i do if i received damaged or defected product ?
                                                </button>
                                            </h2>
                                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>If you received a damaged or defective item, you can initiate a return through "My Orders"
                                                            section. Exchange will not be initiated for damaged item with 24 Hour of delivery.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading13">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                                    13 What is 7 days no question asked policy ?
                                                </button>
                                            </h2>
                                            <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We have a flexible 7 days no questions asked returns policy which is absolutely customer
                                                            friendly. If you do not find the product(s) satisfying, you can return it as long as the following
                                                            conditions are met:</li>
                                                        <li>Product is unused, unwashed and in original condition. You are welcome to try on a
                                                            product but please take adequate measure to preserve its condition</li>
                                                        <li>The price tags, brand tags, shoe-box and all original packaging must be present</li>
                                                        <li>The product must be returned within 7 days</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-faq3" role="tabpanel" aria-labelledby="v-pills-faq3-tab">
                                <div class="acc1">
                                    <div class="accordion" id="accordionExample3">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    1 What all payments methods accepted ?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample3">
                                                <div class="accordion-body">
                                                    <p>The payment options we support are:</p>
                                                    <ul>
                                                        <li>Credit Card</li>
                                                        <li>Debit Card</li>
                                                        <li>Net Banking</li>
                                                        <li>Paytm Wallet</li>
                                                        <li>UPI</li>
                                                        <li>Google Pay</li>
                                                        <li>Credit points/Bonus Points
                                                            We process all online payments through Paytm which provides secure, encrypted
                                                            connections for all credit card, debit card and Net Banking transactions.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    2 What should I do if my payment fails?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample3">
                                                <div class="accordion-body">
                                                    <p>In case there is a failure in payment, please retry and keep the following things in mind:</p>
                                                    <ul>
                                                        <li>Please confirm if the information you’ve provided is correct i.e. account details, billing
                                                            address, and password (for Net Banking); and that your internet connection wasn’t
                                                            disrupted during the process.</li>
                                                        <li>If your account has been debited even after a payment failure, it is normally rolled back to your bank account within 10 business days. For any further clarification, you can email us at ordersupport@bonkerzdonkerz.com.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    3 My account has been debited but order not confirmed ? What should i do ?
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>We ensure that an Order ID is confirmed only once our bank receives the payment from
                                                            your bank. Sometimes, due to unforeseen reasons, the amount might be debited from
                                                            your side but wouldn't have been received by us yet. Please wait for 24 hours to check if
                                                            the order has been confirmed or if the amount is credited back to you. If neither happens,
                                                            please drop us a mail and we’ll help you further.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-faq4" role="tabpanel" aria-labelledby="v-pills-faq4-tab">
                                <div class="acc1">
                                    <div class="accordion" id="accordionExample4">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                    1 How do i use BSDK Points ?
                                                </button>
                                            </h2>
                                            <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="headingOne1" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>You can check how many BSDK Points you have in your account once you login. Select My
                                                            Account and click on ‘BSDK Points’ from the list. You will be able to see Current Active
                                                            Points, Total Purchases, Usage History and Expired Points.</li>
                                                        <li>To use BSDK Points once you have added your products to cart and clicked on the cart
                                                            icon to go to the checkout page, you will see your order details.</li>

                                                        <li>Below that will be an option to apply codes for discounts. Tick the 'Use BSDK Points' box.
                                                            Once you’re done, proceed to checkout, confirm your shipping address, and select the
                                                            desired payment method to confirm your order by clicking ‘Place Order’.</li>

                                                        <li>A Maximum 20% of cart value can be paid using BSDK Points</li>

                                                        <li> BSDK Points cannot be clubbed with a discount code/offer.</li>

                                                        <li>Any BSDK points used would not be reinstated in case you return a product/order.</li>
                                                        <li>BSDK Points are not applicable on products on offer/sale.</li>
                                                        <li>BSDK Points are subject to expiry. To check the expiry date, visit your account details.
                                                            Once expired, the points will lapse automatically and cannot be credited back.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                                    2 What are the BSDK Points ?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Loyalty Points is our membership program where you earn the points on each purchase on
                                                            offline store and at the online website. The rate of earning these points is governed by our
                                                            MY BONKERZ DONKERZ VILLA Membership program policies. The value of 1 loyalty point
                                                            is Rs 0.50</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                                    3 What are the BSDK Money ?
                                                </button>
                                            </h2>
                                            <div id="collapseThree3" class="accordion-collapse collapse" aria-labelledby="headingThree3" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>Credit points are your account wallet balance amount which is the actual amount of the
                                                            product when returned and refund claimed in wallet or in case of cashbacks. The value of
                                                            1 credit point is Rs. 1
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour4">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
                                                    4 Do these points have an expiry?
                                                </button>
                                            </h2>
                                            <div id="collapseFour4" class="accordion-collapse collapse" aria-labelledby="headingFour4" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>While the credit points do not have any expiry, the loyalty points come with an expiry
                                                            which you can check from the My account page by selecting ‘Loyalty Points’. In case your
                                                            account is suspended or closed due to any reason, you’ll lose the credit and loyalty points
                                                            attached to that account. Loyalty and credit points can not be transferred from one
                                                            account to another.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive5">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive5" aria-expanded="false" aria-controls="collapseFive5">
                                                    5 How can i use points or vouchers to make purchase?
                                                </button>
                                            </h2>
                                            <div id="collapseFive5" class="accordion-collapse collapse" aria-labelledby="headingFive5" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>
                                                            While placing the order, on your checkout page you’ll find the option to “Apply coupons “.There you can select any given coupon. On the Payment page, you can select any of the given options from Credit Points, or Loyalty points. Loyalty and Credits are brand specific and are applicable to the same brand only.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix6">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix6" aria-expanded="false" aria-controls="collapseSix6">
                                                    6 My voucher code is not working ? What should i do ?
                                                </button>
                                            </h2>
                                            <div id="collapseSix6" class="accordion-collapse collapse" aria-labelledby="headingSix6" data-bs-parent="#accordionExample4">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li>While placing the order, on your checkout page you’ll find the option to “Apply coupons “.
                                                            There you can select any given coupon. On the Payment page, you can select any of the
                                                            given options from Credit Points, or Loyalty points. Loyalty and Credits are brand specific
                                                            and are applicable to the same brand only</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdown = document.getElementById('faqDropdown');

        dropdown.addEventListener('change', () => {
            const selectedValue = dropdown.value;
            $(`#v-pills-${selectedValue}-tab`).tab('show');
        });

        // Show the correct tab on page load based on the dropdown value
        const initialValue = dropdown.value;
        $(`#v-pills-${initialValue}-tab`).tab('show');
    });
</script>

@endsection