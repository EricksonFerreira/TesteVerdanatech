@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" id="adc-titulo">
                    <h3>Adicionar Produto</h3>
                </div>
                    <form action="#"  id="addForm" method="post">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ csrf_field() }}
                        <label for="nome">Nome*:</label>
                        <input type="text" class="form-control" for="nome" name="nome" id="nomeAdd" placeholder="Digite o nome do produto" required>
                        <label for="preco">Preço da compra*</label>
                        <input type="number" class="form-control" for="preco" name="precoCompra" id="precoAdd"  placeholder="Digite o preço do produto" required>
                        <label for="data">Data de entrada*</label>
                        @php( $dtHoje = date('Y-m-d'))
                        <input type="date"class="form-control" for="data" name="dataEntrada" id="dataAdd" required><br>  
                        <input type="submit" class="form-control btn btn-primary" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="meusProd">
            <div class="list-group">
    <div class="card-header" id='meusProd'>
        <h3>Todos produtos</h3>
    </div>
    @foreach($produtos as $produto)
  <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1"><strong>Nome : </strong>{{$produto->nome}}</h5>
        <small><strong>Data entrada : </strong>{{date("d/m/Y", strtotime($produto->dataEntrada))}}</small>
    </div>
    <p class="mb-1"><strong>Preço da compra : R$ </strong>{{$produto->precoCompra}}</p>
    <!-- <small>Donec id elit non mi porta.</small> -->
    @if(Auth::id() == $produto->user_id)
    <div class="row">
        
        <a href="#" onclick="editar({{$produto->id}});" class="form-control col-md-6 btn btn-success">Editar</a><br>
        <form id="deletarProd" method="POST" class="col-md-6" action="{{route('produto.destroy', $produto->id)}}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" id="delId" name="id" value="{{$produto->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="form-control col-md-12 btn btn-danger" >Excluir</button>
        </form>
    </div>
    @endif
  </div>
    @endforeach
</div>

        </div>
        <!-- <button onclick="recarga()">Recarregar </button> -->
        <div class="col-md-4">
            <div id="editar">
                <div class="card">
                    <div class="card-header">
                        <h3>Editar Produto</h3>
                    </div>
                        <form action="#"  id="updateForm" method="post">
                    {{method_field('PUT')}}

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            {{ csrf_field() }}
                            <label for="nome">Nome*:</label>
                            <input type="text" id="nomeEdit"  class="form-control" for="nome" name="nome" value="">
                            <label for="preco">Preço da compra*</label>
                            <input type="number" id="precoEdit"  class="form-control" for="preco" name="precoCompra" value="">
                            <label for="data">Datas de entrega*</label>
                            @php( $dtHoje = date('Y-m-d'))
                            <input type="date" id="dataEdit"  class="form-control" for="data"name="dataEntrada" value=""><br>   
                            <input type="hidden" id="idEdit" value="">
                            <input type="submit" value="Alterar"  class="form-control btn btn-info" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
recarga();
$('#editar').hide();
$(document).ready(function(){
    recarga();
    updateForm();
    addForm();
    getProdutos();
});

function updateForm(){
    $('#updateForm').submit(function(e) {
        e.preventDefault();
        const id = $('#idEdit').val();
        // console.log(id);
        const nome = $('#nomeEdit').val();
        const precoCompra = $('#precoEdit').val();
        const dataEntrada = $('#dataEdit').val();
        $.ajax({
            url: 'http://localhost:8000/produto/'+id, // caminho para o script que vai processar os dados
            type: 'PUT',
            data: {"nome": nome, "precoCompra": precoCompra, "dataEntrada": dataEntrada, "_token": "{{ csrf_token() }}"},
            success: function(response) {
                $('#resp').html(response);
                $('#editar').hide();
                recarga();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                console.log(status)
            }
        });
        return false;
    });
};

function addForm(){
    $('#addForm').submit(function(e) {
        e.preventDefault();
        const url = "{{route('produto.store')}}";
        // console.log(id);
        const nome = $('#nomeAdd').val();
        const precoCompra = $('#precoAdd').val();
        const dataEntrada = $('#dataAdd').val();
        $.ajax({
            url: url, // caminho para o script que vai processar os dados
            type: 'POST',
            data: {"nome": nome, "precoCompra": precoCompra, "dataEntrada": dataEntrada, "_token": "{{ csrf_token() }}"},
            success: function(response) {
                $('#nomeAdd').val('');
                $('#precoAdd').val('');
                $('#dataAdd').val('');
                recarga();
                // $('#editar').hide();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                console.log(status)
            }
        });
        return false;
        recarga();
    });
};

function editar(id){
    getProduto(id);
};

function getProduto(id){
    $.ajax({
        url: 'http://localhost:8000/produtar/'+id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            // console.log(data);
            $('#nomeEdit').val(data.nome);
            $('#precoEdit').val(data.precoCompra);
            $('#dataEdit').val(data.dataEntrada);
            $('#idEdit').val(data.id);
            $('#editar').show();
            recarga();

            // console.log(data.dataEntrada);
        },
        error: function(data){
            alert('No response from server Produto');
        }
    });
};

function getProdutos(){
    $.ajax({
        url: 'http://localhost:8000/produto/',
        type: 'GET',
        dataType: 'JSON',
        success: function(data){

            // console.log(data.dataEntrada);
        },
        error: function(data){
            alert('No response from server');
        }
    });
};

function recarga(){
     $.ajax({
        url: 'http://localhost:8000/home/home',
        type: 'GET',
        dataType: 'html',
        success: function(data){
            $('#meusProd').html(data);
             // console.log(data);
        },
        error: function(data){
            alert('No response from server recarga');
        }
    });
};
</script>
@endsection
