<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth,Hash;

class RegistroController extends Controller
{
    public function create(){
        return view('registro.create');
    }

    public function store(Request $request){

        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        Auth::login($user);
        return redirect()->route('listar_series');

    }
}
