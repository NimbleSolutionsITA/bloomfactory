    <section class="page_topline ls table_section table_section_sm section_padding_top_5 section_padding_bottom_5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center text-sm-left">
                    <div> <i class="fa fa-clock-o rightpadding_5" aria-hidden="true"></i> Orario: Lun - Sab 11.00 - 20.00 </div>
                </div>
                <div class="col-sm-6 text-center text-sm-right greylinks">
                    <span class="rightpadding_10">Follow Us:</span>
                    <a class="social-icon color-icon socicon-facebook" href="https://www.facebook.com/CBDbloomShopRoma" title="Facebook" target="_blank"></a>
                    <a class="social-icon color-icon socicon-instagram" href="https://www.instagram.com/bloomfactoryroma/" title="Instagram" target="_blank"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="page_toplogo ls table_section table_section_md columns_margin_0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-md-push-4 text-center">
                    <a href="../" class="logo logo_with_text">
                        <img src="/images/logo.png" alt="">
                    </a>
                    <!-- header toggler --><span class="toggle_menu"><span></span></span>
                </div>
                <div class="col-md-4 col-sm-6 col-md-pull-4 text-center text-md-left">
                    <div class="media small-teaser teaser greylinks inline-block text-left">
                        <div class="media-left media-middle">
                            <div class="teaser_icon main_bg_color1 size_small rounded"> <i class="flaticon-placeholder"></i> </div>
                        </div>
                        <div class="media-body media-middle grey"> Via Gabriello Chiabrera, 72<br> 00145 Roma </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 text-center text-md-right">
                    <div class="media small-teaser teaser greylinks inline-block text-right">
                        <div class="media-body media-middle grey">
                            @guest
                                <a href="{{ route('login') }}">Login</a>
                                <br>
                                <a href="{{ route('register') }}">Registrati</a>
                            @endguest
                            @auth
                                {{ Auth::user()->name }}
                                <br>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endauth
                        </div>
                        <div class="media-right media-middle">
                            <div class="teaser_icon main_bg_color1 size_small rounded">
                                <a href="{{route('cart.index')}}">

                                    @if (Cart::instance('default')->count() > 0)

                                        <span class='cart-badge' id="targetEl" value="{{ Cart::instance('default')->count() }}">{{ Cart::instance('default')->count() }}</span>

                                    @endif

                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 202 167.3" style="enable-background:new 0 0 202 167.3;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#808080;}
                                        </style>
                                        <g>
                                            <g>
                                                <path class="st0" d="M156.5,107.5H66.5c-3.4,0-6.3-2.4-7-5.6L45.8,37.2l-12.9-1c-3.9-0.3-6.9-3.7-6.6-7.6c0.3-3.9,3.7-6.9,7.6-6.6l18.3,1.4c3.2,0.2,5.8,2.5,6.4,5.6l13.7,64.2h78.4L161,45.5c0.8-3.9,4.6-6.3,8.5-5.5c3.9,0.8,6.3,4.6,5.5,8.5l-11.5,53.4C162.7,105.1,159.8,107.5,156.5,107.5z" />
                                            </g>
                                            <circle class="st0" cx="82.1" cy="130.8" r="14.2" />
                                            <circle class="st0" cx="142" cy="130.8" r="14.2" />
                                        </g>
                                    </svg>

                                </a>

                            </div>

                            @if (Cart::instance('default')->count() > 0)
                                <div class="headerCart product_list_widget">
                                    <div class="widget widget_shopping_cart">
                                        <h3 class="widget-title">Your Cart</h3>
                                        <div class="widget_shopping_cart_content">
                                            <ul class="cart_list product_list_widget ">
                                                @foreach(Cart::content() as $item)
                                                    <li class="media loop-color">
                                                        <div class="media-left media-middle"> <a href="shop-product-right.html">
                                                                <img src="{{ asset($item->model->image) }}" class="muted_background" alt="">
                                                            </a> </div>
                                                        <div class="media-body media-middle" style="width: 100%;">
                                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" id="{{ $item->rowId }}-head">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <a href="javascript:{}" onclick="document.getElementById('{{ $item->rowId }}-head').submit();" class="remove" title="Remove this item"></a>
                                                            </form>
                                                            <h4> <a href="{{ route('shop.show', [$item->model->category->slug, $item->model->slug]) }}">{{ $item->model->name }}</a> </h4>
                                                            <span class="cart-brand">{{ $item->model->brand }}</span>
                                                            <span class="product-quantity">
                                                                <span>{{ $item->qty }} x</span>
                                                                <span class="price">€{{ $item->model->getFormattedPriceAttribute() }}</span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="total"> <strong class="grey">Subtotal:</strong> <span class="price">€ {{ number_format(Cart::subtotal(), 2) }}</span> </p>
                                            <p class="buttons">
                                                <a href="{{ route('cart.index') }}" class="theme_button color1 min_width_button">Carrello</a>
                                                <a href="{{ route('checkout.index') }}" class="theme_button color1 inverse">Checkout</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <header class="page_header header_color bordered_items columns_margin_0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <!-- main nav start -->
                    <nav class="mainmenu_wrapper">
                        {{ menu('main', 'home_menu') }}
                    </nav>
                    <!-- eof main nav -->
                </div>
            </div>
        </div>
    </header>