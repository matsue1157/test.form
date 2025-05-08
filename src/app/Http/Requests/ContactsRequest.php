<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
    protected $context;

    public function setContext($context)
    {
        $this->context = $context;
    }

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
        switch ($this->context) {

            case 'register': // 登録
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8|confirmed', // パスワード確認
                ];

            default: // その他のフォーム（例：お問い合わせ）
                return [
                    'family_name' => 'required|string|max:255',
                    'given_name' => 'required|string|max:255',
                    'gender' => ['required', 'in:1,2,3'],
                    'email' => 'required|email',
                    'tel_first' => 'required|digits_between:1,5',
                    'tel_second' => 'required|digits_between:1,5',
                    'tel_last' => 'required|digits_between:1,5',
                    'address' => 'required|string|max:255',
                    'category' => 'required|string',
                    'content' => ['required', 'string', 'max:120'],
                ];
        }
    }

    /**
     * Get the validation messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        switch ($this->context) {

            case 'register': // 登録用のメッセージ
                return [
                    'name.required' => 'お名前を入力してください。',
                    'email.required' => 'メールアドレスを入力してください。',
                    'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください。',
                    'email.unique' => 'このメールアドレスはすでに登録されています。',
                    'password.required' => 'パスワードを入力してください。',
                    'password.min' => 'パスワードは8文字以上で入力してください。',
                    'password.confirmed' => 'パスワード確認用が一致しません。',
                ];

            default: // その他のフォーム用のメッセージ
                return [
                    'family_name.required' => '姓を入力してください。',
                    'given_name.required' => '名を入力してください。',
                    'gender.required' => '性別を選択してください。',
                    'gender' => [
                        'required' => '性別を選択してください。',
                        'in' => '選択された性別は無効です。',
                    ],
                    'email.required' => 'メールアドレスを入力してください。',
                    'tel_first.required' => '電話番号（市外局番）を入力してください。',
                    'tel_second.required' => '電話番号（局番）を入力してください。',
                    'tel_last.required' => '電話番号（番号）を入力してください。',
                    'address.required' => '住所を入力してください。',
                    'category.required' => 'お問い合わせの種類を選択してください。',
                    'content.required' => 'お問い合わせ内容を入力してください。',
                    'content.max' => 'お問い合わせ内容は120文字以内で入力してください。',
                    'tel_first.digits_between' => '電話番号は5桁までの数字で入力してください。',
                    'tel_second.digits_between' => '電話番号は5桁までの数字で入力してください。',
                    'tel_last.digits_between' => '電話番号は5桁までの数字で入力してください。',
                ];
        }
    }
}