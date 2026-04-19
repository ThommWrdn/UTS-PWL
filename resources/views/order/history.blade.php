@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Pesanan</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="bg-light">
                    <tr>
                        <th width="10%" class="text-center">ID Pesanan</th>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Status</th>
                        <th width="25%">Total Harga</th>
                        <th width="25%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $o)
                    <tr>
                        <td class="text-center align-middle fw-bold">#{{ $o->id }}</td>
                        <td class="align-middle">{{ $o->created_at->format('d M Y H:i') }}</td>
                        <td class="align-middle">
                            <span class="badge bg-{{ $o->status == 'pending' ? 'warning text-dark' : ($o->status == 'success' ? 'success' : 'secondary') }}">
                                {{ ucfirst($o->status) }}
                            </span>
                        </td>
                        <td class="align-middle fw-medium">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('order.detail', ['id' => $o->id]) }}" class="btn btn-info btn-sm text-white shadow-sm" title="Lihat Detail">
                                <i class="bi bi-eye"></i> Detail
                            </a>
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
