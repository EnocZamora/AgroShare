<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AgroShare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 p-8 space-y-6">
        
        <!-- Encabezado -->
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-extrabold text-emerald-800 tracking-tight">AgroShare</h1>
            <p class="text-sm text-slate-500">Ingresa a tu cuenta para gestionar tus productos</p>
        </div>

        <!-- Mensajes de Estado / Éxito -->
        @if (session('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de Login -->
        <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Correo Electrónico -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2.5 border rounded-xl text-slate-800 border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('email') border-red-500 @enderror"
                    placeholder="ejemplo@correo.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2.5 border rounded-xl text-slate-800 border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordar Sesión -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 mr-2">
                    Recordar sesión
                </label>
            </div>

            <!-- Botón de Ingreso -->
            <button type="submit"
                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlace hacia Registro -->
        <div class="text-center text-sm text-slate-500 pt-2 border-t border-slate-100">
            ¿No tienes una cuenta aún?
            <a href="{{ route('auth.register') }}" class="font-semibold text-emerald-600 hover:underline">Regístrate aquí</a>
        </div>
    </div>
</body>
</html>