<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login_title') }}</title>
    <!-- CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 p-8 space-y-6">
        
        <!-- Encabezado -->
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-extrabold text-emerald-800 tracking-tight">{{ __('messages.app_name') }}</h1>
            <p class="text-sm text-slate-500">{{ __('messages.login_heading') }}</p>
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
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2.5 border rounded-xl text-slate-800 border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('email') border-red-500 @enderror"
                    placeholder="{{ __('messages.login_email_placeholder') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.login_password_label') }}</label>
                <input type="password" name="password" id="password" required
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

    <!-- Modal de Selección de Idioma (Solo si no hay locale en sesión) -->
    @if(!session()->has('locale'))
    <div id="language-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" role="dialog" aria-modal="true" aria-labelledby="language-modal-title">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm animate-fade-in">
            <div class="p-6 space-y-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h2 id="language-modal-title" class="text-xl font-bold text-gray-900">{{ __('messages.select_language_title') }}</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ __('messages.select_language_subtitle') }}</p>
                </div>

                <div class="space-y-2">
                    <form action="{{ route('lang.switch', 'es') }}" method="GET" class="w-full">
                        <button type="submit" class="w-full flex items-center justify-center gap-3 p-4 bg-white border-2 border-emerald-200 hover:border-emerald-500 rounded-xl transition text-left">
                            <svg class="w-6 h-6 text-emerald-700 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                                <path d="M7 10h6v1H7v-1zm0 3h6v1H7v-1z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-bold text-gray-900">{{ __('messages.products_lang_es') }}</p>
                            </div>
                        </button>
                    </form>

                    <form action="{{ route('lang.switch', 'mi') }}" method="GET" class="w-full">
                        <button type="submit" class="w-full flex items-center justify-center gap-3 p-4 bg-white border-2 border-emerald-200 hover:border-emerald-500 rounded-xl transition text-left">
                            <svg class="w-6 h-6 text-emerald-700 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                                <path d="M7 9h6v2H7V9zm0 3h6v2H7v-2z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-bold text-gray-900">{{ __('messages.products_lang_mi') }}</p>
                            </div>
                        </button>
                    </form>

                    <form action="{{ route('lang.switch', 'cr') }}" method="GET" class="w-full">
                        <button type="submit" class="w-full flex items-center justify-center gap-3 p-4 bg-white border-2 border-emerald-200 hover:border-emerald-500 rounded-xl transition text-left">
                            <svg class="w-6 h-6 text-emerald-700 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                                <path d="M7 8h6v1H7V8zm0 3h6v1H7v-1z"/>
                            </svg>
                            <div class="text-left">
                                <p class="font-bold text-gray-900">{{ __('messages.products_lang_cr') }}</p>
                            </div>
                        </button>
                    </form>
                </div>

                <p class="text-center text-xs text-gray-400">
                    {{ __('messages.select_language_note') }}
                </p>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('language-modal');
            if (modal) {
                modal.style.animation = 'fadeIn 0.3s ease-out';
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</body>
</html>