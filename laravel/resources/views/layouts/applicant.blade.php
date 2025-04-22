<!-- resources/views/layouts/applicant.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Applicant Layout</title>
    <!-- Contoh Bootstrap CSS, sesuaikan dengan projekmu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya minimalis contoh */
        body {
            background-color: #f8f9fa;
        }

        .nav-applicant {
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        }

        .nav-applicant .navbar-brand {
            margin-left: 1rem;
        }
    </style>
</head>

<body>

    <nav class="navbar nav-applicant">
        <a class="navbar-brand" href="#">Dashboard Perusahaan</a>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>