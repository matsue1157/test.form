@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

    <div class="rectangle-box"> {{-- 追加：中央配置用のクラス --}}
        <div class="card">
            <div class="card-header">Login</div>

            <div class="rectangle-140">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- メールアドレス -->
                        <div class="group-93"> {{-- グループラッパー --}}
                            <label for="email" class="email-label">メールアドレス</label>
                            <div class="rectangle-141">
                                <input id="email" type="email" name="email"
                                    class="form-control email-input @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- パスワード -->
                        <div class="form-group mt-3">
                            <label for="password">パスワード</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- ログインボタン -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                ログイン
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection