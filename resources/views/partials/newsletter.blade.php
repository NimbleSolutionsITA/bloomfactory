<section id="subscribe" class="cs main_color2 background_cover overlay_color page_subscribe section_padding_top_75 section_padding_bottom_75 table_section table_section_lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-3 text-center text-md-left"> <span class="small-text big black">
					Iscriviti ora alla
				</span>
                <h2 class="section_header">Nostra Newsletter</h2>
            </div>
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-12 col-md-offset-0 col-lg-9">
                <div class="widget widget_mailchimp">
                    <form class="signup" action="{{ route('newsletter') }}" method="post" id="signup">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group margin_0"> <input class="mailchimp_email form-control" name="email" required="" type="email" placeholder="Il tuo indirizzo email*"> </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <button type="submit" class="theme_button color2 block_button margin_0" form="signup" value="Submit">Iscriviti alla newsletter</button>
                            </div>
                            <div class="col-sm-12 margin_0">
                                <div class="response"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>