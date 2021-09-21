@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/inputs.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Criando produto')

@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <form action="product" method="POST">
            @csrf
            <h2>Criando produto</h2>
            <div class="input-field">
                <label for="category">Categoria</label>
                <select id="category" name="category_id" required>
                    <option selected disabled value="" hidden>Selecione uma opção</option>
                    @foreach ($categories as $category)
                        <option 
                        value="{{ $category->id }}" {{ (old('category_id') == $category->id ? "selected":"") }}>
                        {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-field">
                <label for="image_url">Imagem do produto</label>
                <input type="url" id="image_url" name="image_url" placeholder="http://" value="{{ old('image_url') }}">
            </div>
            <div class="input-field">
                <label for="name">Título</label>
                <input type="text" id="name" name="name" placeholder="Digite o título do produto" value="{{ old('name') }}">
            </div>
            <div class="input-field">
                <label for="price">Valor</label>
                <input
                type="text" id="price" class="price" name="price" placeholder="R$"
                value="{{ old('price') }}"
                maxlength="16"
                onkeydown="Mask.apply(this, 'formatBRL')"
                >
            </div>
            <div class="input-field">
                <label for="description">Descrição</label>
                <textarea id="description" name="description" placeholder:="Digite uma descrição para o produto...">{{ old('description') }}</textarea>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </div>
</div>
<script src="{{ URL::asset('js/drop-down.js') }}"></script>
<script src="{{ URL::asset('js/remove-msg.js') }}"></script>
<script src="{{ URL::asset('js/mask.js') }}"></script>
@endsection
