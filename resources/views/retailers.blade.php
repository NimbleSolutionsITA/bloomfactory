@extends('layouts.app')

@section('title', 'Retailers')

@section('content')

    @include('partials.breadcrumbs')
    <section class="ls section_padding_top_100 section_padding_bottom_75 columns_padding_25">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <p style="text-align: center; font-weight: 100; font-size: 1.5em;">Sei un rivenditore e vorresti vendere alcuni dei nostri prodotti nel tuo esercizio commerciale?</p>
                    <p style="text-align: center; font-weight: 100; font-size: 1.5em;">Per maggiori informazioni compila il seguente form:</p>
                    <br><br>
                    <form action="{{ route('retailers.send') }}" method="POST" class="form-horizontal checkout shop-checkout" role="form" id="retailer-form" data-toggle="validator">
                        {{ csrf_field() }}
                        <div class="form-group validate-required" id="name_field"> <label for="name" class="col-sm-3 control-label">
                                <span class="grey">Nome:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="name" id="name" placeholder="" value="{{ old('name') }}" required> </div>
                        </div>
                        <div class="form-group address-field validate-required" id="city_field"> <label for="city" class="col-sm-3 control-label">
                                <span class="grey">Città:</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="city" id="city" placeholder="" value="{{ old('city') }}"> </div>
                        </div>
                        <div class="form-group validate-required validate-email" id="email_field"> <label for="email" class="col-sm-3 control-label">
                                <span class="grey">Email:</span>
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9"> <input type="email" class="form-control " name="email" id="email" placeholder="" value="{{ old('email') }}" required> </div>
                        </div>
                        <div class="form-group validate-required validate-phone" id="phone_field"> <label for="phone" class="col-sm-3 control-label">
                                <span class="grey">Telefono:</span>
                            </label>
                            <div class="col-sm-9"> <input type="text" class="form-control " name="phone" id="phone" placeholder="" value="{{ old('phone') }}"> </div>
                        </div>
                        <div class="form-group validate-required validate-phone" id="phone_field"> <label for="phone" class="col-sm-3 control-label">
                                <span class="grey">Messaggio:</span>
                            </label>
                            <div class="col-sm-9"> <textarea type="textarea" class="form-control " name="message" id="message" placeholder="" value="{{ old('message') }}"> </textarea></div>
                        </div>
                        <div class="place-order">
                            <button class="theme_button color1" name="send" id="send" value="send" style="float: right;"> Invia richiesta </button>
                        </div>
                    </form>
                </div>
                <!--eof .col-sm-8 (main content)-->
            </div>
        </div>
    </section>

@endsection
