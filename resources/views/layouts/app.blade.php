<!DOCTYPE html>
<html>
<head>
    <!-- Judul yang nongol di tab browser -->
    <title>OP Store</title>

    <!-- Bootstrap CDN, diambil langsung dari internet biar gampang ngga usah download -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<!-- Masukin file html (blade) lain, yaitu navigasi bar -->
@include('layouts.navbar')

<!-- Container bootstrap biar isinya ketengah dan rapi, mt-3 itu margin-top -->
<div class="container mt-4 mb-5">
    <!-- Di sinilah konten dari file view lain yang pake extends akan dimuntahin (muncul) -->
    @yield('content')
</div>

<!-- Bootstrap Javascript (Wajib untuk membuat Toast jalan!) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Area Notifikasi Toast Global -->
@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body fw-bold">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var toastEl = document.getElementById('liveToast');
        if (toastEl) {
            // Fix penambahan parameter option object koma yang sebelumnya hilang
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 3500 // 3.5 detik
            });
            toast.show();
        }
    });
</script>
@endif

</body>
</html>
