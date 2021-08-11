<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListedItemsController extends Controller
{
    public function showListedItems()
    {
        $user = Auth::user();
        $items = $user->soldItems()
            ->where('state', 'selling')
            ->with('secondaryCategory.primaryCategory')
            ->orderBy('id', 'DESC')
            ->get();

            return view('mypage.listed_items')
                    ->with('items', $items);
    }
}

