<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKK - Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- font family -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:wght@600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:wght@600&display=swap');
    </style>

    <!---briefcase--->

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="../assets/css/styleadmin.css" rel="stylesheet">

    <script>
        function showPage(page, element) {
            // Hapus kelas aktif dari semua tautan sidebar
            let links = document.querySelectorAll(".sidebar a");
            links.forEach(link => link.classList.remove("active"));
            element.classList.add("active");

            // Sembunyikan semua halaman konten
            let pages = document.querySelectorAll(".content-page");
            pages.forEach(p => p.style.display = "none");

            // Tampilkan halaman yang dipilih
            if (page === 'dashboard') {
                document.getElementById("dashboardContent").style.display = "block";
            } else if (page === 'users') {
                document.getElementById("usersContent").style.display = "block";
            } else if (page === 'announcement') {
                document.getElementById("announcementContent").style.display = "block";
            } else if (page === 'relation') {
                document.getElementById("relationContent").style.display = "block";
            } else if (page === 'lokers') {
                document.getElementById("lokersContent").style.display = "block";
            }
        }

        //backed form tambah kj
    </script>
</head>

<body>
    <div class="sidebar">
        <h4 class="admin-panel-title" style="display: flex; justify-content: center; align-items: center;">Admin panel</h4>
        <a onclick="showPage('dashboard', this)" class="active"><i class="bi bi-house-door" style="font-size: 24px;"></i> Dashboard</a>
        <a onclick="showPage('users', this)"><i class="bi bi-person" style="font-size: 24px;"></i> Pengguna</a>
        <a onclick="showPage('relation', this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" fill="currentColor" class="bi bi-suitcase-lg" viewBox="0 0 16 16">
                <path d="M5 2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2h3.5A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5H14a.5.5 0 0 1-1 0H3a.5.5 0 0 1-1 0h-.5A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2zm1 0h4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H3V3zM15 12.5v-9a.5.5 0 0 0-.5-.5H13v10h1.5a.5.5 0 0 0 .5-.5m-3 .5V3H4v10z" />
            </svg>
            Tambah relasi
        </a>
        <a onclick="showPage('lokers', this)"><i class="bi bi-briefcase" style="font-size: 20px; margin: left 20px;"></i>Tambah Loker</a>
    </div>
    <div class="main-container">
        <div class="topbar">
            <!-- Top bar halaman admin -->
            <div>
                halo selamat datang {{ Auth :: user()->nama }}
            </div>
            <div class="profile-menu">
                <span>{{ Auth :: user()->nama }} <i class="fas fa-chevron-down"></i></span>
                <div class="profile-dropdown">
                    <a href="#"><i class="fas fa-key"></i> Ubah Password</a>
                    <a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        <div class="content">
            <!-- Halaman Dashboard -->
            <div id="dashboardContent" class="content-page" style="display: block;">
                <div class="row">
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card" style="background-color: #683ABB; color: white;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa-solid fa-user" style="color: white; font-size:55px"></i>
                                    <h3 class="mb-0 w-100 text-center" style="color: white; font-size:45px">{{$countUser}}</h3>
                                </div>
                                <p class="mb-0 mt-2" style="color: white;">Jumlah Pengguna</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card" style="background-color: #1984FC; color: white;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa-solid fa-suitcase" style="color: white; font-size:55px"></i>
                                    <h3 class="mb-0 w-100 text-center" style="color: white; font-size:45px">{{ $countloker }}</h3>
                                </div>
                                <p class="mb-0 mt-2" style="color: white;">Jumlah Lowongan Kerja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card" style="background-color:red; color: white;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa-solid fa-industry" style="color: white; font-size:55px"></i>
                                    <h3 class="mb-0 w-100 text-center" style="color: white; font-size:45px">{{ $countRelation }}</h3>
                                </div>
                                <p class="mb-0 mt-2" style="color: white;">Jumlah Relasi Perusahaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card" style="background-color:#DB3C81; color:white">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa-solid fa-user-tie" style="color: white; font-size:55px"></i>
                                    <h3 class="mb-0 w-100 text-center" style="color: white; font-size:45px">0</h3>
                                </div>
                                <p class="mb-0 mt-2" style="color: white;"> Jumlah Lowongan Yang tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Halaman Pengguna -->
            <div id="usersContent" class="content-page" style="display: none;">
                <div class="container mt-5 position-relative">
                    <!-- Card Section (Positioned Behind the Table) -->
                    <div class="card position-absolute w-100" style="top: 20px; left: 0; z-index: -1;">
                        <div class="card-header">
                            <h5>Informasi Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ini adalah card yang berada di belakang tabel. Anda bisa menambahkan informasi lebih lanjut atau elemen lain di dalam card ini.</p>
                            <button class="btn btn-primary">Lihat Detail</button>
                        </div>
                    </div>

                    <!-- Table and Search Bar -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Daftar User</h1>
                        <button class="btn btn-danger">Tambah User</button>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Cari...">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center">
                        <nav class="align-items-center">
                            <ul class="pagination align-items-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Halaman pengumuman -->
            <div id="announcementContent" class="content-page" style="display: none;">
                <h2>Tambah Pengumuman</h2>
                <p>Ini adalah halaman tambah pengumuman umum</p>
            </div>
            <!-- Halaman relasi -->
            <div id="relationContent" class="content-page" style="display: none;">
                <h2>Tambah Jobstreet</h2>
                <p>Ini adalah halaman tambah info loker</p>
            </div>
            <!-- Halaman loker -->
            <div id="lokersContent" class="content-page" style="display: none;">
                <!-- Tombol Tambah Lowongan -->
                <div class="text-end">
                    <button class="btn btn-danger my-3" onclick="toggleForm()">
                        <i class="fas fa-plus"></i> Tambah Lowongan Pekerjaan
                    </button>


                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const ctx = document.getElementById('jobChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret'],
            datasets: [{
                    label: 'Wingsfood',
                    data: [20, 30, 40],
                    backgroundColor: 'green'
                },
                {
                    label: 'Bridgestone',
                    data: [50, 70, 90],
                    backgroundColor: 'blue'
                },
                {
                    label: 'Shinto Kogyo',
                    data: [15, 25, 35],
                    backgroundColor: 'purple'
                },
                {
                    label: 'Mayora',
                    data: [25, 30, 20],
                    backgroundColor: 'red'
                },
                {
                    label: 'Astra',
                    data: [80, 70, 60],
                    backgroundColor: 'yellow'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
    const ctx2 = document.getElementById('percentageChart');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Terdaftar', 'Diterima', 'Tidak Diterima'],
            datasets: [{
                data: [50, 35, 15],
                backgroundColor: ['blue', 'green', 'red']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>

</html>