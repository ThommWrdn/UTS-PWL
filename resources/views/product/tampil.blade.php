<!-- Ngambil layout dasar dari file app.blade.php yang ada di folder layouts -->
@extends('layouts.app')

<!-- Masukin konten ini ke dalem bagian yield('content') di layout app -->
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Data Produk</h2>
    <!-- Tombol buat ngejalanin link ke rute tambah produk -->
    <a href="/product/tambah" class="btn btn-success">+ Tambah Produk</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <!-- Bikin tabel pake class bootstrap biar rapi otomatis -->
        <table class="table table-striped table-hover m-0 text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pake foreach bawaan blade buat ngelooping data dari database (dari controller) -->
                @forelse($product as $p)
                <tr>
                    <!-- Nampilin nomor urut otomatis loop (1, 2, 3 dst) -->
                    <td>{{ $loop->iteration }}</td>
                    <!-- Nampilin kolom data dari database sesuai namanya -->
                    <td><span class="badge bg-secondary">{{ $p->kode_produk }}</span></td>
                    <td class="text-start fw-bold">{{ $p->nama_produk }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <!-- Link buat edit sama hapus, ngelempar ID datanya ke route biar tau mana yang mau diubah/dihapus -->
                        <a href="/product/edit/{{ $p->id }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        <a href="/product/hapus/{{ $p->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Penutup section content biar halamannya nggak lanjut kemana-mana -->
@endsection
