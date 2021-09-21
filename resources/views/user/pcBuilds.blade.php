@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/cards.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Computadores montados')

@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <h2>Minhas montagens</h2>
        <div class="cards">
            @foreach ($pcbuilds as $pcbuild)
                <div class="card" id="{{ $pcbuild->id }}">
                    <img src="{{ $pcbuild->case_url }}" alt="">
                    <div class="card-info">
                        <label>{{ $user->name }}</label>
                        <h3>Computador #{{ $pcbuild->id }}<h3>
                        <p>@money( $pcbuild->total_price )</p>
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