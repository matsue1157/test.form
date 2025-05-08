<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;

// お問い合わせフォーム（入力）
Route::get('/', [ContactController::class, 'index'])->name('contacts.index'); // トップで表示

// 確認・送信・完了
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', fn() => view('thanks'))->name('contacts.thanks');

// 認証関連
Route::get('/login', [ContactController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ContactController::class, 'login']);
Route::post('/logout', [ContactController::class, 'logout'])->name('logout');
Route::get('/register', [ContactController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [ContactController::class, 'register']);

// 管理者関連（認証後、adminミドルウェア使用）
Route::middleware(['auth', 'admin'])->group(function () {
    // 管理者ダッシュボード
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    // こちらが正しい削除ルート
    Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // アイテム管理
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
});

// アイテム関連のルート（adminミドルウェア内で管理）
Route::get('/admin/items', [ItemController::class, 'index'])->name('admin.items.index');