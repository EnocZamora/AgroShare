@extends('layouts.app')

@section('title', 'Agroshare - Publicar Producto')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm space-y-6">
    
    <!-- Barra de Progreso y Navegación -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#1B4D3E] hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Atrás
            </a>
            <h2 class="text-sm md:text-base font-bold text-[#1B4D3E] tracking-wide">Información básica</h2>
            <div class="w-10"></div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div class="h-1.5 bg-[#1B4D3E] rounded-full"></div>
            <div class="h-1.5 bg-gray-200 rounded-full"></div>
            <div class="h-1.5 bg-gray-200 rounded-full"></div>
        </div>
    </div>

    <!-- Banner Informativo -->
    <div class="flex items-center gap-4 border border-emerald-700/30 bg-emerald-50/50 p-4 rounded-xl">
        <div class="w-12 shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Agroshare" class="w-full h-auto object-contain">
        </div>
        <p class="text-xs text-[#1B4D3E] font-medium leading-relaxed">
            Comparte tus cosechas con compradores interesados de forma segura y estructurada.
        </p>
    </div>

    <!-- Mensajes de Error de Validación -->
    @if ($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs space-y-1">
            <p class="font-bold">Por favor corrige los siguientes errores:</p>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Nombre del producto -->
        <div>
            <label for="title" class="block text-xs font-bold text-gray-700 mb-1">Nombre del producto:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800 bg-white"
                placeholder="Ej. Plátano maduro y verde">
            <p class="text-[10px] text-gray-400 mt-1">Escribe un nombre comercial claro y directo.</p>
        </div>

        <!-- Categoría (Controlada por BD) -->
        <div>
            <label for="category_id" class="block text-xs font-bold text-gray-700 mb-1">Categoría:</label>
            <select name="category_id" id="category_id" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">Selecciona una categoría oficial</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-[10px] text-gray-400 mt-1">Selecciona el rubro exacto para facilitar la búsqueda al comprador.</p>
        </div>

        <!-- Precio del producto -->
<div>
    <label for="price" class="block text-xs font-bold text-gray-700 mb-1">Precio ($):</label>
    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required min="0"
        class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
        placeholder="Ej. 150.00">
    <p class="text-[10px] text-gray-400 mt-1">Precio unitario o por lote acordado.</p>
</div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-xs font-bold text-gray-700 mb-1">Descripción:</label>
            <textarea name="description" id="description" rows="3" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
                placeholder="Describe la calidad o características...">{{ old('description') }}</textarea>
        </div>

        <!-- Cantidad disponible y Unidad de medida (Controlada) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="stock" class="block text-xs font-bold text-gray-700 mb-1">Cantidad disponible:</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required min="1"
                    class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800"
                    placeholder="Ej. 100">
            </div>

            <div>
                <label for="unit" class="block text-xs font-bold text-gray-700 mb-1">Unidad de medida:</label>
                <select name="unit" id="unit" required
                    class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                    <option value="">Selecciona unidad</option>
                    <option value="Quintales" {{ old('unit') == 'Quintales' ? 'selected' : '' }}>Quintales</option>
                    <option value="Libras" {{ old('unit') == 'Libras' ? 'selected' : '' }}>Libras</option>
                    <option value="Cajas" {{ old('unit') == 'Cajas' ? 'selected' : '' }}>Cajas</option>
                    <option value="Sacos" {{ old('unit') == 'Sacos' ? 'selected' : '' }}>Sacos</option>
                    <option value="Unidades" {{ old('unit') == 'Unidades' ? 'selected' : '' }}>Unidades</option>
                </select>
                <p class="text-[10px] text-gray-400 mt-1">Estandarizado para evitar errores de escritura.</p>
            </div>
        </div>

        <!-- Ubicación de tu cosecha (Controlada por Departamentos de Nicaragua) -->
        <div>
            <label for="location" class="block text-xs font-bold text-gray-700 mb-1">Ubicación de tu cosecha:</label>
            <select name="location" id="location" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">Selecciona el departamento</option>
                @foreach(['Boaco', 'Carazo', 'Chinandega', 'Chontales', 'Estelí', 'Granada', 'Jinotega', 'León', 'Madriz', 'Managua', 'Masaya', 'Matagalpa', 'Nueva Segovia', 'Rivas', 'Río San Juan', 'RACCN', 'RACCS'] as $dept)
                    <option value="{{ $dept }}" {{ old('location', 'Matagalpa') == $dept ? 'selected' : '' }}>{{ $dept }}, Nicaragua</option>
                @endforeach
            </select>
            <p class="text-[10px] text-gray-400 mt-1">Obligatorio para que los filtros geográficos funcionen con precisión.</p>
        </div>

        <!-- Disponibilidad (Fecha) -->
        <div>
            <label for="availability_date" class="block text-xs font-bold text-gray-700 mb-1">Disponibilidad (Fecha de cosecha/entrega):</label>
            <input type="date" name="availability_date" id="availability_date" value="{{ old('availability_date', date('Y-m-d')) }}" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800 bg-white">
        </div>

        <!-- Foto principal -->
        <div>
            <label for="image" class="block text-xs font-bold text-gray-700 mb-1">Foto principal de la cosecha:</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#1B4D3E] file:text-white hover:file:bg-[#14382c] border border-emerald-700/40 rounded-xl p-2 bg-gray-50">
        </div>

        <!-- Botón Continuar -->
        <div class="pt-4">
            <button type="submit" class="w-full py-3 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl shadow-sm transition text-center tracking-wide">
                Continuar
            </button>
        </div>

    </form>
</div>
@endsection