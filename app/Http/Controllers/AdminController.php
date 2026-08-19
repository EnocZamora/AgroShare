<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Panel principal del administrador/auditor
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalChats = Chat::count();
        
        // Obtener registros recientes para auditoría
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::with('user')->latest()->take(5)->get();

        return view('admin.index', compact('totalUsers', 'totalProducts', 'totalChats', 'recentUsers', 'recentProducts'));
    }
}