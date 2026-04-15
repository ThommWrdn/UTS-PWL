<?php

namespace App\Http\Controllers;

// Import class Request buat nangkep inputan form
use Illuminate\Http\Request;
// Import model Products buat nyambung ke database tabelnya
use App\Models\Products;

class ProductsController extends Controller
{
    // Fungsi buat nampilin semua data produk
    public function tampil()
    {
        // Ambil semua data produk dari database 
        $product = Products::all();
        // Terus dipasing ke view product/tampil.blade.php
        return view('product.tampil', compact('product'));
    }

    // Fungsi buat nampilin UI form buat nambah produk baru
    public function tambah()
    {
        // Nampilin view (form) tambah data
        return view('product.tambah');
    }

    // Fungsi buat nyimpen data yang udah diketik di form nambah
    public function simpan(Request $request)
    {
        // Pengecekan atau validasi data sebelum disimpen
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
        ],[
            // Pesan error kalo nggak diisi dengan bener
            'kode_produk.required' => 'Kode produk wajib diisi',
            'nama_produk.required' => 'Nama produk wajib diisi',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
        ]);
        
        // Simpen semua data (all) dari request form ke database
        Products::create($request->all());
        // Abis sukses disimpen balik lagi ke halaman product
        return redirect('/product')->with('success', 'Data berhasil ditambahkan');
    }
    
    // Fungsi buat nampilin form edit sesuai data yang diclik
    public function edit($id)
    {
        // Cari data berdasarkan ID
        $product = Products::find($id);
        // Lempar data variabel $p ke view product/edit.blade.php
        return view('product.edit', ['p' => $product]);
    }

    // Fungsi buat numpuk (update) data lama dengan data baru di form edit
    public function update(Request $request, $id)
    {
        // Cari dulu data aslinya sebelum di update
        $product = Products::find($id);
        // Update data dengan yang diketik dari form ($request->all())
        $product->update($request->all());
        // Balikin ke halaman product  
        return redirect('/product')->with('success', 'Data berhasil diupdate');
    }

    // Fungsi buat ngehapus data sesuai ID  
    public function hapus($id)
    {
        // Cari datanya pake ID terus dihapus langsung
        $product = Products::find($id);
        $product->delete();
        // Redirect balik ke view daftar product
        return redirect('/product');
    }
}