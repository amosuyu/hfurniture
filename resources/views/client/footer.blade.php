<footer id="footer" class="footer-area">
    <div class="footer-top">
        <div class="container-fluid">
            <div class="plr-185">
                <div class="footer-top-inner gray-bg">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-4">
                            <div class="single-footer footer-about">
                                <div class="footer-logo">
                                    <img src="{{ asset('client/img') }}/logo/logo.png" style="max-width:150px" alt="">
                                </div>
                                <div class="footer-brief">
                                    <p>{{ trans('message.company_brief') }}
                                    </p>
                                </div>
                                <ul class="footer-social">
                                    <li>
                                        <a class="facebook" href="" title="Facebook"><i
                                                class="zmdi zmdi-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a class="google-plus" href="" title="Google Plus"><i
                                                class="zmdi zmdi-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a class="twitter" href="" title="Twitter"><i
                                                class="zmdi zmdi-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a class="rss" href="" title="RSS"><i class="zmdi zmdi-rss"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 hidden-md hidden-sm">
                            <div class="single-footer">
                                <h4 class="footer-title border-left">{{ trans('message.product') }}</h4>
                                <ul class="footer-menu">
                                    <li>
                                        <a href="{{ route('productsByCategory', ['toSort' => 'latest']) }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.new_product') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('productsByCategory', ['toSort' => 'big-sale']) }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.big_sale') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('productsByCategory', ['toSort' => 'best-selling']) }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.selling') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('productsByCategory', ['toSort' => 'hot']) }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.featured_products') }}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <div class="single-footer">
                                <h4 class="footer-title border-left">{{ trans('message.account') }}</h4>
                                <ul class="footer-menu">
                                    <li>
                                        <a href="{{ route('information') }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.my_account') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('listCart') }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.cart') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('loginClient') }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.login') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('loginClient') }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.register') }}</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('payment') }}"><i class="zmdi zmdi-circle"></i><span>{{ trans('message.payment') }}</span></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="single-footer">
                                <h4 class="footer-title border-left">{{ trans('message.contact') }}</h4>
                                <div class="footer-message">
                                    <form id="contact-form" action="{{ route('sendMailContact') }}" method="post">
                                        <input type="text" name="name" placeholder="{{ trans('message.full_name') }}...">
                                        <input type="text" name="email" placeholder="Email...">
                                        <textarea class="height-80" name="message"
                                            placeholder="{{ trans('message.content') }}..."></textarea>
                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit">{{ trans('message.send_contact') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom black-bg">
        <div class="container-fluid">
            <div class="plr-185">
                <div class="copyright">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="copyright-text">
                                <p>&copy;Copyright <a href="" target="_blank">H-Furniture</a> 2021.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <ul class="footer-payment text-right">
                                <li>
                                    <a href="#"><img src="{{ asset('client/img') }}/payment/1.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('client/img') }}/payment/2.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('client/img') }}/payment/3.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('client/img') }}/payment/4.jpg" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "108356958364870");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<!-- END FOOTER AREA -->
