<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // CRUCIAL para la autenticación
use App\Models\User; // Importamos el modelo User

class LoginController extends Controller
{
    /**
     * Propiedad que indica a dónde redirigir después de un login exitoso.
     */
    protected $redirectTo = '/dashboard'; 
    
    /**
     * Muestra el formulario de inicio de sesión (GET /login).
     */
    public function showLoginForm()
    {
        // Carga la vista 'login_page.blade.php' (la vista minimalista)
        return view('login_page'); 
    }

    /**
     * Maneja el proceso de autenticación (POST /login).
     */
    public function authenticate(Request $request)
    {
        // 1. Validar los campos de entrada
        $request->validate([
            'username' => ['required', 'string'], 
            'password' => ['required'],
        ]);

        $loginValue = $request->input('username');
        
        // 2. Determinar si el valor de entrada es un email o un username (Login Flexible)
        $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Crear el array de credenciales
        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->input('password'),
        ];
        
        // 4. Intentar la autenticación
        if (Auth::attempt($credentials)) {
            
            // Si la autenticación es exitosa, regenerar la sesión
            $request->session()->regenerate();

            // Redirigir al dashboard CRUD (usa el valor de $redirectTo o /dashboard)
            return redirect()->intended($this->redirectTo); 
        }

        // 5. Si la autenticación falla, redirigir de vuelta con un error
        return back()->withErrors([
            'username' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('username');
    }

    /**
     * Cierra la sesión del usuario (POST /logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}