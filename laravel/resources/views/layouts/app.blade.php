<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BKK SMKN 2 Kota Bekasi')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        @include('partials.navbar') <!-- Tambahkan navbar jika ada -->
    </header>

    <main class="py-4">
        <div class="container">
            @yield('content') <!-- Tempat untuk konten halaman -->
        </div>
    </main>

    <footer class="text-center py-4">
        <p>&copy; {{ date('Y') }} BKK SMKN 2 Kota Bekasi. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>