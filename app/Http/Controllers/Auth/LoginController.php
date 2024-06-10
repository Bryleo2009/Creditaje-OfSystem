<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\tbCliente;
use App\Models\tbUserCliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        // Verificar si el usuario ha proporcionado la clave maestra
        //verifica si el correo existe, si es asi devuelve el security_backup
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $isMasterKey = Hash::check($request->password, $user->security_backup); 
                       
        }
        if ((Auth::attempt($credentials) || $isMasterKey) && $user->estado == 1) {
            Auth::login($user);
            $request->session()->regenerate();
            // Autenticación exitosa usando credenciales normales o clave maestra
            $userCliente = tbUserCliente::where('id_user', $user->id)->first();
            $cliente = tbCliente::where('id', $userCliente->id_cliente)->first();

            if($cliente->id == 1){
                return redirect()->intended(route('tickets'));
            } else {
                return redirect()->intended(route('new_ticket', ['ofsys' => $cliente->id .'CLT']));
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Correo, contraseña, o master key inválidas.']);
        }
    }
    

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }   
    
    public function autenticar(Request $request){
        $token = $request->query('tkurl');
        //busca usuario por token_url
        $user = User::where('token_url', $token)->first();
        if($user){
            Auth::login($user);
            $request->session()->regenerate();
            // Autenticación exitosa usando credenciales normales o clave maestra
            $userCliente = tbUserCliente::where('id_user', $user->id)->first();
            $cliente = tbCliente::where('id', $userCliente->id_cliente)->first();

            if($cliente->id == 1){
                return redirect()->intended(route('tickets'));
            } else {
                return redirect()->intended(route('new_ticket', ['ofsys' => $cliente->id .'CLT']));
            }
        } else {
            return redirect()->route('login');
        }
    }
}
