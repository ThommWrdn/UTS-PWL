@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-receipt me-2"></i>Detail Pesanan #{{ $order->id }}</h4>
                @if($order->status === 'pending')
                    <span class="badge bg-warning text-dark fs-6">
                        <i class="bi bi-hourglass-split me-1"></i>Pending
                    </span>
                @elseif($order->status === 'delivery')
                    <span class="badge bg-info text-white fs-6">
                        <i class="bi bi-truck me-1"></i>Delivery
                    </span>
                @elseif($order->status === 'delivered')
                    <span class="badge text-white fs-6" style="background-color:#fd7e14">
                        <i class="bi bi-box-seam me-1"></i>Delivered
                    </span>
                @elseif($order->status === 'success')
                    <span class="badge bg-success fs-6">
                        <i class="bi bi-check-circle-fill me-1"></i>Success
                    </span>
                @endif
            </div>
            <div class="card-body">

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

                <div class="mt-4 d-flex gap-2 flex-wrap">

                    {{-- Tombol Kembali: beda tujuan berdasarkan role --}}
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.orders') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Kelola Pesanan
                        </a>
                    @else
                        <a href="{{ route('order.history') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Riwayat
                        </a>
                    @endif

                    {{-- [ADMIN] Tombol aksi berdasarkan status --}}
                    @if(Auth::user()->role === 'admin')
                        @if($order->status === 'pending')
                            <form action="{{ route('admin.order.approve', $order->id) }}" method="POST"
                                  onsubmit="return confirm('Setujui pesanan #{{ $order->id }}?')">
                                @csrf
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-truck me-1"></i>Setujui (Kirim Delivery)
                                </button>
                            </form>
                        @elseif($order->status === 'delivered')
                            <form action="{{ route('admin.order.complete', $order->id) }}" method="POST"
                                  onsubmit="return confirm('Tandai pesanan #{{ $order->id }} sebagai selesai?')">
                                @csrf
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-check2-circle me-1"></i>Tandai Selesai
                                </button>
                            </form>
                        @endif
                    @endif

                    {{-- [USER] Konfirmasi diterima saat status delivery --}}
                    @if(Auth::user()->role === 'user' && $order->status === 'delivery' && $order->user_id === Auth::id())
                        <form action="{{ route('order.confirm', $order->id) }}" method="POST"
                              onsubmit="return confirm('Konfirmasi bahwa barang sudah diterima?')">
                            @csrf
                            <button type="submit" class="btn btn-warning text-dark fw-semibold px-4">
                                <i class="bi bi-hand-thumbs-up me-1"></i>Konfirmasi Diterima
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
