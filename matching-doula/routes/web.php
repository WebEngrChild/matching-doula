<?php

use Illuminate\Support\Facades\Route;

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

Route::get('', 'ItemsController@showItems')->name('top');

Auth::routes();

//今回は使用しないので削除する
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('items/{item}', 'ItemsController@showItemDetail')->name('item');

Route::middleware('auth')
->group(function () {
    Route::get('items/{item}/buy', 'ItemsController@showBuyItemForm')->name('item.buy');
    Route::post('items/{item}/buy', 'ItemsController@buyItem')->name('item.buy');

    // いいね機能
    Route::put('items/{item}/like', 'ItemsController@like')->name('item.like');
    Route::delete('items/{item}/like', 'ItemsController@unlike')->name('item.unlike');

    Route::get('sell', 'SellController@showSellForm')->name('sell');
    Route::post('sell', 'SellController@sellItem')->name('sell');
});

Route::prefix('mypage')
     ->namespace('MyPage')
     ->middleware('auth')
     ->group(function () {
        Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
        Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
        Route::get('bought-items', 'BoughtItemsController@showBoughtItems')->name('mypage.bought-items');
        Route::get('sold-items', 'SoldItemsController@showSoldItems')->name('mypage.sold-items');
        Route::get('listed-items', 'ListedItemsController@showListedItems')->name('mypage.listed-items');
        Route::get('liked-items', 'LikedItemsController@showLikedItems')->name('mypage.liked-items');
        Route::get('vuejs', 'VuejsController@showVuejs')->name('mypage.vuejs');

        // リアルタイムチャット機能
        Route::get('messagesroom/{messageroom}', 'ChatsController@index')->name('mypage.messageroom-index');
        Route::get('messagesroom/messages/{messageroom}', 'ChatsController@fetchMessages')->name('mypage.fetch-mssages');
        Route::post('messagesroom/messages/{messageroom}', 'ChatsController@sendMessage')->name('mypage.send-message');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
