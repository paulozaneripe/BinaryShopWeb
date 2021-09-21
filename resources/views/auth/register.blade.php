@extends('layout')

@section('headContent')
<link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Crie sua conta')

@section('content')
    <div class="container">
        <div class="register-panel">
            <form action="register" method="POST" class="register-slide">
                @csrf
                <h2>Crie sua conta</h2>
                <div class="user">
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input tabindex="1" type="text" name="name" placeholder="Nome" value="{{ old('name') }}">
                    </div>
                    <div 
                    tabindex="2" 
                    class="checkbox-field" 
                    onclick="setAdmin()" 
                    onkeydown = "if (event.keyCode == 13) setAdmin()">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input tabindex="3" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input tabindex="4" type="password" name="password" placeholder="Senha">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input tabindex="5" type="password" name="repeatpw" placeholder="Confirme sua senha">
                </div>
                <input type="hidden" id="is_admin" name="is_admin" value="0">
                <button tabindex="6" type="submit" class="login">Cadastrar</button>
                <div class="mobile-login">
                    <p>
                        Já possui uma conta?
                    </p>
                    <a href="/login">Entrar</a>
                </div>
            </form>
            @include('messages')
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
        <div class="right-panel">
            <div class="content">
                <h1>
                    Cadastre-se para desfrutar da 
                    experiência de montar seu próprio computador
                </h1>
                <p>
                    Já possui uma conta?
                </p>
                <a tabindex="7" href="/login">Entrar</a>
            </div>
            <img src="{{ URL::asset('img/binaryicon.svg') }}" alt="binaries">
        </div>
    </div>
    <script src="{{ URL::asset('js/auth.js') }}"></script>
    <script src="{{ URL::asset('js/remove-msg.js') }}"></script>
@endsection
