<!-- Bikin menu navigasi di atas pake class bootsrap navbar-dark background item (bg-dark) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <!-- Tombol balik ke halaman utama -->
    <a class="navbar-brand fw-bold" href="/">OP Store</a>

    <!-- auth artinya cuma muncul kalo usernya UDAH login -->
    @auth
        <div class="d-flex align-items-center">
        @if(Auth::user()->role == 'admin')
            <a class="nav-link text-white me-3" href="/product">Data Produk</a>
        @endif
        
        <a class="btn btn-danger btn-sm" href="/logout">Logout</a>
        </div>
    @endauth

    <!-- guest artinya cuma muncul kalo usernya BELUM login -->
    @guest
        <a class="btn btn-light text-primary fw-bold" href="/login">Login</a>
    @endguest
  </div>
</nav>
