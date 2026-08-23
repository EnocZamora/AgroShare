<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.profile_title') }} - AgroShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 py-8">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-100 p-8 space-y-6">
        
        <!-- Encabezado -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h1 class="text-2xl font-extrabold text-emerald-800 tracking-tight">{{ __('messages.profile_title') }}</h1>
                <p class="text-sm text-slate-500">{{ __('messages.profile_subtitle') }}</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-emerald-600 hover:underline">
                ← {{ __('messages.profile_back_catalog') }}
            </a>
        </div>

        @if (session('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Sección de Avatar con Previsualización -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                <div class="relative w-24 h-24 rounded-full overflow-hidden border-2 border-emerald-600 shrink-0 bg-emerald-100 flex items-center justify-center">
                    <!-- Imagen de Previsualización / Existente -->
                    <img id="avatar-preview" 
                         src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : '' }}" 
                         alt="{{ $user->name }}" 
                         class="w-full h-full object-cover {{ $user->profile_photo ? '' : 'hidden' }}">

                    <!-- Iniciales (Si no hay foto) -->
                    <span id="avatar-placeholder" 
                          class="text-3xl font-bold text-emerald-800 {{ $user->profile_photo ? 'hidden' : '' }}">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </span>
                </div>

                <div class="w-full space-y-1">
                    <label for="profile_photo" class="block text-sm font-semibold text-slate-700">{{ __('messages.profile_avatar_label') }}</label>
                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor-pointer">
                    <p class="text-[11px] text-slate-400">{{ __('messages.profile_avatar_help') }}</p>
                    @error('profile_photo')
                        <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Datos Personales -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.profile_name_label') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-500 mb-1">{{ __('messages.profile_email_label') }}</label>
                <input type="email" value="{{ $user->email }}" disabled
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-slate-400 bg-slate-50 text-sm cursor-not-allowed">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.profile_phone_label') }}</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="{{ __('messages.profile_phone_placeholder') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                </div>
                <div>
                    <label for="preferred_language" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.profile_language_label') }}</label>
                    <select name="preferred_language" id="preferred_language" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                        <option value="es" {{ old('preferred_language', $user->preferred_language) == 'es' ? 'selected' : '' }}>{{ __('messages.profile_language_es') }}</option>
                        <option value="miskito" {{ old('preferred_language', $user->preferred_language) == 'miskito' ? 'selected' : '' }}>{{ __('messages.profile_language_mi') }}</option>
                        <option value="creole" {{ old('preferred_language', $user->preferred_language) == 'creole' ? 'selected' : '' }}>{{ __('messages.profile_language_cr') }}</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="department" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.profile_department_label') }}</label>
                    <input type="text" name="department" id="department" value="{{ old('department', $user->department) }}" placeholder="{{ __('messages.profile_department_placeholder') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                </div>
                <div>
                    <label for="municipality" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('messages.profile_municipality_label') }}</label>
                    <input type="text" name="municipality" id="municipality" value="{{ old('municipality', $user->municipality) }}" placeholder="{{ __('messages.profile_municipality_placeholder') }}"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                </div>
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-md transition duration-200">
                {{ __('messages.profile_save_button') }}
            </button>
        </form>
    </div>

    <!-- Script de Previsualización en Tiempo Real -->
    <script>
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('avatar-preview');
                    const placeholder = document.getElementById('avatar-placeholder');
                    
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>