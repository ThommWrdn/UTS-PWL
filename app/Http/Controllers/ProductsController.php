<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function tampil()
    {
        $product = Products::all();
        return view('product.tampil', compact('product'));
    }

    public function tambah()
    {
        return view('product.tambah');
    }

    public function simpan(Request $request)
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

    public function hapus($id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect('/product');
    }
}