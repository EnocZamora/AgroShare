<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Constructor para asegurar que solo admin o auditor entren
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->role, ['admin', 'auditor'])) {
                abort(403, 'No tienes autorización para acceder a esta sección.');
            }
            return $next($request);
        });
    }

    // Panel principal de administración y auditoría
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalChats = Chat::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.index', compact('totalUsers', 'totalProducts', 'totalChats', 'recentUsers', 'recentProducts'));
    }
}
