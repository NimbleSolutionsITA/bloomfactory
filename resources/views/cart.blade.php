@extends('layouts.app')

@section('title', 'Carrello')

@section('content')

    @include('partials.breadcrumbs')

    <section class="ls section_padding_top_100 section_padding_bottom_75 columns_padding_25">
        <div class="container">

            @if (session()->has('success_message'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ session()->get('success_message') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <!-- <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4"> -->
                 <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table shop_table cart cart-table">
                            <thead>
                            <tr>
                                <td class="product-info">Prodotto</td>
                                <td class="product-price-td">Prezzo</td>
                                <td class="product-quantity">Quantità</td>
                                <td class="product-subtotal">Totale</td>
                                <td class="product-remove">&nbsp;</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::content() as $item)

                                <tr class="cart_item">
                                    <td class="product-info">
                                        <div class="media">
                                            <div class="media-left"> <a href="shop-product-right.html">
                                                    <img class="media-object cart-product-image" src="{{ $item->model->image }}" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading" style="margin-bottom: 0"> <a href="{{ route('shop.show', [$item->model->category->slug, $item->model->slug]) }}">{{ $item->model->name }}</a> </h4>
                                                <span class="cart-brand">{{ $item->model->brand }}</span><br>
                                                {{ \App\Category::where('id', $item->model->category_id)->first()->name  }}
                                             </div>
                                        </div>
                                    </td>
                                    <td class="product-price"> <span class="currencies">€</span><span class="amount">{{ $item->model->getFormattedPriceAttribute() }}</span> </td>
                                    <td class="product-quantity">
                                        <form action="{{ route('cart.update', $item->rowId)}}" method="POST">
                                            {{ csrf_field() }}
                                            <select class="quantity" data-id='{{ $item->rowId }}'>
                                                @for ($i = 1; $i < 10 + 1 ; $i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </td>
                                    <td class="product-subtotal"> <span class="currencies">$</span><span class="amount">{{  number_format($item->model->getFormattedPriceAttribute() * $item->qty, 2) }}</span> </td>
                                    <td class="product-remove">
                                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="remove fontsize_20" title="Remove this item">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-buttons">
                        <a class="theme_button color1" href="{{ route('shop') }}">Continua lo Shopping</a>
                        <a href="{{ route('checkout.index') }}" class="theme_button inverse">Vai al Checkout</a>
                    </div>
                    <div class="cart-collaterals">
                        <div class="cart_totals">
                            <h4>Totale carrello</h4>
                            <table class="table">
                                <tbody>
                                <tr class="cart-subtotal">
                                    <td>Totele prodotti</td>
                                    <td><span class="currencies">€</span><span class="amount"> {{ number_format(Cart::subtotal(), 2) }}</span> </td>
                                </tr>
                                @if(Cart::count()>0)
                                    <tr class="shipping">
                                        <td>Spedizione <i>(gratuita per ordini superiori a 75€)</i></td>
                                        @if (Cart::subtotal()>75 )
                                            <td> Spedizione gratuita </td>
                                        @else
                                            <td> € 7.50 </td>
                                        @endif
                                    </tr>
                                @endif
                                @if (!empty(Session::get('coupon')))
                                    <tr class="shipping">
                                        <td>Coupon {{ Session::get('coupon')['name'] }}
                                            <form class="coupon_remove" action="{{ route('coupon.destroy') }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                        <td>€ {{ number_format($discount, 2) }}</td>
                                    </tr>
                                @endif
                                <tr class="order-total">
                                    <td class="grey">Totale ordine</td>
                                    <td><strong class="grey"><span class="currencies">€</span><span class="amount">
                                    @if (Cart::subtotal()>75)
                                            {{ number_format($newSubtotal, 2)}}
                                        @else
                                            {{ number_format($newSubtotal + 7.5, 2)}}
                                        @endif
                                    </span> </strong> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        @if (empty(Session::get('coupon')))
                        <div class="col-md-6">
                            <div class="coupon with_padding rounded with_background">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <h4 class="topmargin_0">Codici sconto</h4>
                                    <p>Inserisci qui il tuo Coupon se ne possiedi uno</p>
                                    <div class="form-group">
                                        <label class="sr-only" for="coupon_code">Coupon:</label>
                                        <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="Codice sconto">
                                    </div>
                                    <button type="submit" class="theme_button color1" href="#">Applica Coupon</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        <!--
                        <div class="col-md-6">
                            <div class="shipping-calculator-form with_padding rounded with_background">
                                <h4 class="topmargin_0">Shipping &amp; Tax</h4>
                                <p>Enter destination to get shipping</p>
                                <div class="form-group">
                                    <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state form-control">
                                        <option value="">Select a country…</option>
                                        <option value="AX">Åland Islands</option>
                                        <option value="OM">Oman</option>
                                        <option value="GB" selected="selected">United Kingdom (UK)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="" placeholder="State / county" name="calc_shipping_state" id="calc_shipping_state">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="" placeholder="Postcode / Zip" name="calc_shipping_postcode" id="calc_shipping_postcode">
                                </div>
                                <div>
                                    <button type="submit" name="calc_shipping" class="theme_button color1" value="1">Update Totals</button>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <!--eof .col-sm-8 (main content)-->
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
    <script>
        (function() {
            const classname = document.querySelectorAll('.quantity');

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function () {
                    const id = element.getAttribute('data-id');
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                        .then(function (response) {
                            window.location.href = '{{ route('cart.index') }}'
                        })
                        .catch(function (error) {
                            console.log(error);
                            window.location.href = '{{ route('cart.index') }}'
                        });
                });
            })
        })();
    </script>
@endsection

