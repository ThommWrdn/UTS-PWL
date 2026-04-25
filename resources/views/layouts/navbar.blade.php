<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">OP Store</a>

    @auth
        <div class="d-flex align-items-center">
            @if(Auth::user()->role == 'admin')
                <a class="nav-link text-white me-3" href="/product">Data Produk</a>
                <a class="nav-link text-white me-3" href="/category">Kategori</a>
                <a class="nav-link text-white me-3" href="{{ route('admin.orders') }}">Kelola Pesanan</a>
            @else
                <a class="nav-link text-white me-3" href="{{ route('order.index') }}">Belanja</a>
                <a class="nav-link text-white me-3" href="{{ route('order.history') }}">Riwayat Pesanan</a>
            @endif
            
            <a class="btn btn-danger btn-sm" href="/logout">Logout</a>
        </div>
    @endauth

    @guest
        <a class="btn btn-light text-primary fw-bold" href="/login">Login</a>
    @endguest
  </div>
</nav>
