<!DOCTYPE html>
<html lang="pt-BR">
@include('layouts.header')
<body>

    @include('layouts.nav')
    <div class="container-fluid">

        <div class="container-cadastro">

            <form method="POST" action="cadastro">
                {{ csrf_field() }} <!-- Obrigatorio para segurança -->

                <div class="signup">
                    <h2>Cadastra-se agora</h2>
                    
                    <div class="form-group">
                        <aside>
                            <label for="name" class="form-label">Nome</label>
                        </aside>
                        
                        <div>
                            <input id="name" name="name" class="form-item" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <aside>
                            <label for="email" class="form-label">Email</label>
                        </aside>
                        <div>
                            <input id="email" name="email" class="form-item" type="email">
                        </div>
                    </div>  

                    <div class="form-group">
                        <aside>
                            <label for="password" class="form-label">Senha</label>
                        </aside>
                        <div>
                            <input id="password" name="password" class="form-item" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <aside>
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        </aside>
                        <div>
                            <input id="password_confirmation" name="password_confirmation" class="form-item" type="password">
                        </div>
                    </div>
                
                    <div class="form-group-btn">
                        <button id="btn" class="button button-purple" type="submit">Cadastrar</button>
                    </div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </form>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>