@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="mb-0"><i class="bi bi-basket2 me-2"></i>Manajemen Pesanan</h2>
        <p class="text-muted mb-0">Kelola dan setujui semua pesanan dari user</p>
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
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th width="8%"  class="text-center">ID</th>
                        <th width="18%">User</th>
                        <th width="17%">Tanggal</th>
                        <th width="15%">Status</th>
                        <th width="17%">Total Harga</th>
                        <th width="25%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="text-center fw-bold">#{{ $order->id }}</td>
                        <td>
                            <i class="bi bi-person-circle me-1 text-secondary"></i>
                            {{ $order->user->name ?? 'User Dihapus' }}
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @php
                                $statusMap = [
                                    'pending'   => ['bg-warning text-dark', 'bi-hourglass-split',   'Pending'],
                                    'delivery'  => ['bg-info text-white',   'bi-truck',             'Delivery'],
                                    'delivered' => ['bg-orange text-white', 'bi-box-seam',          'Delivered'],
                                    'success'   => ['bg-success',           'bi-check-circle-fill', 'Success'],
                                ];
                                $s = $statusMap[$order->status] ?? ['bg-secondary', 'bi-question-circle', ucfirst($order->status)];
                            @endphp
                            <span class="badge {{ $s[0] }}">
                                <i class="bi {{ $s[1] }} me-1"></i>{{ $s[2] }}
                            </span>
                        </td>
                        <td class="fw-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center flex-wrap">

                                {{-- Tombol Detail --}}
                                <a href="{{ route('admin.order.detail', $order->id) }}"
                                   class="btn btn-sm btn-outline-secondary" title="Lihat Detail">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>

                                {{-- [ADMIN] Setujui: pending → delivery --}}
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.order.approve', $order->id) }}" method="POST"
                                          onsubmit="return confirm('Setujui pesanan #{{ $order->id }}? Barang akan mulai dikirim.')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-truck me-1"></i>Setujui
                                        </button>
                                    </form>

                                {{-- Status delivery: menunggu konfirmasi user --}}
                                @elseif($order->status === 'delivery')
                                    <span class="badge bg-light text-muted border">
                                        <i class="bi bi-clock me-1"></i>Menunggu User
                                    </span>

                                {{-- Status success: selesai --}}
                                @elseif($order->status === 'success')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        <i class="bi bi-check-all me-1"></i>Selesai
                                    </span>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Badge warna orange (delivered) dengan CSS inline --}}
<style>
    .bg-orange { background-color: #fd7e14 !important; }
</style>
@endsection
