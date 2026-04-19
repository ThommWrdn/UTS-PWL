@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="mb-0"><i class="bi bi-tags me-2"></i>Daftar Kategori</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('category.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th>Nama Kategori</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="text-center align-middle">{{ $category->id }}</td>
                        <td class="align-middle fw-medium">{{ $category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-warning btn-sm text-dark px-3" title="Edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="{{ route('category.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-sm px-3" onclick="return confirm('Yakin ingin menghapus kategori ini?')" title="Hapus">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            Belum ada Kategori
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
