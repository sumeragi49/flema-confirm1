<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name' => ['required'],
            'content' => ['required', 'max:255'],
            'image' => ['required', 'mimes:jpeg,png'],
            'categories' => ['required'],
            'condition_id' => ['required'],
            'content' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'content.required' => '商品に関して詳細を入力してください',
            'content.max:255' => '255文字以内で入力してください',
            'image.required' => '画像をアップロードしてください',
            'image.mimes:jpeg,png' => 'jpeg,png形式で入力してください',
            'condition_id.required' => '商品の状態を選択してください',
            'categories.required' => 'カテゴリーを選択してください',
            'content.required' => '商品の説明を入力してください',
            'content.max:255' => '商品の説明は255文字以内で入力してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '数値を入力してください',
            'price.min:0' => '0以上の数値を入力してください',
        ];
    }
}
