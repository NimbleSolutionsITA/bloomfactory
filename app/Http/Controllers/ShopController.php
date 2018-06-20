<?php

namespace App\Http\Controllers;

use View;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Show the shop page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Shop';

        $products = Product::orderBy('price','asc');

        if (request()->has('sort')) {
            switch (request('sort'))
            {
                case 'naa':
                    $products = Product::orderBy('name', 'asc');
                    break;
                case 'nad':
                    $products = Product::orderBy('name', 'desc');
                    break;
                case 'pra':
                    $products = Product::orderBy('price', 'asc');
                    break;
                case 'prd':
                    $products = Product::orderBy('price', 'desc');
                    break;
            }
        }

        if (request()->has('keyword')) {
            $products = $products->where('name', 'like', '%'.request()->keyword.'%');
        }

        if (request()->has('min_price') && request()->has('max_price')) {
            $products = $products->where('price','>=',request()->min_price*100);
            $products = $products->where('price','<=',request()->max_price*100);
        }

        if (request()->has('cat') && request('cat') != 0) {
            switch (request('cat')) {
                case 111222:
                    $products = $products->whereIn('category_id', [1,2]);
                    $title = 'Infiorescenze, Hash e Solidi';
                    break;
                case 333555:
                    $products = $products->whereIn('category_id', [3,5]);
                    $title = 'Oli, Cristalli & Vape';
                    break;
                default:
                    $products = $products->where('category_id', request('cat'));
                    $title = Category::find(request('cat'))->name;
            }

        }

        $products = $products->where('stock', '>', 0)->paginate(4)->appends([
            'cat' => request('cat'),
            'min_price' => request('min_price'),
            'max_price' => request('max_price'),
            'keyword' => request('keyword'),
            'sort' => request('sort'),
        ]);

        $categories = Category::all();

        return view('shop', compact(['products', 'categories', 'title']) );

    }

    public function category($cat)
    {
        $category = Category::where('slug', $cat)->firstOrFail();
        $products = Product::where('category_id', $category->id)->where('stock', '>', 0)->orderBy('price','asc')->paginate(4);

        $title = $category->name;

        $categories = Category::all();

        return view('shop', compact(['products', 'categories', 'title']) );
    }

    public function show($cat, $slug)
    {
        $category = Category::where('slug', $cat)->firstOrFail();
        $product = Product::where('slug', $slug)->where('stock', '>', 0)->firstOrFail();

        if ($category->id != $product->category->id)
            return view('errors.404',array(),404);

        return view('product')->with('product', $product);
    }
}