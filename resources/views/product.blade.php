@extends('layouts.app')

@section('title', $product->name)

@section('content')

    @include('partials.breadcrumbs')

    <section class="ls section_padding_top_150 section_padding_bottom_130 columns_padding_25">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div itemscope="" itemtype="http://schema.org/Product" class="product type-product row">
                        <div class="col-sm-6">
                            <div class="images text-center rounded"> <a href="{{ asset($product->image) }}" itemprop="image" class="woocommerce-main-image zoom prettyPhoto" data-gal="prettyPhoto[product-gallery]">
                                    <img src="{{ asset($product->image) }}" class="attachment-shop_single wp-post-image" alt="" title="">
                                </a> </div>
                            <!--eof .images -->
                            <div class="thumbnails-wrap">
                                <div id="product-thumbnails" class="owl-carousel thumbnails product-thumbnails" data-margin="10" data-nav="false" data-dots="true" data-responsive-lg="4" data-responsive-md="4" data-responsive-sm="3" data-responsive-xs="2">

                                    @if(json_decode($product->gallery))
                                        @foreach(json_decode($product->gallery) as $image)
                                            <a href="{{ asset($image) }}" class="zoom first rounded" title="" data-gal="prettyPhoto[product-gallery]">
                                                <img src="{{ asset($image) }}" class="attachment-shop_thumbnail" alt="">
                                            </a>
                                        @endforeach
                                    @endif
                                    <a href="/images/brands/hi-res/{{ $product->brand }}.jpg" class="zoom first rounded" title="" data-gal="prettyPhoto[product-gallery]">
                                        <img src="/images/brands/hi-res/{{ $product->brand }}.jpg" class="attachment-shop_thumbnail" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- eof .images -->
                        </div>
                        <div class="summary entry-summary col-sm-6">
                            <div class="content-justify vertical-center content-margins">
                                <div class="cbd-level">
                                    <h6>CBD:</h6>
                                    <div class="star-rating" title="Rated 5.0 out of 5" style="margin-top: 0;">
                                                <span style="width:{{ $product->cbd * 5 }}%">
                                                    <strong class="rating">5.0</strong> out of 5
                                                </span>
                                    </div>
                                </div>
                                <span class="price main_bg_color2">
								<span class="amount">{{ $product->getFormattedPriceAttribute() }} €</span> </span>
                            </div>
                            <h1 itemprop="name" class="product_title">{{ $product->name }}</h1>
                            <div>
                                {{ $product->decription }}
                                <div class="two-columns-text">
                                    <ul class="list2 color1">
                                        <li>Type: Sativa</li>
                                        <li>Chemdawg x Lights x Skunk </li>
                                        <li>Diesel x Pungent x Earthy</li>
                                        <li>Happy x Euphoric x Uplifting</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row product_meta small-text greylinks columns_padding_0">
                                <div class="col-sm-6"> <span class="posted_in">
									<span>Categories:</span> <span class="categories-links">
										<a rel="category" href="shop-right.html">cannabis</a>, <a rel="category" href="shop-right.html">flowers</a>
									</span> </span>
                                </div>
                                <div class="col-sm-6"> <span class="posted_in">
									<span>Tags:</span> <span class="categories-links">
										<a rel="category" href="shop-right.html">flowers</a>
									</span> </span>
                                </div>
                            </div>
                            <form class="cart topmargin_50" method="post" enctype="multipart/form-data" action="{{ route('cart.store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <div class="row">
                                    <div class="col-sm-6 greylinks"> <a href="#0" class="small-text bold">
                                            <i class="fa fa-list-alt highlight3 rightpadding_10" aria-hidden="true"></i>
                                            Add to wishlist
                                        </a> </div>
                                    <div class="col-sm-6 small-icons"> <span class="small-text rightpadding_10">Share:</span> <a class="social-icon socicon-facebook" href="#" title="Facebook"></a> <a class="social-icon socicon-twitter" href="#" title="Twitter"></a> <a class="social-icon socicon-google" href="#"
                                                                                                                                                                                                                                                                             title="Google"></a> <a class="social-icon socicon-youtube" href="#" title="Youtube"></a> </div>
                                </div>
                                <hr class="divider_30 bottommargin_40">
                                <div class="inline-content">
                                    <span class="quantity form-group">
                                        <select name="product_quantity">
                                            @for ($i = 1; $i < 10 + 1 ; $i++)
                                                <option>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </span>
                                    <button type="submit" class="theme_button color1 min_width_button add_to_cart_button">
                                        Add to cart
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- .summary.col- -->
                    </div>
                    <!-- .product.row -->
                    <div class="woocommerce-tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs color2 wc-tabs" role="tablist">
                            <li class="active"><a href="#details_tab" role="tab" data-toggle="tab">Description</a></li>
                            <li><a href="#additional_tab" role="tab" data-toggle="tab">Additional</a></li>
                            <li><a href="#reviews_tab" role="tab" data-toggle="tab">Reviews</a></li>
                            <li><a href="#custom_tab" role="tab" data-toggle="tab">Custom</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content big-padding top-color-border color2">
                            <div class="tab-pane fade in active" id="details_tab">
                                <p>Duis autem veiudolorn hendrerit vulputate velit esse molestie. consequat, vel illum dolore eu feugiat nulla facilisis at vereros accumsan etiusto dignissim:</p>
                                <ul class="list2 darklinks">
                                    <li> <a href="#">Lorem ipsum dolor sit amet</a> </li>
                                    <li> <a href="#">Sint animi non ut sed</a> </li>
                                    <li> <a href="#">Eaque blanditiis nemo</a> </li>
                                    <li> <a href="#">Amet, consectetur adipisicing</a> </li>
                                    <li> <a href="#">Blanditiis nemo quaerat</a> </li>
                                </ul>
                                <div class="well"> <strong class="highlight">Warning!</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam </div>
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                            </div>
                            <div class="tab-pane fade" id="additional_tab">
                                <table class="table table-striped topmargin_30">
                                    <tr>
                                        <th class="grey">Product title:</th>
                                        <td>Product Name</td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Item SKU:</th>
                                        <td>5552281538</td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Brand:</th>
                                        <td><a href="#">Brand Name</a></td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Style:</th>
                                        <td>SuperStyle</td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Size:</th>
                                        <td>Middle</td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Color:</th>
                                        <td>Black</td>
                                    </tr>
                                    <tr>
                                        <th class="grey">Targeted Group:</th>
                                        <td>All</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="reviews_tab">
                                <div class="comments-area" id="comments">
                                    <ol class="comment-list">
                                        <li class="comment even thread-even depth-1 parent">
                                            <article class="comment">
                                                <div class="comment-author"> <img class="media-object" alt="" src="/images/faces/05.jpg"> </div>
                                                <div class="comment-body"> <span class="reply">
										<a href="#respond">
											<i class="fa fa-reply" aria-hidden="true"></i>
											<span>Reply</span> </a>
															</span>
                                                    <div class="comment-meta darklinks"> <a class="author_url" rel="external nofollow" href="#">Callie Allen</a> <span class="comment-date small-text highlight no-spacing">
											<time datetime="2017-11-08T15:05:23+00:00" class="entry-date">25 jan, 2018 at 12:34</time>
										</span> </div>
                                                    <div class="comment-rating"> <span class="grey">Customer Rating: </span>
                                                        <div class="star-rating" title="Rated 4.00 out of 5"> <span style="width:80%">
												<strong class="rating">4.00</strong> out of 5
											</span> </div>
                                                    </div>
                                                    <p>First Level Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                </div>
                                            </article>
                                            <!-- .comment-body -->
                                            <ol class="children">
                                                <li class="comment byuser odd alt depth-2 parent">
                                                    <article class="comment">
                                                        <div class="comment-author"> <img class="media-object" alt="" src="/images/faces/03.jpg"> </div>
                                                        <div class="comment-body"> <span class="reply">
												<a href="#respond">
													<i class="fa fa-reply" aria-hidden="true"></i>
													<span>Reply</span> </a>
																	</span>
                                                            <div class="comment-meta darklinks"> <a class="author_url" rel="external nofollow" href="#">Mayme Quinn</a> <span class="comment-date small-text highlight no-spacing">
													<time datetime="2017-11-08T15:05:23+00:00" class="entry-date">25 jan, 2018 at 12:34</time>
												</span> </div>
                                                            <div class="comment-rating"> <span class="grey">Customer Rating: </span>
                                                                <div class="star-rating" title="Rated 5.0 out of 5"> <span style="width:100%">
												<strong class="rating">5.0</strong> out of 5
											</span> </div>
                                                            </div>
                                                            <p>Second Level Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                        </div>
                                                    </article>
                                                    <!-- .comment-body -->
                                                    <ol class="children">
                                                        <li class="comment byuser even depth-3">
                                                            <article class="comment">
                                                                <div class="comment-author"> <img class="media-object" alt="" src="/images/faces/01.jpg"> </div>
                                                                <div class="comment-body"> <span class="reply">
														<a href="#respond">
															<i class="fa fa-reply" aria-hidden="true"></i>
															<span>Reply</span> </a>
																			</span>
                                                                    <div class="comment-meta darklinks"> <a class="author_url" rel="external nofollow" href="#">Helen McCarthy</a> <span class="comment-date small-text highlight no-spacing">
															<time datetime="2017-11-08T15:05:23+00:00" class="entry-date">25 jan, 2018 at 12:34</time>
														</span> </div>
                                                                    <div class="comment-rating"> <span class="grey">Customer Rating: </span>
                                                                        <div class="star-rating" title="Rated 4.0 out of 5"> <span style="width:80%">
												<strong class="rating">4.0</strong> out of 5
											</span> </div>
                                                                    </div>
                                                                    <p>Third Level Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                                </div>
                                                            </article>
                                                            <!-- .comment-body -->
                                                        </li>
                                                        <!-- #comment-## -->
                                                    </ol>
                                                    <!-- .children -->
                                                </li>
                                                <!-- #comment-## -->
                                            </ol>
                                            <!-- .children -->
                                        </li>
                                        <!-- #comment-## -->
                                    </ol>
                                    <!-- .comment-list -->
                                </div>
                                <!-- #comments -->
                                <div class="comment-respond" id="respond">
                                    <h3>Write Your Own Review</h3>
                                    <div> <span class="grey">Your rating:</span>
                                        <p class="stars"> <a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a> </p>
                                    </div>
                                    <form class="comment-form" id="commentform" method="post" action="./">
                                        <div class="row columns_padding_10">
                                            <div class="col-md-6">
                                                <p class="comment-form-author"> <label for="author">Name <span class="required">*</span></label>
                                                    <!-- <i class="rt-icon2-user-outline"></i> --><input type="text" aria-required="true" size="30" value="" name="author" id="author" class="form-control" placeholder="Full Name"> </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="comment-form-email"> <label for="comment_email">Email <span class="required">*</span></label>
                                                    <!-- <i class="rt-icon2-mail2"></i> --><input type="email" aria-required="true" size="30" value="" name="comment_email" id="comment_email" class="form-control" placeholder="Email Address"> </p>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="comment-form-chat"> <label for="comment">Comment</label>
                                                    <!-- <i class="rt-icon2-pencil3"></i> --><textarea aria-required="true" rows="8" cols="45" name="comment" id="comment" class="form-control" placeholder="Review"></textarea> </p>
                                            </div>
                                        </div>
                                        <p class="form-submit topmargin_30"> <button type="submit" id="submit" name="submit" class="theme_button color1">Submit Review</button> <button type="reset" id="reset" class="theme_button">Clear Form</button> </p>
                                    </form>
                                </div>
                                <!-- #respond -->
                            </div>
                            <div class="tab-pane fade" id="custom_tab">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                            </div>
                        </div>
                        <!-- eof .tab-content -->
                    </div>
                    <!-- .woocommerce-tabs -->
                    <div class="row topmargin_60">
                        <div class="col-sm-12">
                            <h3 class="text-center bottommargin_40">Related products</h3>
                            <div class="owl-carousel with_shadow_items" data-dots="false" data-loop="true" data-autoplay="true" data-responsive-lg="3">
                                <article class="product vertical-item content-padding rounded overflow_hidden with_background loop-color">
                                    <div class="item-media"> <img src="/images/shop/01.jpg" alt="" /> <span class="price main_bg_color">
										<ins>
											<span class="amount">$50.00</span> </ins>
												</span>
                                        <div class="product-buttons"> <a href="#" class="favorite_button">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> <a href="#" class="add_to_cart">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="star-rating" title="Rated 5.0 out of 5"> <span style="width:100%">
											<strong class="rating">5.0</strong> out of 5
										</span> </div>
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <p class="content-3lines-ellipsis">Swine meatball shankle cow kielbasa burgdoggen shoulder andouille pork loin brisket leberkas.</p>
                                    </div>
                                </article>
                                <article class="product vertical-item content-padding rounded overflow_hidden with_background loop-color">
                                    <div class="item-media"> <img src="/images/shop/02.jpg" alt="" /> <span class="price main_bg_color">
										<ins>
											<span class="amount">$85.00</span> </ins>
												</span>
                                        <div class="product-buttons"> <a href="#" class="favorite_button">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> <a href="#" class="add_to_cart">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="star-rating" title="Rated 4.0 out of 5"> <span style="width:80%">
											<strong class="rating">4.0</strong> out of 5
										</span> </div>
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Pre-Rolls</a> </h4>
                                        <p class="content-3lines-ellipsis">Pork andouille pig, beef ribs prosciutto sausage picanha leberkas ham hock cow. Kevin doner filet mignon.</p>
                                    </div>
                                </article>
                                <article class="product vertical-item content-padding rounded overflow_hidden with_background loop-color">
                                    <div class="item-media"> <img src="/images/shop/03.jpg" alt="" /> <span class="price main_bg_color">
										<ins>
											<span class="amount">$99.00</span> </ins>
												</span>
                                        <div class="product-buttons"> <a href="#" class="favorite_button">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> <a href="#" class="add_to_cart">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="star-rating" title="Rated 3.0 out of 5"> <span style="width:60%">
											<strong class="rating">3.0</strong> out of 5
										</span> </div>
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Concentrates</a> </h4>
                                        <p class="content-3lines-ellipsis">Biltong ribeye cupim meatloaf, burgd shoulder jerky pork loin turducken alcatra venison sirloin.</p>
                                    </div>
                                </article>
                                <article class="product vertical-item content-padding rounded overflow_hidden with_background loop-color">
                                    <div class="item-media"> <img src="/images/shop/04.jpg" alt="" /> <span class="price main_bg_color">
										<ins>
											<span class="amount">$99.00</span> </ins>
												</span>
                                        <div class="product-buttons"> <a href="#" class="favorite_button">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> <a href="#" class="add_to_cart">
                                                <span class="sr-only">Add to favorite</span>
                                            </a> </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="star-rating" title="Rated 3.5 out of 5"> <span style="width:70%">
											<strong class="rating">3.5</strong> out of 5
										</span> </div>
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Oil</a> </h4>
                                        <p class="content-3lines-ellipsis">Pancetta t-bone ball tip pig buffalo, fatback filet mignon brisket frankfurter boudin jowl tenderloin.</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <!--eof .col-sm-8 (main content)-->
            </div>
        </div>
    </section>
@endsection
