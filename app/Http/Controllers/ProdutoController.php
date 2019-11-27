<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Auth;

class ProdutoController extends Controller
{
 	public function index()
    {
        $produtos = Produto::all();
		return response()->json($produtos);    
	}

    public function create()
    {
        return view('produto.cadastro-edit-produto');
    }

    public function store(Request $request)
    {
        $validar = $request->validate([
            'nome'              => 'required',
            'precoCompra'       => 'required|numeric',
            'dataEntrada'       => 'required',
        ],
        [
            'nome.required'             => 'Preencha o seu nome',
            'precoCompra.required'      => 'Digite seu preço da compra',
            'precoCompra.numeric'       => 'Digite apenas numeros no preço',
            'dataEntrada.required'      => 'Digite sua data de entrega',
        ]); 
    /*Adicionando todos esses itens da model*/
        $produto                   	= new Produto;
        $produto->nome             	= $request->nome;
        $produto->precoCompra      	= $request->precoCompra;
        $produto->dataEntrada      	= $request->dataEntrada;
        $produto->user_id      		= Auth::user()->id;
        $produto->save();
    
        return redirect('/home');
    }

    public function show($id)
    {
        return Produto::find($id);
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto/cadastro-edit-produto', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $validar = $request->validate([
            'nome'              => 'required',
            'precoCompra'       => 'required|numeric',
            'dataEntrada'       => 'required',
        ],
        [
            'nome.required'             => 'Preencha o seu nome',
            'precoCompra.required'      => 'Digite seu preço da compra',
            'precoCompra.numeric'       => 'Digite apenas numeros no preço',
            'dataEntrada.required'      => 'Digite sua data de entrega',
        ]); 
        /*Adicionando todos esses itens da model*/
        $produtos                   = Produto::find($id);
        $produtos->nome             = $request->nome;
        $produtos->precoCompra      = $request->precoCompra;
        $produtos->dataEntrada      = $request->dataEntrada;
        $produtos->save();
    	
    	return response()->json($request);
        // return redirect(route('/home'));
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect(route('home'));
    }
    public function produtos(int $id){
    	$dados = Produto::find($id);
    	return response()->json($dados);
    }
}
