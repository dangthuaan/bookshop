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
    return view('welcome');
});

Auth::routes();

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', function() {
    return view('admin.layouts.default-admin');
})->name('admin.layouts.default-admin')->middleware('auth');


/*Route::middleware(['auth'])->prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Uses first & second Middleware
    	Route::get('books', 'Admin\BookController@index')->name('books.index');
		Route::get('books/create', 'Admin\BookController@create')->name('books.create');
		Route::post('books', 'Admin\BookController@store')->name('books.store');
		Route::get('book/{book}/', 'Admin\BookController@show')->name('books.show');
		Route::get('book/{book}/edit', 'Admin\BookController@edit')->name('books.edit');
		Route::put('books/{book}', 'Admin\BookController@update')->name('books.update');
		Route::delete('books/{book}', 'Admin\BookController@destroy')->name('books.destroy');

		Route::resource('books', 'Admin\BookController');

});*/

Route::middleware(['auth'])->prefix('home')->name('client.')->namespace('Client')->group(function () {
	// Uses first & second Middleware
	Route::get('shop/cart', 'OrderController@index')->name('orders.index');
	Route::post('shop/orders', 'OrderController@store')->name('orders.store');

	Route::post('shop/cart/minusQuantity', 'OrderController@minusQuantity')->name('orders.minusQuantity');
	Route::post('shop/cart/plusQuantity', 'OrderController@plusQuantity')->name('orders.plusQuantity');

	Route::delete('shop/orders', 'OrderController@destroy')->name('orders.destroy');
	/* Route::get('home/shop/orders/create-order', 'OrderController@create')->name('orders.create');
	Route::post('home/shop/orders', 'OrderController@store')->name('orders.store');
	Route::get('home/shop/orders/{order}/', 'OrderController@show')->name('orders.show');
	Route::get('home/shop/orders/{order}/edit-order', 'OrderController@edit')->name('orders.edit');
	Route::put('home/shop/orders/{order}', 'OrderController@update')->name('orders.update');
	Route::delete('home/shop/orders/{order}', 'OrderController@destroy')->name('orders.destroy'); */


	/*Route::resource('books', 'Admin\BookController');*/

});


/*
prefix: rút gọn đường link (/)
name: rút gọn đặt tên của route (->name)
namespace: thư mục cha của Controller
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Uses first & second Middleware
    	Route::get('books', 'AdminController@index')->name('books.index');
		Route::get('books/create-book', 'AdminController@create')->name('books.create');
		Route::post('books', 'AdminController@store')->name('books.store');
		Route::get('books/{book}/', 'AdminController@show')->name('books.show');
		Route::get('books/{book}/edit-book', 'AdminController@edit')->name('books.edit');
		Route::put('books/{book}', 'AdminController@update')->name('books.update');
		Route::delete('books/{book}', 'AdminController@destroy')->name('books.destroy');

		/*Route::resource('books', 'Admin\BookController');*/

});

Route::get('/home', function () {
    return view('client.books.book-home');
});

Route::middleware(['auth'])->name('client.')->namespace('Client')->group(function () {
	// Uses first & second Middleware
	Route::get('home/shop', 'BookController@index')->name('books.index');
	Route::get('home/shop/{book}/', 'BookController@show')->name('books.show');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
	// Uses first & second Middleware
	Route::get('categories', 'CategoryController@index')->name('categories.index');
	Route::get('categories/create-category', 'CategoryController@create')->name('categories.create');
	Route::post('categories', 'CategoryController@store')->name('categories.store');
	Route::get('categories/edit-category', 'CategoryController@edit')->name('categories.edit');
	Route::put('categories', 'CategoryController@update')->name('categories.update');
	Route::delete('categories', 'CategoryController@destroy')->name('categories.destroy');

	/*Route::resource('books', 'Admin\BookController');*/

});

