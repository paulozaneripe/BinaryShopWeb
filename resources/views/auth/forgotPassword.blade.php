@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/forgotPassword.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Recuperar senha')

@section('content')
    <div class="container">
        <div class="forgot-password-panel">
            <form action="forgot-password" method="POST" class="register-slide">
                @csrf
                <h2>Recuperar senha</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Digite seu e-mail">
                </div>
                <button type="submit" class="login">Recuperar</button>
                <a href="/login">Voltar</a>
            </form>
            @include('messages')
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
    </div>
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <script src="{{ URL::asset('js/remove-msg.js') }}"></script>
@endsection
