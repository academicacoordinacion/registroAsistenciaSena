<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){

        return view('user.login');
    }
    public function mostrarLogin()
    {
    }
    public function iniciarSesion(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // La autenticación fue exitosa
            return redirect()->route('home.index')->with('success', '¡Sesión Iniciada!'); // Puedes redirigir a donde desees
        } else {
            // La autenticación falló
            return back()->withInput()->withErrors(['error' => 'Correo o contraseña invalido']);
        }
    }
    public function verificarLogin()
    {

        if (auth()->check()) {
            return redirect('home');
        } else {
            return redirect('login');
        }
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Token Name')->plainTextToken; // Generar el token

            $persona = Persona::find($user->persona_id);

            // Retornar la respuesta JSON incluyendo el token
            return response()->json(['user' => $user, 'persona' => $persona, 'token' => $token], 200);
        }
    return response()->json(['error' => 'Credenciales incorrectas'], 401);
        //  back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }
}
