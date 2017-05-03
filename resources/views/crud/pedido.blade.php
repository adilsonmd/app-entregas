@extends ('crud.master')

@section('title', 'pedidos')

@section('css')
    <link rel="stylesheet" href="css/crud.css">
@endsection

@section('content')
<script>

    var deleteId = null;
    var editId = null;

    function clearEditText()
    {
        document.querySelector('#edproduto').value = null;
        document.querySelector('#edDescricao').value = null;
        document.querySelector('#edEstado').value = null;
        document.querySelector('#edCidade').value = null;
        document.querySelector('#edBairro').value = null;
    }

    function getById(id) {
        clearEditText();
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                var dados = JSON.parse(xhttp.responseText);
                document.querySelector('#edProduto').value = dados.produto;
                document.querySelector('#edDescricao').value = dados.descricao;
                document.querySelector('#edEstado').value = dados.estado;
                document.querySelector('#edCidade').value = dados.cidade;
                document.querySelector('#edBairro').value = dados.bairro;
                document.querySelector('#edId').value = id;
                console.log(dados);
            }
            else {
                console.log("Resposta ainda não chegou ou houve um erro");
                console.log(xhttp);
            }
        }
        xhttp.open('get', 'get-pedido/'+id, true);
        xhttp.send();    
    }
    function editById(id)
    {
        var token = document.querySelector("#token_editar").getAttribute('content');
        var xhttp = new XMLHttpRequest();
        
        var data = {
            name : document.querySelector('#edproduto').value,
            email : document.querySelector('#edDescricao').value,
            estado : document.querySelector('#edEstado').value,
            cidade : document.querySelector('#edCidade').value,
            bairro : document.querySelector('#edBairro').value
        }
        xhttp.onload = function(){
            if(xhttp.readyState == 4) {
                console.log("provavelmente editou");
                console.log(xhttp);
            }
        };
        xhttp.open("put", 'edit-pedido/'+id, true);
        xhttp.setRequestHeader("CSRF-TOKEN", token);
        xhttp.send(data);
    }
    function deleteById(id)
    {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function(){
            if(xhttp.readyState == 4) {
                console.log("provavelmente deletou");
                console.log(xhttp);
            }
        };
        xhttp.open("delete", 'delete-pedido/'+id, true);
        xhttp.send(null);
    }
</script>

   <div class="container-fluid" style="background-color: white;">
    <h3>pedidos</h3>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar
    </button>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>produto</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Entregador</th>
            <th></th>
        </tr>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->name }}</td>
            <td>{{ $pedido->email }}</td>
            <td>{{ $pedido->dt_nasc }}</td>
            <td>{{ $pedido->estado }}</td>
            <td>{{ $pedido->cidade }}</td>
            <td>{{ $pedido->bairro }}</td>
            <td></td>
            <td>
                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                <button class="btn btn-success" type="button"
                    data-toggle="modal" data-target="#modalEditar" onclick="editId = {{ $pedido->id }}; 
                    getById(editId);">
                    Editar
                </button>

                <button class="btn btn-danger" type="button"
                data-toggle="modal" data-target="#modalDeletar" onclick="deleteId = {{ $pedido->id}}">
                    Excluir
                </button>
            </td>
        </tr>
        @endforeach

    </table>
    @section('modal-cadastro')
        <form class="form-crud" method="POST" action="create-pedido">
            <input type="hidden" id="token_cadastrar" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" class="form-control" name="produto" placeholder="produto">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="descricao" placeholder="Descrição"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="estado" placeholder="Estado">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cidade" placeholder="Cidade">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="bairro" placeholder="Bairro">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
    @endsection
            
    @section('modal-editar')
        <form class="form-crud" method="POST" action="edit-pedido">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="token_editar" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="edId" name="id">
            <div class="form-group">
                <input type="text" id="edProduto" class="form-control" name="produto" placeholder="produto">
            </div>
            <div class="form-group">
                <textarea id="edDescricao" class="form-control" name="descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <input type="text" id="edEstado" class="form-control" name="estado" placeholder="Estado">
            </div>
            <div class="form-group">
                <input type="text" id="edCidade" class="form-control" name="cidade" placeholder="Cidade">
            </div>
            <div class="form-group">
                <input type="text" id="edBairro" class="form-control" name="bairro" placeholder="Bairro">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="editById(editId)">Editar</button>
            
        </form>
    @endsection

    @section('modal-deletar')
        <h4>Você tem certeza que deseja excluir esse registro?</h4>
        <h5>Essa ação é irreversível</h5>
    @endsection
        
</div> <!--CONTAINER-->

    @section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" async integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @endsection

@endsection