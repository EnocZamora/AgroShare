<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 p-8 space-y-6">
        
        <!-- Encabezado con selector de idioma -->
        <div class="flex items-center justify-between">
            <div class="text-center space-y-2 flex-1">
                <h1 class="text-3xl font-extrabold text-emerald-800 tracking-tight">{{ __('messages.app_name') }}</h1>
                <p class="text-sm text-slate-500">{{ __('messages.login_heading') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <form action="{{ route('lang.switch', 'es') }}" method="GET" class="inline">
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale', 'es') === 'es' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                        ES
                    </button>
                </form>
                <form action="{{ route('lang.switch', 'mi') }}" method="GET" class="inline">
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale') === 'mi' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                        MI
                    </button>
                </form>
                <form action="{{ route('lang.switch', 'cr') }}" method="GET" class="inline">
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg border {{ session('locale') === 'cr' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-white border-gray-200 text-gray-600 hover:border-emerald-300' }} transition">
                        CR
                    </button>
                </form>
            </div>
        </div>

        <!-- Mensajes de Estado / Éxito -->
        @if (session('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de Login -->
        <form action="{{ route('auth.login.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Correo Electrónico -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.login_email_label') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                    class="w-full px-4 py-2.5 border rounded-xl text-slate-800 border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('email') border-red-500 @enderror"
                    placeholder="{{ __('messages.login_email_placeholder') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.login_password_label') }}</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="w-full px-4 py-2.5 border rounded-xl text-slate-800 border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('password') border-red-500 @enderror"
                    placeholder="{{ __('messages.login_password_placeholder') }}">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordar Sesión -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 mr-2">
                    {{ __('messages.login_remember') }}
                </label>
            </div>

            <!-- Botón de Ingreso -->
            <button type="submit"
                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                {{ __('messages.login_button') }}
            </button>
        </form>

        <!-- Enlace hacia Registro -->
        <div class="text-center text-sm text-slate-500 pt-2 border-t border-slate-100">
            {{ __('messages.login_no_account') }}
            <a href="{{ route('auth.register') }}" class="font-semibold text-emerald-600 hover:underline">{{ __('messages.login_register_link') }}</a>
        </div>
    </div>
</body>
</html>