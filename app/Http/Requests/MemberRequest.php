<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'member' => 'required',
            // 'roomname' => 'required'
        ];
    }

    public function messages(){
      // dd(2);
      return[
        'member.required' => 'メンバーの選択をしてください。',
        // 'roomname.required' => 'トークルーム名の入力をしてください',
      ];
    }

}
