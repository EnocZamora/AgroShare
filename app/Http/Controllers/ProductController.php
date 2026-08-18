<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Mostrar lista de productos
    public function index()
    {
        $products = Product::with(['category', 'user'])->latest()->get();
        return view('products.index', compact('products'));
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

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }
}
