<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <!--cdn fontawessome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f8fa;
        }

        /* Sidebar */
        .sidebar {
            background-color: #ffffff;
            min-height: 100vh;
            border-right: 1px solid #dee2e6;
        }

        .sidebar h4 {
            padding: 20px;
            margin: 0;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 15px 20px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #D9E8FF;
            color: #000;
        }

        /* Top bar */
        .topbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        /* Stat Cards */
        .card-stats {
            color: #fff;
            border: none;
            text-align: center;
        }

        .bg-blue {
            background-color: #0d6efd;
        }

        .bg-purple {
            background-color: #6f42c1;
        }

        .bg-pink {
            background-color: #d63384;
        }

        .bg-green {
            background-color: #198754;
        }

        .card-stats .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 120px;
        }

        .card-stats h5 {
            margin: 0;
            font-size: 2rem;
            font-weight: bold;
        }

        .card-stats p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Grafik */
        .chart-container {
            width: 100%;
            position: relative;
            /* Bisa beri min-height agar tidak terlalu kecil */
            min-height: 300px;
        }

        /* Pastikan canvas memenuhi lebar container */
        .chart-container canvas {
            width: 100% !important;
            height: auto !important;
        }

        /* Info Card */
        .info-card p {
            margin: 0;
            font-size: 0.9rem;
        }

        .info-card h5 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .progress-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }

        .progress-circle .value {
            position: absolute;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-12 col-md-2 sidebar">
                <h4>ADMIN PANEL</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door" style="font-size: 20px;"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pengguna') }}"><i class="bi bi-people me-2" style="font-size: 20px;"></i>Pengguna</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-bullhorn" style="font-size: 20px;"></i>Pengumuman</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.loker') }}"><i class="bi bi-briefcase me-2" style="font-size: 20px;"></i> Info Loker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('relasi.dashboard') }}"><i class="fa-solid fa-industry"></i> Relasi Perusahaan</a>
                    </li>
                </ul>
            </div>
            <!-- Main Content -->
            <div class="col">
                <!-- Top Bar -->
                <nav class="navbar topbar">
                    <div class="container-fluid">
                        <span class="navbar-text fw-bold">
                            Halo, Selamat datang Admin
                        </span>
                        <div>
                            <span class="navbar-text me-3">Admin</span>
                            <a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </nav>

                <div class="container-fluid mt-4">
                    <!-- Stat Cards: 4 kolom -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats bg-blue">
                                <div class="card-body">
                                    <h5>{{ $countUser }}</h5>
                                    <p>Jumlah Pengguna</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats bg-purple">
                                <div class="card-body">
                                    <h5>{{ $countTersedia }}</h5>
                                    <p>Jumlah Lowongan yang tersedia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats bg-pink">
                                <div class="card-body">
                                    <h5>{{ $countRelation }}</h5>
                                    <p>Jumlah Relasi Perusahaan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats bg-green">
                                <div class="card-body">
                                    <h5>{{ $countloker }}</h5>
                                    <p>Lowongan yang Terdaftar</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="row g-3">
                        <!-- Bar Chart -->
                        <div class="col-md-8">
                            <div class="card h-100">
                                <div class="card-header fw-bold">Lowongan Pekerjaan</div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart + Info -->
                        <div class="col-md-4">
                            <div class="card mb-3 h-100">
                                <div class="card-header fw-bold">Jumlah Persentase Data</div>
                                <div class="card-body">
                                    <div class="chart-container" style="max-height:350px;">
                                        <canvas id="donutChart"></canvas>
                                    </div>
                                    <!-- <div class="card info-card">
                                        <div class="card-body d-flex justify-content-around">
                                            <div class="text-center">
                                                <div class="card info-card" style="max-height: 50px;">
                                                    <p>Terdaftar</p>
                                                    <canvas id="myPieChart"></canvas>
                                                    <h5>50 Orang</h5>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="card-body">
                                                    <p>Diterima</p>
                                                    <h5>35 Orang</h5>
                                                </div>

                                            </div>
                                            <div class="text-center">
                                                <p>Tidak Diterima</p>
                                                <h5>15 Orang</h5>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- End row -->
                </div> <!-- End container-fluid mt-4 -->
            </div> <!-- End col (Main Content) -->
        </div> <!-- End row -->
    </div> <!-- End container-fluid -->

    <!-- Bootstrap Bundle JS (termasuk Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data dari Controller
        const companyNames = JSON.parse('{!! json_encode($NamaPerusahaan) !!}');
        const applicantCounts = JSON.parse('{!! json_encode($hitungtujuanUser) !!}');
    </script>

    <script>
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: companyNames,
                datasets: [{
                    label: 'Jumlah Pelamar',
                    data: applicantCounts,
                    backgroundColor: companyNames.map(() => 'rgba(54, 162, 235, 0.7)')
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pelamar'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Perusahaan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => `${ctx.parsed.y} pelamar`
                        }
                    }
                }
            }
        });
    </script>

    <!-- Pastikan ini berada di dalam tag <script> yang benar -->
    <script>
        // Mendefinisikan data untuk chart
        const dataMenunggu = JSON.parse('{!! json_encode($countMenunggu) !!}');
        const dataDiterima = JSON.parse('{!! json_encode($countDiterima) !!}');
        const dataDitolak = JSON.parse('{!! json_encode($countDitolak) !!}');
    </script>

    <script>
        // Inisialisasi Donut Chart
        const donutCtx = document.getElementById('donutChart').getContext('2d');
        const donutChart = new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [dataMenunggu, dataDiterima, dataDitolak],
                    backgroundColor: [
                        'rgba(13,110,253,0.8)', // Biru = Menunggu
                        'rgba(25,135,84,0.8)', // Hijau = Diterima
                        'rgba(220,53,69,0.8)' // Merah = Ditolak
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Inisialisasi Pie Chart Kecil
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Menunggu', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [dataMenunggu, dataDiterima, dataDitolak],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html>