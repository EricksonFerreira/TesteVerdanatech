@isset($produto)
	<h1>Editar produto</h1>
	<form action="{{route('produto.update',$produto->id)}}" method="post">
	{{method_field('PUT')}}
@else
	<h1>Adicionar produto</h1>
	<form action="{{route('produto.store')}}" method="post">
@endisset
	{{ csrf_field() }}
	<label>Nome*</label>
	<input type="text" name="nome" value="{{old('nome',$produto->nome ?? '')}}">
	<label>Preço da compra*</label>
	<input type="number" name="precoCompra" value="{{old('precoCompra',$produto->precoCompra ?? '')}}">
	<label>Data de entrada*</label>
	@php( $dtHoje = date('Y-m-d'))
	<input type="date" name="dataEntrada" value="{{old('dataEntrada',$produto->dataEntrada ?? $dtHoje )}}">
	@isset($produto)
		<input type="submit" value="Alterar">
	@else
		<input type="submit" value="Enviar">
	@endIsset
</form>
<a href="{{route('usuario.index')}}">Lista de Usuários</a><br>
<a href="{{route('usuario.create')}}">Adicionar de Usuário</a><br>
<a href="{{route('produto.index')}}">Lista de Produtos</a>
