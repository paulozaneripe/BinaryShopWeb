@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/cards.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Produtos')

@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <h2>Nossos produtos</h2>
        <div class="cards">
        @foreach ($products as $product)
            <div class="card" id="{{ $product->id }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <div class="card-info">
                    @foreach ($categories as $category)
                        @if($category->id == $product->category_id)
                        <label>{{ $category->name }}</label>
                        @endif
                    @endforeach
                    <h3>{{ $product->name }}<h3>
                    <p>@money( $product->price )</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/drop-down.js') }}"></script>
<script src="{{ URL::asset('js/cards.js') }}"></script>
<script src="{{ URL::asset('js/remove-msg.js') }}"></script>
@endsection
