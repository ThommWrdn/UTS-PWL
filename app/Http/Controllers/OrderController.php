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
            'status' => Order::STATUS_PENDING,
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

    public function detail($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        
        // Security check
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('order.detail', compact('order'));
    }
    
    // [ADMIN] Lihat semua order
    public function adminOrders()
    {
        $orders = Order::with(['user', 'orderDetails.product'])->oldest()->get();
        return view('order.admin_orders', compact('orders'));
    }

    // [ADMIN] Setujui order: pending → delivery
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Order tidak dalam status pending.');
        }
        $order->update(['status' => Order::STATUS_DELIVERY]);
        return back()->with('success', 'Order disetujui! Barang sedang dalam pengiriman.');
    }

    // [USER] Konfirmasi terima barang: delivery → delivered
    public function confirmReceived($id)
    {
        $order = Order::findOrFail($id);

        // Hanya pemilik order yang boleh konfirmasi
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->status !== Order::STATUS_DELIVERY) {
            return back()->with('error', 'Order belum dalam status pengiriman.');
        }
        $order->update(['status' => Order::STATUS_DELIVERED]);
        return back()->with('success', 'Terima kasih! Barang sudah diterima. Menunggu konfirmasi admin.');
    }

    // [ADMIN] Tandai selesai: delivered → success
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== Order::STATUS_DELIVERED) {
            return back()->with('error', 'Order belum dikonfirmasi diterima oleh user.');
        }
        $order->update(['status' => Order::STATUS_SUCCESS]);
        return back()->with('success', 'Order selesai! Transaksi berhasil.');
    }
}
