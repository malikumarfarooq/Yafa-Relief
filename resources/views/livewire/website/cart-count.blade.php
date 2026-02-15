<a href="{{ route('website.checkout') }}"class="header-cart-btn position-relative">
    <img src="/src/images/cart.png" alt="Cart">
    @if($count > 0)
        <span class="">
            {{ $count }}
        </span>
    @else
        <span>0</span>
    @endif
    </a>