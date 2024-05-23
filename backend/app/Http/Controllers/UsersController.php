<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }

    public function show(Request $request)
    {
        $users = Users::FindOrFail($request->id);
        return response ()->json($users);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|min:8',
            'bloco' => 'required',
        ]);
        $data['password'] = Hash::make($data['password']);

        $users = Users::create($data);
        return response()->json($users, 201);
    }

    public function edit(Request $request, $id)
    {
        $users = Users::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:50',
            'bloco' => 'required|string',
        ]);

        if ($users->update($data)) {
            return response()->json(["message" => "success"], 200);
        }

        return response()->json(["message" => "error"], 500);
    }

    public function delete($id)
    {
        $users = Users::findOrFail($id);
        if($users->delete()){
            return response()->json(['message' => 'Usuario deletado com sucesso']);
        }
        return response()->json(['error' => 'deu pau'],500);

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($token = Auth::attempt($credentials)) {
            return response()->json(['token'=> $token,'message' => 'Login realizado com sucesso'],200);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            return response()->json(['message' => "Logout realizado com sucesso"]);
        } else {
            return response()->json(['message' => "Usuário não autenticado. Impossível fazer logout."], 401);
        }
    }
}
