<?php

namespace App\View\Components;

use App\Models\PrimaryCategory; //カテゴリ選択肢追加
use Illuminate\Support\Facades\Request; //フォーム保持追加
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
        $user = Auth::user();

        //カテゴリー追加
        $categories = PrimaryCategory::query()
        ->with([
            'secondaryCategories' => function ($query) {
                $query->orderBy('sort_no');
            }
        ])

        //検証用
        // ->with('secondaryCategories')
        ->orderBy('sort_no')
        ->get();

        //フォーム保持追加
        $defaults = [
            'category' => Request::input('category', ''),
            'keyword'  => Request::input('keyword', ''),
        ];

        return view('components.header')
            ->with('user', $user)
            ->with('categories', $categories)//カテゴリ選択肢追加
            ->with('defaults', $defaults);
    }
}
