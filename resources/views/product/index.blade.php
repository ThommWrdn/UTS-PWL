@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Data Produk</h2>
    <a href="{{ route('product.tambah') }}" class="btn btn-success">+ Tambah Produk</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover m-0 text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($product as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start fw-bold">{{ $p->name }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>
                        <a href="{{ route('product.edit', $p->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        <a href="{{ route('product.hapus', $p->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted py-3">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
