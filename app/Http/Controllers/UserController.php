<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.list-usuario', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.cadastro-edit-usuario');
    }

    public function store(Request $request)
    {
        $validar = $request->validate([
            'nome'          => 'required',
            'cpf'           => 'required|numeric',
            'endereco'      => 'required',
            'telefone'      => 'required|numeric',
        ],
        [
            'nome.required'         => 'Preencha o seu nome',
            'cpf.required'          => 'Digite seu cpf',
            'cpf.numeric'           => 'Seu CPF pode conter apenas números',
            'endereco.required'     => 'Digite seu endereço',
            'telefone.required'     => 'Digite seu telefone',
            'telefone.numeric'      => 'Digite apenas numeros no telefone',     
        ]); 
    /*Adicionando todos esses itens da model*/
        $usuarios                = new Usuario;
        $usuarios->cpf           = $request->cpf;
        $usuarios->nome          = $request->nome;
        $usuarios->endereco      = $request->endereco;
        $usuarios->telefone      = $request->telefone;
        $usuarios->save();
    
        return redirect('/usuario/');

    }
    
    public function show($cpf)
    {
        return Usuario::find($cpf);
    }

    public function edit($cpf)
    {
        $usuario = Usuario::find($cpf);
        return view('usuario/cadastro-edit-usuario', compact('usuario'));
        
    }

    public function update(Request $request, $cpf)
    {
        $validar = $request->validate([
            'nome'          => 'required',
            'cpf'           => 'required|numeric',
            'endereco'      => 'required',
            'telefone'      => 'required|numeric',
        ],
        [
            'nome.required'         => 'Preencha o seu nome',
            'cpf.required'          => 'Digite seu cpf',
            'cpf.numeric'           => 'Seu CPF pode conter apenas números',
            'endereco.required'     => 'Digite seu endereço',
            'telefone.required'     => 'Digite seu telefone',
            'telefone.numeric'      => 'Digite apenas numeros no telefone',     
        ]); 
        /*Adicionando todos esses itens da model*/
        $usuario                = Usuario::find($cpf);
        $usuario->cpf           = $request->cpf;
        $usuario->nome          = $request->nome;
        $usuario->endereco      = $request->endereco;
        $usuario->telefone      = $request->telefone;
        $usuario->save();
    
        return redirect(route('usuario.index'));
    }

    public function destroy($cpf)
    {
        $usuario = Usuario::find($cpf);
        $usuario->delete();
        return redirect('/usuario');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validar = $request->validate([
            'cpf'   => 'required|numeric',
        ],
        [
            'cpf.required'  => 'Digite seu cpf',
            'cpf.numeric'   => 'Seu CPF pode conter apenas números',
        ]); 
        /*Adicionando todos esses itens da model*/
        $usuarios = Usuario::all();
        foreach ($usuarios as $usuario) {
            if ($request->cpf == $usuario->cpf) {
                // $request->session()->put('nome', 'Valor');
                Session::put('usuario.nome', $usuario->nome);
                Session::put('usuario.cpf', $usuario->cpf);
                if(Session::get('usuario.nome') and Session::get('usuario.nome')){
                    return redirect(route('usuario.index'));
                }
            }
        }
        return redirect(route('usuario.login'));
    }
}
