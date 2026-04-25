<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $product = Products::all();
        return view('product.index', compact('product'));
    }

    public function show()
    {
        $product = Products::all();
        return view('product.show', compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
        ],[
            'kode_produk.required' => 'Kode produk wajib diisi',
            'nama_produk.required' => 'Nama produk wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
        ]);
        
        Products::create($request->all());
        return redirect('/product')->with('success', 'Data berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $product = Products::find($id);
        return view('product.edit', ['p' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $product->update($request->all());
        return redirect('/product')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect('/product');
    }
}