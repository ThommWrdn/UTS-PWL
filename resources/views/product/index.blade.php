@extends('layouts.app')

@section('content')

{{-- Page Title + Actions --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0 fw-bold" style="color:#1e3a5f;">
            <i class="bi bi-box-seam-fill me-2" style="color:#2563eb;"></i>Data Produk
        </h2>
        <p class="text-muted small mb-0">Kelola seluruh data produk toko Anda</p>
    </div>
    <div class="d-flex gap-2">
        {{-- Tombol Preview PDF --}}
        <a href="{{ route('product.previewPdf') }}" target="_blank"
           class="btn btn-outline-danger d-flex align-items-center gap-1"
           title="Preview PDF di browser">
            <i class="bi bi-eye-fill"></i>
            <span class="d-none d-md-inline">Preview PDF</span>
        </a>
        {{-- Tombol Download PDF --}}
        <a href="{{ route('product.downloadPdf') }}"
           class="btn btn-danger d-flex align-items-center gap-1"
           title="Download Laporan PDF">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span class="d-none d-md-inline">Download PDF</span>
        </a>
        {{-- Tombol Tambah --}}
        <a href="{{ route('product.tambah') }}"
           class="btn btn-primary d-flex align-items-center gap-1">
            <i class="bi bi-plus-circle-fill"></i>
            <span class="d-none d-md-inline">Tambah Produk</span>
        </a>
    </div>
</div>

{{-- Card Table --}}
<div class="card border-0 shadow" style="border-radius: 14px; overflow: hidden;">
    {{-- Card Header --}}
    <div class="card-header border-0 d-flex justify-content-between align-items-center py-3 px-4"
         style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);">
        <span class="text-white fw-semibold">
            <i class="bi bi-table me-1"></i> Daftar Produk
        </span>
        <span class="badge bg-white text-primary fw-bold">
            {{ $product->count() }} produk
        </span>
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0 align-middle" id="table-produk">
                <thead>
                    <tr style="background-color:#f0f5ff; border-bottom: 2px solid #dce8ff;">
                        <th class="text-center px-3 py-3" style="width:50px; color:#1e3a5f;">#</th>
                        <th class="px-3 py-3" style="color:#1e3a5f;">Nama Produk</th>
                        <th class="text-center px-3 py-3" style="color:#1e3a5f;">Harga</th>
                        <th class="text-center px-3 py-3" style="color:#1e3a5f;">Stok</th>
                        <th class="text-center px-3 py-3" style="color:#1e3a5f;">Gambar</th>
                        <th class="text-center px-3 py-3" style="color:#1e3a5f;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product as $p)
                    <tr class="table-row-hover border-bottom"
                        style="transition: background .15s;">
                        {{-- No --}}
                        <td class="text-center text-muted fw-bold px-3">{{ $loop->iteration }}</td>

                        {{-- Nama --}}
                        <td class="px-3">
                            <div class="fw-semibold" style="color:#1e3a5f;">{{ $p->name }}</div>
                            @if($p->category)
                            <small class="text-muted">{{ $p->category->name }}</small>
                            @endif
                        </td>

                        {{-- Harga --}}
                        <td class="text-center px-3">
                            <span class="badge rounded-pill px-3 py-2"
                                  style="background-color:#e8f4ff; color:#2563eb; font-size:.85rem; font-weight:600;">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- Stok --}}
                        <td class="text-center px-3">
                            @if($p->stock > 10)
                                <span class="badge rounded-pill bg-success px-3 py-2" style="font-size:.82rem;">
                                    {{ $p->stock }}
                                </span>
                            @elseif($p->stock > 0)
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2" style="font-size:.82rem;">
                                    {{ $p->stock }}
                                </span>
                            @else
                                <span class="badge rounded-pill bg-danger px-3 py-2" style="font-size:.82rem;">
                                    Habis
                                </span>
                            @endif
                        </td>

                        {{-- Gambar --}}
                        <td class="text-center px-3">
                            @if($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}"
                                     alt="{{ $p->name }}"
                                     class="rounded"
                                     style="width:64px; height:64px; object-fit:cover; border: 2px solid #dce8ff;">
                            @else
                                <div class="d-flex align-items-center justify-content-center rounded"
                                     style="width:64px;height:64px;background:#f0f5ff;margin:auto;">
                                    <i class="bi bi-image text-muted" style="font-size:1.5rem;"></i>
                                </div>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center px-3">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('product.edit', $p->id) }}"
                                   class="btn btn-sm btn-outline-warning d-flex align-items-center gap-1"
                                   title="Edit Produk">
                                    <i class="bi bi-pencil-fill"></i>
                                    <span class="d-none d-lg-inline">Edit</span>
                                </a>
                                <a href="{{ route('product.hapus', $p->id) }}"
                                   class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                   title="Hapus Produk"
                                   onclick="return confirm('Yakin ingin menghapus produk \'{{ addslashes($p->name) }}\'?')">
                                    <i class="bi bi-trash-fill"></i>
                                    <span class="d-none d-lg-inline">Hapus</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size:2.5rem; color:#c0d0e8;"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada data produk.</p>
                            <a href="{{ route('product.tambah') }}" class="btn btn-primary btn-sm mt-3">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Sekarang
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Card Footer --}}
    @if($product->count() > 0)
    <div class="card-footer border-0 px-4 py-2"
         style="background:#f8fbff; font-size:.82rem; color:#6c7fa8;">
        Menampilkan <strong>{{ $product->count() }}</strong> produk &nbsp;|&nbsp;
        Total nilai stok:
        <strong>
            Rp {{ number_format($product->sum(function($p){ return $p->price * $p->stock; }), 0, ',', '.') }}
        </strong>
    </div>
    @endif
</div>

<style>
    .table-row-hover:hover {
        background-color: #f0f5ff !important;
    }
</style>

@endsection
