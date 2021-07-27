<?php
namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VuejsController extends Controller
{
    public function showVuejs()
    {
        return view ('mypage.vuejs');
    }
}
