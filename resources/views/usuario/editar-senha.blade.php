@extends ('layouts.master')
@section('title', 'Editar Perfil')

@section('css')
    <link rel="stylesheet" href="css/editar.css">
@endsection


@section('content')
<div class="container-fluid">

    <div class="container-cadastro">

    <ul class="lista">
        <li>
            <a class="_barra is-active" href="editar">Editar perfil</a>
        </li>
        <li>
            <a class="_barra" href="editar/senha">Alterar senha</a>
        </li>
        <li>
            <a class="_barra" href="editar/endereco">Editar endereço</a>
        </li>
    </ul>

    <form method="POST" action="cadastro" >

        <div class="form-group">
            <aside>
                <label for="password" class="form-label">Senha</label>
            </aside>
            <div class="form-item">
                <input id="password" name="password" class="form-item" type="password">
            </div>
        </div>

        <div class="form-group">
            <aside>
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            </aside>
            <div class="form-item">
                <input id="password_confirmation" name="password_confirmation" class="form-item" type="password">
            </div>
        </div> 

        <div class="form-group-btn">
            <button id="btn-cadastro" class="button button-purple" type="submit">Cadastrar</button>
        </div>

    </form>
    </div>
</div>
@endsection