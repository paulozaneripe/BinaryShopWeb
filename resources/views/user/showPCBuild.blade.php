@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/pcbuildInfo.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

<title>BinaryShop - Computador #{{ $pcbuild->id }}</title>
@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <section class="show">
            <div class="highlight">
                <img src="{{ $pccomponents[6]->image_url }}" alt="Computador #{{ $pcbuild->id }}">
                <div class="title-price">
                    <h2>Computador #{{ $pcbuild->id }}</h2><p>@money( $pcbuild->total_price )</p>
                </div>
            </div>
            <div class="pcbuild-content">
                <div class="pcbuild" id="{{ $pccomponents[0]->id }}">
                    <img src="{{ $pccomponents[0]->image_url }}"  alt="{{ $pccomponents[0]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[0]->name }}</p>
                        <p>@money($pccomponents[0]->price)</p>
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[1]->id }}">
                    <img src="{{ $pccomponents[1]->image_url }}"  alt="{{ $pccomponents[1]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[1]->name }}</p>
                        <p>@money($pccomponents[1]->price)</p>
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[2]->id }}">
                    <img src="{{ $pccomponents[2]->image_url }}"  alt="{{ $pccomponents[2]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[2]->name }}</p>
                        <p>@money($pccomponents[2]->price)</p>
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[3]->id }}">
                    <img src="{{ $pccomponents[3]->image_url }}"  alt="{{ $pccomponents[3]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[3]->name }}</p>
                        @if($pccomponents[3]->quantity > 1)
                            <div class="quantity">
                                <p>{{ $pccomponents[3]->quantity }}x  @money($pccomponents[3]->price)</p>
                            </div>
                        @endif
                        <p>@money($pccomponents[3]->total_price)</p> 
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[4]->id }}">
                    <img src="{{ $pccomponents[4]->image_url }}"  alt="{{ $pccomponents[4]->name }}">
                    <div class="pcbuild-info">
                    <p>{{ $pccomponents[4]->name }}</p>
                        @if($pccomponents[4]->quantity > 1)
                            <div class="quantity">
                                <p>{{ $pccomponents[4]->quantity }}x  @money($pccomponents[4]->price)</p>
                            </div>
                        @endif
                        <p>@money($pccomponents[4]->total_price)</p> 
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[5]->id }}">
                    <img src="{{ $pccomponents[5]->image_url }}"  alt="{{ $pccomponents[5]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[5]->name }}</p>
                        <p>@money($pccomponents[5]->price)</p>
                    </div>
                </div>
                <div class="pcbuild" id="{{ $pccomponents[6]->id }}">
                    <img src="{{ $pccomponents[6]->image_url }}"  alt="{{ $pccomponents[6]->name }}">
                    <div class="pcbuild-info">
                        <p>{{ $pccomponents[6]->name }}</p>
                        <p>@money($pccomponents[6]->price)</p>
                    </div>
                </div>
            </div>
            @if($user->id != $pcbuild->user_id)
                <div class="pcbuild-user">
                    <p><i class="fas fa-user"></i>{{ $pcbuild->user_name }}</p>
                </div>
            @endif
            @if($user->id == $pcbuild->user_id)
                <a href="/pc-builds/{{ $pcbuild->id }}/edit">Editar</a>
            @endif
        </section>
    </div>
</div>
<script src="{{ URL::asset('js/drop-down.js') }}"></script>
<script src="{{ URL::asset('js/remove-msg.js') }}"></script>
<script src="{{ URL::asset('js/mask.js') }}"></script>
<script src="{{ URL::asset('js/cards.js') }}"></script>
@endsection
