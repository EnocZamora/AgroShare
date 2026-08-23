<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 py-8">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl border border-slate-100 p-8 space-y-6">
        
        <!-- Encabezado con selector de idioma -->
        <div class="flex items-center justify-between">
            <div class="text-center space-y-2 flex-1">
                <h1 class="text-3xl font-extrabold text-emerald-800 tracking-tight">{{ __('messages.app_name') }}</h1>
                <p class="text-sm text-slate-500">{{ __('messages.register_heading') }}</p>
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

        <!-- Formulario de Registro -->
        <form action="{{ route('auth.register.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_name_label') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('messages.register_name_placeholder') }}" autocomplete="name"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('name') border-red-500 @enderror">
                @error('name') 
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_email_label') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="{{ __('messages.register_email_placeholder') }}" autocomplete="email"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('email') border-red-500 @enderror">
                @error('email') 
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Contraseñas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_password_label') }}</label>
                    <input type="password" name="password" id="password" required placeholder="{{ __('messages.register_password_placeholder') }}" autocomplete="new-password"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm @error('password') border-red-500 @enderror">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_password_confirm_label') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="{{ __('messages.register_password_confirm_placeholder') }}" autocomplete="new-password"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>
            </div>
            @error('password') 
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
            @enderror

            <!-- Teléfono e Idioma -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_phone_label') }}</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('messages.register_phone_placeholder') }}" autocomplete="tel"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>
                <div>
                    <label for="preferred_language" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_language_label') }}</label>
                    <select name="preferred_language" id="preferred_language" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                        <option value="es" {{ old('preferred_language') == 'es' ? 'selected' : '' }}>{{ __('messages.register_language_es') }}</option>
                        <option value="miskito" {{ old('preferred_language') == 'miskito' ? 'selected' : '' }}>{{ __('messages.register_language_mi') }}</option>
                        <option value="creole" {{ old('preferred_language') == 'creole' ? 'selected' : '' }}>{{ __('messages.register_language_cr') }}</option>
                    </select>
                </div>
            </div>

            <!-- Departamento y Municipio -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="department" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_department_label') }}</label>
                    <input type="text" name="department" id="department" value="{{ old('department') }}" placeholder="{{ __('messages.register_department_placeholder') }}" autocomplete="address-level1"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>
                <div>
                    <label for="municipality" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.register_municipality_label') }}</label>
                    <input type="text" name="municipality" id="municipality" value="{{ old('municipality') }}" placeholder="{{ __('messages.register_municipality_placeholder') }}" autocomplete="address-level2"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition text-sm">
                </div>
            </div>

            <!-- Botón de Registro -->
            <button type="submit" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-md transition duration-200 mt-2">
                {{ __('messages.register_button') }}
            </button>
        </form>

        <!-- Enlace hacia Login -->
        <div class="text-center text-sm text-slate-500 pt-2 border-t border-slate-100">
            {{ __('messages.register_has_account') }} 
            <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:underline">{{ __('messages.register_login_link') }}</a>
        </div>
    </div>
</body>
</html>