<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => ['file', 'image'],
            'name' => ['required', 'string', 'max:255'],
            'activities' => ['required', 'string', 'max:2000'],
            'messages' => ['required', 'string', 'max:2000'],
            'activity_image1' =>  ['file', 'image'],
            'activity_image2' =>  ['file', 'image'],
            'activity_image3' =>  ['file', 'image'],
       ];
    }
}
