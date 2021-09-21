@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/inputs.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Editando produto')

@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <form action="update" method="POST">
            @method('put')
            @csrf
            <h2>Editando produto</h2>
            <div class="input-field">
                <label for="category">Categoria</label>
                <select id="category" name="category_id" required>
                    <option selected disabled value="" hidden>Selecione uma opção</option>
                    @foreach ($categories as $category)
                        <option 
                        value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected":"" }}>
                        {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-field">
                <label for="image_url">Imagem do produto</label>
                <input type="url" id="image_url" name="image_url" placeholder="http://" value="{{ $product->image_url }}">
            </div>
            <div class="input-field">
                <label for="name">Título</label>
                <input type="text" id="name" name="name" placeholder="Digite o título do produto" value="{{ $product->name }}">
            </div>
            <div class="input-field">
                <label for="price">Valor</label>
                <input
                type="text" id="price" class="price" name="price" placeholder="R$"
                value="@money( $product->price )"
                maxlength="16"
                onkeydown="Mask.apply(this, 'formatBRL')"
                >
            </div>
            <div class="input-field">
                <label for="description">Descrição</label>
                <textarea id="description" name="description" placeholder:="Digite uma descrição para o produto...">{{ $product->description }}</textarea>
            </div>
            <button type="submit">Salvar</button>
            <button class="delete" type="submit" form="form-delete">Deletar</button>
        </form>
        <form id="form-delete" action="delete" method="POST">
            @csrf
            @method('delete')
        </form>
    </div>
</div>
<script>
    const formDelete = document.querySelector("#form-delete")
    formDelete.addEventListener("submit", function(event){
        const confirmation = confirm("Deseja deletar?")
        if(!confirmation) {
            event.preventDefault()
        }
    })
</script>
<script src="{{ URL::asset('js/drop-down.js') }}"></script>
<script src="{{ URL::asset('js/remove-msg.js') }}"></script>
<script src="{{ URL::asset('js/mask.js') }}"></script>
@endsection
