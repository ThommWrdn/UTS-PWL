<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function store(Request $request)
    {
     //
    }

    public function index()
    {
        return view('order.index');
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
