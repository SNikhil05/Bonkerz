<div class="card rounded-0 border shadow-none">

    <div class="card-header pt-4 pb-1 border-bottom-0">
        <h3 class="fs-16 fw-700 mb-0">Summary</h3>
        <div class="text-right">
            <!-- Items Count -->
            <span class="badge badge-inline badge-primary fs-12 rounded-0 px-2">
                {{ count($carts) }}
                Items
            </span>

            <!-- Minimum Order Amount -->
            @php
            $coupon_discount = 0;
            @endphp
            @if (Auth::check() && get_setting('coupon_system') == 1)
            @php
            $coupon_code = null;
            @endphp

            @foreach ($carts as $key => $cartItem)
            @php
            $product = $cartItem['product_id'];
            @endphp
            @if ($cartItem->coupon_applied == 1)
            @php
            $coupon_code = $cartItem->coupon_code;
            break;
            @endphp
            @endif
            @endforeach

            @php
            $coupon_discount = carts_coupon_discount($coupon_code);
            @endphp
            @endif

            @php $subtotal_for_min_order_amount = 0; @endphp
            @foreach ($carts as $key => $cartItem)
            @php $subtotal_for_min_order_amount += cart_product_price($cartItem, $cartItem->product, false, false) * $cartItem['quantity']; @endphp
            @endforeach
            @if (get_setting('minimum_order_amount_check') == 1 && $subtotal_for_min_order_amount < get_setting('minimum_order_amount')) <span class="badge badge-inline badge-primary fs-12 rounded-0 px-2">
                Minimum Order Amount {{ single_price(get_setting('minimum_order_amount')) }}
                </span>
                @endif

        </div>
    </div>



    <div class="card-body">
        <!-- Products Info -->
        <table class="table">
            <thead>
                <tr>
                    <th class="product-name border-top-0 border-bottom-1 pl-0 fs-12 fw-400 opacity-60">Product</th>
                    <th class="product-total text-right border-top-0 border-bottom-1 pr-0 fs-12 fw-400 opacity-60">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                $product_shipping_cost = 0;
                $shipping_region = $shipping_info['city'];
                @endphp
                @foreach ($carts as $cartItem)
                @php
                $product = $cartItem->product_id;
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
                $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];
                $product_shipping_cost = $cartItem['shipping_cost'];

                $shipping += $product_shipping_cost;

                $product_name_with_choice = $product->name;
                if ($cartItem['variant'] != null) {
                $product_name_with_choice = $product->name . ' - ' . $cartItem['variant'];
                }
                @endphp
                <tr class="cart_item">


                </tr>
                @endforeach
            </tbody>
        </table>










    </div>
</div>