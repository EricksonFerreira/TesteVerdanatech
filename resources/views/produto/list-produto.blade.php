<!-- <div class="card">
    <div class="card-header" id='meusProd'>
    	<h3>Todos produtos</h3>
    </div>
    <hr>
    @foreach($produtos as $produto)
    <hr>	
        <ul>
            <li class="nomeLista"><strong>Nome : </strong>{{$produto->nome}}</li>
            <li><strong>Preço da compra : </strong>{{$produto->precoCompra}}</li>
            <li><strong>Data entrada : </strong>{{date("d/m/Y", strtotime($produto->dataEntrada))}}</li>
            @if(Auth::id() == $produto->user_id)
	            <a href="#" onclick="editar({{$produto->id}});">Editar</a><br>
	            <form id="deletarProd" method="POST" action="{{route('produto.destroy', $produto->id)}}">
	                <input type="hidden" name="_method" value="DELETE">
					<input type="hidden" id="delId" name="id" value="{{$produto->id}}">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <button>Excluir</button>
	            </form>
            @endif
        </ul>
        <hr>	
    @endforeach
</div>
 -->


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
