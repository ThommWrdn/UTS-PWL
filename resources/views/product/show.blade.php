@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Data Produk</h2>
    <a href="/product/tambah" class="btn btn-success">+ Tambah Produk</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover m-0 text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($product as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge bg-secondary">{{ $p->kode_produk }}</span></td>
                    <td class="text-start fw-bold">{{ $p->nama_produk }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>
                        @if($p->gambar)
                            <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}" class="img-fluid" style="max-height: 100px;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="/product/edit/{{ $p->id }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        <a href="/product/hapus/{{ $p->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
