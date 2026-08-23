<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Procesa la autenticación del usuario.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => __('messages.login_email_required'),
            'email.email' => __('messages.login_email_valid'),
            'password.required' => __('messages.login_password_required'),
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectByRole()
                ->with('success', __('messages.login_success', ['name' => Auth::user()->name]));
        }

        return back()->withErrors([
            'email' => __('messages.login_invalid_credentials'),
        ])->onlyInput('email');
    }

    /**
     * Redirige según el rol del usuario autenticado.
     */
    private function redirectByRole()
    {
        $user = Auth::user();
        $role = $user->rol_sistema ?? 'USUARIO';

        return match ($role) {
            'ADMINISTRADOR' => redirect()->route('admin.index'),
            'AUDITOR' => redirect()->route('auditor.index'),
            default => redirect()->route('products.index'),
        };
    }

    /**
     * Muestra el formulario de registro.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario en Agroshare.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'preferred_language' => 'nullable|string|max:10',
        ], [
            'name.required' => __('messages.register_name_required'),
            'email.required' => __('messages.register_email_required'),
            'email.unique' => __('messages.register_email_unique'),
            'password.required' => __('messages.register_password_required'),
            'password.min' => __('messages.register_password_min'),
            'password.confirmed' => __('messages.register_password_confirmed'),
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['rol_sistema'] = 'USUARIO';

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('products.index')
            ->with('success', __('messages.register_success', ['name' => $user->name]));
    }

    /**
     * Cierra la sesión activa del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}