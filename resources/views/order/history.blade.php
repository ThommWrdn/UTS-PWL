@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Pesanan</h2>
    </div>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="bg-light">
                    <tr>
                        <th width="10%" class="text-center">ID Pesanan</th>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Status</th>
                        <th width="20%">Total Harga</th>
                        <th width="30%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $o)
                    <tr>
                        <td class="text-center align-middle fw-bold">#{{ $o->id }}</td>
                        <td class="align-middle">{{ $o->created_at->format('d M Y H:i') }}</td>
                        <td class="align-middle">
                            @if($o->status === 'pending')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-hourglass-split me-1"></i>Pending
                                </span>
                            @elseif($o->status === 'delivery')
                                <span class="badge bg-info text-white">
                                    <i class="bi bi-truck me-1"></i>Delivery
                                </span>
                            @elseif($o->status === 'delivered')
                                <span class="badge text-white" style="background-color:#fd7e14">
                                    <i class="bi bi-box-seam me-1"></i>Delivered
                                </span>
                            @elseif($o->status === 'success')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>Success
                                </span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($o->status) }}</span>
                            @endif
                        </td>
                        <td class="align-middle fw-medium">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td class="text-center align-middle">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('order.detail', ['id' => $o->id]) }}"
                                   class="btn btn-info btn-sm text-white shadow-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                {{-- Tombol Konfirmasi Diterima: hanya saat status delivery --}}
                                @if($o->status === 'delivery')
                                    <form action="{{ route('order.confirm', $o->id) }}" method="POST"
                                          onsubmit="return confirm('Konfirmasi bahwa barang sudah diterima?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning text-dark fw-semibold">
                                            <i class="bi bi-hand-thumbs-up me-1"></i>Konfirmasi Diterima
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                            Baru daftar? Yuk mulai belanja dan nikmati produk-produk terbaik kami!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
