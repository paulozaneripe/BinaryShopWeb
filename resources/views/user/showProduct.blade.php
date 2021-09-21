@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/show.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

<title>BinaryShop - {{ $product->name }}</title>
@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <section class="show">
            <div class="highlight">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <div class="title-price">
                    <h2>{{ $product->name }}</h2><p>@money( $product->price )</p>
                </div>
            </div>
            <label>Descrição:</label>
            <p style="white-space: pre-line; text-align: left;">{{ $product->description }}</p>
            <label>Categoria:</label>
            <p>{{ $category->name }}</p>
            @if($user->is_admin == 1)
                <a href="/products/{{ $product->id }}/edit">Editar</a>
            @endif
        </section>
    </div>
</div>
<script src="{{ URL::asset('js/drop-down.js') }}"></script>
<script src="{{ URL::asset('js/remove-msg.js') }}"></script>
<script src="{{ URL::asset('js/mask.js') }}"></script>
@endsection
