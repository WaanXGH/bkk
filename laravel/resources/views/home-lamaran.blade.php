@extends('layouts.app');



@section('content')



<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail {{ $lowongan->judul }}</li>
        </ol>
    </nav>

    <style>
        #upload-section {
            text-align: center;
            margin-top: 20px;
        }

        .upload-label {
            display: inline-block;
            cursor: pointer;
            color: #555;
            transition: color 0.3s ease;
        }

        .upload-label:hover {
            color: #007BFF;
        }

        .readonly-input[readonly] {
            background-color: #e9ecef;
            /* Warna abu-abu muda */
            color: #6c757d;
            /* Warna teks abu-abu */
            cursor: not-allowed;
            /* Menampilkan ikon tanda larangan */
        }
    </style>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/' .$lowongan->gambar) }}" alt="{{ $lowongan->judul }}" class="img-fluid mb-3">
                </div>
                <div class="col-md-8">
                    <h3 class="text-primary">{{ strip_tags($lowongan->judul) }}</h3>

                    @php
                    // Pastikan konsistensi variabel, gunakan $lowongan untuk tanggal mulai, tanggal selesai, dan max pelamar
                    if(now()->lt($lowongan->tanggal_mulai)) {
                    $status = 'Akan Datang';
                    } elseif(now()->gt($lowongan->tanggal_selesai)) {
                    $status = 'Kadaluarsa';
                    } else {
                    // Gunakan $pelamar_count jika sudah didefinisikan, atau misalnya $lowongan->pelamars->count()
                    $status = ($pelamar_count >= $lowongan->max_pelamar) ? 'Penuh' : 'Tersedia';
                    }
                    @endphp


                    <p class="card-text">Status:
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

                    <p class="card-text">
                        Jumlah Pelamar: {{ $pelamar_count }}<br>
                        Maksimal Pelamar: {{ $lowongan->max_pelamar }}<br>
                        Berlaku Hingga: {{ $lowongan->tanggal_selesai }}
                    </p>
                    <p><strong>Maksimal Kuota Pelamar:</strong> {{ $lowongan->max_pelamar }}</p>
                    <p><strong>Range Gaji Pekerjaan:</strong> Rp{{ number_format($lowongan->gaji_terendah, 0, ',', '.') }} - Rp{{ number_format($lowongan->gaji_tertinggi, 0, ',', '.') }}</p>
                </div>
            </div>

            <hr>

            <h5>Deskripsi Pekerjaan</h5>
            <p>{{ strip_tags($lowongan->detail_s) }}</p>

            <h5>Kriteria Pelamar</h5>
            {!! $lowongan->detail !!}

            <div class="text-center mt-4">
                @if($status == 'Penuh')
                <button type="button" class="btn btn-primary btn-lg" onclick="showFullAlert()">Lamar Sekarang</button>
                @elseif($status == 'Kadaluarsa')
                <button type="button" class="btn btn-primary btn-lg" onclick="showExpiredAlert()">Lamar Sekarang</button>
                @elseif($status == 'Akan Datang')
                <button type="button" class="btn btn-primary btn-lg" onclick="showComingSoonAlert()">Lamar Sekarang</button>
                @else
                @if(Auth::check() && $applied)
                <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#hasilLamaranModal">
                    Lihat Hasil Seleksi
                </button>
                @else
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#lamarModal">
                    Lamar Sekarang
                </button>
                @endif
                @endif
            </div>

        </div>
    </div>

    <!-- Modal Lamar -->
    <div class="modal fade" id="lamarModal" tabindex="-1" aria-labelledby="lamarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="lamarModalForm" action="{{ route('lowongan.apply', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="lamarModalLabel">Form Lamar Pekerjaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nama Lengkap -->
                        <div class="mb-3">

                            <input type="text" class="form-control readonly-input" id="id_lowongan" name="id_lowongan" value="{{ $lowongan->id }}" readonly>
                            <br>
                            <input type="text" class="form-control readonly-input" id="id_pelamar" name="id_pelamar" value="{{ Auth::user()->id }}" readonly>

                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control readonly-input" id="nama_lengkap" name="nama_lengkap" value="{{ Auth::user()->nama }}" readonly>
                        </div>
                        <!-- Tempat dan Tanggal Lahir -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Anda" required></textarea>
                        </div>
                        <!-- Upload CV -->
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Upload Foto </label>
                            <div class="upload-container text-center p-4">
                                <label for="upload-input" class="d-block border border-dashed p-4 rounded">
                                    <div class="upload-icon mb-2">
                                        <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                    </div>
                                    <p class="mb-1" style="font-size: 20px;">Taruh CV anda di sini</p>
                                    <p class="text-muted" style="font-size: 12px;">Format file: JPG, PNG, SVG</p>
                                    <span class="btn btn-primary">Pilih File</span>

                                    @error('file_cv')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </label>
                                <input type="file" id="upload-input" name="file_cv" class="d-none" accept="image/*">
                                <div id="preview-container" class="position-relative mt-3" style="display: none;">
                                    <img id="preview-image" src="" alt="Pratinjau Gambar" style="max-width: 100%; max-height: 150px; border-radius: 5px;">
                                    <button type="button" id="cancel-upload" class="btn-close position-absolute top-0 end-0" style="background-color: white; border: 1px solid #ccc;"></button>
                                </div>
                                <div id="fileError" class="text-danger mt-2" style="display: none;">Format file tidak didukung atau ukuran file terlalu besar.</div>
                            </div>

                            <div id="fileError" class="text-danger mt-2" style="display: none;">Format file tidak didukung atau ukuran file terlalu besar.</div>
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control readonly-input" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08XX XXXX XXXX" required>
                        </div>
                        <!-- NIK -->
                        <div class="mb-3">
                            <label for="NIK" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="NIK" name="NIK" placeholder="Masukkan Nomor KTP" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitForm">Kirim Lamaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Modal Lamar -->

    <!-- Modal Hasil Seleksi -->
    <div class="modal fade" id="hasilLamaranModal" tabindex="-1" aria-labelledby="hasilLamaranModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Menggunakan modal-lg agar lebih lebar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hasilLamaranModalLabel">Detail Hasil Seleksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Menggunakan container fluid agar tampilan responsive -->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Biodata Perusahaan -->
                            <div class="col-md-4">
                                <h6>Biodata Perusahaan</h6>
                                <hr>
                                <!-- Misalnya field di lowongan untuk data perusahaan -->
                                <p><strong>Nama perusahaan:</strong> {{ $lowongan->judul ?? 'Belum diisi' }}</p>
                                <p><strong>Alamat perusahaan:</strong> {{ $lowongan->alamat ?? 'Belum diisi' }}</p>
                                <p><strong>Deskripsi:</strong> {{strip_tags($lowongan->detail_s) ?? 'Belum diisi' }}</p>
                            </div>
                            <!-- Biodata Pelamar -->
                            <div class="col-md-4">
                                <h6>Biodata Pelamar</h6>
                                <hr>
                                <!-- Mengambil data dari user yang login dan data lamaran -->
                                <p><strong>Nama:</strong> {{ $applied->nama_lengkap ?? 'Belum diisi' }}</p>
                                <p><strong>Email:</strong> {{ $applied->email ?? 'Belum diisi' }}</p>
                                <p><strong>No. HP:</strong> {{ $applied->no_hp ?? 'Belum diisi' }}</p>
                                <p><strong>NIK:</strong> {{ $applied->NIK ?? 'Belum diisi' }}</p>
                            </div>
                            <!-- Data dan Tujuan Lamaran -->
                            <div class="col-md-4">
                                <h6>Tujuan & Status Lamaran</h6>
                                <hr>
                                <!-- Asumsikan ada field tujuan_lamaran di tabel apply_loker -->
                                <p><strong>Tujuan Lamaran:</strong></p>
                                <p>{{ $applied->tujuan_lamaran ?? 'Melamar Pekerjaan' }}</p>

                                <hr>
                                <!-- Status Seleksi -->
                                <p><strong>Status Seleksi:</strong> {{ $applied->status ?? 'Belum ada status' }}</p>

                                <!-- Catatan -->
                                <!-- <p><strong>Catatan:</strong> {{ $applied->catatan ?? '-' }}</p> -->

                                @if($applied)
                                <!-- Status Seleksi -->
                                <!-- <p><strong>Status Seleksi:</strong> {{ $applied->status ?? 'Belum ada status' }}</p> -->

                                <!-- Catatan -->
                                <!-- <p><strong>Catatan:</strong> {{ $applied->catatan ?? '-' }}</p> -->

                                <!-- Pesan berdasarkan status -->
                                @if($applied->status === 'ditolak')
                                <div class="alert alert-danger mt-2">
                                    Maaf, Anda tidak lolos seleksi. Semangat terus dan jangan menyerah! 💪
                                </div>
                                @elseif($applied->status === 'diterima')
                                <div class="alert alert-success mt-2">
                                    Selamat, Anda diterima! 🎉<br>
                                    Untuk proses lebih lanjut, silakan datang ke kantor BKK SMKN 2 Kota Bekasi.
                                </div>
                                @endif
                                @else
                                <p><em>Anda belum pernah melamar di perusahaan ini.</em></p>
                                @endif

                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end container-fluid -->
                </div> <!-- end modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <!-- Jika perlu CRUD (misalnya link untuk edit data lamaran) -->
                    @if(Auth::check() && $applied && $applied->status === 'menunggu')
                    <a href="{{ route('lamaran.edit', $applied->id) }}" class="btn btn-primary">Edit Data Lamaran</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.7/quill.bubble.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showFullAlert() {
        Swal.fire({
            title: 'Pekerjaan Penuh',
            text: 'Lamaran untuk pekerjaan ini sudah penuh.',
            icon: 'error',
            confirmButtonText: 'Tutup'
        });
    }

    function showExpiredAlert() {
        Swal.fire({
            title: 'Lowongan Kadaluarsa',
            text: 'Lowongan ini sudah kadaluarsa dan tidak dapat dilamar.',
            icon: 'error',
            confirmButtonText: 'Tutup'
        });
    }

    function showComingSoonAlert() {
        Swal.fire({
            title: 'Lowongan Akan Datang',
            text: 'Lowongan ini akan dibuka dalam waktu dekat. Silakan cek kembali nanti.',
            icon: 'info',
            confirmButtonText: 'Tutup'
        });
    }
</script>
<!-- Script untuk SweetAlert berdasarkan session -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitForm');
        const form = document.getElementById('lamarModalForm');
        const uploadInput = document.getElementById('upload-input');
        const fileError = document.getElementById('fileError');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const cancelUpload = document.getElementById('cancel-upload');

        // Preview gambar sebelum diupload
        uploadInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const allowedFormats = ['image/jpeg', 'image/png', 'image/svg+xml'];
            const maxSize = 4 * 1024 * 1024;

            fileError.style.display = 'none';
            previewContainer.style.display = 'none';

            if (file) {
                if (!allowedFormats.includes(file.type) || file.size > maxSize) {
                    fileError.style.display = 'block';
                    uploadInput.value = '';
                } else {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Batalkan upload
        cancelUpload.addEventListener('click', function() {
            previewContainer.style.display = 'none';
            previewImage.src = '';
            uploadInput.value = '';
        });

        // Validasi form dan kirim
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            let isValid = true;
            const requiredInputs = form.querySelectorAll("input[required], textarea[required]");

            requiredInputs.forEach(function(input) {
                if (input.value.trim() === "") {
                    isValid = false;
                    input.classList.add("is-invalid");
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            // Validasi upload file
            const file = uploadInput.files[0];
            const allowedFormats = ['image/jpeg', 'image/png', 'image/svg+xml'];
            const maxSize = 4 * 1024 * 1024;

            if (!file || !allowedFormats.includes(file.type) || file.size > maxSize) {
                isValid = false;
                fileError.style.display = 'block';
            } else {
                fileError.style.display = 'none';
            }

            if (isValid) {
                Swal.fire({
                    icon: 'success',
                    title: 'Form berhasil dikirim!',
                    text: 'Data Anda telah berhasil dikirim.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // $('#lamarModal').modal('hide');
                        setTimeout(() => {
                            form.submit();
                        }, 300);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Pastikan semua kolom terisi dan gambar valid!'
                });
            }
        });
    });
</script>

@endsection