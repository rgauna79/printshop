<footer class="footer ">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 border-right">
                    <div class="widget widget-about">
                        <img src="{{ url('assets/images/logo-footer.png') }}" class="footer-logo" alt="Footer Logo" width="100%" height="25">
                        <p>Magic Print is an innovative and creative company. </p>

                        <div class="social-icons">
                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 border-right">
                    <div class="widget">
                        <h4 class="widget-title">Useful Links</h4>
                        <ul class="widget-list">
                            <li><a href="{{ url('about')}}">About Magic Print</a></li>
                            <li><a href="#">How to shop on Magic Print</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="{{ url('contact')}}">Contact us</a></li>
                            <li><a href="#signin-modal" data-toggle="modal">Log in</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 border-right">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>

                        <ul class="widget-list">
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Money-back guarantee!</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Terms and conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>

                        <ul class="widget-list">
                            <li><a href="#signin-modal" data-toggle="modal">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © {{ date('Y') }} Magic Print. All Rights Reserved.</p><!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="{{ url('assets/images/payments.png')}}" alt="Payment methods" width="272" height="20">
            </figure>
    </div>
</footer>