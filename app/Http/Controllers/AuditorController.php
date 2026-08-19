<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Panel general para Admin / Auditor
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalChats = Chat::count();
        $totalMessages = Message::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::with('user')->latest()->take(5)->get();

        return view('admin.index', compact('totalUsers', 'totalProducts', 'totalChats', 'totalMessages', 'recentUsers', 'recentProducts'));
    }

    // Vista de Auditoría Específica: Listado completo para revisión de registros
    public function auditLogs(Request $request)
    {
        $users = User::withCount(['products'])->latest()->get();
        $products = Product::with('user', 'category')->latest()->get();

        return view('admin.audit', compact('users', 'products'));
    }
}