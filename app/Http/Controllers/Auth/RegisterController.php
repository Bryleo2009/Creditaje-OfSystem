<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\tbCliente;
use App\Models\tbUserCliente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return view('auth.register');
    }

    public function register(Request $request)
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'codigo' => 'required|string|max:10',
            ]);

            $usuario = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'token_url' => md5($request->email),
            ]);

            $cliente = new tbCliente();
            $cliente->nombre = $request->name;
            $cliente->email = $request->email;
            $cliente->codigo = strtoupper($request->codigo);
            $cliente->save();

            $usuarioCliente = new tbUserCliente();
            $usuarioCliente->id_user = $usuario->id;
            $usuarioCliente->id_cliente = $cliente->id;
            $usuarioCliente->save();

            return redirect()->route('login');
    }
        
}
