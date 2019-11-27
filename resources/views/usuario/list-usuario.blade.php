@if (!Session()->has('usuario.nome'))
	<h1>existe sessão!</h1>
@endif
@foreach($usuarios as $usuario)
	<ul>
		<li><strong>Nome : </strong>{{$usuario->nome}}</li>
		<li><strong>CPF : </strong>{{$usuario->cpf}}</li>
		<li><strong>Endereço : </strong>{{$usuario->endereco}}</li>
		<li><strong>Telefone : </strong>{{$usuario->telefone}}</li>
		<a href="{{route('usuario.edit', $usuario->cpf)}}">Editar</a><br>
		<form method="POST" action="{{route('usuario.destroy', $usuario->cpf)}}">
			<input type="hidden" name="_method" value="DELETE">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button>Excluir</button>
		</form>
	</ul>
@endforeach
  
<a href="{{route('usuario.index')}}">Lista de Usuários</a><br>
<a href="{{route('usuario.create')}}">Adicionar de Usuário</a><br>
<a href="{{route('produto.index')}}">Lista de Produtos</a><br>
<a href="{{route('produto.create')}}">Adicionar de Produto</a>
