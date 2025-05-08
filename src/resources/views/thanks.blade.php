@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__content">
        <div class="thanks__heading">
            <h2>お問い合わせありがとうございました</h2>
            <div class="form__group">
                <div class="form__group-content">
                    <a href="{{ url('/') }}" class="btn btn-home">HOME</a>
                </div>
            </div>
@endsection