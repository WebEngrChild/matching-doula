<?php

namespace App\View\Components;

use App\Models\PrimaryCategory;
use App\Models\Prefecture;
use App\Models\Municipalitie;
use App\Models\MessageRead;
use App\Models\Item;
use Illuminate\Support\Facades\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        //都道府県
        $prefectures = Prefecture::query()
        ->orderBy('sort_no')
        ->get();

        //カテゴリー追加
        $categories = PrimaryCategory::query()
        ->with([
            'secondaryCategories' => function ($query) {
                $query->orderBy('sort_no');
            }
        ])
        ->orderBy('sort_no')
        ->get();

        //フォーム保持追加
        $defaults = [
            'prefecture'        => Request::input('prefecture', ''),
            'municipalitie'     => Request::input('municipalitie', ''),
            'category' => Request::input('category', ''),
            'keyword'  => Request::input('keyword', ''),
        ];

        //通知機能
            $user = '';
            $seller_reads='';
            $buyer_reads='';
            $seller_readcheck ='';
            $buyer_readcheck ='';

        //通知機能(売り)
        if (Auth::check()) {
            $user = Auth::user();
            $seller_reads = $user->sellerRead->all();
            $buyer_reads = $user->buyerRead->all();

            foreach($seller_reads as $read){
            if($read->read === 0){
                $seller_readcheck = false;
                break;
                }
            }

            foreach($buyer_reads as $read){
            if($read->read === 0){
                $buyer_readcheck = false;
                break;
                }
            }
        }

        return view('components.header')
        ->with('user', $user)
        ->with('prefectures', $prefectures)
        ->with('categories', $categories)
        ->with('defaults', $defaults)
        ->with('seller_readcheck', $seller_readcheck)
        ->with('buyer_readcheck', $buyer_readcheck);
    }
}
