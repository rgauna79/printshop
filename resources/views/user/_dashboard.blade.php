<p>Hello <span class="font-weight-normal text-dark">{{Auth::user()->name}}</span> (not <span class="font-weight-normal text-dark">User</span>? <a href="{{ url('/logout') }}">Log out</a>) 
    <br>
    From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
