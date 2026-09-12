<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
//use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [ 
            'totalOrders' => Order::count(),
            'monthlyRevenue' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total'),
            'lowStockProducts' => Product::where('stock', 0)->count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
