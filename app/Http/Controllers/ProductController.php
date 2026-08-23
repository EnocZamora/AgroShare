<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Mostrar lista general de productos (Catálogo)
    public function index()
    {
        $products = Product::with(['category', 'user'])->latest()->get();
        return view('products.index', compact('products'));
    }

    // Mostrar los productos del usuario autenticado con filtrado por pestañas
    public function myProducts(Request $request)
    {
        $tab = $request->get('tab', 'activas');

        $query = Product::where('user_id', Auth::id())->with(['category']);

        if ($tab === 'finalizadas') {
            $query->where('status', 'finalizado');
        } elseif ($tab === 'incompletas') {
            $query->where('status', 'incompleto');
        } else {
            $query->where('status', 'activo');
        }

        $products = $query->latest()->get();
            
        return view('products.my-products', compact('products', 'tab'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Guardar el producto y su imagen en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'location' => 'nullable|string|max:100',
            'availability_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'location' => $request->location,
            'availability_date' => $request->availability_date,
            'status' => 'activo',
            'image' => $imagePath,
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

    // Actualizar el producto y su imagen
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
            'location' => 'nullable|string|max:100',
            'availability_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'location' => $request->location,
            'availability_date' => $request->availability_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.my-products')->with('success', 'Producto actualizado exitosamente.');
    }

    // Actualizar únicamente el estado del producto
    public function updateStatus(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:activo,finalizado,incompleto',
        ]);

        $product->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Estado del producto actualizado exitosamente.');
    }

    // Eliminar el producto y su imagen asociada
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.my-products')->with('success', 'Producto eliminado exitosamente.');
    }
}