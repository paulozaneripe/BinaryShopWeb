@extends('layout')

@section('headContent')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/inputs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/build.css') }}">
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
@endsection

@section('title','BinaryShop - Editando montagem')

@section('content')
@include('messages')
@include('user/structures/header')
<div class="container">
    <div class="content">
        <form action="update" id="build" method="POST" novalidate>
            @method('put')
            @csrf
            <h2>Editando montagem</h2>
            <div class="input-content">
                <img id="motherboard-image" 
                src="{{ $pccomponents[0]->image_url }}" 
                alt="Placa mãe">
                <div class="input-field">
                    <label for="motherboard">Placa mãe</label>
                    <select 
                    id="motherboard" 
                    name="motherboard" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        <option selected disabled value="" hidden>
                            Selecione uma placa mãe
                        </option>
                        @foreach ($categories[0] as $motherboard)
                            <option 
                            data-price="{{ $motherboard->price }}" 
                            data-image="{{ $motherboard->image_url }}"
                            data-type="motherboard"
                            value="{{ $motherboard->name }}"
                            @if($motherboard->name == $pccomponents[0]->name)
                                selected
                            @endif
                            >
                                {{ $motherboard->name }}
                            </option>
                        @endforeach
                    </select>
                    <input 
                    type="text" id="motherboard-price" class="price" 
                    placeholder="R$" value="@money($pccomponents[0]->price)" readonly
                    >
                    <p>
                        Verifique se sua placa mãe é compatível 
                        com o processador selecionado.
                    </p>
                </div>
            </div>
            <div class="input-content">
                <img id="cpu-image" 
                src="{{ $pccomponents[1]->image_url }}"  
                alt="Processador">
                <div class="input-field">
                    <label for="cpu">Processador</label>
                    <select 
                    id="cpu" 
                    name="cpu" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        <option selected disabled value="" hidden>
                            Selecione um processador
                        </option>
                        @foreach ($categories[1] as $cpu)
                            <option 
                            data-price="{{ $cpu->price }}" 
                            data-image="{{ $cpu->image_url }}" 
                            data-type="cpu"
                            value="{{ $cpu->name }}"
                            @if($cpu->name == $pccomponents[1]->name)
                                selected
                            @endif
                            >
                                {{ $cpu->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" id="cpu-price" class="price" 
                    placeholder="R$" value="@money($pccomponents[1]->price)" readonly
                    >
                </div>
            </div>
            <div class="input-content">
                <img id="gpu-image" 
                src="{{ $pccomponents[2]->image_url }}"  
                alt="Placa de vídeo">
                <div class="input-field">
                    <label for="gpu">Placa de vídeo</label>
                    <select 
                    id="gpu" 
                    name="gpu" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        <option selected disabled value="" hidden>
                            Selecione uma placa de vídeo
                        </option>
                        @foreach ($categories[2] as $gpu)
                            <option 
                            data-price="{{ $gpu->price }}" 
                            data-image="{{ $gpu->image_url }}" 
                            data-type="gpu"
                            value="{{ $gpu->name }}"
                            @if($gpu->name == $pccomponents[2]->name)
                                selected
                            @endif
                            >
                                {{ $gpu->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" id="gpu-price" class="price" 
                    placeholder="R$" value="@money($pccomponents[2]->price)" readonly
                    >
                </div>
            </div>
            <div class="input-content">
                <img id="ram-image" 
                src="{{ $pccomponents[3]->image_url }}"   
                alt="Memória RAM">
                <div class="input-field">
                    <label for="ram">Memória RAM</label>
                    <select 
                    id="ram" 
                    name="ram" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        <option selected disabled value="" hidden>
                            Selecione uma memória
                        </option>
                        @foreach ($categories[3] as $ram)
                            <option 
                            data-price="{{ $ram->price }}" 
                            data-image="{{ $ram->image_url }}" 
                            data-type="ram" 
                            value="{{ $ram->name }}"
                            @if($ram->name == $pccomponents[3]->name)
                                selected
                            @endif
                            >
                                {{ $ram->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-info">
                        <input type="text" id="ram-price" class="price" 
                        placeholder="R$" value="@money($pccomponents[3]->total_price)" readonly>
                        <input 
                        type="number" 
                        id="ram-quantity" 
                        name="ramQty" 
                        min="1" 
                        max="4" 
                        placeholder="Qtd" 
                        onchange="updatePrices(this)" 
                        value="{{ $pccomponents[3]->quantity }}"
                        >
                        <label>unidade(s)</label>
                    </div>
                </div>
            </div>
            <div class="input-content">
                <img id="storage-image" 
                src="{{ $pccomponents[4]->image_url }}"  
                alt="Armazenamento">
                <div class="input-field">
                    <label for="storage">Armazenamento</label>
                    <select 
                    id="storage" 
                    name="storage" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        <option selected disabled value="" hidden>
                            Selecione uma opção de armazenamento
                        </option>
                        @foreach ($categories[4] as $storage)
                            <option 
                            data-price="{{ $storage->price }}" 
                            data-image="{{ $storage->image_url }}" 
                            data-type="storage"
                            value="{{ $storage->name }}"
                            @if($storage->name == $pccomponents[4]->name)
                                selected
                            @endif
                            >
                                {{ $storage->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-info">
                        <input type="text" id="storage-price" class="price" 
                        placeholder="R$" value="@money($pccomponents[4]->total_price)" readonly>
                        <input 
                        type="number" 
                        id="storage-quantity" 
                        name="storageQty" 
                        min="1" 
                        max="4" 
                        placeholder="Qtd" 
                        onchange="updatePrices(this)" 
                        value="{{ $pccomponents[4]->quantity }}"
                        >
                        <label>unidade(s)</label>
                    </div>
                </div>
            </div>
            <div class="input-content">
                <img id="powersuply-image" 
                src="{{ $pccomponents[5]->image_url }}"   
                alt="Fonte">
                <div class="input-field">
                    <label for="powersuply">Fonte</label>
                    <select 
                    name="powersuply" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        @foreach ($categories[5] as $powersuply)
                            <option 
                            data-price="{{ $powersuply->price }}" 
                            data-image="{{ $powersuply->image_url }}" 
                            data-type="powersuply"
                            value="{{ $powersuply->name }}"
                            @if($powersuply->name == $pccomponents[5]->name)
                                selected
                            @endif
                            >
                                {{ $powersuply->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" id="powersuply-price" class="price" 
                    placeholder="R$" value="@money($pccomponents[5]->price)" readonly>
                </div>
            </div>
            <div class="input-content">
                <img id="case-image" 
                src="{{ $pccomponents[6]->image_url }}"   
                alt="Gabinete">
                <div class="input-field">
                    <label for="case">Gabinete</label>
                    <select 
                    name="case" 
                    onchange="updatePrices(this)" 
                    required
                    >
                        @foreach ($categories[6] as $case)
                            <option 
                            data-price="{{ $case->price }}" 
                            data-image="{{ $case->image_url }}" 
                            data-type="case"
                            value="{{ $case->name }}"
                            @if($case->name == $pccomponents[6]->name)
                                selected
                            @endif
                            >
                                {{ $case->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" id="case-price" class="price" 
                    placeholder="R$" value="@money($pccomponents[6]->price)" readonly>
                </div>
            </div>
            <div class="final-bar">

                <button 
                type="submit" 
                class="clean-fields-button" 
                form="form-delete"
                >

                <i class="far fa-trash-alt"></i>Deletar

                </button>

                <div class="final-price-field">
                    <label for="total-price">Preço total</label>
                    <input type="text" name="total_price" id="total-price" class="price" 
                    placeholder="R$" value="@money($pcbuild->total_price)" readonly>
                </div>

            </div>
            <button type="submit" class="login" >Salvar</button>
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
<script src="{{ URL::asset('js/update-prices.js') }}"></script>
@endsection
