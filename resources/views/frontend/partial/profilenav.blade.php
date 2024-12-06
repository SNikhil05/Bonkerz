<div class="my__account--section__inner border-radius-10 mb-5">
    <h2 class="account__content--title h3 mb-20">My Profile</h2>
    <ul class="account__menu">

        <li class="account__menu--list"><a href="#"> <i class="fa fa-user-circle text-red me-2"></i>{{ $user->name }}</a></li>
        <li class="account__menu--list"><a href="#"> <i class="fa-solid fa-square-envelope text-red me-2"></i> {{ $user->email }}</a></li>

    </ul>
</div>
<div class="my__account--section__inner border-radius-10 mb-5">
    <ul class="account__menu">

        <li class="account__menu--list active"><a href="{{ route('profile') }}">Profile</a></li>
        <li class="account__menu--list"><a href="{{ route('purchase_history.index') }}">Order</a></li>
        <!-- <li class="account__menu--list"><a href="#">Gift Vouchers</a></li> -->

        @php
        use Carbon\Carbon;
        $userId = auth()->id();
        $totalPoints = App\Models\BsdkPoint::where('user_id', $userId)->where('expires_at', '>', Carbon::now())->sum('points');
        $bsdkMoney = $totalPoints/2;
        @endphp
        <li class="account__menu--list"><a href="{{ route('user.bsdkPoint') }}">BSDK Points <span class="text-success fs-6">(Active BSDK Points: {{ round($totalPoints) ?? 0 }})</span></a>
        </li>
        <li class="account__menu--list"><a href="{{ route('user.bsdkMoney') }}">BSDK Money <span class="text-success fs-6">(BSDK Money Balance: ₹ {{ round($bsdkMoney) ?? 0 }})</span></a>
        </li>
        <!-- <li class="account__menu--list"><a href="#">Saved Address</a> -->
        </li>
        <li class="account__menu--list"><a href="{{ route('faq') }}">FAQs</a>
        </li>

        <li class="account__menu--list"><a href="{{ route('user.logout') }}">Log Out</a></li>
    </ul>
</div>