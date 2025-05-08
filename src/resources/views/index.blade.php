@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="contact-form-wrapper">
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>

            <form class="form" action="{{ url('contacts/confirm') }}" method="post">
                @csrf

                <!-- 名前 -->
                <div class="form__group name-group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content form__name-split">
                        <div class="form__input--text">
                            <input type="text" name="family_name" placeholder="例: 山田" value="{{ old('family_name') }}">
                        </div>
                        <div class="form__input--text">
                            <input type="text" name="given_name" placeholder="例: 太郎" value="{{ old('given_name') }}">
                        </div>
                    </div>
                    <div class="form__error">
                        @error('family_name') <div>{{ $message }}</div> @enderror
                        @error('given_name') <div>{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- 性別 -->
                <div class="form__group gender-group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__radio-group">
                            <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性</label>
                            <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性</label>
                            <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他</label>
                        </div>
                        <div class="form__error">
                            @error('gender') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- メールアドレス -->
                <div class="form__group email-group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                        </div>
                        <div class="form__error">
                            @error('email') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- 電話番号 -->
                <div class="form__group tel-group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text tel-flex">
                            <input type="tel" name="tel_first" placeholder="090" value="{{ old('tel_first') }}"
                                maxlength="4">
                            <span>-</span>
                            <input type="tel" name="tel_second" placeholder="1234" value="{{ old('tel_second') }}"
                                maxlength="4">
                            <span>-</span>
                            <input type="tel" name="tel_last" placeholder="5678" value="{{ old('tel_last') }}"
                                maxlength="4">
                        </div>
                        <div class="form__error">
                            @error('tel_first') <div>{{ $message }}</div> @enderror
                            @error('tel_second') <div>{{ $message }}</div> @enderror
                            @error('tel_last') <div>{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- 住所 -->
                <div class="form__group address-group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                        </div>
                        <div class="form__error">
                            @error('address') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- 建物名 -->
                <div class="form__group building-name-group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text confirm-table__text">
                            {{ $contact['building_name'] !== null && $contact['building_name'] !== '' ? $contact['building_name'] : '例: 千駄ヶ谷マンション101' }}
                            <input type="hidden" name="building_name" value="{{ $contact['building_name'] ?? '' }}">
                        </div>
                        <div class="form__error">
                            @error('building_name') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- お問い合わせの種類 -->
                <div class="form__group category-group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問合せの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__select">
                            <select name="category">
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>選択してください</option>
                                <option value="資料請求" {{ old('category') == '資料請求' ? 'selected' : '' }}>資料請求</option>
                                <option value="ご相談" {{ old('category') == 'ご相談' ? 'selected' : '' }}>ご相談</option>
                                <option value="その他" {{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                        <div class="form__error">
                            @error('category') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- お問い合わせ内容 -->
                <div class="form__group content-group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="content" placeholder="お問合せ内容をご記載ください">{{ old('content') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('content') {{ $message }} @enderror
                        </div>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </div>
@endsection