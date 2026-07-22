<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('user/dashboard');
            }
        }
        
        return back()->with('failed', 'Email atau password salah!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create($validated);

        Auth::login($user);

        if (Auth::user()->role == 'admin') {
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->intended('user/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $totalOrders = Order::count();
            $totalRevenue = Order::whereIn('status', [Order::STATUS_DELIVERED, Order::STATUS_SUCCESS])->sum('total_price');
            $totalProducts = Products::count();
            $totalUsers = User::where('role', 'user')->count();

            // Chart 1: Status Transaksi Pesanan (Pie Chart)
            $orderStatusRaw = Order::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();
            
            $orderStatusData = $orderStatusRaw->map(function ($item) {
                return [
                    'name' => ucfirst($item->status),
                    'y'    => (int) $item->count,
                ];
            })->values();

            // Chart 2: Produk per Kategori (Column Chart)
            $categoryDataRaw = Category::withCount('product')->get();
            $categoryCategories = $categoryDataRaw->pluck('name')->values();
            $categorySeriesData = $categoryDataRaw->pluck('product_count')->values();

            // Chart 3: Pemantauan Stok Produk (Bar Chart)
            $productsStockRaw = Products::select('name', 'stock')->orderBy('stock', 'asc')->get();
            $stockProductNames = $productsStockRaw->pluck('name')->values();
            $stockValues = $productsStockRaw->pluck('stock')->values();

            return view('dashboard.admin', compact(
                'totalOrders',
                'totalRevenue',
                'totalProducts',
                'totalUsers',
                'orderStatusData',
                'categoryCategories',
                'categorySeriesData',
                'stockProductNames',
                'stockValues'
            ));
        } else {
            return view('dashboard.user');
        }
    }
}
