<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'my-account') active @endif" href="{{ url('user/my-account') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'orders') active @endif" href="{{ url('user/orders') }}" >Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'address') active @endif " href="{{ url('user/address') }}" >Adresses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) == 'detail') active @endif" href="{{ url('user/detail') }}">Account Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/logout') }}">Sign Out</a>
        </li>
    </ul>
</aside>
