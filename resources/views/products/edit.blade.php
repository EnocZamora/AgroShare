@extends('layouts.app')

@section('title', 'Agroshare - Editar Producto')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    
    <div class="bg-white p-6 rounded-xl border border-emerald-700/30 shadow-sm">
        <h2 class="text-xl font-bold text-[#1B4D3E]">Editar Producto</h2>
        <p class="text-xs text-gray-500 mt-1">Modifica los detalles de tu publicación.</p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-emerald-700/30 shadow-sm">
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Título del Producto</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" required
                    class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Categoría</label>
                    <select name="category_id" required class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Precio ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                        class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Unidad de Medida (Ej. kg, saco)</label>
                    <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" required
                        class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Stock Disponible</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                        class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Descripción</label>
                <textarea name="description" rows="4" required
                    class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#1B4D3E]">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('products.my-products') }}" class="bg-gray-100 text-gray-700 text-xs px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#1B4D3E] text-white text-xs px-4 py-2 rounded-lg font-medium hover:bg-emerald-800 transition">
                    Actualizar Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection