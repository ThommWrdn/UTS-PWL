@extends('layouts.sidpil')

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

    @foreach($product as $item)
        <div style="border:1px solid #ccc; padding:15px; margin-bottom:10px;">
            
            <h3>{{ $item->name }}</h3>
            <p>Harga : Rp {{ number_format($item->price,0,',','.') }}</p>
            <p>Stok : {{ $item->stock }}</p>

            <form action="{{ route('order.store') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $item->id }}">

                <label>Jumlah:</label>
                <input type="number" name="jumlah" min="1" max="{{ $item->stock }}" required>

                <button type="submit">Tambah</button>
            </form>

        </div>
    @endforeach

</body>
</html>
@endsection