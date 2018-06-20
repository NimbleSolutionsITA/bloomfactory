@extends('layouts.app')

@section('title', 'Contatti')

@section('content')

    @include('partials.breadcrumbs')

    <section id="map" class="ls" data-address="Via Gabriello Chiabrera 72, Roma, RM, Italia">
        <!-- marker description and marker icon goes here -->
        <div class="map_marker_description">
            <h3>Bloom Factory</h3>
            <p>Via Gabriello Chiabrera, 72 - 00145 Roma</p>
            <img class="map_marker_icon" src="/images/marker.png" alt="" style="width:50px;">
        </div>
    </section>
    <section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Scrivici</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 to_animate" data-animation="scaleAppear">
                    <form action="{{ route('contacts.send') }}" method="POST" class="contact-form columns_padding_5 bottommargin_40" role="form" id="contact-form" data-toggle="validator">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group bottommargin_0">
                                    <label for="name">Nome <span class="required">*</span></label>
                                    <i class="fa fa-user highlight" aria-hidden="true"></i>
                                    <input type="text" aria-required="true" size="30"  name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Nome" required>											</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group bottommargin_0">
                                    <label for="phone">Telefono<span class="required">*</span></label>
                                    <i class="fa fa-phone highlight" aria-hidden="true"></i>
                                    <input type="text" aria-required="false" size="30" value="{{ old('phone') }}" name="phone" id="phone" class="form-control" placeholder="Telefono">											</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group bottommargin_0">
                                    <label for="email">Email address<span class="required">*</span></label>
                                    <i class="fa fa-envelope highlight" aria-hidden="true"></i>
                                    <input type="email" aria-required="true" size="30" value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="Indirizzo Email" required>											</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group bottommargin_0">
                                    <label for="subject">Oggetto<span class="required">*</span></label>
                                    <i class="fa fa-flag highlight" aria-hidden="true"></i>
                                    <input type="text" aria-required="true" size="30" value="{{ old('subject') }}" name="subject" id="subject" class="form-control" placeholder="Oggetto" required>											</div>
                            </div>
                            <div class="col-sm-12">
                                <div class="contact-form-message form-group bottommargin_0">
                                    <label for="message">Messaggio</label>
                                    <i class="fa fa-comment highlight" aria-hidden="true"></i>
                                    <textarea aria-required="true" rows="3" cols="45" name="message" id="message" class="form-control" placeholder="Messaggio"></textarea> </div>
                            </div>
                            <div class="col-sm-12 bottommargin_0">
                                <div class="contact-form-submit topmargin_10">
                                    <button type="submit" id="contact_form_submit" name="send" id="send" value="send" class="theme_button color1 wide_button margin_0">Invia messaggio</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 to_animate" data-animation="scaleAppear">
                    <ul class="list1 no-bullets no-top-border no-bottom-border">
                        <li>
                            <div class="media">
                                <div class="media-left"> <i class="rt-icon2-shop highlight fontsize_18"></i> </div>
                                <div class="media-body">
                                    <h6 class="media-heading grey">Indirizzo:</h6> Via Gabriello Chiabrera, 72 - 00145 Roma ITALIA </div>
                            </div>
                        </li>
                        <li>
                            <div class="media">
                                <div class="media-left"> <i class="rt-icon2-phone5 highlight fontsize_18"></i> </div>
                                <div class="media-body">
                                    <h6 class="media-heading grey">Telefono:</h6> +39 06 541 1036 </div>
                            </div>
                        </li>
                        <li>
                            <div class="media">
                                <div class="media-left"> <i class="rt-icon2-mail highlight fontsize_18"></i> </div>
                                <div class="media-body greylinks">
                                    <h6 class="media-heading grey">Email:</h6> <a href="shop@bloomfactory.it">shop@bloomfactory.it</a> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
