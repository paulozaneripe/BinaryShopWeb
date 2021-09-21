@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/forgotPassword.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/resetPassword.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Resetar senha')

@section('content')
    <div class="container">
        <div class="forgot-password-panel">
            <form action="/reset-password-success" method="POST" class="login-slide">
                @csrf
                <h2>Resetar senha</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="E-mail" value="{{ $email }}" readonly>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Nova senha">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="repeatpw" placeholder="Confirme sua senha">
                </div>
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit" class="login">Resetar</button>
            </form>
            @include('messages')
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
    </div>
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <script src="{{ URL::asset('js/remove-msg.js') }}"></script>
@endsection
