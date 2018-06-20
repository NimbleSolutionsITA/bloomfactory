<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//HOME
Route::get('/home', 'HomeController@index')->name('home');

//SHOP
Route::get('/shop', 'ShopController@index')->name('shop');
Route::get('/shop/{category}', 'ShopController@category')->name('shop.category');
Route::get('/shop/{category}/{product}', 'ShopController@show')->name('shop.show');

//CART
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::post('/cartFavorite', 'CartController@storeFavorite')->name('cart.storeFavorite');
Route::post('/cart/{product}', 'CartController@updateQty')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::get('/cart/empty', 'CartController@empty')->name('cart.empty');

//CHECKOUT
Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

//COUPONS
Route::post('/coupons', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupons', 'CouponsController@destroy')->name('coupon.destroy');

//OTHER PAGES
Route::get('/about-us', 'AboutController@index')->name('about-us');
Route::get('/retailers', 'RetailersController@index')->name('retailers');
Route::post('/retailers', 'RetailersController@send')->name('retailers.send');
Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::post('/contacts', 'ContactsController@send')->name('contacts.send');
Route::get('/cookie-policy', 'CookiePolicyController@index')->name('cookie-policy');

//NEWSLETTER
Route::post('/subscribe-newsletter', 'NewsletterController@subscribe')->name('newsletter');

//VOYAGER ADMIN PANEL
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
