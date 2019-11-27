@isset($usuario)
	<h1>Editar usuario</h1>
	<form action="{{route('usuario.update',$usuario->cpf)}}" method="post">
	{{method_field('PUT')}}
@else
	<h1>Adicionar usuario</h1>
	<form action="{{route('usuario.store')}}" method="post">
@endisset
	{{ csrf_field() }}
	<label>Nome*</label>
	<input type="text" name="nome" value="{{old('nome',$usuario->nome ?? '')}}">
	<label>CPF*</label>
	<input type="number" name="cpf" value="{{old('cpf',$usuario->cpf ?? '')}}">
	<label>Endereço*</label>
	<input type="text" name="endereco" value="{{old('endereco',$usuario->endereco ?? '')}}">
	<label>Telefone*</label>
	<input type="number" name="telefone" value="{{old('telefone',$usuario->telefone ?? '')}}">
	@isset($usuario)
		<input type="submit" value="Alterar">
	@else
		<input type="submit" value="Enviar">
	@endIsset
</form>
{{$valor = isset($_SESSION['usuario.nome']) ? 'S' : 'N'}}
<a href="{{route('usuario.index')}}">Lista de Usuários</a><br>
<a href="{{route('usuario.create')}}">Adicionar de Usuário</a><br>
<a href="{{route('produto.index')}}">Lista de Produtos</a><br>
<a href="{{route('produto.create')}}">Adicionar de Produto</a>
