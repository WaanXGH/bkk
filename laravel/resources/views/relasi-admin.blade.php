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

        /* Styling tabel agar lebih responsif dan sejajar */
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
            text-align: center;
            /* Horizontal alignment */
            vertical-align: middle;
            /* Vertical alignment */
        }

        .table-soft tbody tr:last-child td {
            border-bottom: none;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            /* Memastikan gambar tetap responsif */
        }

        .btn i {
            margin-right: 5px;
            /* Memberikan jarak antara ikon dan teks */
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
                        <a class="nav-link " href="{{ route('admin.loker') }}"><i class="bi bi-briefcase me-2"></i> Info Loker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{('') }}"><i class="fa-solid fa-industry"></i> Relasi Perusahaan</a>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">+ Tambah </button>
                    </div>

                    <div class="card shadow-sm" style="margin-top: 50px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-soft">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Tanggal Diupload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($relasi as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->image_p) }}" class="img-fluid" alt="logo perusahaan" style="max-height: 150px;">
                                            </td>
                                            <td class="td-main">{{Str::limit(strip_tags($item->nama_p),30) }}</td>
                                            <td class="td-main">{{ $item->created_at }}</td>
                                            <td class="td-main">
                                                <!-- <a href="{{ route('relasi.dashboard', $item->id) }}" class="btn btn-sm btn-primary me-1">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </a> -->
                                                <a href="javascript:void(0)"
                                                    onclick="openEditModal('{{ $item->id }}', '{{ $item->nama_p }}', '{{ Storage::url($item->image_p) }}')"
                                                    class="btn btn-sm btn-warning me-1">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>

                                                <form action="{{ route('relasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <form action="{{ route('tambah-relasi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="userModalLabel">Form Menambah Informasi Relasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Perusahaan..." id="nama_p" name="nama_p" required>
                                </div>
                                <div class="mb-3">
                                    <div class="upload-container text-center p-4">
                                        <label for="upload-input" class="d-block border border-dashed p-4 rounded">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                            </div>
                                            <p class="mb-1" style="font-size: 20px;">Tarik dan taruh dokumen disini</p>
                                            <p class="text-muted" style="font-size: 12px;">Format file: JPG, PNG, SVG, PDF</p>
                                            <span class="btn btn-primary">Upload</span>
                                        </label>
                                        <input type="file" id="upload-input" class="d-none" accept="image/*" name="image_p">
                                        <div id="preview-container" class="position-relative mt-3" style="display: none;">
                                            <img id="preview-image" src="" alt="Preview Gambar" style="max-width: 100%; height: auto; border-radius: 5px;">
                                            <button id="cancel-upload" class="btn-close position-absolute top-0 end-0" style="background-color: white; border: 1px solid #ccc; cursor: pointer;">&times;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: red;">Batal</button>
                                <button type="submit" class="btn btn-primary">Buat Relasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal edit Pengguna -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('relasi.update', '') }}" method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="editModalLabel">Edit Relasi Perusahaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="relasi_id" id="edit_relasi_id">
                                <div class="mb-3">
                                    <label for="edit_nama_p" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="edit_nama_p" name="nama_p" required>
                                </div>
                                <div class="mb-3">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Logo Saat Ini</label>
                                        <img id="current_image" src="" alt="Logo perusahaan" class="img-thumbnail d-block" style="max-height: 150px;">
                                    </div>
                                    <div class="upload-container text-center p-4">
                                        <label for="edit_image_p" class="d-block border border-dashed p-4 rounded">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                            </div>
                                            <p class="mb-1" style="font-size: 20px;">Tarik dan taruh logo baru disini</p>
                                            <p class="text-muted" style="font-size: 12px;">Format file: JPG, PNG, SVG</p>
                                            <span class="btn btn-primary">Pilih File</span>
                                        </label>
                                        <input type="file" id="edit_image_p" name="image_p" class="d-none" accept="image/*">
                                        <div id="edit-preview-container" class="position-relative mt-3" style="display: none;">
                                            <img id="edit-preview-image" src="" alt="Preview Logo Baru" style="max-width: 100%; max-height: 150px; border-radius: 5px;">
                                            <button type="button" id="edit-cancel-upload" class="btn-close position-absolute top-0 end-0" style="background-color: white; border: 1px solid #ccc;"></button>
                                        </div>
                                    </div>
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

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-header position-relative">
                                <h5 class="modal-title w-100 text-center" id="editModalLabel">Edit Relasi Perusahaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="relasi_id" id="edit_relasi_id">
                                <div class="mb-3">
                                    <label for="edit_nama_p" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="edit_nama_p" name="nama_p" required>
                                </div>
                                <div class="mb-3">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Logo Saat Ini</label>
                                        <img id="current_image" src="" alt="Logo perusahaan" class="img-thumbnail d-block" style="max-height: 150px;">
                                    </div>
                                    <div class="upload-container text-center p-4">
                                        <label for="edit_image_p" class="d-block border border-dashed p-4 rounded">
                                            <div class="upload-icon mb-2">
                                                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                            </div>
                                            <p class="mb-1" style="font-size: 20px;">Tarik dan taruh logo baru disini</p>
                                            <p class="text-muted" style="font-size: 12px;">Format file: JPG, PNG, SVG</p>
                                            <span class="btn btn-primary">Pilih File</span>
                                        </label>
                                        <input type="file" id="edit_image_p" name="image_p" class="d-none" accept="image/*">
                                        <div id="edit-preview-container" class="position-relative mt-3" style="display: none;">
                                            <img id="edit-preview-image" src="" alt="Preview Logo Baru" style="max-width: 100%; max-height: 150px; border-radius: 5px;">
                                            <button type="button" id="edit-cancel-upload" class="btn-close position-absolute top-0 end-0" style="background-color: white; border: 1px solid #ccc;"></button>
                                        </div>
                                    </div>
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

            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">+ Tambah -->

            <script>
                var quill = new Quill('#editor-container', {
                    theme: 'snow'
                });

                function submitForm() {
                    document.querySelector('#detail').value = quill.root.innerHTML;
                }
            </script>

        </div> <!-- End container-fluid -->

        <!-- Bootstrap Bundle JS (termasuk Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function openEditModal(id, nama_p, image_url) {
                const modal = document.getElementById('editModal');
                const form = document.getElementById('editForm');

                // Update form action URL
                form.action = "{{ route('relasi.update', ':id') }}".replace(':id', id);

                // Set existing values
                document.getElementById('edit_relasi_id').value = id;
                document.getElementById('edit_nama_p').value = nama_p;
                document.getElementById('current_image').src = image_url;

                // Reset new image preview
                document.getElementById('edit-preview-container').style.display = 'none';
                document.getElementById('edit_image_p').value = '';

                // Show modal
                new bootstrap.Modal(modal).show();
            }

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

            tinymce.init({
                selector: '#detail'
            });

            document.getElementById('upload-input').addEventListener('change', function(e) {
                const fileName = e.target.files[0].name;
                alert(`File "${fileName}" berhasil dipilih!`);
            });

            //script buat texteditor
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });

            function submitForm(event) {
                event.preventDefault();
                document.querySelector('#detail').value = quill.root.innerHTML;

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