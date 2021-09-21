<div class="menu">
    <div class="title">
        <h1 onclick="javascript:location.href='/'"></h1>
    </div>
    <div class="links">
        <a href="/build-pc">Monte seu computador</a>
        @if($user)
            @if($user->is_admin == 1)
            <a href="/create-product">Criar produto</a>
            @endif
        @endif
        <a href="/products">Produtos</a>
    </div>
    <div class="loggedUser" onclick="dropDown()">
        <i class="fas fa-user-circle"></i>
        <span>
        @if($user)
            {{ $user->name }}
        @endif
        </span>
        <i class="fas fa-angle-up"></i>
    </div>
    <div class="drop-down">
        <div class="drop-down-options">
            <a href="/">Home<i class="fas fa-home"></i></a>
        </div>
        <div class="drop-down-options">
            <a href="/pc-builds">Montados<i class="fas fa-desktop"></i></a>
        </div>
        <div class="drop-down-options">
            <a href="/logout">Sair<i class="fas fa-door-open"></i></a>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/menu-select.js') }}"></script>