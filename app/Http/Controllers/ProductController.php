<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Mostrar lista general de productos (Catálogo)
    public function index()
    {
        $products = Product::with(['category', 'user'])->latest()->get();
        return view('products.index', compact('products'));
    }

    // Mostrar los productos del usuario autenticado
    public function myProducts()
    {
        $products = Product::where('user_id', Auth::id())
            ->with(['category'])
            ->latest()
            ->get();
            
        return view('products.my-products', compact('products'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Guardar el producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'status' => 'activo',
        ]);

        return redirect()->route('products.my-products')->with('success', 'Producto creado exitosamente.');
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        $product->load(['category', 'user']);
        return view('products.show', compact('product'));
    }

    // Mostrar formulario para editar producto
    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Actualizar el producto en la base de datos
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'unit' => $request->unit,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.my-products')->with('success', 'Producto actualizado exitosamente.');
    }

    // Eliminar el producto
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.my-products')->with('success', 'Producto eliminado exitosamente.');
    }
}