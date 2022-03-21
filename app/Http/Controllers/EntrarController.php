<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class EntrarController extends Controller
{
    public function index(){
        return view('entrar.index');
    }

    public function entrar(Request $request){

        if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()
                ->back()
                ->withErrors("Erro ao se autenticar.");
        };

        return redirect()->route('listar_series');

    }
}
