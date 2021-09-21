@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Login')

@section('content')
    <div class="container">
        <div class="left-panel">
            <div class="content">
                <h1>
                    Faça seu login e descubra como
                    montar seu novo computador
                </h1>
                <p>
                    Ainda não possui uma conta?
                </p>
                <a href="/register">Cadastre-se</a>
            </div>
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
        <div class="login-panel">
            <form action="login" method="POST" class="login-slide">
                @csrf
                <h2>Login</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input tabindex="1" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input tabindex="2" type="password" name="password" placeholder="Senha">
                </div>
                <a tabindex="3" href="/forgot-password">Esqueceu sua senha?</a>
                <button tabindex="4" type="submit" class="login">Iniciar sessão</button>
                <div class="mobile-register">
                    <p>
                        Ainda não possui uma conta?
                    </p>
                    <a tabindex="5" href="/register">Cadastre-se</a>
                </div>
            </form>
            @include('messages')
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
    </div>
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <script src="{{ URL::asset('js/remove-msg.js') }}"></script>
@endsection
