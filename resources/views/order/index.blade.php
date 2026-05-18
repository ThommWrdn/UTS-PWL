@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
</head>
<body>

    <h2>Daftar Produk</h2>

    @foreach($product as $p)
        <div style="border:1px solid #ccc; padding:15px; margin-bottom:10px;">
            
            <h3>{{ $p->name }}</h3>
            @if($p->gambar)
                <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->name }}" style="max-height: 100px; display: block; margin-bottom: 10px;">
            @endif
            <p>Harga : Rp {{ number_format($p->price,0,',','.') }}</p>
            <p>Stok : {{ $p->stock }}</p>

            <form action="{{ route('order.store') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $p->id }}">

                <label>Jumlah:</label>
                <input type="number" name="jumlah" min="1" max="{{ $p->stock }}" required>

                <button type="submit">Tambah</button>
            </form>

        </div>
    @endforeach

</body>
</html>
@endsection