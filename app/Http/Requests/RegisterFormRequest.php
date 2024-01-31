<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * authorize：アクセスに対してフォームリクエストの利用の是非を定義(真偽値)
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * rules：バリデーションルール(連想配列)
     * @return array
     */
    public function rules()
    {
        return [
            //'項目名' => '検証ルール|検証ルール'
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users,mail',
            'password' => 'required|string|alpha_num|confirmed|min:8|max:20',
            'password_confirmation' => 'required|string|alpha_num|min:8|max:20'
        ];
    }

    public function messages()
    {
        return [
            // '項目名.検証ルール' => 'メッセージ'
            'username.required' => 'ユーザー名は必須入力です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以下で入力してください。',

            'mail.required' =>'メールアドレスは必須入力です。',
            'mail.min' => 'メールアドレスは5文字以上で入力してください。',
            'mail.max' => 'メールアドレスは40文字以下で入力してください。',
            'mail.email' => 'メールアドレスの形式で入力してください。',
            'mail.unique' => '登録済みのメールアドレスは使用不可です。',

            'password.required' => 'パスワードは入力必須です。',
            'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
            'password.min' => 'パスワードは８文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以下で入力してください。',
            'password.confirmation' => 'パスワードが一致していません。'
        ];
    }
}
