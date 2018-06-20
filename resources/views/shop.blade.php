@extends('layouts.app')

@section('title', $title)

@section('content')

    @include('partials.breadcrumbs')

    <section class="ls section_padding_top_150 section_padding_bottom_100 columns_padding_30">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4">
                    <div class="shop-sorting">
                        <form class="form-inline content-justify vertical-center content-margins">
                            @if ($products->total() == 0)
                                <div>Nessun risultato</div>
                            @else
                                <div> Showing {{ (($products->currentPage() - 1) * $products->perPage()) + 1 }}-
                                    @if ($products->currentPage() == $products->lastPage())
                                        {{ $products->total() }}
                                    @else
                                        {{ $products->currentPage() * 4 }}
                                    @endif
                                    of {{ $products->total() }} results
                                </div>
                            @endif
                            <div class="form-group select-group">
                                <select aria-required="true" id="sort" name="sort" class="choice empty form-control" onchange="this.form.submit()">
                                    <option value="" disabled selected data-default>Ordinamento predefinito</option>
                                    <option {{ request('sort') == 'pra' ? 'selected' : '' }} value="pra">per Prezzo asc</option>
                                    <option {{ request('sort') == 'prd' ? 'selected' : '' }} value="prd">per Prezzo dsc</option>
                                    <option {{ request('sort') == 'naa' ? 'selected' : '' }} value="naa">per Nome asc</option>
                                    <option {{ request('sort') == 'nad' ? 'selected' : '' }} value="nad">per Nome dsc</option>
                                </select>
                                <i class="fa fa-angle-down theme_button color1 no_bg_button" aria-hidden="true"></i>
                            </div>
                        </form>
                    </div>
                    <div class="columns-2">
                        <ul id="products" class="products list-unstyled">

                            @foreach($products->getCollection()->all() as $product)

                                <li class="product type-product loop-color">
                                    <article class="vertical-item content-padding rounded overflow_hidden with_background">
                                        <div class="item-media">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                            @if(file_exists(public_path('/images/brands/'.$product->brand.'.png')))
                                                <img class="brand" src="/images/brands/{{ $product->brand }}.png">
                                            @endif
                                            <span class="price main_bg_color">
                                                <ins>€ <span class="amount">{{ $product->getFormattedPriceAttribute() }}</span></ins>
                                            </span>
                                            <div class="product-buttons">
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
                                            <h4 class="entry-title topmargin_5"><span>{{ $product->brand }}</span> <a href="{{ route('shop.show', [$product->category->slug, $product->slug]) }}">{{ $product->name }}</a> </h4>
                                            <p class="content-3lines-ellipsis">{!! \Illuminate\Support\Str::words(strip_tags($product->flavour),$words = 15, $end='...') !!}</p>
                                        </div>
                                    </article>
                                </li>

                            @endforeach


                        </ul>
                    </div>
                    <!-- eof .columns-* -->
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
                <aside class="col-sm-5 col-md-4 col-lg-4 col-sm-pull-7 col-md-pull-8 col-lg-pull-8">

                    <div class="widget widget_search">
                        <h3 class="widget-title">Cerca ora</h3>
                        <form method="get" class="form-inline" action="{{ route('shop') }}">
                            <div class="form-group margin_0">
                                <label class="sr-only" for="widget-search">Search for:</label>
                                <input id="widget-search" type="text" value="" name="keyword" class="form-control" placeholder="Inserisci le prole chiave...">
                            </div>
                            <button type="submit" class="theme_button color1 no_bg_button">Search</button>
                        </form>
                    </div>
                    <div class="widget widget_categories">
                        <h3 class="widget-title">Tutte le categorie</h3>
                        <select name="cat" class="wrap-select-group" form="filterform">
                            <option value="0">Tutte</option>
                            @foreach($categories as $category)
                                <option {{ request('cat') == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--
                    <div class="widget widget_categories">
                        <h3 class="widget-title">Flavor / Smell</h3> <select name="cat" class="wrap-select-group">
                            <option value="1">All</option>
                            <option value="2">Type 1</option>
                            <option value="3">Type 2</option>
                            <option value="4">Type 3</option>
                            <option value="5">Type 4</option>
                        </select>
                    </div>
                    <div class="widget widget_categories">
                        <h3 class="widget-title">Effect</h3> <select name="cat" class="wrap-select-group">
                            <option value="1">All</option>
                            <option value="2">Effect 1</option>
                            <option value="3">Effect 2</option>
                            <option value="4">Effect 3</option>
                            <option value="5">Effect 4</option>
                        </select>
                    </div>
                    -->
                    <div class="widget widget_price_filter">
                        <h3 class="widget-title">Filtra per prezzo</h3>
                        <!-- price slider -->
                        <form method="get" action="{{ route('shop') }}" class="form-inline"  id="filterform">
                            <div class="slider-range-price"></div>
                            <input type="hidden" value="" name="min_price" />
                            <input type="hidden" value="" name="max_price" />
                            <div class="price_label" style=""> Prezzo: <span class="price_from">2</span> - <span class="price_to">35</span> </div>
                            <div class="topmargin_20"> <button type="submit" class="theme_button color1 min_width_button">Filtra</button> </div>
                        </form>
                    </div>

                    <div class="widget widget_shopping_cart">
                        <h3 class="widget-title">Il tuo carrello</h3>
                        <div class="widget_shopping_cart_content">
                            <ul class="cart_list product_list_widget ">
                                @foreach(Cart::content() as $item)
                                    <li class="media loop-color">
                                        <div class="media-left media-middle"> <a href="shop-product-right.html">
                                                <img src="{{ asset($item->model->image) }}" class="muted_background" alt="">
                                            </a> </div>
                                        <div class="media-body media-middle">
                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" id="{{ $item->rowId }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="javascript:{}" onclick="document.getElementById('{{ $item->rowId }}').submit();" class="remove" title="Remove this item"></a>
                                            </form>
                                            <h4> <a href="">{{ $item->model->name }}</a> </h4>
                                            <span class="cart-brand" style="color: #369a47">{{ $item->model->brand }}</span>
                                            <span class="product-quantity">
                                                <span>{{ $item->qty }} x</span>
                                                <span class="price">€{{ $item->model->getFormattedPriceAttribute() }}</span>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="total"> <strong class="grey">Totale prodotti:</strong> <span class="price">€ {{ number_format(Cart::subtotal(), 2) }}</span> </p>
                            <p class="buttons">
                                <a href="{{ route('cart.index') }}" class="theme_button color1 min_width_button">Vedi Carrello</a>
                                <a href="{{ route('checkout.index') }}" class="theme_button color1 inverse">Checkout</a>
                            </p>
                        </div>
                    </div>
                </aside>
                <!-- eof aside sidebar -->
            </div>
        </div>
    </section>

    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: transparent;
            color: #a6a6a6;
            padding: 16px;
            font-style: italic;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 12px;
            border: none;
            cursor: pointer;
        }

        /* Dropdown button on hover & focus */
        .dropbtn:hover, .dropbtn:focus {
            background-color: #3e8e41;
        }

        /* The search field */
        #myInput {
            border-box: box-sizing;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        /* The search field when it gets focus/clicked on */
        #myInput:focus {outline: 3px solid #ddd;}

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            border: 1px solid #ddd;
            z-index: 2;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border: 1px solid rgba(128, 128, 128, 0.5);
            width: 100%&
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {display:block;}
    </style>
    <script>
        /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
