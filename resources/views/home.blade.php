<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>
    
    @include('layouts.nav')

    <div class="container">
        
        @if (Auth::check())
            <h2>Pedidos feitos</h2>
            
            @if(isset($pedidos))
            <ul class="lista-pedidos">
                @foreach($pedidos as $pedido)
                    <li class="item-pedido">{{ $pedido->item }}</li>
                @endforeach
            </ul>
            
            @else
            <p class="no-pedidos">Você não fez nenhum pedido</p>
            <a class="btn" href="#">Criar Agora</a>
            @endif

        @else
            <h2>Home App Entrega</h2>
            <hr/>
            
            <a href="#">Login</a>
            <a href="#">Cadastre-se</a>

            <p class="content">{{ $content }}</p>
        @endif
    </div>
    @include('layouts.footer')
</body>
</html>