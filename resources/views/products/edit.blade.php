@extends('layouts.app')

@section('title', __('messages.product_form_title_edit'))

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm space-y-6">
    
    <!-- Encabezado -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <a href="{{ route('products.my-products') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#1B4D3E] hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                {{ __('messages.product_form_cancel') }}
            </a>
            <h2 class="text-sm md:text-base font-bold text-[#1B4D3E] tracking-wide">{{ __('messages.product_form_title_edit') }}</h2>
            <div class="w-10"></div>
        </div>
        <p class="text-xs text-gray-500">{{ __('messages.product_form_banner_text') }}</p>
    </div>

    <!-- Mensajes de Error de Validación -->
    @if ($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs space-y-1">
            <p class="font-bold">{{ __('messages.product_form_errors_title') }}</p>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Título del Producto -->
        <div>
            <label for="title" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_name_label') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $product->title) }}" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800 bg-white"
                placeholder="{{ __('messages.product_form_name_placeholder') }}">
        </div>

        <!-- Categoría (Controlada por BD) -->
        <div>
            <label for="category_id" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_category_label') }}</label>
            <select name="category_id" id="category_id" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">{{ __('messages.product_form_category_placeholder') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <p class="text-[10px] text-gray-400 mt-1">{{ __('messages.product_form_category_help') }}</p>
        </div>

        <!-- Precio y Stock -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="price" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_price_label') }}</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0"
                    class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800">
            </div>

            <div>
                <label for="stock" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_stock_label') }}</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                    class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800">
            </div>
        </div>

        <!-- Unidad de Medida (Controlada) -->
        <div>
            <label for="unit" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_unit_label') }}</label>
            <select name="unit" id="unit" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">{{ __('messages.product_form_unit_placeholder') }}</option>
                @foreach(['Quintales', 'Libras', 'Cajas', 'Sacos', 'Unidades'] as $u)
                    <option value="{{ $u }}" {{ old('unit', $product->unit) == $u ? 'selected' : '' }}>
                        {{ __('messages.unit_' . strtolower($u)) }}
                    </option>
                @endforeach
            </select>
            <p class="text-[10px] text-gray-400 mt-1">{{ __('messages.product_form_unit_help') }}</p>
        </div>

        <!-- Ubicación (Controlada por Departamentos de Nicaragua) -->
        <div>
            <label for="location" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_location_label') }}</label>
            <select name="location" id="location" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] bg-white text-gray-800">
                <option value="">{{ __('messages.product_form_location_placeholder') }}</option>
                @foreach(['Boaco', 'Carazo', 'Chinandega', 'Chontales', 'Estelí', 'Granada', 'Jinotega', 'León', 'Madriz', 'Managua', 'Masaya', 'Matagalpa', 'Nueva Segovia', 'Rivas', 'Río San Juan', 'RACCN', 'RACCS'] as $dept)
                    <option value="{{ $dept }}" {{ old('location', $product->location ?? 'Matagalpa') == $dept ? 'selected' : '' }}>{{ $dept }}, Nicaragua</option>
                @endforeach
            </select>
            <p class="text-[10px] text-gray-400 mt-1">{{ __('messages.product_form_location_help') }}</p>
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block text-xs font-bold text-gray-700 mb-1">{{ __('messages.product_form_description_label') }}</label>
            <textarea name="description" id="description" rows="3" required
                class="w-full px-3 py-2.5 text-sm border border-emerald-700/40 rounded-xl focus:outline-none focus:border-[#1B4D3E] text-gray-800">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('products.my-products') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition">
                {{ __('messages.cancel') }}
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#1B4D3E] hover:bg-[#14382c] text-white text-xs font-bold rounded-xl shadow-sm transition tracking-wide">
                {{ __('messages.product_form_update') }}
            </button>
        </div>

    </form>
</div>
@endsection