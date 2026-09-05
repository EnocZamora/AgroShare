<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-200 via-emerald-100/60 to-slate-200 min-h-screen flex items-center justify-center p-4 antialiased selection:bg-emerald-600 selection:text-white">
    
    <!-- Tarjeta Principal de Login -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl shadow-emerald-950/15 border border-slate-200/80 p-8 space-y-6">
        
        <!-- Encabezado con selector de idioma (Sin icono) -->
        <div class="flex items-start justify-between gap-4">
            <div class="text-left space-y-1 flex-1">
                <h1 class="text-3xl font-black text-emerald-900 tracking-tight">{{ __('messages.app_name') }}</h1>
                <p class="text-sm text-slate-500 font-normal leading-snug">{{ __('messages.login_heading') }}</p>
            </div>

            <!-- Selector de Idioma -->
            <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl border border-slate-200">
                <form action="{{ route('lang.switch', 'es') }}" method="GET" class="inline">
                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ session('locale', 'es') === 'es' ? 'bg-white text-emerald-800 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                        ES
                    </button>
                </form>
                <form action="{{ route('lang.switch', 'mi') }}" method="GET" class="inline">
                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ session('locale') === 'mi' ? 'bg-white text-emerald-800 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                        MI
                    </button>
                </form>
                <form action="{{ route('lang.switch', 'cr') }}" method="GET" class="inline">
                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ session('locale') === 'cr' ? 'bg-white text-emerald-800 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                        CR
                    </button>
                </form>
            </div>
        </div>

        <!-- Mensajes de Estado / Éxito -->
        @if (session('success'))
            <div class="p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Formulario de Login -->
        <form action="{{ route('auth.login.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Correo Electrónico -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.login_email_label') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                    class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-slate-800 border-slate-200 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm @error('email') border-red-400 bg-red-50/30 @enderror"
                    placeholder="{{ __('messages.login_email_placeholder') }}">
                @error('email')
                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.login_password_label') }}</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-slate-800 border-slate-200 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm @error('password') border-red-400 bg-red-50/30 @enderror"
                    placeholder="{{ __('messages.login_password_placeholder') }}">
                @error('password')
                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recordar Sesión -->
            <div class="flex items-center justify-between text-sm pt-1">
                <label class="flex items-center gap-2.5 text-slate-600 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500/30 cursor-pointer accent-emerald-600">
                    <span class="text-xs font-medium text-slate-600">{{ __('messages.login_remember') }}</span>
                </label>
            </div>

            <!-- Botón de Ingreso -->
            <button type="submit"
                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold text-sm rounded-xl shadow-lg shadow-emerald-600/25 transition-all duration-150 cursor-pointer">
                {{ __('messages.login_button') }}
            </button>
        </form>

        <!-- Enlace hacia Registro -->
        <div class="text-center text-xs text-slate-500 pt-4 border-t border-slate-100">
            {{ __('messages.login_no_account') }}
            <a href="{{ route('auth.register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline ml-1">{{ __('messages.login_register_link') }}</a>
        </div>
    </div>
</body>
</html>