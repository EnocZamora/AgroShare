<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalChats = Chat::count();
        $totalMessages = Message::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentProducts = Product::with('user')->latest()->take(5)->get();

        return view('auditor.index', compact('totalUsers', 'totalProducts', 'totalChats', 'totalMessages', 'recentUsers', 'recentProducts'));
    }
}