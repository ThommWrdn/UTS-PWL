@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-receipt me-2"></i>Detail Pesanan #{{ $order->id }}</h4>
                <span class="badge bg-{{ $order->status == 'pending' ? 'warning text-dark' : ($order->status == 'success' ? 'success' : 'secondary') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="text-muted mb-1">Informasi Pemesanan</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="150" class="text-secondary">Tanggal</th>
                                <td>: {{ $order->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Nama Pemesan</th>
                                <td>: {{ $order->user->name ?? 'User' }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Status Pesanan</th>
                                <td>: {{ ucfirst($order->status) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h5 class="mb-3 text-secondary"><i class="bi bi-box-seam me-2"></i>Daftar Produk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th class="text-start">Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->orderDetails as $index => $detail)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <span class="fw-medium">{{ $detail->product->name ?? 'Produk Dihapus' }}</span>
                                </td>
                                <td class="text-center align-middle">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="text-center align-middle">{{ $detail->quantity }}</td>
                                <td class="text-end align-middle fw-medium text-success">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada detail produk</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end fs-5">Total Bayar</th>
                                <th class="text-end text-success fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 text-start">
                    <a href="{{ route('order.history') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
