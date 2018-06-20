    <footer class="page_footer ds pattern section_padding_top_150 section_padding_bottom_130 columns_margin_bottom_30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 text-center">
                    <div class="logo vertical_logo"> <img src="/images/logo-white.png" alt=""></div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 text-center text-sm-left">
                    <div class="widget widget_text greylinks color2">
                        <h4 class="widget-title"> I nostri contatti </h4>
                        <div class="media small-media">
                            <div class="media-left"> <i class="fa fa-map-marker highlight2"></i> </div>
                            <div class="media-body">Via Gabriello Chiabrera, 72</div>
                        </div>
                        <div class="media small-media">
                            <div class="media-left"> <i class="fa fa-pencil highlight2"></i> </div>
                            <div class="media-body"> <a href="mailto:shop@bloomfactory.it">shop@bloomfactory.it</a> </div>
                        </div>
                        <div class="media small-media">
                            <div class="media-left"> <i class="fa fa-internet-explorer highlight2"></i> </div>
                            <div class="media-body"> <a href="#">www.bloomfactory.it</a> </div>
                        </div>
                        <div class="media small-media">
                            <div class="media-left"> <i class="fa fa-phone highlight2"></i> </div>
                            <div class="media-body">39 06 541 1036 </div>
                        </div>
                        <div class="media small-media">
                            <div class="media-left"> <i class="fa fa-clock-o highlight2"></i> </div>
                            <div class="media-body">Aperto Lun - Sab 11.00 - 20.00</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12 text-center text-sm-left">
                    <div class="widget widget_recent_posts">
                        <h4 class="widget-title">Instagram feed</h4>
                        <div class="row">
                            @for($i = 0; $i < 3; $i++)
                                <div class="col-sm-4">
                                    <a href="{{ $instagram[$i]->link }}" target="_blank"><img src="{{ $instagram[$i]->images->thumbnail->url }}" alt="{{ $instagram[$i]->caption->text }}"></a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-lg-3 col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-0 text-center">
                    <div class="widget widget_text"> <a href="#">
                            <img src="/images/banner.png" alt="">
                        </a> </div>
                </div>
                -->
            </div>
        </div>
    </footer>
    <section class="ds ms page_copyright section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <span class="th-copyright">Made with <i style="color: #D9534F;" class="fa fa-heart"></i> by <a style="color: white; text-decoration: underline;" href="http://www.nimble-solutions.com" target="_blank">Nimble Solutions</a></span>
                    <!--
                    <div class="social-links">
                        <a class="social-icon border-icon rounded-icon socicon-facebook" href="#" title="Facebook"></a>
                        <a class="social-icon border-icon rounded-icon socicon-twitter" href="#" title="Twitter"></a>
                        <a class="social-icon border-icon rounded-icon socicon-google" href="#" title="Google"></a>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </section>