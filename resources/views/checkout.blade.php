@extends('layouts.app')

@section('title', 'Checkout')

@section('extra-css')
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        /**
         * The CSS shown here will not be introduced in the Quickstart guide, but shows
         * how you can use CSS to style your Element's container.
         */
        .StripeElement {
            background-color: transparent;
            height: 50px;
            padding: 15px 20px 11px;
            border-radius: 10px;
            border: 1px solid rgba(128, 128, 128, 0.5);
            font-size: 16px;
            line-height: 30px;
            font-weight: 400;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>


@endsection

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
                <div class="col-sm-7 col-md-8 col-lg-8">
                    @guest
                        <div class="shop-info">Sei già nostro cliente? <a data-toggle="collapse" href="#registeredForm" aria-expanded="false" aria-controls="registeredForm">Effettua il login</a> </div>
                        <div class="collapse" id="registeredForm">
                            <form class="checkout with_border with_padding form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <p>Se hai già acquistato da noi prima, inserisci perfavore i tuoi dettagli per il login. Se invece sei un nuovo cliente procedi perfavore all'Indirizzo di spedizione</p>
                                <div class="form-group"> <label for="username" class="col-sm-3 control-label">
                                        <span class="grey">Email:</span>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group"> <label for="password" class="col-sm-3 control-label">
                                        <span class="grey">Password:</span>
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox"> <label for="rememberme" class="control-label">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                Ricordami
                                            </label> </div> <input type="submit" class="theme_button color1 topmargin_20" name="login" value="Login">
                                        <div class="lost_password"> <a href="{{ route('password.request') }}">Hai perso la password?</a> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endguest
                    <h2>Indirizzo di spedizione</h2>
                    <form action="{{ route('checkout.store') }}" method="POST" class="form-horizontal checkout shop-checkout" role="form" id="payment-form" data-toggle="validator">
                        {{ csrf_field() }}
                        <div class="form-group"> <label for="billing_country" class="col-sm-3 control-label">
                                <span class="grey">Paese:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="billing_country" id="billing_country">
                                    <option value="">Seleziona un paese…</option>
                                    <option value="IT" selected="selected">Italia</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group validate-required" id="name_field"> <label for="name" class="col-sm-3 control-label">
                                <span class="grey">Nome:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="name" id="name" placeholder="" value="@guest{{ old('name') }}@endguest @auth{{ Auth::user()->billing_name }}@endauth" required> </div>
                        </div>
                        <!--
                        <div class="form-group" id="billing_company_field"> <label for="billing_company" class="col-sm-3 control-label">
                                <span class="grey">Company Name:</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="billing_company" id="billing_company" placeholder="" value=""> </div>
                        </div>
                        -->
                        <div class="form-group address-field validate-required" id="address_field"> <label for="address" class="col-sm-3 control-label">
                                <span class="grey">Indirizzo:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="address" id="address" placeholder="" value="@guest{{ old('address') }}@endguest @auth{{ Auth::user()->billing_address }}@endauth" required> </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9"> <input type="text" class="form-control " name="billing_address_2" id="billing_address_2" placeholder="" value=""> </div>
                        </div>
                        -->
                        <div class="form-group address-field validate-required" id="city_field"> <label for="city" class="col-sm-3 control-label">
                                <span class="grey">Città:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="city" id="city" placeholder="" value="@guest{{ old('city') }}@endguest @auth{{ Auth::user()->billing_city }}@endauth" required> </div>
                        </div>
                        <div class="form-group address-field validate-state" id="province_field"> <label for="province" class="col-sm-3 control-label">
                                <span class="grey">Provincia:</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " value="@guest{{ old('province') }}@endguest @auth{{ Auth::user()->billing_province }}@endauth" placeholder="" name="province" id="province" required> </div>
                        </div>
                        <div class="form-group address-field validate-required validate-postcode" id="postalcode_field"> <label for="postalcode" class="col-sm-3 control-label">
                                <span class="grey">CAP:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="number" class="form-control " name="postalcode" id="postalcode" placeholder="" value="{{ Auth::user() ? Auth::user()->billing_postcode : old('postcode') }}" required> </div>
                        </div>
                        <div class="form-group validate-required validate-email" id="email_field"> <label for="email" class="col-sm-3 control-label">
                                <span class="grey">Email:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="email" class="form-control " name="email" id="email" placeholder="" value="@guest{{ old('email') }}@endguest @auth{{ Auth::user()->email }}@endauth" required> </div>
                        </div>
                        <div class="form-group validate-required validate-phone" id="phone_field"> <label for="phone" class="col-sm-3 control-label">
                                <span class="grey">Telefono:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="phone" id="phone" placeholder="" value="@guest{{ old('phone') }}@endguest @auth{{ Auth::user()->billing_phone }}@endauth" required> </div>
                        </div>
                        <div class="form-group form-stripe">

                            <div class="form-group validate-required" id="name_on_card_field"> <label for="name_on_card" class="col-sm-3 control-label">
                                    <span class="grey">Nome sulla carta:</span>
                                    <span class="required">*</span>
                                </label>
                                <div class="col-sm-9"> <input type="text" class="form-control " name="name_on_card" id="name_on_card" placeholder="" value="{{ old('name_on_card') }}" required> </div>
                            </div>
                            <label for="card-element" class="col-sm-3 control-label" style="color: #333;">
                                Carta di credito
                            </label>
                            <div class="col-sm-9">
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <!--
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Vuoi creare un nuovo Account?
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Stesso indirizzo di spedizione?
                                    </label>
                                </div>
                                -->
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="order_comments" class="col-sm-3 control-label">
                                <span class="grey">Order Notes:</span>
                            </label>
                            <div class="col-sm-9"> <textarea name="order_comments" class="form-control" id="order_comments" placeholder="" rows="5"></textarea> </div>
                        </div>
                        -->
                    </form>
                </div>
                <!--eof .col-sm-8 (main content)-->
                <!-- sidebar -->
                <aside class="col-sm-5 col-md-4 col-lg-4">
                    <h3 class="widget-title" id="order_review_heading">Il tuo ordine</h3>
                    <div id="order_review" class="shop-checkout-review-order">
                        <table class="table shop_table shop-checkout-review-order-table">
                            <thead>
                            <tr>
                                <td class="product-name">Prodotti</td>
                                <td class="product-total">Totale</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( Cart::content() as $item)
                                    <tr class="cart_item">
                                        <td class="product-name"> {{ $item->model->name }} <span class="product-quantity">× {{ $item->qty }}</span> </td>
                                        <td class="product-total"> <span class="amount grey"><span class="currencies">€</span>{{ $item->model->getFormattedPriceAttribute() * $item->qty }}</span> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="cart-subtotal">
                                <td>Totale prodotti:</td>
                                <td> <span class="amount grey"><span class="currencies">€</span><span class="amount">{{ Cart::subtotal() }}</span></span> </td>
                            </tr>
                            @if (Cart::count() > 0)
                                <tr class="shipping">
                                    <td>Spedizione:</td>
                                    <td>
                                        <span class="grey">
                                            @if (Cart::subtotal()>75)
                                                Spedizione gratuita
                                            @else
                                                €7.50
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endif
                            <tr class="order-total">
                                <td>Totale:</td>
                                <td>
                                    <span class="amount grey">
                                        <strong>
                                            <span class="currencies">€</span>
                                            <span class="amount">
                                                @if (Cart::subtotal()>75)
                                                    {{ Cart::total()}}
                                                @else
                                                    {{ Cart::total() + 7.5}}
                                                @endif
                                            </span>
                                        </strong>
                                    </span>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        <div id="payment" class="shop-checkout-payment">
                            <h3 class="widget-title">Pagamento</h3>
                            <ul class="list1 no-bullets payment_methods methods">
                                <li class="payment_method_bacs">
                                    <div class="radio"> <label for="payment_method_bonifico">
                                            <input id="payment_method_bonifico" type="radio" name="payment_method" value="bonifico" checked="checked">
                                            <span class="grey">Bonifico Bancario</span>
                                        </label> </div>
                                    <div class="payment_box payment_method_bacs">
                                        <p>Effettua il pagamento tramite bonifico bancario. Usa l'ID dell'ordine che riceverai tramite email come causale del pagamento. Il tuo ordine verrà spedito in seguito all'effettivo accredito sul nostro conto.</p>
                                    </div>
                                </li>
                                <!--
                                <li class="payment_method_cheque">
                                    <div class="radio"> <label for="payment_method_cheque">
                                            <input id="payment_method_cheque" type="radio" name="payment_method" value="cheque">
                                            <span class="grey">Cheque Payment</span>
                                        </label> </div>
                                </li>
                                <li class="payment_method_paypal">
                                    <div class="radio"> <label for="payment_method_paypal">
                                            <input id="payment_method_paypal" type="radio" name="payment_method" value="paypal">
                                            <span class="grey">PayPal</span>

                                        </label> </div>
                                </li>
                                -->
                                <li class="payment_method_paypal">
                                    <div class="radio"> <label for="payment_method_stripe">
                                            <input id="payment_method_stripe" type="radio" name="payment_method" value="stripe">
                                            <span class="grey"><img src="{{ asset('/images/logo-stripe.png') }}" width="200"></span>

                                        </label> </div>
                                </li>
                            </ul>

                            <div class="place-order">
                                <button class="theme_button color1" name="checkout_place_order" id="place_order" value="Place order"> Effettua l'ordine </button>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- eof aside sidebar -->
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function() {

            $('.form-stripe').hide();

            $('input[type="radio"]').click(function() {
                if($(this).attr('id') == 'payment_method_stripe') {
                    $('.form-stripe').show();
                }

                else {
                    $('.form-stripe').hide();
                }
            });

            // Create a Stripe client.
            var stripe = Stripe('pk_test_HLaVb62hZOD8jU987wlb7GmR');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Raleway", sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');

            if (document.getElementById('payment_method_stripe').checked)
            {
                $("#place_order").click( function(event) {
                    event.preventDefault();

                    // Disable submit button
                    document.getElementById('place_order').disabled = true;

                    var options = {
                        name: document.getElementById('name_on_card').value,
                        address_line1: document.getElementById('address').value,
                        address_city: document.getElementById('city').value,
                        address_state: document.getElementById('province').value,
                        address_zip: document.getElementById('postalcode').value
                    };

                    stripe.createToken(card, options).then(function (result) {
                        if (result.error) {
                            // Inform the user if there was an error.
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;

                            // Enable submit button
                            document.getElementById('place_order').disabled = false;

                        } else {
                            // Send the token to your server.
                            stripeTokenHandler(result.token);
                        }
                    });
                });

                function stripeTokenHandler(token) {
                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            }

            if (document.getElementById('payment_method_bonifico').checked)
            {
                $("#place_order").click( function(event) {
                    event.preventDefault();
                    var form = document.getElementById('payment-form');

                    // Disable submit button
                    document.getElementById('place_order').disabled = true;

                    // Submit the form
                    form.submit();
                });
            }
        });
    </script>
@endsection