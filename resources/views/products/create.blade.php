@extends('layouts.app')

@section('title', 'Agroshare - Publicar Producto')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-xl border border-emerald-700/30 shadow-sm">
    
    <div class="mb-6">
        <h2 class="text-xl font-bold text-[#1B4D3E]">Registrar Nueva Cosecha o Producto</h2>
        <p class="text-xs text-gray-500 mt-1">Completa los datos detallados para ofertar tu producto directamente en la plataforma.</p>
    </div>

    <!-- Mensajes de Error de Validación -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs space-y-1">
            <p class="font-bold">Por favor corrige los siguientes errores:</p>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Título del Producto -->
        <div>
            <label for="title" class="block text-xs font-bold text-gray-700 mb-1">Título del Producto</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800 placeholder-gray-400"
                placeholder="Ej. Café Arábica de Altura o Tomates Rojos">
        </div>

        <!-- Categoría -->
        <div>
            <label for="category_id" class="block text-xs font-bold text-gray-700 mb-1">Categoría</label>
            <select name="category_id" id="category_id" required
                class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-xs font-bold text-gray-700 mb-1">Descripción detallada</label>
            <textarea name="description" id="description" rows="4" required
                class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800 placeholder-gray-400"
                placeholder="Describe la calidad, proceso o características de tu cosecha...">{{ old('description') }}</textarea>
        </div>

        <!-- Precio y Unidad -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-xs font-bold text-gray-700 mb-1">Precio (C$)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                    class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
                    placeholder="0.00">
            </div>

            <div>
                <label for="unit" class="block text-xs font-bold text-gray-700 mb-1">Unidad de Medida</label>
                <input type="text" name="unit" id="unit" value="{{ old('unit') }}" required
                    class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
                    placeholder="Ej. Quintal, Libras, Cajas">
            </div>
        </div>

        <!-- Stock / Cantidad Disponible -->
        <div>
            <label for="stock" class="block text-xs font-bold text-gray-700 mb-1">Cantidad Disponible (Stock)</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required
                class="w-full px-3 py-2 text-sm border border-emerald-700/50 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
                placeholder="Ej. 50">
        </div>

        <!-- Botones de Acción -->
        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('products.index') }}" class="px-4 py-2 text-xs font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-2 text-xs font-bold text-white bg-[#1B4D3E] hover:bg-[#14382c] rounded-xl shadow-sm transition">
                Guardar y Publicar
            </button>
        </div>

    </form>
</div>
@endsection