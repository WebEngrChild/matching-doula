<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EditItemRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SellRequest;
use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use App\Models\Prefecture;
use Illuminate\Http\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EditItemController extends Controller
{
    public function showEditItemForm(Item $item)
    {
        $prefectures = Prefecture::orderBy('sort_no')->get();
        $categories = PrimaryCategory::orderBy('sort_no')->get();
        $conditions = ItemCondition::orderBy('sort_no')->get();

        return view('mypage.edit_form')
        ->with('item', $item)
        ->with('categories', $categories)
        ->with('conditions', $conditions)
        ->with('prefectures', $prefectures);
    }

    public function EditItem(EditItemRequest $request, Item $item)
    {
        $user = Auth::user();

        if($request->file('item-image')) {
            $imageName = $this->saveImage($request->file('item-image'));
        } else {
            $imageName = $item->image_file_name;
        }

        $item->image_file_name       = $imageName;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        $item->prefecture_id        = $request->input('prefecture');
        $item->zoom                   = $request->input('zoom');
        $item->save();

        return redirect()->back()
            ->with('status', '商品情報を変更しました');
    }

         /**
      * 商品画像をリサイズして保存します
      *
      * @param UploadedFile $file アップロードされた商品画像
      * @return string ファイル名
      */
      private function saveImage(UploadedFile $file): string
      {
          $tempPath = $this->makeTempPath();

          Image::make($file)->fit(300, 300)->save($tempPath);

          $filePath = Storage::disk('s3')
              ->putFile('item-images', new File($tempPath));

          return basename($filePath);
      }

      /**
       * 一時的なファイルを生成してパスを返します。
       *
       * @return string ファイルパス
       */
      private function makeTempPath(): string
      {
          $tmp_fp = tmpfile();
          $meta   = stream_get_meta_data($tmp_fp);
          return $meta["uri"];
      }
}
