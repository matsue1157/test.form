<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム（入力画面）
    public function index()
    {
        $contact = [];  // 必要に応じて初期化
        $contact = [
            'building_name' => '千駄ヶ谷マンション101'
        ];
        return view('index', compact('contact'));
    }

    // 確認画面の表示
    public function confirm(ContactsRequest $request)
    {
        // バリデーションされたデータをビューに渡す
        return view('confirm', ['contact' => $request->validated()]);
    }

    // データの保存処理（通常はDB保存やメール送信）
    public function store(ContactsRequest $request)
    {
        // お問い合わせ内容をDBに保存（例）
        // Contact::create($request->validated());

        return redirect('/thanks')->with('status', 'お問い合わせを受け付けました');
    }

    // 完了画面の表示
    public function thanks()
    {
        return view('thanks');
    }

    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('login');
    }

    // ログイン処理
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => '認証に失敗しました。',
        ])->withInput();
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // 登録フォームを表示
    public function showRegisterForm()
    {
        return view('register');
    }

    // ユーザー登録処理
    public function register(ContactsRequest $request)
    {
        // 登録用のバリデーションをセット
        $request->setContext('register');

        // バリデーション後のデータを取得
        $validated = $request->validated();

        // ユーザー登録処理（DB保存）
        // User::create($validated);  // 例：ユーザーを保存

        return redirect('/login')->with('status', '登録が完了しました。ログインしてください。');
    }
}