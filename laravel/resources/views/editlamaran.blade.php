@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Lamaran ke {{ $lamaran->loker->nama_perusahaan }}</h3>

    @if ($locked)
    <div class="alert alert-warning">
        Anda tidak dapat mengedit lamaran ini karena sudah melewati batas waktu edit (2 hari).
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5>Biodata Anda</h5>
            <p><strong>Nama:</strong> {{ $lamaran->nama_lengkap }}</p>
            <p><strong>Email:</strong> {{ $lamaran->email }}</p>
            <p><strong>Tempat/Tanggal Lahir:</strong> {{ $lamaran->tempat_lahir }}, {{ $lamaran->tanggal_lahir }}</p>
            <p><strong>Alamat:</strong> {{ $lamaran->alamat }}</p>
            <p><strong>No HP:</strong> {{ $lamaran->no_hp }}</p>
            <p><strong>NIK:</strong> {{ $lamaran->NIK }}</p>
            <p><strong>File CV:</strong> <a href="{{ asset('storage/' . $lamaran->file_cv) }}" target="_blank">Lihat CV</a></p>
        </div>
    </div>
    @else
    <form id="editForm" action="{{ route('lamaran.update', $lamaran->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Form inputan seperti nama, TTL, alamat, dll -->
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $lamaran->nama_lengkap }}" required>
        </div>

        <!-- TTL -->
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ $lamaran->tempat_lahir }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $lamaran->tanggal_lahir }}" required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $lamaran->alamat }}</textarea>
        </div>

        <!-- NIK -->
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="NIK" class="form-control" value="{{ $lamaran->NIK }}" required>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $lamaran->no_hp }}" required>
        </div>

        <!-- Upload CV -->
        <div class="mb-3">
            <label>File CV (opsional)</label>
            <input type="file" name="file_cv" class="form-control">
            @if ($lamaran->file_cv)
            <small class="text-muted">CV saat ini: <a href="{{ asset('storage/' . $lamaran->file_cv) }}" target="_blank">Lihat CV</a></small>
            @endif
        </div>

        <button type="button" class="btn btn-success" onclick="konfirmasiEdit()">Update Lamaran</button>
    </form>
    @endif
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fungsi untuk konfirmasi sebelum mengupdate
    function konfirmasiEdit() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Perubahan ini akan disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form jika konfirmasi diterima
                document.getElementById('editForm').submit();
            }
        });
    }

    // Menampilkan SweetAlert berdasarkan session success/error
    const success = document.body.dataset.success;
    const error = document.body.dataset.error;

    if (success) {
        Swal.fire({
            title: 'Berhasil!',
            text: success,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } else if (error) {
        Swal.fire({
            title: 'Gagal!',
            text: error,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
</script>