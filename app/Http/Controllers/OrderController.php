<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Products::find($request->product_id);

        if ($product->stock < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $product->price * $request->jumlah,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->jumlah,
            'price' => $product->price,
            'subtotal' => $product->price * $request->jumlah,
        ]);

        $product->decrement('stock', $request->jumlah);

        return redirect()->route('order.index')->with('success', 'Yeay, pesanan sukses masuk!');
    }

    public function index()
    {
        $product = Products::all();
        return view('order.index', compact('product'));
    }

    public function show()
    {
        $order = Order::all();
        return view('order.show', compact('order'));
    }

    public function history()
    {
        $order = Order::where('user_id', Auth::id())->get();
        return view('order.history', compact('order'));
    }
}
