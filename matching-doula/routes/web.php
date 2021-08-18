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
Route::get('', 'ItemsController@showItems')->name('top');
Route::get('items/{item}', 'ItemsController@showItemDetail')->name('item');
Route::get('items/{item}/seller', 'ItemsController@showSeller')->name('seller');

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
        Route::get('sold-items', 'SoldItemsController@showSoldItems')->name('mypage.sold-items');

        //出品中商品
        Route::get('listed-items', 'ListedItemsController@showListedItems')->name('mypage.listed-items');
        Route::get('liked-items', 'LikedItemsController@showLikedItems')->name('mypage.liked-items');
     }
);

// リアルタイムチャット(メッセージルーム認証)
Route::prefix('mypage')
     ->namespace('MyPage')
     ->middleware('auth')
     ->middleware('messageroom')
     ->group(function () {
        Route::get('messagesroom/{messageroom}', 'ChatsController@index')->name('mypage.messageroom-index');
        Route::post('messagesroom/{messageroom}/zoom', 'ZoomMakeController@makeZoomMeeting')->name('mypage.make-zoom');
    }
);

// リアルタイムチャット(メッセージ送信認証)
Route::prefix('mypage')
     ->namespace('MyPage')
     ->middleware('auth')
     ->middleware('message')
     ->group(function () {
        Route::get('messagesroom/messages/{messageroom}', 'ChatsController@fetchMessages')->name('mypage.fetch-mssages');
        Route::post('messagesroom/messages/{messageroom}', 'ChatsController@sendMessage')->name('mypage.send-message');
    }
);


