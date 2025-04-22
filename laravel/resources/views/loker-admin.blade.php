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

    <!--API text editor -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

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
            padding: 10px 10px;
            border-bottom: 1px solid #e9ecef;
            text-align: center;
        }

        .table-soft tbody tr:last-child td {
            border-bottom: none;
        }

        .upload-container {
            background-color: #f9f9f9;
            border: 2px dashed #007bff;
            border-radius: 8px;
            cursor: pointer;
            max-width: 400px;
            margin: auto;
        }

        .upload-container:hover {
            background-color: #eaf3ff;
        }

        .upload-icon i {
            color: #007bff;
        }


        .td-main {
            text-align: center;
            /* Horizontal alignment */
            vertical-align: middle;
            /* Vertical alignment */
            max-width: 150px;
        }

        input[type="file"] {
            display: none;
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
                        <a class="nav-link" href="{{ route('admin.pengguna') }}"><i class="bi bi-people me-2"></i> Pengguna</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-bullhorn me-2"></i> Pengumuman</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.loker') }}"><i class="bi bi-briefcase me-2"></i> Info Loker</a>
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
                                            <th>Logo</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Detail Lowongan</th>
                                            <th>Max pelamar</th>
                                            <th>Masa Berlaku</th>
                                            <th>kisaran Gaji</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lokers as $loker)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $loker->gambar) }}" class="img-fluid" alt="logo_compani" style="max-height: 150px; max-width: 150px;">
                                            </td>
                                            <td class="td-main">{{ Str::limit(strip_tags($loker->judul), 30)  }}</td>
                                            <td class="td-main">{{ Str::limit(strip_tags($loker->detail), 50) }}</td>
                                            <td class="td-main">{{ $loker->max_pelamar }}</td>
                                            <td class="td-main">{{ $loker->tanggal_mulai }} <strong> — </strong> {{ $loker->tanggal_selesai }} </td>
                                            <td class="td-main">Rp.{{ $loker->gaji_terendah }} <strong> — </strong> Rp.{{ $loker->gaji_tertinggi }}</td>
                                            <td class="td-main">
                                                @php
                                                // Hitung jumlah pelamar
                                                $countPelamar = $loker->pelamars->count();

                                                // Periksa apakah lowongan belum dimulai (tanggal_mulai di masa depan)
                                                if(now()->lt($loker->tanggal_mulai)) {
                                                $status = 'Akan Datang';
                                                } elseif(now()->gt($loker->tanggal_selesai)) {
                                                $status = 'Kadaluarsa';
                                                } else {
                                                $status = ($countPelamar >= $loker->max_pelamar) ? 'Penuh' : 'Tersedia';
                                                }
                                                @endphp

                                                <p class="card-text">
                                                    Status:
                                                    @if($status == 'Kadaluarsa')
                                                    <span class="badge bg-warning text-dark">Kadaluarsa</span>
                                                    @elseif($status == 'Penuh')
                                                    <span class="badge bg-danger text-light">Penuh</span>
                                                    @elseif($status == 'Akan Datang')
                                                    <span class="badge bg-info text-dark">Akan Datang</span>
                                                    @else
                                                    <span class="badge bg-success">Tersedia</span>
                                                    @endif
                                                </p>

                                            </td>

                                            <td class="td-main">
                                                <a href="{{ route('admin.lihat.pelamar', $loker->id) }}" class="btn btn-sm btn-primary me-1" style="margin-bottom: 5px;">
                                                    <i class="bi bi-eye"></i> Lihat Pelamar
                                                </a>

                                                <a href="javascript:void(0)"
                                                    onclick="openEditModal(
        '{{ $loker->id }}',
        '{{ $loker->judul }}',
        '{{ Storage::url($loker->gambar) }}',
        '{{ $loker->detail }}',
        '{{ $loker->detail_s }}',
        '{{ $loker->alamat }}',
        '{{ $loker->max_pelamar }}',
        '{{ $loker->tanggal_mulai }}',
        '{{ $loker->tanggal_selesai }}',
        '{{ $loker->jobdesk }}',
        '{{ $loker->gaji_terendah }}',
        '{{ $loker->gaji_tertinggi }}'
    )"
                                                    class="btn btn-sm btn-warning me-1">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <!-- <form action="{{ route('loker.destroy', $loker->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form> -->
                                                <form action="{{ route('loker.destroy', $loker->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
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

            <!-- Modal Tambah Loker -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('new-lokers') }}" method="POST" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class=" modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="userModalLabel">Form Menambah Informasi Loker</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Perusahaan..." id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <div class="upload-container text-center p-4">
                                        <label for="upload-input" class="d-block border border-dashed p-4 rounded">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                            </div>
                                            <p class="mb-1" style="font-size: 20px;">Tarik dan taruh dokumen disini</p>
                                            <p class="text-muted" style="font-size: 12px;">Format file: JPG, PNG, SVG</p>
                                            <span class="btn btn-primary">Upload</span>
                                        </label>
                                        <input type="file" id="upload-input" class="d-none" accept="image/*" name="gambar">
                                        <div id="preview-container" class="position-relative mt-3" style="display: none;">
                                            <img id="preview-image" src="" alt="Preview Gambar" style="max-width: 100%; height: auto; border-radius: 5px;">
                                            <button id="cancel-upload" class="btn-close position-absolute top-0 end-0" style="background-color: white; border: 1px solid #ccc; cursor: pointer;">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="detail_pekerjaan">Detail Pekerjaan</label>
                                    <div id="editor" style="height: 100px;"></div>
                                    <input type="hidden" name="detail" id="detail">
                                </div>

                                <div class="mb-3">
                                    <label for="detail_pekerjaan" class="form-label">Detail Singkat</label>
                                    <div id="editor_s" style="height: 100px;"></div>
                                    <input type="hidden" name="detail_s" id="detail_s">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Perusahaan</label>
                                    <textarea class="form-control" placeholder="Masukkan alamat perusahaan..." id="alamat" name="alamat" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="jobdesk" class="form-label">Jobdesk</label>
                                    <input type="textarea" class="form-control" placeholder="Masukkan Jobdesk..." id="jobdesk" name="jobdesk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="max_pelamar" class="form-label">Maksimal Pelamar</label>
                                    <input type="number" class="form-control" placeholder="Jumlah maksimal pelamar" id="max_pelamar" name="max_pelamar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kisaran_gaji" class="form-label">Kisaran Gaji terendah</label>
                                    <input type="number" class="form-control" placeholder="Masukkan kisaran gaji terendah" id="gaji_terendah" name="gaji_terendah" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kisaran_gaji" class="form-label">Kisaran Gaji tertinggi</label>
                                    <input type="number" class="form-control" placeholder="Masukkan kisaran gaji tertinggi" id="gaji_tertinggi" name="gaji_tertinggi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="masa_berlaku" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_selesai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="masa_berlaku" class="form-label">Berlaku Hingga</label>
                                    <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: red;">Batal</button>
                                <button type="submit" class="btn btn-primary">Buat Loker</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Perhatikan action di sini tidak di-set, dan data-base-url diset untuk pengaturan dinamis -->
                        <form action="" method="POST" enctype="multipart/form-data" id="editForm" data-base-url="{{ url('loker/edit') }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="editModalLabel">Edit Loker Perusahaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Hidden input untuk ID, gunakan name "id" agar sesuai validasi jika perlu -->
                                <label for="edit_loker_id" class="form-label">ID Perusahaan</label>
                                <input type="text" class="form-control" name="id" id="edit_loker_id" readonly required>

                                {{-- Nama Perusahaan --}}
                                <div class="mb-3">
                                    <label for="edit_nama_p" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="edit_nama_p" name="judul" required>
                                </div>

                                {{-- Logo --}}
                                <div class="mb-3">
                                    <label class="form-label">Logo Saat Ini</label>
                                    <img id="current_image" src="" alt="Logo perusahaan" class="img-thumbnail d-block mb-2" style="max-height: 150px;">
                                    <label for="edit_image_p" class="form-label">Upload Logo Baru</label>
                                    <input type="file" id="edit_image_p" name="image_p" class="form-control" accept="image/*">
                                    <div id="edit-preview-container" class="mt-2" style="display: none;">
                                        <img id="edit-preview-image" src="" alt="Preview Logo Baru" style="max-width: 100%; max-height: 150px; border-radius: 5px;">
                                        <button type="button" id="edit-cancel-upload" class="btn-close position-absolute top-0 end-0"></button>
                                    </div>
                                </div>

                                {{-- Detail --}}
                                <div class="mb-3">
                                    <label for="edit_detail" class="form-label">Detail</label>
                                    <div id="edit_detail_editor" style="height: 150px;"></div>
                                    <input type="hidden" id="edit_detail" name="detail" required>
                                </div>

                                {{-- Detail Singkat --}}
                                <div class="mb-3">
                                    <label for="edit_detail_s" class="form-label">Detail Singkat</label>
                                    <div id="edit_detail_s_editor" style="height: 100px;"></div>
                                    <input type="hidden" id="edit_detail_s" name="detail_s" required>
                                </div>

                                {{-- Alamat --}}
                                <div class="mb-3">
                                    <label for="alamat_edit" class="form-label">Alamat Perusahaan</label>
                                    <textarea class="form-control" id="alamat_edit" name="alamat" rows="3" required></textarea>
                                </div>

                                {{-- Jobdesk --}}
                                <div class="mb-3">
                                    <label for="edit_jobdesk_s" class="form-label">Jobdesk</label>
                                    <textarea class="form-control" id="edit_jobdesk_s" name="jobdesk" rows="3" required></textarea>
                                </div>

                                {{-- Maksimal Pelamar --}}
                                <div class="mb-3">
                                    <label for="edit_max_pelamar" class="form-label">Maksimal Pelamar</label>
                                    <input type="number" class="form-control" id="edit_max_pelamar" name="max_pelamar" required>
                                </div>

                                {{-- Gaji Terendah --}}
                                <div class="mb-3">
                                    <label for="gaji_terendah_edit" class="form-label">Gaji Terendah</label>
                                    <input type="number" class="form-control" id="gaji_terendah_edit" name="gaji_terendah" required>
                                </div>

                                {{-- Gaji Tertinggi --}}
                                <div class="mb-3">
                                    <label for="gaji_tertinggi_edit" class="form-label">Gaji Tertinggi</label>
                                    <input type="number" class="form-control" id="gaji_tertinggi_edit" name="gaji_tertinggi" required>
                                </div>

                                {{-- Tanggal Mulai --}}
                                <div class="mb-3">
                                    <label for="edit_tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="edit_tanggal_mulai" name="tanggal_mulai" required>
                                </div>

                                {{-- Tanggal Selesai --}}
                                <div class="mb-3">
                                    <label for="edit_tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="edit_tanggal_selesai" name="tanggal_selesai" required>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




        </div> <!-- End container-fluid -->

        <script>

        </script>

        <!-- Bootstrap Bundle JS (termasuk Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.btn-delete');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Yakin ingin menghapus?',
                            text: "Data yang dihapus tidak bisa dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>



        @if($message = Session::get('failed'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $message }}",
                confirmButtonColor: '#d33'
            });
        </script>
        @endif

        @if($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "{{ $message }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
        @endif

        </script>

        <script>
            // Initialize Quill editor for detail and detail_s fields
            var quillDetail = new Quill('#edit_detail_editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link'],
                        ['clean']
                    ]
                }
            });

            // Inisialisasi Quill.js untuk "Detail Singkat"
            var quillDetailS = new Quill('#edit_detail_s_editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['clean']
                    ]
                }
            });

            var quillDetails_r = new Quill('#editor_s', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['clean']
                    ]
                }
            });

            // Salin data Quill ke input tersembunyi saat form dikirim
            document.getElementById('editForm').addEventListener('submit', function(event) {
                document.getElementById('edit_detail').value = quillDetail.root.innerHTML.trim();
                document.getElementById('edit_detail_s').value = quillDetailS.root.innerHTML.trim();

                // Validasi jika konten kosong
                if (document.getElementById('edit_detail').value === "" || document.getElementById('edit_detail_s').value === "") {
                    event.preventDefault();
                    alert("Konten tidak boleh kosong!");
                }
            });

            function openEditModal(id, judul, gambar, detail, detail_s, alamat, max_pelamar, tanggal_mulai, tanggal_selesai, jobdesk, gaji_terendah, gaji_tertinggi) {
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');

                // Update action form secara dinamis, gunakan attribute data-base-url
                const baseUrl = form.getAttribute('data-base-url');
                form.action = `${baseUrl}/${id}`;

                // Set nilai-nilai ke input-field
                document.getElementById('edit_loker_id').value = id;
                document.getElementById('edit_nama_p').value = judul;
                document.getElementById('current_image').src = gambar;
                document.getElementById('alamat_edit').value = alamat;
                document.getElementById('edit_jobdesk_s').value = jobdesk;
                document.getElementById('gaji_terendah_edit').value = gaji_terendah;
                document.getElementById('gaji_tertinggi_edit').value = gaji_tertinggi;
                document.getElementById('edit_max_pelamar').value = max_pelamar;
                document.getElementById('edit_tanggal_mulai').value = tanggal_mulai;
                document.getElementById('edit_tanggal_selesai').value = tanggal_selesai;

                // Set konten editor Quill
                quillDetail.root.innerHTML = detail;
                quillDetailS.root.innerHTML = detail_s;

                // Reset preview upload gambar baru
                document.getElementById('edit-preview-container').style.display = 'none';
                document.getElementById('edit_image_p').value = '';

                // Tampilkan modal
                new bootstrap.Modal(modal).show();
            }



            document.getElementById('editForm').addEventListener('submit', function(event) {
                document.getElementById('edit_detail').value = quillDetail.root.innerHTML.trim();
                document.getElementById('edit_detail_s').value = quillDetailS.root.innerHTML.trim();

                // Validasi jika konten kosong
                if (document.getElementById('edit_detail').value === "" || document.getElementById('edit_detail_s').value === "") {
                    event.preventDefault();
                    alert("Konten tidak boleh kosong!");
                }
            });

            // Handle new image preview
            document.getElementById('edit_image_p').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewContainer = document.getElementById('edit-preview-container');
                const previewImage = document.getElementById('edit-preview-image');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle cancel upload
            document.getElementById('edit-cancel-upload').addEventListener('click', function() {
                document.getElementById('edit-preview-container').style.display = 'none';
                document.getElementById('edit_image_p').value = '';
            });

            document.getElementById('upload-input').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewContainer = document.getElementById('preview-container');
                const previewImage = document.getElementById('preview-image');
                const cancelButton = document.getElementById('cancel-upload');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result; // Tampilkan gambar
                        previewContainer.style.display = 'block'; // Tampilkan preview container
                    };
                    reader.readAsDataURL(file); // Membaca file sebagai Data URL
                }

                // Fungsi tombol silang untuk membatalkan unggahan
                cancelButton.addEventListener('click', function() {
                    previewContainer.style.display = 'none'; // Sembunyikan preview container
                    previewImage.src = ''; // Reset gambar
                    document.getElementById('upload-input').value = ''; // Reset input file
                });
            });

            //             tinymce.init({
            //     selector: '#detail',
            //     plugins: 'lists link image table',
            //     toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image table',
            //     height: 300
            // });

            //debug gambar
            // document.getElementById('upload-input').addEventListener('change', function(e) {
            //     const fileName = e.target.files[0].name;
            //     alert(`File "${fileName}" berhasil dipilih!`);
            // });

            //script buat texteditor

            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link'], // Hanya menggunakan tombol link, tanpa upload image
                        ['align', {
                            'align': 'center'
                        }],
                        ['clean']
                    ]
                }
            });

            // Saat form disubmit, salin isi editor ke dalam input tersembunyi
            document.getElementById('myForm').addEventListener('submit', function(event) {
                // Salin konten dari editor Quill.js ke input tersembunyi
                var detailContent = quill.root.innerHTML.trim();
                var detailSContent = quillDetails_r.root.innerHTML.trim();

                // Validasi jika konten kosong
                if (detailContent === "" || detailContent === "<p><br></p>" || detailSContent === "" || detailSContent === "<p><br></p>") {
                    event.preventDefault();
                    alert("Konten tidak boleh kosong!");
                    return;
                }

                // Salin konten ke input tersembunyi
                document.getElementById('detail').value = detailContent;
                document.getElementById('detail_s').value = detailSContent;
            });


            function submitForm(event) {
                event.preventDefault();

                // Simulasi request ke backend (gantilah ini dengan request AJAX sungguhan)
                fetch('your-backend-url', {
                        method: 'POST',
                        body: new FormData(event.target)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('success-message').classList.remove('d-none');
                            document.getElementById('error-message').classList.add('d-none');
                        } else {
                            document.getElementById('error-message').classList.remove('d-none');
                            document.getElementById('success-message').classList.add('d-none');
                        }
                    })
                    .catch(() => {
                        document.getElementById('error-message').classList.remove('d-none');
                        document.getElementById('success-message').classList.add('d-none');
                    });
            }
        </script>

</body>

</html>