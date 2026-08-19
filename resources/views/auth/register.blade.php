@extends('layouts.app')

@section('title', 'Registro - Agroshare')

@section('content')
<div class="max-w-xl mx-auto mb-10">
    <div class="bg-[#1B4D3E] text-white p-6 rounded-t-xl shadow-sm text-center">
        <h1 class="text-2xl font-bold">Crear Cuenta en Agroshare</h1>
        <p class="text-emerald-100 text-sm mt-1">Únete a la plataforma para publicar y comprar productos agrícolas</p>
    </div>

    <div class="border border-emerald-700 rounded-b-xl bg-white p-6 shadow-sm">
        <form action="{{ route('auth.register.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo o Razón Social</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ej. Juan Pérez"
                    class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com"
                    class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Contraseñas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••"
                        class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                </div>
            </div>
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            <!-- Teléfono e Idioma -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono (Opcional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+505 8888 8888"
                        class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Idioma Preferido</label>
                    <select name="preferred_language" class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                        <option value="es">Español</option>
                        <option value="miskito">Miskito</option>
                        <option value="creole">Inglés Criollo (Creole)</option>
                    </select>
                </div>
            </div>

            <!-- Departamento y Municipio -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                    <input type="text" name="department" value="{{ old('department') }}" placeholder="Ej. Matagalpa"
                        class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Municipio</label>
                    <input type="text" name="municipality" value="{{ old('municipality') }}" placeholder="Ej. San Ramón"
                        class="w-full border border-emerald-700 rounded-lg p-3 text-gray-800 focus:ring-2 focus:ring-[#1B4D3E] focus:outline-none">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1B4D3E] hover:bg-[#14382c] text-white font-bold py-3 px-4 rounded-xl transition shadow-md mt-4">
                Registrarme en Agroshare
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600 border-t border-gray-100 pt-4">
            ¿Ya tienes una cuenta? 
            <a href="{{ route('auth.login') }}" class="text-[#1B4D3E] font-bold hover:underline">Inicia sesión aquí</a>
        </div>
    </div>
</div>
@endsection