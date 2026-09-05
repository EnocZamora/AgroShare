<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-200 via-emerald-100/60 to-slate-200 min-h-screen flex items-center justify-center p-4 py-10 antialiased selection:bg-emerald-600 selection:text-white">
    
    <!-- Tarjeta Principal de Registro -->
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-2xl shadow-emerald-950/15 border border-slate-200/80 p-8 space-y-6">
        
        <!-- Encabezado con selector de idioma (Sin icono) -->
        <div class="flex items-start justify-between gap-4">
            <div class="text-left space-y-1 flex-1">
                <h1 class="text-3xl font-black text-emerald-900 tracking-tight">{{ __('messages.app_name') }}</h1>
                <p class="text-sm text-slate-500 font-normal leading-snug">{{ __('messages.register_heading') }}</p>
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

        <!-- Formulario de Registro -->
        <form action="{{ route('auth.register.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_name_label') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('messages.register_name_placeholder') }}" autocomplete="name"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm @error('name') border-red-400 bg-red-50/30 @enderror">
                @error('name') 
                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Email -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_email_label') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="{{ __('messages.register_email_placeholder') }}" autocomplete="email"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm @error('email') border-red-400 bg-red-50/30 @enderror">
                @error('email') 
                    <p class="text-red-500 text-xs font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Contraseñas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_password_label') }}</label>
                    <input type="password" name="password" id="password" required placeholder="{{ __('messages.register_password_placeholder') }}" autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm @error('password') border-red-400 bg-red-50/30 @enderror">
                </div>
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_password_confirm_label') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="{{ __('messages.register_password_confirm_placeholder') }}" autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm">
                </div>
            </div>
            @error('password') 
                <p class="text-red-500 text-xs font-medium">{{ $message }}</p> 
            @enderror

            <!-- Teléfono e Idioma -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_phone_label') }}</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="{{ __('messages.register_phone_placeholder') }}" autocomplete="tel"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm">
                </div>
                <div class="space-y-1.5">
                    <label for="preferred_language" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_language_label') }}</label>
                    <select name="preferred_language" id="preferred_language" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm cursor-pointer">
                        <option value="es" {{ old('preferred_language') == 'es' ? 'selected' : '' }}>{{ __('messages.register_language_es') }}</option>
                        <option value="miskito" {{ old('preferred_language') == 'miskito' ? 'selected' : '' }}>{{ __('messages.register_language_mi') }}</option>
                        <option value="creole" {{ old('preferred_language') == 'creole' ? 'selected' : '' }}>{{ __('messages.register_language_cr') }}</option>
                    </select>
                </div>
            </div>

            <!-- Departamento y Municipio estandarizados -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="department" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_department_label') }}</label>
                    <select name="department" id="department" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm cursor-pointer @error('department') border-red-400 bg-red-50/30 @enderror">
                        <option value="" disabled {{ old('department') ? '' : 'selected' }}>Seleccionar departamento...</option>
                    </select>
                    @error('department')
                        <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1.5">
                    <label for="municipality" class="block text-xs font-bold uppercase tracking-wider text-slate-600">{{ __('messages.register_municipality_label') }}</label>
                    <select name="municipality" id="municipality" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition text-sm cursor-pointer @error('municipality') border-red-400 bg-red-50/30 @enderror">
                        <option value="" disabled {{ old('municipality') ? '' : 'selected' }}>Seleccionar municipio...</option>
                    </select>
                    @error('municipality')
                        <p class="text-red-500 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botón de Registro -->
            <button type="submit" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold text-sm rounded-xl shadow-lg shadow-emerald-600/25 transition-all duration-150 cursor-pointer mt-2">
                {{ __('messages.register_button') }}
            </button>
        </form>

        <!-- Enlace hacia Login -->
        <div class="text-center text-xs text-slate-500 pt-4 border-t border-slate-100">
            {{ __('messages.register_has_account') }} 
            <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline ml-1">{{ __('messages.register_login_link') }}</a>
        </div>
    </div>

    <!-- Script para alimentar municipios de Nicaragua -->
    <script>
        const nicaraguaLugares = {
            "Matagalpa": ["Matagalpa", "Sébaco", "Ciudad Darío", "San Ramón", "Matiguás", "Muy Muy", "Esquipulas", "San Dionisio", "San Isidro", "Terrabona", "Río Blanco", "Rancho Grande", "El Tuma - La Dalia"],
            "Managua": ["Managua", "Ciudad Sandino", "Tipitapa", "Mateare", "San Rafael del Sur", "Villa El Carmen", "Ticuantepe", "El Crucero", "San Francisco Libre"],
            "Estelí": ["Estelí", "Condega", "Pueblo Nuevo", "San Juan de Limay", "La Trinidad", "San Nicolás"],
            "Jinotega": ["Jinotega", "San Rafael del Norte", "San Sebastián de Yalí", "La Concordia", "Santa María de Pantasma", "Wiwilí de Jinotega", "El Cuá", "Bocay"],
            "León": ["León", "Chichigalpa", "Nagarote", "La Paz Centro", "El Sauce", "Achuapa", "Santa Rosa del Peñón", "El Jicaral", "Larreynaga - Malpaisillo", "Quezalguaque"],
            "Chinandega": ["Chinandega", "Corinto", "El Viejo", "Chichigalpa", "Posoltega", "El Realejo", "Puerto Morazán", "Somotillo", "Villa El Carmen", "Santo Tomás del Norte", "Cinco Pinos", "San Pedro del Norte", "San Francisco del Norte"],
            "Masaya": ["Masaya", "Nindirí", "Tisma", "Catarina", "San Juan de Oriente", "Niquinohomo", "Nandasmo", "Masatepe", "La Concepción"],
            "Carazo": ["Jinotepe", "Diriamba", "Dolores", "El Rosario", "La Conquista", "La Paz de Carazo", "San Marcos", "Santa Teresa"],
            "Granada": ["Granada", "Diriá", "Diriomo", "Nandaime"],
            "Rivas": ["Rivas", "Altagracia", "Belén", "Buenos Aires", "Cárdenas", "Moyogalpa", "Potosí", "San Jorge", "San Juan del Sur", "Tola"],
            "Nueva Segovia": ["Ocotal", "Jalapa", "Jícaro", "Murra", "Quilalí", "San Fernando", "Santa María", "Wiwilí de Nueva Segovia", "Dipilto", "Ciudad Antigua", "Mozonte", "Macuelizo"],
            "Madriz": ["Somoto", "Palacagüina", "San Lucas", "Las Sabanas", "San José de Cusmapa", "Telpaneca", "Totogalpa", "Yalagüina", "San Juan de Río Coco"],
            "Boaco": ["Boaco", "Camoapa", "San Lorenzo", "Santa Lucía", "Teustepe", "San José de los Remates"],
            "Chontales": ["Juigalpa", "Acoyapa", "Comalapa", "El Coral", "La Libertad", "San Francisco de Cuapa", "San Pedro de Lóvago", "Santo Domingo", "Santo Tomás", "Villa Sandino"],
            "Río San Juan": ["San Carlos", "El Almendro", "El Castillo", "Morrito", "San Juan del Norte", "San Miguelito"],
            "Costa Caribe Norte (RACCN)": ["Puerto Cabezas (Bilwi)", "Waspam", "Siuna", "Rosita", "Bonanza", "Mulukukú", "Prinzapolka"],
            "Costa Caribe Sur (RACCS)": ["Bluefields", "Kukra Hill", "Laguna de Perlas", "Corn Island", "El Tortuguero", "La Cruz de Río Grande", "Paiwas", "Nueva Guinea", "El Rama", "Muelle de los Bueyes", "Bocana de Paiwas"]
        };

        const depSelect = document.getElementById('department');
        const munSelect = document.getElementById('municipality');
        const oldDep = "{{ old('department') }}";
        const oldMun = "{{ old('municipality') }}";

        Object.keys(nicaraguaLugares).forEach(dep => {
            const opt = document.createElement('option');
            opt.value = dep;
            opt.textContent = dep;
            if (oldDep === dep) opt.selected = true;
            depSelect.appendChild(opt);
        });

        function actualizarMunicipios(depSeleccionado, munSeleccionado = '') {
            munSelect.innerHTML = '<option value="" disabled selected>Seleccionar municipio...</option>';
            if (!depSeleccionado || !nicaraguaLugares[depSeleccionado]) return;

            nicaraguaLugares[depSeleccionado].forEach(mun => {
                const opt = document.createElement('option');
                opt.value = mun;
                opt.textContent = mun;
                if (munSeleccionado === mun) opt.selected = true;
                munSelect.appendChild(opt);
            });
        }

        depSelect.addEventListener('change', function() {
            actualizarMunicipios(this.value);
        });

        if (oldDep) {
            actualizarMunicipios(oldDep, oldMun);
        }
    </script>
</body>
</html>