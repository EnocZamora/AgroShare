<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalChats = Chat::count();
        $totalMessages = Message::count();
        
        $recentUsers = User::withCount('products')
            ->latest()
            ->take(10)
            ->get();
        
        $recentProducts = Product::with(['user', 'category'])
            ->latest()
            ->take(10)
            ->get();
        
        $pendingProducts = Product::where('status', 'incompleto')->count();
        $activeProducts = Product::where('status', 'activo')->count();

        return view('admin.index', compact(
            'totalUsers', 'totalProducts', 'totalChats', 'totalMessages',
            'recentUsers', 'recentProducts', 'pendingProducts', 'activeProducts'
        ));
    }

    public function audit(Request $request)
    {
        $tab = $request->query('tab', 'users');
        $perPage = 20;

        $emptyPaginator = fn(string $pageName) => new LengthAwarePaginator(
            items: collect(),
            total: 0,
            perPage: $perPage,
            currentPage: 1,
            options: [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );

        $users = match ($tab) {
            'users' => User::query()
                ->withCount('products')
                ->latest()
                ->paginate($perPage, ['*'], 'users_page')
                ->withQueryString(),
            default => $emptyPaginator('users_page')
        };

        $products = match ($tab) {
            'products' => Product::query()
                ->with(['user', 'category'])
                ->latest()
                ->paginate($perPage, ['*'], 'products_page')
                ->withQueryString(),
            default => $emptyPaginator('products_page')
        };

        $chats = match ($tab) {
            'chats' => Chat::query()
                ->with(['product', 'buyer', 'seller'])
                ->withCount('messages')
                ->latest()
                ->paginate($perPage, ['*'], 'chats_page')
                ->withQueryString(),
            default => $emptyPaginator('chats_page')
        };

        return view('admin.audit', compact('users', 'products', 'chats', 'tab'));
    }
}
