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

Auth::routes();
Route::get('/home', 'ItemsController@showItems');

//商品一覧
Route::get('', 'ItemsController@showItems')->name('top');

//出品中商品詳細
Route::get('items/{item}', 'ItemsController@showItemDetail')->name('item');

//出品者詳細
Route::get('items/seller/{user}', 'ItemsController@showSeller')->name('seller');

Route::middleware('auth')
    ->group(function () {
        //購入
        Route::get('items/{item}/buy', 'ItemsController@showBuyItemForm')->name('item.buy');
        Route::post('items/{item}/buy', 'ItemsController@buyItem')->name('item.buy');

        // お気に入り
        Route::put('items/{item}/like', 'ItemsController@like')->name('item.like');
        Route::delete('items/{item}/like', 'ItemsController@unlike')->name('item.unlike');

        //売却
        Route::get('sell', 'SellController@showSellForm')->name('sell');
        Route::post('sell', 'SellController@sellItem')->name('sell');
    });

Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware('auth')
    ->group(function () {
        //プロフィール編集
        Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
        Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');

        //出品中商品編集
        Route::get('edit-item/{item}', 'EditItemController@showEditItemForm')->name('mypage.edit-item');
        Route::post('edit-item/{item}', 'EditItemController@editItem')->name('mypage.edit-item');

        //購入済み商品
        Route::get('bought-items', 'BoughtItemsController@showBoughtItems')->name('mypage.bought-items');

        //売却済み商品
        Route::get('sold-items', 'SoldItemsController@showSoldItems')->name('mypage.sold-items');

        //出品中商品
        Route::get('listed-items', 'ListedItemsController@showListedItems')->name('mypage.listed-items');
        Route::get('liked-items', 'LikedItemsController@showLikedItems')->name('mypage.liked-items');

        //いいね獲得ランキング
        Route::get('liked-users', 'LikedItemsController@showLikedUsers')->name('mypage.liked-users');
     });

Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware('auth')
    ->middleware('messageroom')
    ->group(function () {

        // リアルタイムチャット(メッセージルーム認証)
        Route::get('messagesroom/{messageroom}', 'ChatsController@index')->name('mypage.messageroom-index');
        Route::post('messagesroom/{messageroom}/zoom', 'ZoomMakeController@makeZoomMeeting')->name('mypage.make-zoom');
     });

Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware('auth')
    ->middleware('message')
    ->group(function () {

        // リアルタイムチャット(メッセージ送信認証)
        Route::get('messagesroom/messages/{messageroom}', 'ChatsController@fetchMessages')->name('mypage.fetch-mssages');
        Route::post('messagesroom/messages/{messageroom}', 'ChatsController@sendMessage')->name('mypage.send-message');
    });


