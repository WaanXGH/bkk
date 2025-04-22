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

        /* Styling custom untuk tampilan tabel yang lebih soft */
        .table-soft {
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table-soft thead {
            background-color: #f8f9fa;
        }

        .table-soft th,
        .table-soft td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .table-soft tbody tr:last-child td {
            border-bottom: none;
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door" style="font-size: 20px;"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.pengguna') }}"><i class="bi bi-people me-2"></i> Pengguna</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-bullhorn me-2"></i> Pengumuman</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.loker') }}"><i class="bi bi-briefcase me-2"></i> Info Loker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('relasi.dashboard')}}"><i class="fa-solid fa-industry"></i> Relasi Perusahaan</a>
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

                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center" style="margin-top: 80px;">
                        <h4>Kelola Data Pengguna</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">+ Tambah
                    </div>

                    <div class="card shadow-sm" style="margin-top: 50px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover table-soft">
                                    <thead class="table-light">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Profil</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Email</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil" class="rounded-circle" width="50" height="50"></td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->NIK }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    onclick="openEditModal('{{ $user->id }}', '{{ $user->nama }}', '{{ $user->email }}')"
                                                    class="btn btn-sm btn-warning me-1">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end table section-->


                </div>
            </div> <!-- End row -->


            <!-- Modal Tambah Pengguna -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="userModalLabel">Form Menambah akun user</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap..." name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Masukkan email..." name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Password</label>
                                    <input type="email" class="form-control" id="password" placeholder="Masukkan Password..." name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">konfirmasi password</label>
                                    <input type="email" class="form-control" id="confirm_password" placeholder="Konfirmasi Password..." name="confirm_password" required>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: red;">Batal</button>
                                <button type="submit" class="btn btn-primary">Buat Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- End container-fluid -->

        <!-- Modal Edit Pengguna -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('user.update' ,'') }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-header position-relative">
                            <h5 class="modal-title w-100 text-center" id="editUserModalLabel">Form Edit Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editNama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="editnama" name="nama" placeholder="Masukkan Nama Lengkap..." required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editemail" name="email" placeholder="Masukkan Email..." required>
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Password Baru (Opsional)</label>
                                <input type="password" class="form-control" id="editpassword" name="password" placeholder="Masukkan Password Baru...">
                            </div>
                            <div class="mb-3">
                                <label for="editConfirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="editconfirmpassword" name="confirm_password" placeholder="Konfirmasi Password Baru...">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: red;">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap Bundle JS (termasuk Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function openEditModal(id, nama, email) {
                // Set form action dengan ID pengguna
                const form = document.getElementById('editUserForm');
                form.action = `{{ route('user.update', ':id') }}`.replace(':id', id);

                // Isi data ke input modal
                document.getElementById('editnama').value = nama;
                document.getElementById('editemail').value = email;

                // Kosongkan password fields
                document.getElementById('editpassword').value = '';
                document.getElementById('editconfirmpassword').value = '';

                // Tampilkan modal
                const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editUserModal.show();
            }
        </script>
</body>

</html>