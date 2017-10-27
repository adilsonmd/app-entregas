<?php

namespace App\Http\Controllers;

use Validator;
use App\Cliente;
use App\Entregador;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function postLogin(Request $request)
    {
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(auth()->user()->entregador_id == null){
                return redirect()->route('cliente.home');
            }
            return redirect()->route('entregador.home');
        }
        
        return redirect()->back()->withInput();
        //response()->json(['status' => 'FAIL'], 401);
    }
    
    public function getLogout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function postSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:60',
            'email' => 'required|unique:cliente|max:60',
            'password' => 'required|confirmed',
            'radioTipoCadastro' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect('signup')->with(['error' => $validator])->withInput();
        }
        
        // Validação passou =============

        $cliente = new Cliente;
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->password = bcrypt($request->password);
        $cliente->save();

        if($request->radioTipoCadastro == 'entregador') {
            // Cliente temporario para adquirir o ID do usuario
            $temp = Cliente::where('email', $request->email)->first(); // Objeto collection
            $cliente = Cliente::find($temp->id); // Objeto Cliente

            $entregador = new Entregador;
            $entregador->cliente_id = $cliente->id;
            $entregador->save();

            $entregadorTemporario = Entregador::where('cliente_id', $cliente->id)->first();
            // Atualiza com id do entregador
            $cliente->entregador_id = $entregadorTemporario->id;

            $cliente->save();
        }
        
        return redirect('login');
    }
}
