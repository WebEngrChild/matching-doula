<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
     public function showProfileEditForm()
     {
        $user =  Auth::user();

         return view('mypage.profile_edit_form')
             ->with([
                 'user' => $user,
             ]);
     }

     public function editProfile(EditRequest $request)
     {
         $user = Auth::user();

         $user->name = $request->input('name');
         $user->activities = $request->input('activities');
         $user->messages = $request->input('messages');

         if ($request->has('avatar')) {
            $fileName = $this->saveAvatar($request->file('avatar'));
            $user->avatar_file_name = $fileName;
         }

         if ($request->has('activity_image1')) {
            $fileName = $this->saveActivityImage($request->file('activity_image1'));
            $user->activity_image_file_name_1 = $fileName;
         }

         if ($request->has('activity_image2')) {
            $fileName = $this->saveActivityImage($request->file('activity_image2'));
            $user->activity_image_file_name_2 = $fileName;
         }

         if ($request->has('activity_image3')) {
            $fileName = $this->saveActivityImage($request->file('activity_image3'));
            $user->activity_image_file_name_3 = $fileName;
         }

        $user->save();

         return redirect()->back()
             ->with('status', 'プロフィールを変更しました。');
     }

     /**
      * アバター画像をリサイズして保存します
      *
      * @param UploadedFile $file アップロードされたアバター画像
      * @return string ファイル名
      */
      private function saveAvatar(UploadedFile $file): string
      {
          $tempPath = $this->makeTempPath();

          Image::make($file)->fit(200, 200)->save($tempPath);

          $filePath = Storage::disk('s3')
              ->putFile('avatars', new File($tempPath));

          return basename($filePath);
      }

      private function saveActivityImage(UploadedFile $file): string
      {
          $tempPath = $this->makeTempPath();

          Image::make($file)->fit(200, 200)->save($tempPath);

          $filePath = Storage::disk('s3')
              ->putFile('activity_images', new File($tempPath));

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
