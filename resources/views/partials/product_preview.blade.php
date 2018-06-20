<section id="products" class="ds parallax page_shop section_padding_top_150 section_padding_bottom_150">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-4"> <span class="small-text big highlight4">
					Il nostro Shop
				</span>
                <h2 class="section_header">Acquista qui i prodotti CBD</h2>
                <div class="widget widget_categories topmargin_50">
                    <ul class="greylinks color4">
                        @foreach($categories as $category)
                            <li> <a href="/shop/{{ $category->slug }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <p class="topmargin_40">
                    <a href="{{ route('shop') }}" class="theme_button color4">
                        Vai al negozio
                    </a>
                </p>
            </div>
            <div class="col-lg-9 col-sm-8">
                <div class="owl-carousel" data-nav="true" data-responsive-lg="3">
                    @foreach($products as $product)
                        <article class="product ls vertical-item content-padding rounded overflow_hidden loop-color">
                            <div class="item-media">
                                <img src="{{ asset($product->image) }}" alt="" />
                                @if(file_exists(public_path('/images/brands/'.$product->brand.'.png')))
                                    <img class="brand" src="/images/brands/{{ $product->brand }}.png" style="width: 50px;">
                                @endif
                                <span class="price main_bg_color">
                                    <ins>
                                        <span class="amount">€ {{ $product->getFormattedPriceAttribute() }}</span>
                                    </ins>

                                </span>
                                <div class="product-buttons" style="z-index: 9999;">
                                    <a href="javascript:{}" onclick="document.getElementById('{{ $product->id }}-favorite').submit();" class="favorite_button">
                                        <span class="sr-only">Add to favorite</span>
                                    </a>
                                    <a href="javascript:{}" onclick="document.getElementById('{{ $product->id }}').submit();" class="add_to_cart">
                                        <span class="sr-only">Add to cart</span>
                                    </a>

                                    <form method="post" enctype="multipart/form-data" action="{{ route('cart.storeFavorite') }}" id="{{ $product->id }}-favorite">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->getFormattedPriceAttribute() }}">
                                        <input type="hidden" name="product_quantity" value="1">
                                    </form>

                                    <form method="post" enctype="multipart/form-data" action="{{ route('cart.store') }}" id="{{ $product->id }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->getFormattedPriceAttribute() }}">
                                        <input type="hidden" name="product_quantity" value="1">
                                    </form>
                                </div>
                            <div class="item-content">
                                <div class="cbd-level">
                                    @if($product->cbd > 0)
                                        <h6>CBD {{ $product->cbd }}%</h6>
                                        <div class="star-rating" title="Rated 5.0 out of 5">
                                                        <span style="width:{{ $product->cbd * 5 }}%">
                                                            <strong class="rating">5.0</strong> out of 5
                                                        </span>
                                        </div>
                                    @else
                                        <h6 style="color: #359a47">{{ strtoupper($categories->where('id', $product->category_id)->first()->name) }}</h6>
                                    @endif

                                </div>
                                <h4 class="entry-title topmargin_5"> <a href="{{ route('shop.show', [$product->category->slug, $product->slug]) }}">{{ $product->name }}</a> </h4>
                                <p class="content-3lines-ellipsis">{!! \Illuminate\Support\Str::words(strip_tags($product->flavour),$words = 12, $end='...') !!}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>