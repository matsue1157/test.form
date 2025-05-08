@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>

        <form class="form" action="{{ route('contacts.store') }}" method="post">
            @csrf
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <!-- お名前 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            {{ $contact['family_name'] }} {{ $contact['given_name'] }}
                            <input type="hidden" name="family_name" value="{{ $contact['family_name'] }}">
                            <input type="hidden" name="given_name" value="{{ $contact['given_name'] }}">
                        </td>
                    </tr>
                    <!-- 性別 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly />
                        </td>
                    </tr>
                    <!-- メール -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
                        </td>
                    </tr>
                    <!-- 電話番号 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            {{ $contact['tel_first'] }}-{{ $contact['tel_second'] }}-{{ $contact['tel_last'] }}
                            <input type="hidden" name="tel_first" value="{{ $contact['tel_first'] }}">
                            <input type="hidden" name="tel_second" value="{{ $contact['tel_second'] }}">
                            <input type="hidden" name="tel_last" value="{{ $contact['tel_last'] }}">
                        </td>
                    </tr>
                    <!-- 住所 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                        </td>
                    </tr>
                    <!-- 建物名 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building_name"
                                value="{{ $contact['building_name'] ?? '例: 千駄ヶ谷マンション101' }}" readonly />
                        </td>
                    </tr>
                    <!-- お問い合わせの種類 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            <input type="text" name="category" value="{{ $contact['category'] }}" readonly />
                        </td>
                    </tr>
                    <!-- お問い合わせ内容 -->
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <textarea name="content" readonly>{{ $contact['content'] }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
                <button type="button" onclick="history.back();">修正する</button>
            </div>
        </form>
    </div>
@endsection